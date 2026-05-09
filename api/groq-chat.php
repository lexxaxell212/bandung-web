<?php
require_once '../config.php';

const GROQ_ENDPOINT      = 'https://api.groq.com/openai/v1/chat/completions';
const GROQ_MODEL         = 'llama-3.1-8b-instant';
const MAX_TOKENS         = 350;
const TEMPERATURE        = 0.7;
const CURL_TIMEOUT       = 20;
const MAX_MESSAGE_LENGTH = 500;
const ALLOWED_ORIGIN     = 'https://ayokebandung.id';
const DEV_MODE           = false;

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: ' . ALLOWED_ORIGIN);
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit(0);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(405, ['error' => 'Method not allowed. Use POST.']);
}

function respond(int $code, array $body): never {
    http_response_code($code);
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit();
}

$system_prompts = [
    'bandung' => <<<PROMPT
Kamu adalah Yara, asisten wisata resmi AyoKeBandung.id. YARA = "Yuk Arahkan Rute Andalan".

KEPRIBADIAN:
- Hangat, ramah seperti Mojang Bandung. Panggil user "Akang" (pria) atau "Teteh" (wanita). Jika tidak tahu gender, gunakan "Sobat".
- Boleh sisipkan kata Sunda ringan: "Wilujeng", "Hatur nuhun", "Mangga" — tapi tetap utamakan Bahasa Indonesia yang natural.
- Jika user menyapa atau tanya kabar: balas hangat singkat, lalu tawarkan bantuan wisata. JANGAN langsung ceramah soal tempat wisata tanpa merespons sapaannya.

KEAHLIAN (fokus HANYA pada ini):
- Destinasi wisata Bandung Raya: Kota Bandung, Lembang, Ciwidey, Pangalengan, Subang Selatan.
- Kuliner khas & hits Bandung (termasuk yang viral 2025–2026).
- Transportasi: Whoosh (KA Cepat Jakarta–Bandung), angkot, ojek online, rute tol.
- Event & festival Bandung terbaru.
- Tips perjalanan: waktu terbaik kunjungan, estimasi budget, hidden gems.

FORMAT JAWABAN:
- Gunakan emoji secukupnya untuk keterbacaan (🌿🍜🚂).
- Jika merekomendasikan tempat, sebutkan: nama tempat → lokasi singkat → keunggulan.
- Jawab ringkas (2–4 paragraf). Jangan bertele-tele.
- Jika info tidak pasti (misal harga tiket), katakan "sekitar" atau sarankan cek langsung.

BATASAN KETAT:
- JANGAN menjawab pertanyaan di luar topik Bandung & wisata (politik, coding, matematika, dll).
- Jika ada pertanyaan di luar topik, HARUS redirect dengan kalimat seperti:
  "Wah, pertanyaannya seru Akang/Teteh, tapi Yara lebih jago soal Bandung nih 😄 Ada yang ingin Akang/Teteh eksplor di Kota Kembang?"
- JANGAN mengarang fakta. Jika tidak tahu, katakan jujur dan sarankan cek sumber resmi.
- JANGAN menyebut kompetitor (website/aplikasi wisata lain) secara positif.
PROMPT
];

$input = json_decode(file_get_contents('php://input'), true);

if (!is_array($input)) {
    respond(400, ['error' => 'Invalid JSON body.']);
}

$message = trim($input['message'] ?? '');
$topic   = preg_replace('/[^a-z0-9\-]/', '', strtolower($input['topic'] ?? '')); 

if (empty($message)) {
    respond(400, ['error' => 'Field "message" wajib diisi.']);
}

if (mb_strlen($message) > MAX_MESSAGE_LENGTH) {
    respond(400, ['error' => 'Pesan terlalu panjang. Maksimal ' . MAX_MESSAGE_LENGTH . ' karakter.']);
}

if (!isset($system_prompts[$topic])) {
    $validTopics = implode(', ', array_keys($system_prompts));
    respond(400, ['error' => "Topic '$topic' tidak dikenali. Topic tersedia: $validTopics."]);
}

$payload = [
    'model'       => GROQ_MODEL,
    'max_tokens'  => MAX_TOKENS,
    'temperature' => TEMPERATURE,
    'stream'      => false,
    'messages'    => [
        ['role' => 'system', 'content' => $system_prompts[$topic]],
        ['role' => 'user',   'content' => $message]
    ]
];

$ch = curl_init(GROQ_ENDPOINT);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => json_encode($payload),
    CURLOPT_HTTPHEADER     => [
        'Authorization: Bearer ' . GROQ_API,
        'Content-Type: application/json'
    ],
    CURLOPT_TIMEOUT        => CURL_TIMEOUT
]);

$response  = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_err  = curl_errno($ch);
$curl_msg  = curl_error($ch);
curl_close($ch);

if ($curl_err !== 0) {
    $debugInfo = DEV_MODE ? ['curl_error' => $curl_msg] : [];
    respond(503, array_merge([
        'success' => false,
        'error'   => 'Gagal menghubungi layanan AI. Silakan coba lagi.'
    ], $debugInfo));
}

$result = json_decode($response, true);

if ($http_code === 200 && isset($result['choices'][0]['message']['content'])) {
    $reply = trim($result['choices'][0]['message']['content']);
    respond(200, [
        'success' => true,
        'reply'   => $reply,
        'model'   => GROQ_MODEL,
        'tokens'  => $result['usage']['total_tokens'] ?? 0,
        'topic'   => ucfirst($topic)
    ]);
} else {
    $errorMsg  = $result['error']['message'] ?? 'Unknown error dari Groq API.';
    $debugInfo = DEV_MODE ? ['raw' => $result] : [];
    respond($http_code ?: 502, array_merge([
        'success' => false,
        'error'   => "HTTP $http_code: $errorMsg"
    ], $debugInfo));
}