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
        <h1>Add a friend</h1>
        <?php
            // List all friends that are not already friends
            require_once("config.php");
            $conn = new mysqli($host, $user, $pswd, $dbnm);

            // Check if the connection failed and display an error message
            if (!$conn) {
                echo("<p>Database connection failure</p>");
            } else {
                // Check if the user is logged in
                if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];

                    // Add friend if form submitted
                    if (isset($_POST['friend_id'])) {
                        // Add friend to myfriends table
                        $friend_id = $_POST['friend_id'];
                        $stmt = $conn->prepare("INSERT INTO myfriends (friend_id1, friend_id2) VALUES (?, ?)");
                        $stmt->bind_param("ii", $id, $friend_id);
                        $stmt->execute();
                        $stmt->close();
                        // Update friend count for both users
                        $stmt = $conn->prepare("UPDATE friends SET num_of_friends = num_of_friends + 1 WHERE friend_id = ?");
                        $stmt->bind_param("i", $id); // Current user
                        $stmt->execute();
                        $stmt->bind_param("i", $friend_id); // New friend
                        $stmt->execute();
                        $stmt->close();
                    }

                    // Page init
                    $limit = 11; // Number of friends per page (is one more than displayed to know if there is a next page)
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page, default to 1
                    $offset = ($page - 1) * ($limit - 1); // Offset for SQL query

                    // Get list of people not already friends
                    $stmt = $conn->prepare("
                        SELECT f.friend_id, f.profile_name, f.friend_email # Select required fields
                        FROM friends f # Alias for friends table
                        LEFT JOIN myfriends mf1 ON f.friend_id = mf1.friend_id1 AND mf1.friend_id2 = ? # Join myfriends table on friend_id1 and friend_id2 is the current user
                        LEFT JOIN myfriends mf2 ON f.friend_id = mf2.friend_id2 AND mf2.friend_id1 = ? # Join myfriends table on friend_id2 and friend_id1 is the current user
                        WHERE f.friend_id != ? AND mf1.friend_id1 IS NULL AND mf2.friend_id2 IS NULL # Select people that are not the current user and not already friends
                        LIMIT ? OFFSET ? # Limit results to 10 per page
                    ");
                    $stmt->bind_param("iiiii", $id, $id, $id, $limit, $offset);
                    $stmt->execute();
                    $stmt->store_result();

                    // Display list of people not already friends
                    if ($stmt->num_rows > 0) {
                        $stmt->bind_result($friend_id, $profile_name, $friend_email);
                        // Opening tags for the form and table
                        echo("<form action='friendadd.php' method='POST'><table>");
                        echo("<tr><th>Profile Name</th><th>Mutual Friends</th></tr>");

                        // Display each person
                        $i = 0; // Used to prevent the last one from being displayed (needed because I fetch 11 to know if there is a next page)
                        while ($stmt->fetch()) {
                            if ($i == $limit - 1) {
                                break;
                            }
                            $i++;
                            $stmt2 = $conn->prepare("SELECT f1.user2 AS mutual_friend
                                                            FROM (
                                                                SELECT friend_id1 AS user1, friend_id2 AS user2 FROM myfriends
                                                                UNION
                                                                SELECT friend_id2 AS user1, friend_id1 AS user2 FROM myfriends
                                                            ) AS f1
                                                            JOIN (
                                                                SELECT friend_id1 AS user1, friend_id2 AS user2 FROM myfriends
                                                                UNION
                                                                SELECT friend_id2 AS user1, friend_id1 AS user2 FROM myfriends
                                                            ) AS f2
                                                            ON f1.user2 = f2.user2
                                                            WHERE f1.user1 = ?
                                                            AND f2.user1 = ?;");
                            $stmt2->bind_param("ii", $id, $friend_id);
                            $stmt2->execute();
                            $stmt2->store_result();
                            $mutualFriends = $stmt2->num_rows;
                            echo("<tr><td>$profile_name</td><td>$mutualFriends</td><td><button name='friend_id' type='submit' value='$friend_id'>Add Friend</button></td></tr>");
                        }

                        // Closing tags for the form and table
                        echo("</table></form>");

                        // Page controls
                        $prevPage = $page > 1 ? $page - 1 : 1;
                        $nextPage = $page + 1;
                        echo("<div>");
                        // Only display previous if not on the first page
                        if ($page > 1) {
                            echo("<a href='friendadd.php?page=$prevPage'>Previous Page</a> ");
                        }
                        // Only display next if there are more results
                        if ($stmt->num_rows == $limit) {
                            echo("<a href='friendadd.php?page=$nextPage'>Next Page</a>");
                        }
                        echo("</div>");
                    } else {
                        // No friends to add (probably either the user is already friends with everyone or there are no other people in the database)
                        echo("<p>No friends to add</p>");
                    }
                    $stmt->close();

                    } else {
                        // Redirect to login if not logged in
                        header("Location: login.php");
                }
            }
        ?>
    </main>
</body>
</html>