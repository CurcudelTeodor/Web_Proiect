<?php
if (isset($_POST['option'])) {
  $selectedOption = $_POST['option'];

  echo "Opțiunea selectată: " . $selectedOption;
}
?>