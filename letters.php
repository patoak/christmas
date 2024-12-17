<?php
// Include the Database class for DB connection
include('Database.php');

// Create a new instance of the Database class
$config = [
    'host' => 'server43.areait.lv',
    'dbname' => 'jekabsar_christmas',
    'user' => 'jekabsar_reader',
    'pass' => 'Christmas2022'
];

$db = new Database($config);

// Fetch all the letters from the database
$sql = "SELECT children.firstname, children.surname, children.age, letters.letter_text 
        FROM children
        JOIN letters ON children.id = letters.sender_id";
$letters = $db->query($sql);

// Display the letters in a readable format
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Children's Letters to Santa Claus</title>";
echo "<link rel='stylesheet' href='letters-styles.css'>";
echo "</head>";
echo "<body>";

echo "<h1>Children's Letters to Santa Claus</h1>";
foreach ($letters as $letter) {
    echo "<div class='letter'>";
    echo "<h2>" . $letter['firstname'] . " " . $letter['surname'] . " (" . $letter['age'] . " years old)</h2>";
    echo "<p> " . $letter['letter_text'] . "</p>";
    echo "</div>";
}

echo "</body>";
echo "</html>";
?>
