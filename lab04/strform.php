<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="Name - ID">
<title>strform</title>
</head>
<body>
    <h1>Str Form</h1>
    <form action="./strprocess.php" method="POST" >
        <p>
            <label for="input">Enter a string:</label>
            <input type="text" name="input" id="input" required="required" />
        </p>
        <p>
            <input type="submit" value="Submit" />
            <input type="reset" value="Reset" />
        </p>
    </form>
</body>
</html>