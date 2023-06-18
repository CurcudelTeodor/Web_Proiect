// Function to handle the import button click event
function handleImportButtonClick() {
  const input = document.createElement("input");
  input.type = "file";
  input.accept = ".json";
  
  input.addEventListener("change", function(event) {
    const file = event.target.files[0];
    readFileAndSendData(file);
  });
  
  input.click();
}

// Read the file and send the data to the PHP script
function readFileAndSendData(file) {
  const reader = new FileReader();
  
  reader.onload = function(event) {
    const jsonData = event.target.result;
    sendJsonDataToServer(jsonData);
  };
  
  reader.readAsText(file);
}

// Send the JSON data to the PHP script using AJAX
function sendJsonDataToServer(jsonData) {
  const xhr = new XMLHttpRequest();
  
  xhr.open("POST", "import.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // The request was successful
        console.log(xhr.responseText);
      } else {
        // An error occurred
        console.error("Error:", xhr.status);
      }
    }
  };
  
  xhr.send(jsonData);
}

// Add event listener to the import button
const importButton = document.getElementById("import-button");
importButton.addEventListener("click", handleImportButtonClick);
