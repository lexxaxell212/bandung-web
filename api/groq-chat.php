<?php
// api/groq-chat.php - Groq LPU Turbo Fast!
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

// GANTI DENGAN API KEY ANDA!
$API_KEY = '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'; // 47 characters

$input = json_decode(file_get_contents('php://input'), true);
$message = trim($input['message'] ?? '');
$topic = strtolower($input['topic'] ?? '');

if (empty($message)) {
    echo json_encode(['error' => 'Message required']);
    exit();
}

// Custom System Prompts per TOPIC
$system_prompts = [
    'bandung' => "Anda adalah AI Kota Bandung - panduan lengkap tentang Kota Bandung, Jawa Barat. Jawab:
    - Semua pertanyaan tentang kota bandung
    - Destinasi wisata di Kota Bandung
    - Kuliner di Bandung
    - Tour Guide Bandung profesional
    - Ahli sejarah & budaya Bandung
    - Rekomendasi kuliner, wisata, hotel
    - Info cuaca, transportasi
    - Tone: Enthusiastic, welcoming, local pride, Bahasa Indonesia natural + santai",
];

$system_prompt = $system_prompts[$topic];

// Groq API - Model tercepat!
$data = [
    'messages' => [
        ['role' => 'system', 'content' => $system_prompt],
        ['role' => 'user', 'content' => $message]
    ],
    'model' => 'llama-3.1-8b-instant', // Super fast!
    'max_tokens' => 500,
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