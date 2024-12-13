<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Name - ID">
    <title>standardpalindromeadvanced</title>
</head>
<body>
    <h1>Standard Palindrome Advanced</h1>
    <form action="#" method="POST">
        <label for="input">Enter a string:</label>
        <input type="text" id="input" name="input" required>
        <input type="submit" value="Submit">
    </form>
    <?php
        if (isset($_POST["input"])) {
            $input = $_POST["input"];
            $input = str_replace([" ", ".", ",", "!", "?", "-"], "", $input);
            $reverse = strrev($input);
            if (strcmp($input, $reverse) == 0) {
                echo "<p>$input is a perfect palindrome.</p>";
            } else {
                echo "<p>$input is not a perfect palindrome.</p>";
            }
        } else {
            //      echo "<p>input is empty.</p>";
        }
    ?>
</body>
</html>