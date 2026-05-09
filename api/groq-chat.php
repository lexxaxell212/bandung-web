<?php
require_once '../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit(0);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'POST only']);
    exit();
}

// APIKEY
$API_KEY = GROQ_API;

$input = json_decode(file_get_contents('php://input'), true);
$message = trim($input['message'] ?? '');
$topic = strtolower($input['topic'] ?? '');

if (empty($message)) {
    echo json_encode(['error' => 'Message required']);
    exit();
}

// Custom System Prompts
$system_prompts = [
    'bandung' => "
        [IDENTITY]
        Nama: Yara (Asisten AyoKeBandung.id). 
        Filosofi Nama: 'Yuk Arahkan Rute Andalan'. Yara melambangkan cahaya & keramahan Mojang Bandung.
        Peran: Tour guide digital, ahli kuliner, sejarah, & tren Bandung 2026.

        [CONVERSATIONAL]
        - Jika ditanya 'Siapa/Kenapa Yara?': Jawab singkat bahwa Yara adalah singkatan 'Yuk Arahkan Rute Andalan', asisten yang siap jadi 'cahaya' pemandu liburan di Bandung.
        - Tone: Ramah, santun (Nyunda), panggil 'Akang/Teteh'.
        - Gaya: Manusiawi, bukan robot. Jika disapa/tanya kabar, balas dulu dengan hangat sebelum masuk ke info wisata.

        [SCOPE]
        - Fokus: Bandung Raya (Kota, Lembang, Ciwidey, Pangalengan).
        - Update 2026: Info Whoosh, event terbaru, & hidden gems.
        - Bahasa: Indonesia natural + sedikit istilah Sunda (Wilujeng sumping, Hatur nuhun).

        [RULE]
        Jika di luar topik Bandung, arahkan kembali dengan sopan ke pesona Kota Kembang.
    "
];

$system_prompt = $system_prompts[$topic];

$data = [
    'messages' => [
        ['role' => 'system', 'content' => $system_prompt],
        ['role' => 'user', 'content' => $message]
    ],
    'model' => 'llama-3.1-8b-instant', 
    'max_tokens' => 350,
    'temperature' => 0.7,
    'stream' => false
];

$ch = curl_init('https://api.groq.com/openai/v1/chat/completions');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . $API_KEY,
        'Content-Type: application/json'
    ],
    CURLOPT_TIMEOUT => 20
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http_code === 200) {
    $result = json_decode($response, true);
    $reply = $result['choices'][0]['message']['content'] ?? 'No response';
    
    echo json_encode([
        'success' => true,
        'reply' => trim($reply),
        'model' => $data['model'],
        'tokens' => $result['usage']['total_tokens'] ?? 0,
        'topic' => ucfirst($topic)
    ]);
} else {
    $error = json_decode($response, true)['error']['message'] ?? 'Unknown error';
    echo json_encode([
        'success' => false,
        'error' => "HTTP $http_code: $error"
    ]);
}
?>