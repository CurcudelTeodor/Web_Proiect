<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $targetDirectory = 'C:/xampp/htdocs/Zoo/Web_Proiect/images/';
    $targetFile = $targetDirectory . basename($_FILES['image']['name']);
    
    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        echo 'Image uploaded successfully.';
    } else {
        echo 'Failed to upload the image.';
    }
}
?>
