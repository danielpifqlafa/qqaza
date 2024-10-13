<?php
// Check for required parameters
if (isset($_GET['userId']) && isset($_GET['page'])) {
    $userId = $_GET['userId'];
    $page = $_GET['page'];

    // Load active user data from JSON
    $file = 'active_users.json';
    $activeUsers = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    // Update the redirection URL for the specified user
    if (isset($activeUsers[$userId])) {
        $activeUsers[$userId]['redirectionUrl'] = $page;
        
        // Save updated active user data back to JSON file
        if (file_put_contents($file, json_encode($activeUsers)) !== false) {
            http_response_code(200); // Success
        } else {
            http_response_code(500); // Server error
        }
    } else {
        http_response_code(404); // User not found
    }
} else {
    http_response_code(400); // Bad request
}
?>
