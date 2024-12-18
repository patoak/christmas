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

// Fetch all the gifts from the database
$gifts_sql = "SELECT name FROM gifts";
$gifts_result = $db->query($gifts_sql);
$gifts = $gifts_result->fetchAll(PDO::FETCH_COLUMN); // Fetch all gift names into an array

// Fetch all the letters from the database
$sql = "SELECT children.firstname, children.surname, children.age, letters.letter_text 
        FROM children
        JOIN letters ON children.id = letters.sender_id";
$letters = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC); // Fetch all letters into an associative array

// Function to highlight gift names in the letter text
function highlight_gifts($letter_text, $gifts) {
    foreach ($gifts as $gift) {
        $letter_text = str_ireplace($gift, "<span class='highlight'>$gift</span>", $letter_text);
    }
    return $letter_text;
}

// Display the letters with highlighted gifts
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Santa's Helper - Letters</title>";
echo "<link rel='stylesheet' href='letters-styles.css'>";
echo "</head>";
echo "<body>";

// Snowflakes container
echo "<div id='snowflakes-container'></div>";
echo "<script src='snowflakes-script.js'></script>";

echo "<h1>Children's Letters to Santa Claus</h1>";

// Loop through each letter and display the content
foreach ($letters as $letter) {
    echo "<div class='letter'>";
    echo "<h2>{$letter['firstname']} {$letter['surname']} ({$letter['age']} years old)</h2>";
    
    // Display the letter with highlighted gifts
    echo "<p>" . highlight_gifts($letter['letter_text'], $gifts) . "</p>";
    
    // Display the full list of requested gifts below the letter
    echo "<p><strong>Requested Gifts:</strong> ";
    $requested_gifts = [];
    foreach ($gifts as $gift) {
        if (stripos($letter['letter_text'], $gift) !== false) {
            $requested_gifts[] = $gift;
        }
    }
    echo implode(", ", $requested_gifts);
    echo "</p>";
    echo "</div>";
}

echo "</body>";
echo "</html>";
?>
