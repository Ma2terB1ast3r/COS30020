<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Web Application Development :: Lab 3" />
<meta name="keywords" content="Web,programming" />
<title>Using if and while statements</title>
</head>
<body>
    <h1>Web Programming - Lab 3 - Leap year</h1>
    <?php
        if (isset ($_GET["year"])) { // check if form data exists
        $year = $_GET["year"]; // obtain the form data
            if (is_numeric($year) && $year > 0) { // check if $year is a number and is positive
                if ($year == round ($year)) { // check if $year is an integer

                        if ($year % 4 == 0) { // check if year is divisible by 4
                            if ($year % 100 == 0) { // check if year is divisible by 100
                                if ($year % 400 == 0) { // check if year is divisible by 400
                                    echo "<p>", $year, " is a leap year.</p>";
                                } else {
                                    echo "<p>", $year, " is not a leap year.</p>";
                                }
                            } else {
                                echo "<p>", $year, " is a leap year.</p>";
                            }
                        } else {
                            echo "<p>", $year, " is not a leap year.</p>";
                        }

                    } else { // year is not an integer
                        echo "<p>Please enter an integer.</p>";
                    }
                } else { // year is not positive
                    echo "<p>Please enter a positive integer. </p>";
                }
        } else { // no input
            echo "<p>Please enter a positive integer.</p>";
        }
    ?>
</body>
</html>