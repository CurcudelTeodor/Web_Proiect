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
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $selectedType = $_POST['Type'];
  $selectedHabitat = $_POST['Habitat'];
  $selectedClimate = $_POST['Climate'];
  $selectedStatus = $_POST['Status'];
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
  //pregatim array-ul pentru raspuns
  $response = array();
  
  foreach ($result as $row) {
    //adaugam fiecare animal (care corespunde filtrarii) la response 
    $animal = array(
      'id' => $row['id'],
      'name' => $row['name'],
      'science_name' => $row['science_name'],
      //adaugam alte campuri dupa nevoie
    );
    $response[] = $animal;
  }

  //convertim array-ul pt raspuns in JSON
  $jsonResponse = json_encode($response);
  
  //trimitem JSON-ul la client (browser)
  header('Content-Type: application/json');
  echo $jsonResponse;
} else {
  //nu am gasit animale (count($result<0))
  $response = array(
    'message' => 'No animals found.'
  );

  //convertim array-ul pt raspuns in JSON
  $jsonResponse = json_encode($response);

  //trimitem JSON-ul la client (browser)
  header('Content-Type: application/json');
  echo $jsonResponse;
}
