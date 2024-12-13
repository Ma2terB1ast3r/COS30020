<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Name - ID">
    <title>perfectpalindrome</title>
</head>
<body>
    <h1>Perfect Palindrome</h1>
    <?php
        if (isset($_POST["input"])) {
            $input = $_POST["input"];
            $reverse = strrev($input);
            if (strcmp($input, $reverse) == 0) {
                echo "<p>$input is a perfect palindrome.</p>";
            } else {
                echo "<p>$input is not a perfect palindrome.</p>";
            }
        } else {
            echo "<p>input is empty.</p>";
        }
    ?>
</body>
</html>