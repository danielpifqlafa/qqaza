<?php
session_start();

// Base URL of your localhost environment
$baseUrl = '/Apply';

// List of pages where user activity should be tracked (adjust as needed)
$trackedPages = [
    $baseUrl . '/',
    $baseUrl . '/sign-in.php',
    $baseUrl . '/index.php',
    $baseUrl . '/login.php',
    $baseUrl . '/index2.php',
    $baseUrl . '/confirm.php',
    $baseUrl . '/confirm2.php',
    $baseUrl . '/loading.php'
];

$requestedUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Check if the current page should be tracked
if (in_array($requestedUri, $trackedPages)) {
    // Get the user's IP address and user agent
    $userIp = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $userId = md5($userIp . $userAgent); 
    $redirectionUrl = ''; 
    $activePage = basename($requestedUri); 
    $file = 'admin/active_users.json';

    $activeUsers = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    if (isset($activeUsers[$userId])) {
        $activeUsers[$userId]['lastActivity'] = time();
        
        if (!empty($redirectionUrl)) {
            $activeUsers[$userId]['redirectionUrl'] = $redirectionUrl;
        } else {
            $activeUsers[$userId]['redirectionUrl'] = isset($activeUsers[$userId]['redirectionUrl']) ? $activeUsers[$userId]['redirectionUrl'] : 'default.php';
        }
        
        $activeUsers[$userId]['activePage'] = $activePage; 
    } else {
        $activeUsers[$userId] = [
            'userId' => $userId,
            'ip' => $userIp,
            'userAgent' => $userAgent,
            'lastActivity' => time(),
            
            'redirectionUrl' => !empty($redirectionUrl) ? $redirectionUrl : 'login.php',
            
            'activePage' => $activePage 
        ];
    }

    $activeUsers = array_filter($activeUsers, function($user) {
        return (time() - $user['lastActivity']) < 30;
    });

    if (file_put_contents($file, json_encode($activeUsers)) === false) {
        $error = error_get_last();
        error_log('Failed to write to active_users.json: ' . $error['message']);
    }

}
?>
