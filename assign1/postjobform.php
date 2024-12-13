<!-- COS30020 Assignment 1 - Name ID -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Name - ID">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Post Job - COS30020 Assign1</title>
</head>
<body>
    <main>
        <header>
            <h1 class="bannerText">Job Vacancy System</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="postjobform.php">Post a Job</a></li>
                    <li><a href="searchjobform.php">Search</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </nav>
        </header>

        <h1>Post a job vacancy</h1>
        <form action="postjobprocess.php" method="POST">
            <!-- Text - Exactly 5 length, starts with "ID" then 3 numbers -->
            <label for="positionID">Position ID</label>
            <input type="text" id="positionID" name="positionID"><br>

            <!-- Text - Max 10 length, allow select symbols -->
            <label for="positionTitle">Position Title</label>
            <input type="text" id="positionTitle" name="positionTitle"><br>

            <!-- Text area - Max 250 length -->
            <label for="positionDescription">Position Description</label>
            <textarea id="positionDescription" name="positionDescription"></textarea><br>

            <!-- Text - should be dd/mm/yy format, defaults to today -->
            <label for="closingDate">Closing Date</label>
            <input type="text" id="closingDate" name="closingDate" value="<?php echo date('d/m/y')?>"><br>

            <!-- Radio btn - 2 options -->
            <label for="positionType">Position Type</label>
            <fieldset name="positionType">
                <input type="radio" id="positionTypeFull" name="positionType" value="1">
                <label for="positionTypeFull">Full-time</label>
                <input type="radio" id="positionTypePart" name="positionType" value="2">
                <label for="positionTypePart">Part-time</label>
            </fieldset><br>

            <!-- Radio btn - 2 options -->
            <label for="contractType">Contract Type</label>
            <fieldset name="contractType">
                <input type="radio" id="contractTypeO" name="contractType" value="1">
                <label for="contractTypeO">On-Going</label>
                <input type="radio" id="contractTypeF" name="contractType" value="2">
                <label for="contractTypeF">Fixed-term</label>
            </fieldset><br>

            <!-- Radio btn - 2 options -->
            <label for="location">Location</label>
            <fieldset name="location">
                <input type="radio" id="locationO" name="location" value="1">
                <label for="locationO">On-Site</label>
                <input type="radio" id="locationR" name="location" value="2">
                <label for="locationR">Remote</label>
            </fieldset><br>

            <!-- Check box - 2 options -->
            <label for="acceptApplications">Accept Application By</label>
            <fieldset name="acceptApplications">
                <input type="checkbox" id="acceptApplicationsEmail" name="acceptApplicationsEmail" value="1">
                <label for="acceptApplicationsEmail">Email</label>
                <input type="checkbox" id="acceptApplicationsPost" name="acceptApplicationsPost" value="1">
                <label for="acceptApplicationsPost">Post</label>
            </fieldset><br>

            <button type="submit">Post job vacancy</button>
        </form>
    </main>
</body>
</html>