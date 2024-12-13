<!-- Name - ID (31/07/2024) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Web, Web Programming">
    <meta name="author" content="Name - ID">
    <title>Lab 02 - Arrays and Variables</title>
</head>
<body>
    <?php
        $input = 2.4; // Default input
        $input_unaltered = 2.4;    

        if (isset($_GET["input"])       ) { // If user gives form input then change the variable
            $input = $_GET["input"]; // Get input from form
            $input_unaltered     = $_GET["input"];
        };

        if (is_numeric($input)) {
            if (is_float($input+0)) { // Convert input to int if float
                $input = (int) round($input);
            };
        };

        if (is_numeric($input)) { // If the input is a number
            $half_input = $input / 2; // Halves input
            $is_even = is_integer($half_input); // Checks if input is even
            ($is_even) // check status
                ? $status = "even"
                : $status = "not even";
            echo "<p>The variable $input_unaltered is $status.</p>";
            return;
        } else { // If the input is not a number
            echo "<p>The variable $input_unaltered is not a number.</p>";
            return;
        }

    ?>
</body>
</html>