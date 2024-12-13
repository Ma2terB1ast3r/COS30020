<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Name - ID">
    <title>lab06</title>
</head>
<body>
    <h1>Web Programming - Lab06</h1>
    <a href="guestbookform.php">Add another visitor</a>
    <a href="guestbookshow.php">Show guest book</a>
    <?php // read the comments for hints on how to answer each name
        if (isset($_POST["name"]) && isset($_POST["email"])) { // check if both form data exists
            $name = $_POST["name"]; // obtain the form name data
            $email = $_POST["email"]; // obtain the form quantity data
            $regexp = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"; // regular expression for email
            if (preg_match($regexp, $email)) {
                // echo "<p>Email address is valid.</p>";
            } else {
                echo "<p>Email address is not valid.</p>";
                exit;
            }
            $filename = "../../data/guestbook.txt"; // assumes php file is inside lab06
            $alldata = array(); // create an empty array
            if (file_exists($filename)) { // check if file exists for reading
                $namedata = array(); // create an empty array
                $handle = fopen($filename, "r"); // open the file in read mode
                while (!feof($handle)) { // loop while not end of file
                    $onedata = fgets($handle); // read a line from the text file
                    if ($onedata != "") { // ignore blank lines
                        $onedata = trim($onedata); // remove leading and trailing spaces    
                        $data = explode(",", $onedata); // explode string to array
                        $alldata [] = $data; // create an array element
                        // print_r($data);
                        $namedata[] = $data [0]; // create a string element
                        $emaildata[] = $data [1]; // create a string element
                    }
                }
                fclose ($handle); // close the text file
                $newdata = !(in_array($name, $namedata) & in_array($email, $emaildata)); // check if name exists in array
                if ($email == $emaildata[0]) {
                    echo "<p style='color: red;'>That email already exists. Please go back and try again.</p>";
                    exit;
                }
            } else {
                $newdata = true; // file does not exists, thus it must be a new data
            }
            if ($newdata) {
                $handle = fopen($filename, "a"); // open the file in append mode
                $data = $name . "," . $email . "\n"; // concatenate name and email delimited
                // by comma
                fputs($handle, $data); // write string to text file
                fclose ($handle); // close the text file
                $alldata [] = array($name, $email); // add data to array
                echo "<p>Thank you for signing</p>";
            } else {
                echo "<p>You have already signed the guest book</p>";
            }
        } else { // no input
            echo "<p style='color: red;'>Please enter a name and email. Please go back and try again.</p>";
        }
    ?>
</body>
</html>