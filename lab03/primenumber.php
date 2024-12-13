<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Web Application Development :: Lab 3" />
<meta name="keywords" content="Web,programming" />
<title>Using if and while statements</title>
</head>
<body>
    <h1>Web Programming - Lab 3 - Prime Number</h1>
    <?php
        if (isset ($_GET["num"])) { // check if form data exists
        $num = $_GET["num"]; // obtain the form data
            if (is_numeric($num) && $num > 0) { // check if $num is a number and positive
                if ($num == round ($num)) { // check if $num is an integer

                    $count = $num; // declare and initialise the count variable
                    while ($count > 1) { // loop to check if number is prime
                        $count--; // next number
                        if ($count == 1) { // number is prime
                            echo "<p>", $num, " is a prime number.</p>";
                        } else if ($num % $count == 0) { // number is not prime
                            echo "<p>", $num, " is not a prime number.</p>";
                            break;
                        }
                    }

                    } else { // num is not an integer
                        echo "<p>Please enter an integer.</p>";
                    }
                } else { // num is not positive
                    echo "<p>Please enter a positive integer. </p>";
                }
        } else { // no input
            echo "<p>Please enter a positive integer.</p>";
        }
    ?>
</body>
</html>