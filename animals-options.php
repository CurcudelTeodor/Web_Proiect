<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $selectedType = $_POST['Type'];
  $selectedHabitat = $_POST['habitat'];
  $selectedClimate = $_POST['Climate'];
  $selectedStatus = $_POST['Statut'];

  echo "Selected Type: " . $selectedType . "<br>";
  echo "Selected Habitat: " . $selectedHabitat . "<br>";
  echo "Selected Climate: " . $selectedClimate . "<br>";
  echo "Selected Status: " . $selectedStatus . "<br>";
}
?>


<?php
//facem conexiunea
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

//facem query-ul bazandu-ne pe filtrele primite din frontend
$sql = "SELECT * FROM animals WHERE 1=1";
$params = array();

if (!empty($selectedType)) {
  $sql .= " AND type = :type";
  $params['type'] = $selectedType;
}

if (!empty($selectedHabitat)) {
  $sql .= " AND region = :region";
  $params['region'] = $selectedHabitat;
}

if (!empty($selectedClimate)) {
  $sql .= " AND climate = :climate";
  $params['climate'] = $selectedClimate;
}

if (!empty($selectedStatus)) {
  $sql .= " AND conservation_status = :status";
  $params['status'] = $selectedStatus;
}

//preparam si executam query-ul (cu optiunile din filtre)
$stmt = $pdo->prepare($sql);
$stmt->execute($params);

//lua rezultatele din bd si le afisam (deocamdata)
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) > 0) {
  foreach ($result as $row) {
    echo "ID: " . $row['id'] . "<br>";
    echo "Name: " . $row['name'] . "<br>";
    echo "Science Name: " . $row['science_name'] . "<br>";
    //afisam alte coloane dupa nevoie...
    echo "<br>";
  }
} else {
  echo "No animals found.";
}
?>