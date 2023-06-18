<?php
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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $searchQuery = filter_input(INPUT_POST, 'searchQuery', FILTER_SANITIZE_STRING);

  // construct the SQL query to fetch the suggestions
  $sql = "SELECT * FROM animals WHERE name LIKE :searchQuery LIMIT 5";
  $params = array('searchQuery' => $searchQuery . '%');

  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (count($result) > 0) {
    $response = array();

    foreach ($result as $row) {
      $response[] = $row; // Fetch the entire row as suggestion
    }

    echo json_encode($response);
  } else {
    echo json_encode([]);
  }
}
?>
