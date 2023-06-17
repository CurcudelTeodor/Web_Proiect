<?php
// Establish the database connection
$host = 'localhost';
$dbname = 'zoo';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die('Connection failed: ' . $e->getMessage());
}

// Retrieve the selected animal type from the frontend
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $selectedType = $_POST['Type'];
}

// Build the SQL query based on the selected animal type
$sql = "SELECT * FROM animals WHERE type = :type ORDER BY name ASC";

// Prepare and execute the query with the selected animal type
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':type', $selectedType);
$stmt->execute();

// Fetch the animal data from the database
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($result) > 0) {
  // Prepare the response array
  $response = array();

  foreach ($result as $row) {
    // Add each animal (matching the selected type) to the response array
    $animal = array(
      'id' => $row['id'],
      'name' => $row['name'],
      'science_name' => $row['science_name'],
      'type' => $row['type'],
      'region' => $row['region'],
      'climate' => $row['climate'],
      'conservation_status' => $row['conservation_status'],
      'description' => $row['description'],
      'min_weight' => $row['min_weight'],
      'max_weight' => $row['max_weight'],
      // Add additional fields as needed
    );
    $response[] = $animal;
  }

  // Convert the response array to JSON format
  $jsonResponse = json_encode($response);

  // Send the JSON response to the client (browser)
  header('Content-Type: application/json');
  echo $jsonResponse;
} else {
  // No animals found for the selected type
  $response = array(
    'message' => 'No animals found for the selected type.'
  );

  // Convert the response array to JSON format
  $jsonResponse = json_encode($response);

  // Send the JSON response to the client (browser)
  header('Content-Type: application/json');
  echo $jsonResponse;
}
