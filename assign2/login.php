<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Name - ID">
    <link rel="stylesheet" href="style.css">
    <title>Assignment 2</title>
</head>
<body>
    <main>
        <!-- Navbar -->
        <header>
            <?php
                require_once("functions/navbar.php");
                renderNavbar();
            ?>
        </header>

        <!-- Main content -->
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php if(isset($_POST['email'])){echo($_POST['email']);}?>"> <!-- Keep email in form if invalid -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </form>
        <?php
            require_once("config.php");
            // Check if the form was submitted properly
            if (isset($_POST['email']) && isset($_POST['password'])) {
                // Fetch form data
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Connect to the database
                $conn = new mysqli($host, $user, $pswd, $dbnm);
                if ($conn) {
                    $query = "SELECT friend_id FROM friends WHERE friend_email = ? AND password = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ss", $email, $password);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // If the query returns a single row, the user is authenticated
                    if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                        $id = $row['friend_id'];
                        // Setup session variables
                        $_SESSION['email'] = $email;
                        $_SESSION['id'] = $id;
                        header("Location: friendlist.php");
                    } else { // Display error message if authentication failed
                        echo("<p style='color: red;'>Invalid email or password</p>");
                    }
                    $result->free_result();
                    $conn->close();
                } else {
                    // Display error message if database connection failed
                    echo("<p style='color: red;'>Database connection failed</p>");
                }
            }
        ?>
        </main>
    </body>
</html>