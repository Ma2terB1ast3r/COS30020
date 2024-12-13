<!-- COS30020 Assignment 1 - Name ID -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Name - ID">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Search Jobs - COS30020 Assign1</title>
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

        <h1>Search for job vacancies</h1>
        <form action="searchjobprocess.php" method="GET">
            <!-- Job Title -->
            <label for="job_title">Job Title:</label>
            <input type="text" name="job_title" id="job_title" placeholder="Job Title"><br>

            <!-- Position Type -->
            <label for="position">Position:</label>
            <fieldset>
                <input type="checkbox" name="positionType[]" id="positionTypeFull" value="1">
                <label for="positionTypeFull">Full-time</label><br>
                <input type="checkbox" name="positionType[]" id="positionTypePart" value="2">
                <label for="positionTypePart">Part-time</label><br>
            </fieldset><br>

            <!-- Contract Type -->
            <label for="contract">Contract:</label>
            <fieldset>
                <input type="checkbox" name="contractType[]" id="contractTypeO" value="1">
                <label for="contractTypeO">On-Going</label><br>
                <input type="checkbox" name="contractType[]" id="contractTypeF" value="2">
                <label for="contractTypeF">Fixed-term</label><br>
            </fieldset><br>

            <!-- Application Type -->
            <label for="application_type">Application Type:</label>
            <fieldset>
                <input type="checkbox" name="acceptApplicationsEmail" id="acceptApplicationsEmail" value="1">
                <label for="acceptApplicationsEmail">Email</label><br>
                <input type="checkbox" name="acceptApplicationsPost" id="acceptApplicationsPost" value="1">
                <label for="acceptApplicationsPost">Post</label><br>
            </fieldset><br>

            <!-- Location -->
            <label for="location">Location:</label>
            <fieldset>
                <input type="checkbox" name="location[]" id="locationOnSite" value="1">
                <label for="locationOnSite">On-Site</label><br>
                <input type="checkbox" name="location[]" id="locationRemote" value="2">
                <label for="locationRemote">Remote</label><br>
            </fieldset><br>

            <button type="submit">Search</button>
        </form>
    </main>
</body>
</html>