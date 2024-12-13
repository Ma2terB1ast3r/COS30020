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
        <h1>Friend List</h1>
        <?php
            require_once("config.php");
            // Check if the user is logged in
            if (isset($_SESSION['id'])) {
                // Remove friend if form submitted
                if (isset($_POST['friend_id'])) {
                    // Remove friend from myfriends table
                    $conn = new mysqli($host, $user, $pswd, $dbnm);
                    $id = $_SESSION['id'];
                    $friend_id = $_POST['friend_id'];
                    $stmt = $conn->prepare("DELETE FROM myfriends WHERE (friend_id1 = ? AND friend_id2 = ?) OR (friend_id1 = ? AND friend_id2 = ?)");
                    $stmt->bind_param("iiii", $id, $friend_id, $friend_id, $id);
                    $stmt->execute();
                    $stmt->close();
                    // Update friend count for both users
                    $stmt = $conn->prepare("UPDATE friends SET num_of_friends = num_of_friends - 1 WHERE friend_id = ?");
                    $stmt->bind_param("i", $id); // Current user
                    $stmt->execute();
                    $stmt->bind_param("i", $friend_id); // Old friend
                    $stmt->execute();
                    $stmt->close();
                }

                // List all friends
                $conn = @mysqli_connect($host, $user, $pswd, $dbnm);
                $id = $_SESSION['id'];
                $stmt = $conn->prepare("SELECT DISTINCT f.friend_email, f.friend_id, f.profile_name # Select friend email (that isn't a duplicate)
                                                FROM myfriends mf # Alias for myfriends table
                                                JOIN friends f ON (mf.friend_id1 = f.friend_id OR mf.friend_id2 = f.friend_id) # Join friends table on friend_id1 or friend_id2
                                                WHERE (mf.friend_id1 = ? OR mf.friend_id2 = ?) AND f.friend_id != ? "); # Select friends of the current user
                $stmt->bind_param("iii", $id, $id, $id);
                $stmt->execute();
                $stmt->store_result();
                // Display friends
                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($friend_email, $friend_id, $profile_name);
                    // Opening tags for the table/form
                    echo("<form method='POST' action='friendlist.php'><table>");
                    echo("<tr><th>Profile Name</th></tr>");
                    // Display each friend
                    while ($stmt->fetch()) {
                        echo("<tr><td>$profile_name</td><td><button name='friend_id' value='$friend_id'>Unfriend</button></td></tr>");
                    }
                    // Closing tags for the table/form
                    echo("</table></form>");
                } else {
                    // Display message if no friends
                    echo("<p>No friends</p>");
                }
                $stmt->close();
            } else {
                // Redirect to login if not logged in
                header("Location: login.php");
            }
        ?>
    </main>
</body>
</html>