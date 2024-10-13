<?php
session_start();

// Base URL of your localhost environment
$baseUrl = '/scr-fiver-home';

// List of pages where user activity should be tracked (adjust as needed)
$trackedPages = [
    $baseUrl . '/index.html',
    $baseUrl . '/sign-in.html',
    $baseUrl . '/login.html',
    $baseUrl . '/index2.html',
    $baseUrl . '/confirm.html',
    $baseUrl . '/test.php',
    $baseUrl . '/confirm2.html'
];

// Get the current page URI without the domain part
$requestedUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
echo $requestedUri . ' --- '. $trackedPages[5];

// Check if the current page should be tracked
if (in_array($requestedUri, $trackedPages)) {
    echo 'hello';
    exit; 
    // Get the user's IP address and user agent
    $userIp = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $userId = md5($userIp . $userAgent); // Create a unique identifier based on IP and user agent

    // Path to the file where active user data will be stored
    $file = 'active_users.json';

    // Load existing active user data
    if (file_exists($file)) {
        $activeUsers = json_decode(file_get_contents($file), true) ?: [];
    } else {
        $activeUsers = [];
    }

    // Update the user's last activity time
    $activeUsers[$userId] = [
        'ip' => $userIp,
        'userAgent' => $userAgent,
        'lastActivity' => time()
    ];

    // Remove users who have been inactive for more than 30 seconds
    $activeUsers = array_filter($activeUsers, function($user) {
        return (time() - $user['lastActivity']) < 30;
    });

    // Save the updated active user data
    if (file_put_contents($file, json_encode($activeUsers)) === false) {
        // Handle error if file_put_contents fails
        $error = error_get_last();
        error_log('Failed to write to active_users.json: ' . $error['message']);
    }

    // Prepare the response data
    $responseData = [];
    $sequence = 1;
    foreach ($activeUsers as $id => $user) {
        $responseData[] = [
            'sequence' => $sequence++,
            'ip' => $user['ip'],
            'lastActivity' => date('Y-m-d H:i:s', $user['lastActivity'])
        ];
    }

    // Output the list of active users with sequence numbers and last activity times
    header('Content-Type: application/json');
    echo json_encode($responseData);
} else {
    // If the page is not in the trackedPages list, return an empty response or handle accordingly
    header('Content-Type: application/json');
    echo json_encode([]);
}
?>
