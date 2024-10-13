<?php

$file = 'active_users.json';
$jsonData = file_get_contents($file);

if ($jsonData === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to read active_users.json']);
    exit;
}

$decodedData = json_decode($jsonData, true);

if ($decodedData === null && json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500);
    echo json_encode(['error' => 'Invalid JSON format in active_users.json']);
    exit;
}

if (!is_array($decodedData)) {
    $decodedData = [];
}

$responseData = [];
$sequence = 1;
foreach ($decodedData as $userId => $userData) {
    $responseData[] = [
        'sequence' => $sequence++,
        'userId' => $userData['userId'],
        'activePage' => $userData['activePage'],
        'ip' => $userData['ip'],
        'lastActivity' => date('Y-m-d H:i:s', $userData['lastActivity'])
    ];
}

header('Content-Type: application/json');

echo json_encode($responseData);
?>
