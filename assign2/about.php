<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Name - ID">
    <link rel="stylesheet" href="style.css">
    <title>Assignment 2</title>
</head>
<body>
    <main>
        <!-- Navbar -->
        <header>
            <?php
                require_once("functions/navbar.php");
                renderNavbar();
            ?>
        </header>

        <!-- Main content -->
        <h1>About</h1>
        <h2>Questions</h2>
        <ul>
            <li>What tasks you have not attempted or not completed?<br>
                I have attempted all of the tasks.</li>
            <li>What special features have you done, or attempted, in creating the site that we should know about?<br>
                I have attempted and completed both of the "extra challenge" tasks.</li>
            <li>Which parts did you have trouble with?<br>
                I had some trouble with the more advanced SQL statements that were required for the advanced tasks but after some more research and testing, I learn how to make it work as intended.</li>
            <li>What would you like to do better next time?<br>
                Next time I would like to spend more time on the styles to make the website look nicer and more modern</li>
            <li>What additional features did you add to the assignment? (if any)<br>
                I created a custom navbar that renders on each page and will change depending on if the user is logged in or not. I also added functionality to automatically login new users that signup.</li>
        </ul>
    </main>
</body>
</html>