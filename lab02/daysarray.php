<!-- Name - ID (31/07/2024) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Web, Web Programming">
    <meta name="author" content="Name - ID">
    <title>Lab 02 - Arrays and Variables</title>
</head>
<body>
    <?php
        $days = array ("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
        echo "<p>The days of the week in English are: $days[0], $days[1], $days[2], $days[3], $days[4], $days[5], $days[6]</p>";
        $days[0] = "Dimanche";
        $days[1] = "Lundi";
        $days[2] = "Mardi";
        $days[3] = "Mercredi";
        $days[4] = "Jeudi";
        $days[5] = "Vendredi";
        $days[6] = "Samedi";
        echo "<p>The days of the week in French are $days[0], $days[1], $days[2], $days[3], $days[4], $days[5], $days[6]</p>";
    ?>
</body>
</html>