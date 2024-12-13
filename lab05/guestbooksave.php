<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Name - ID">
    <title>lab05</title>
</head>
<body>
    <h1>Web Programming - Lab 5</h1>
    <a href="guestbookshow.php">Show Guest Book</a>
    <?php
        if (isset($_POST["fName"]) && isset($_POST["lName"])) { // check if both form data exists
            $fName = $_POST["fName"]; // obtain the form item data
            $lName = $_POST["lName"]; // obtain the form quantity data
            $filename = "../../data/lab05/guestbook.txt"; // assumes php file is inside lab05
            // $filename = "guestbook.txt";

            if (!file_exists("../../data/lab05")) {
                mkdir("../../data/lab05", 0777, true);
            }

            $handle = fopen($filename, "a"); // open the file in append mode
            $data = addslashes($fName . " " . $lName . "\n"); // concatenate item and qty delimited by comma
            fwrite($handle, $data); // write string to text file
            fclose($handle); // close the text file
            echo "<p>Thank you for signing</p> "; // generate guest book
        } else { // no input
            echo "<p style='color: red;'>Please enter a first name and last name.</p><a href='guestbookform.php' style='color: red;'>Click here to go back.</a>";
        }
    ?>
</body>
</html>