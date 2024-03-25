<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="authenticate.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>

        <input type="submit" value="Login">
    </form>

    <!-- Register Button -->
    <br>
    <a href="register.php">
        <button type="button">Register</button>
    </a>

    <a href="admin_login.php">
    <button type="button">Login as Administrator</button>
    </a>
    <a href="admin_register.php">
    <button type="button">Register as Administrator</button>
    </a>
</body>
</html>
