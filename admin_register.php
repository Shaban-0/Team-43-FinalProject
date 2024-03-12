<!-- This is a new file named admin_register.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Registration</title>
</head>
<body>
    <h1>Admin Registration</h1>
    <form action="process_admin_registration.php" method="post">

        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required>
        <br><br>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required>
        <br><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="mobile">Mobile:</label>
        <input type="text" id="mobile" name="mobile" required>
        <br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>

        <!-- Special code input field -->
        <label for="specialCode">Special Code:</label>
        <input type="text" id="specialCode" name="specialCode" required>
        <br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
