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
        <?php
            // File path
            $filePath = "../../data/jobs/positions.txt";

            // Define the JobListing class to store job listings for easier handling
            class JobListing {
                public $positionID;
                public $positionTitle;
                public $positionDescription;
                public $closingDate;
                public $positionType;
                public $contractType;
                public $location;
                public $acceptApplicationsEmail;
                public $acceptApplicationsPost;
            }

            // Check if the file exists
            if (!file_exists($filePath)) {
                echo "<p>There are no current job listings</p>";
                return;
            }

            // Sanitize user input by wrapping in double quotes and escaping special characters
            function sanitize_user_input($value) {
                $escaped_value = str_replace('"', '""', $value); // Escape double quotes
                $escaped_value = str_replace("\n", "\\n", $escaped_value); // Escape newlines
                $escaped_value = str_replace("\r", "\\r", $escaped_value); // Escape carriage returns TODO: remove?
                $escaped_value = str_replace("\t", "\\t", $escaped_value); // Escape tabs TODO: remove?
                $escaped_value = htmlspecialchars($escaped_value); // Handle special characters
                return '"' . $escaped_value . '"'; // Enclose in double quotes
            }

            // Take in user input from GET request and sanitize, will default to empty string if not set
            $jobTitle = isset($_GET['job_title']) ? $_GET['job_title'] : '';
            $position = isset($_GET['positionType']) ? $_GET['positionType'] : '';
            $contract = isset($_GET['contractType']) ? $_GET['contractType'] : '';
            $applicationTypePost = isset($_GET['acceptApplicationsPost']) ? $_GET['acceptApplicationsPost'] : '0';
            $applicationTypeEmail = isset($_GET['acceptApplicationsEmail']) ? $_GET['acceptApplicationsEmail'] : '0';
            $location = isset($_GET['location']) ? $_GET['location'] : '';

            // Read the file and store the job listings in an array of JobListing objects
            $file = fopen($filePath, "r");
            $jobListings = array();
            while (!feof($file)) {
                $line = fgets($file);
                $data = str_getcsv($line);
                $jobListing = new JobListing();
                $jobListing->positionID = $data[0];
                $jobListing->positionTitle = $data[1];
                $jobListing->positionDescription = $data[2];
                $jobListing->closingDate = $data[3];
                $jobListing->positionType = $data[4];
                $jobListing->contractType = $data[5];
                $jobListing->location = $data[6];
                $jobListing->acceptApplicationsEmail = $data[7];
                $jobListing->acceptApplicationsPost = $data[8];
                array_push($jobListings, $jobListing);
            }
            fclose($file);

            // Filter the job listings based on the user input
            $filteredJobListings = array_filter($jobListings, function($jobListing) use ($jobTitle, $position, $contract, $applicationTypePost, $applicationTypeEmail, $location) {
                // Filter by job title
                if (!empty($jobTitle) && stripos($jobListing->positionTitle, $jobTitle) === false) {
                    return false;
                }

                // Filter by position type
                if (!empty($position) && !in_array($jobListing->positionType, $position)) {
                    return false;
                }

                // Filter by contract type
                if (!empty($contract) && !in_array($jobListing->contractType, $contract)) {
                    return false;
                }

                // Filter by application type
                // If the user has selected both or neither, then the show all
                // If the user has selected one or the other, then filter by that
                if ($applicationTypePost !=  $applicationTypeEmail) {
                    if ($applicationTypePost == '1' && $jobListing->acceptApplicationsPost == '0') {
                        return false;
                    }
                    if ($applicationTypeEmail == '1' && $jobListing->acceptApplicationsEmail == '0') {
                        return false;
                    }
                }

                // Filter by location
                if (!empty($location) && !in_array($jobListing->location, $location)) {
                    return false;
                }

                // If the job listing passes all filters, then it can be shown
                return true;
            });

            // Filter out job listings that have already closed
            $filteredJobListings = array_filter($filteredJobListings, function($jobListing) {
                $date = DateTime::createFromFormat('d/m/y', $jobListing->closingDate);
                $now = new DateTime();
                return $date >= $now;
            });

            // Sort the filtered job listings by closing date
            usort($filteredJobListings, function($a, $b) {
                $dateA = DateTime::createFromFormat('d/m/Y', $a->closingDate);
                $dateB = DateTime::createFromFormat('d/m/Y', $b->closingDate);
                return ($dateA < $dateB) ? -1 : (($dateA > $dateB) ? 1 : 0);
            });

            // Output the filtered job listings
            foreach ($filteredJobListings as $jobListing) {
                // Convert numbers to text
                $positionType = $jobListing->positionType == '1' ? 'Full-time' : 'Part-time';
                $contractType = $jobListing->contractType == '1' ? 'On-Going' : 'Fixed-term';
                $location = $jobListing->location == '1' ? 'On-Site' : 'Remote';
                $acceptApplicationsEmail = $jobListing->acceptApplicationsEmail == '1' ? 'Yes' : 'No';
                $acceptApplicationsPost = $jobListing->acceptApplicationsPost == '1' ? 'Yes' : 'No';

                // Output the job listing
                echo "
                    <div class='jobListing'>
                        <h2>Title: <em>{$jobListing->positionTitle}</em></h2>
                        <p>Description: <br><em>{$jobListing->positionDescription}</em></p><br>
                        <p>ID: <em>{$jobListing->positionID}</em> |
                        Closing Date: <em>{$jobListing->closingDate}</em> |
                        Position Type: <em>$positionType</em> |
                        Contract Type: <em>$contractType</em> |
                        Location: <em>$location</em> |
                        Accepting Applications by Email: <em>$acceptApplicationsEmail</em> |
                        Accepting Applications by Post: <em>$acceptApplicationsPost</em></p>
                    </div>
                ";
            }
        ?>
    </main>
</body>
</html>