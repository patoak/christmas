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

// Fetch all gifts (id, name, and count_available)
$gifts_sql = "SELECT id, name, count_available FROM gifts";
$gifts_result = $db->query($gifts_sql);
$gifts = $gifts_result->fetchAll();

// Check if gifts are fetched
if ($gifts_result->rowCount() == 0) {
    echo "<p>Nav dāvanu datubāzē.</p>";
    exit();
}

// Initialize an array to track the number of requests for each gift
$gift_requests = [];

// Query to fetch all letters and check which gifts are requested
$letters_sql = "SELECT letter_text FROM letters";
$letters_result = $db->query($letters_sql);

// Check if letters are fetched
if ($letters_result->rowCount() == 0) {
    echo "<p>Nav vēstuļu datubāzē.</p>";
    exit();
}

// Loop through each letter and count how many times each gift is mentioned
while ($letter = $letters_result->fetch()) {
    foreach ($gifts as $gift) {
        // Check if gift name is mentioned in the letter
        if (stripos($letter['letter_text'], $gift['name']) !== false) {
            // Increment the requested count for this gift
            if (!isset($gift_requests[$gift['id']])) {
                $gift_requests[$gift['id']] = 0;
            }
            $gift_requests[$gift['id']]++;
        }
    }
}

// Display gifts and their stock/demand
echo "<!DOCTYPE html>";
echo "<html lang='lv'>"; // Latvian language
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Dāvanu saraksts</title>";
echo "<link rel='stylesheet' href='gifts-styles.css'>"; // Assuming you have a styles file
echo "</head>";
echo "<body>";

echo "<div id='snowflakes-container'></div>";

echo "<h1>Dāvanu saraksts un noliktavas uzskaite</h1>";
echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>Dāvanu nosaukums</th>";
echo "<th>Pieejamais skaits</th>";
echo "<th>Pieprasītais skaits</th>";
echo "<th>Statuss</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

// Display each gift's stock and demand, and check if stock is enough
foreach ($gifts as $gift) {
    // Get the requested count for the gift
    $requested_count = isset($gift_requests[$gift['id']]) ? $gift_requests[$gift['id']] : 0;

    // Check if there is enough stock
    $status = $gift['count_available'] >= $requested_count ? "Pietiekami" : "Nepietiekami";
    $status_class = $status == "Pietiekami" ? "sufficient" : "not-enough";

    // Output the table row
    echo "<tr>";
    echo "<td>" . htmlspecialchars($gift['name']) . "</td>";
    echo "<td>" . $gift['count_available'] . "</td>";
    echo "<td>" . $requested_count . "</td>";
    echo "<td class='$status_class'>" . $status . "</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

echo "<script src='snowflakes-script.js'></script>";

echo "</body>";
echo "</html>";
?>
