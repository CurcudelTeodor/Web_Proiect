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

// Verificăm dacă cererea este de tip POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Validare și filtrare input
  $searchQuery = filter_input(INPUT_POST, 'searchQuery', FILTER_SANITIZE_STRING);

  // construim interogarea SQL pentru a căuta animalele care conțin șirul de căutare
  $sql = "SELECT * FROM animals WHERE name LIKE :searchQuery";
  $params = array('searchQuery' => '%' . $searchQuery . '%');

  // pregătim și executăm interogarea
  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);

  // preluăm rezultatele și le afișăm în format JSON
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (count($result) > 0) {
    $response = array();

    foreach ($result as $row) {
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
        'image' => isset($row['image']) ? $row['image'] : null

      );

      $response[] = $animal;
    }

    echo json_encode($response);
  } else {
    echo json_encode([]);
  }
}
?>
