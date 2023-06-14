<?php
// Assuming you have a MySQL connection established
$host = 'localhost';
$dbname = 'zoo';
$username = 'root';
$password = '';

// Create a PDO instance
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Handle the animal ID or name parameter
$animalName = $_GET['name'];

// Implement data retrieval logic
$sql = "SELECT * FROM animals WHERE name = :name";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $animalName);
$stmt->execute();
$animal = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if animal exists
if ($animal) {
  // Format the response
  $response = [
    'id' => $animal['id'],
    'name' => $animal['name'],
    'science_name' => $animal['science_name'],
    'type'=> $animal['type'],
    'region'=> $animal['region'],
    'climate'=> $animal['climate'],
    'conservation_status'=> $animal['conservation_status'],
    'description'=> $animal['description'],
    'min_weight'=> $animal['min_weight'],
    'max_weight'=> $animal['max_weight'],
    // Add other fields as needed
  ];

  // Set the appropriate HTTP headers
  header('Content-Type: application/json');

  // Return the response
  echo json_encode($response);
} else {
  // Animal not found
  $response = [
    'error' => 'Animal not found',
  ];

  // Set the appropriate HTTP headers
  header('Content-Type: application/json');
  http_response_code(404);

  // Return the response
  echo json_encode($response);
}
?>
