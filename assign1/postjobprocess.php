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
        <?php
            // File path
            $filePath = "../../data/jobs/positions.txt";

            // Function to sanitize user input by wrapping in double quotes and escaping special characters
            function sanitize_user_input($value) {
                $escaped_value = str_replace('"', '""', $value); // Escape double quotes
                $escaped_value = str_replace("\n", "\\n", $escaped_value); // Escape newlines
                $escaped_value = str_replace("\r", "\\r", $escaped_value); // Escape carriage returns
                $escaped_value = str_replace("\t", "\\t", $escaped_value); // Escape tabs
                $escaped_value = htmlspecialchars($escaped_value); // Handle special characters
                return '"' . $escaped_value . '"'; // Enclose in double quotes
            }

            // Initialize error message
            $errorMessage = "";

            // Check if all fields are filled and output error message if not
            if (empty($_POST['positionID']) ||
                empty($_POST['positionTitle']) ||
                empty($_POST['positionDescription']) ||
                empty($_POST['closingDate']) ||
                empty($_POST['positionType']) ||
                empty($_POST['contractType']) ||
                empty($_POST['location']) ||
                (empty($_POST['acceptApplicationsEmail']) &&
                empty($_POST['acceptApplicationsPost']))) {
                $errorMessage = "All fields are required.";
                echo "<p>$errorMessage</p>";
                return;
            }

            // Take in user inputs from POST request and sanitize
            // Position ID - Exactly 5 length, starts with "ID" then 3 numbers
            $positionID = $_POST['positionID'];
            // Validate Position ID
            if (!preg_match('/^ID\d{3}$/', $positionID)) {
                $errorMessage .= "<li class=errorMsg>Invalid Position ID. It should start with 'ID' followed by 3 numbers.</li>";
            }
            // Check that the Position ID is unique
            if (file_exists($filePath)) {
                // Read the file and output the data
                $file = fopen($filePath, "r");
                $IDs = array();
                while (!feof($file)) {
                    $line = fgets($file);
                    $data = str_getcsv($line);
                    array_push($IDs, $data[0]);
                }
                fclose($file);
                // Check that the Position ID is unique within the file
                if (in_array($positionID, $IDs)) {
                    $errorMessage .= "<li class=errorMsg>Position ID already exists.</li>";
                }
            }
            $positionID = sanitize_user_input($_POST['positionID']);

            // Position Title - Max 10 length, allow select symbols
            $positionTitle = $_POST['positionTitle'];
            if (strlen($positionTitle) > 10) {
                $errorMessage .= "<li class=errorMsg>Position Title is too long.</li>";
            }
            if (!preg_match('/^[a-zA-Z0-9\s,.!]+$/', $positionTitle)) {
                $errorMessage .= "<li class=errorMsg>Position Title is invalid.</li>";
            }
            $positionTitle = sanitize_user_input($_POST['positionTitle']);

            // Position Description - Max 250 length
            $positionDescription = sanitize_user_input($_POST['positionDescription']);
            if (strlen($positionDescription) > 250) {
                $errorMessage .= "<li class=errorMsg>Position Description is too long.</li>";
            }

            // Closing Date - Should be dd/mm/yy format
            $closingDate = $_POST['closingDate'];
            // Validate Closing Date
            if (!preg_match('/^\d{2}\/\d{2}\/\d{2}$/', $closingDate)) {
                $errorMessage .= "<li class=errorMsg>Invalid Closing Date. It should be in the format dd/mm/yy.</li>";
            }
            $closingDate = sanitize_user_input($closingDate);

            // Fieldset inputs
            $positionType = sanitize_user_input($_POST['positionType']);
            $contractType = sanitize_user_input($_POST['contractType']);
            $location = sanitize_user_input($_POST['location']);

            // Accept Applications - Check box
            if (!isset($_POST['acceptApplicationsEmail'])) {
                $acceptApplicationsEmail = '"0"';
            } else {
                $acceptApplicationsEmail = sanitize_user_input($_POST['acceptApplicationsEmail']);
            }
            if (!isset($_POST['acceptApplicationsPost'])) {
                $acceptApplicationsPost = '"0"';
            } else {
                $acceptApplicationsPost = sanitize_user_input($_POST['acceptApplicationsPost']);
            }

            // If there are any errors, output them and return
            if (!empty($errorMessage)) {
                echo "<ul>$errorMessage</ul>";
                return;
            }

            // Concatenate data for storage
            // Data is formatted as ID,Title,Description,ClosingDate,PositionType,ContractType,Location,AcceptApplicationsEmail,AcceptApplicationsPost
            $data = "$positionID,$positionTitle,$positionDescription,$closingDate,$positionType,$contractType,$location,$acceptApplicationsEmail,$acceptApplicationsPost";

            // If the file does not exist, create it and write the data
            if (!file_exists("../../data/jobs")) {
                mkdir("../../data/jobs", 02777, true);
            }
            if (!file_exists($filePath)) {
                $file = fopen($filePath, "w");
                fwrite($file, $data);
                fclose($file);

                // Output success message then return
                echo "<p class=successMsg>The job has been successfully posted.</p>";
                return;
            }

            // If the file exists, append the data
            $file = fopen($filePath, "a");
            fwrite($file, "\n$data");
            fclose($file);

            // Output success message
            echo "<p class=successMsg>The job has been successfully posted.</p>";
        ?>
    </main>
</body>
</html>