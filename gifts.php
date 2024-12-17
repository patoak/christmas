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

// Fetch all gifts
$sql = "SELECT name, count_available FROM gifts";
$gifts = $db->query($sql);

// Display gifts in a numbered list
echo "<h1>Gift List</h1>";
echo "<ol>";
foreach ($gifts as $gift) {
    echo "<li>" . $gift['name'] . " - Available: " . $gift['count_available'] . "</li>";
}
echo "</ol>";
?>
