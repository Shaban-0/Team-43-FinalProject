<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>
    <form action="admin_authenticate.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
