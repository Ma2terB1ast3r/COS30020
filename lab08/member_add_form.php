<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="Name - ID">
<title>Wk8 - VIP Members</title>
</head>
<body>
    <h1>Web Programming - Lab08 - VIP Members Page</h1>
    <form action="member_add.php" method="POST">
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" maxlength="40" required><br>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" maxlength="40" required><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="M">Male</option>
            <option value="F">Female</option>
            <option value="O">Other</option>
        </select><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" maxlength="40" required><br>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" maxlength="20" required><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>