<?php
// Include the Database class
include('Database.php');

// Create a new instance of the Database class
$config = [
    'host' => 'server43.areait.lv',
    'dbname' => 'jekabsar_christmas',
    'user' => 'jekabsar_reader',
    'pass' => 'Christmas2022'
];

$db = new Database($config);

// Fetch all children
$sql = "SELECT firstname, middlename, surname, age FROM children ORDER BY surname";
$children = $db->query($sql);

// Display children in a table
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Santa's Helper - Children</title>";
echo "<link rel='stylesheet' href='children-styles.css'>";
echo "</head>";
echo "<body>";

echo "<div id='snowflakes-container'></div>";

echo "<h1>Children List</h1>";
echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>First Name</th>";
echo "<th>Middle Name</th>";
echo "<th>Last Name</th>";
echo "<th>Age</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
foreach ($children as $child) {
    echo "<tr>";
    echo "<td>" . $child['firstname'] . "</td>";
    echo "<td>" . $child['middlename'] . "</td>";
    echo "<td>" . $child['surname'] . "</td>";
    echo "<td>" . $child['age'] . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";

echo "<script src='snowflakes-script.js'></script>";

echo "</body>";
echo "</html>";
?>
