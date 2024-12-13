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
    <?php
        $filename = "../../data/guestbook.txt"; //TODO: THIS IS TEMPORARY
        $alldata = array(); // create an empty array

        if (file_exists($filename)) { // check if file exists for reading
            $namedata = array(); // create an empty array
            $handle = fopen($filename, "r"); // open the file in read mode
            while (!feof($handle)) { // loop while not end of file
                $onedata = fgets($handle); // read a line from the text file
                if ($onedata != "") { // ignore blank lines
                    $data = explode(",", $onedata); // explode string to array
                    $alldata[] = $data; // create an array element
                    $namedata[] = $data[0]; // create a string element
                    $emaildata[] = $data[1]; // create a string element
                }
            }
            fclose($handle); // close the text file
        }

        sort($alldata); // sort array elements
        echo "<p>Guest book</p>";
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Email</th></tr>";
        foreach ($alldata as $data) { // loop using for each
            echo "<tr><td>", htmlspecialchars($data[0]), "</td><td>", htmlspecialchars($data[1]), "</td></tr>";
        }
        echo "</table>";
    ?>
    <a href="guestbookform.php">Add another visitor</a>
</body>
</html>