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
    <form action="#" method="GET">
        <label for="search">Search for last name:</label>
        <input type="text" id="search" name="search" maxlength="40" required><br>
        <input type="submit" value="Submit">
    </form>
    <?php
        // Check if the search term is set, if not set it to an empty string so that all members are displayed
        if (!isset($_GET["search"])) {
            // exit();
            $search_term = "";
        } else {
            $search_term = $_GET["search"];
        }

        // DB query and display
        require_once("settings.php");
        $conn = @mysqli_connect($host, $user, $pswd, $dbnm);
        if (!$conn) {
            echo "<p>Database connection failure</p>";
        } else {
            $query = "SELECT member_id, fname, lname, email FROM vipmembers WHERE lname LIKE '%$search_term%'";
            $result = mysqli_query($conn, $query);
            echo "<table border=\"1\"'>\n";
            echo "<tr>\n "
                . "<th scope=\"col\">Member ID</th>\n "
                . "<th scope=\"col\">First Name</th>\n "
                . "<th scope=\"col\">Last Name</th>\n "
                . "<th scope=\"col\">Email</th>\n "
                . "</tr>\n ";
            while ($row = mysqli_fetch_row($result)) {
                echo "<tr>\n ";
                echo "<td>", $row[0], "</td>\n ";
                echo "<td>", $row[1], "</td>\n ";
                echo "<td>", $row[2], "</td>\n ";
                echo "<td>", $row[3], "</td>\n ";
                echo "</tr>\n ";
            }
            mysqli_free_result($result);
            mysqli_close($conn);
        }
    ?>
</body>
</html>