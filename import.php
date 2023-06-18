<?php
include ("connect.php");
$jsonData = file_get_contents('php://input');

// Parse the JSON data into a PHP array or object
$data = json_decode($jsonData);
// Access the individual fields from the JSON data
$animalName = $data->name;
$scientificName = $data->scientificName;
$conservationStatus = $data->conservationStatus;
$type = $data->type;
$climate = $data->climate;
$minWeight = $data->minWeight;
$maxWeight = $data->maxWeight;
$description = $data->description;
$region = $data->region;
echo $description;
$DB= new Database();
$query = "INSERT INTO animals (name, science_name, type, region, climate, conservation_status, description, min_weight, max_weight)
       VALUES ('$animalName', '$scientificName', '$type','$region','$climate', '$conservationStatus', '$description','$minWeight', '$maxWeight')";
 $DB->save($query);

// Process the data as needed, such as inserting into a MySQL table

// Return a response indicating the success or status of the operation
//echo "Data received successfully!";
?>
