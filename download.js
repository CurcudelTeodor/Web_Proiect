// Function to handle the download button click event
function handleDownloadButtonClick() {
    const animalName = document.getElementById("animal-nameT").textContent;
    const currentDate = new Date().toISOString().split("T")[0];
    const fileName = animalName.toLowerCase().replace(/\s+/g, "") + "_" + currentDate + ".json";
    
    const animalInfo = {
      name: animalName,
      scientificName: document.getElementById("animal-scientific-nameT").textContent,
      conservationStatus: document.getElementById("animal-conservation-statusT").textContent,
      type: document.getElementById("animal-typeT").textContent,
      climate: document.getElementById("animal-climateT").textContent,
      minWeight: document.getElementById("min-weightT").textContent,
      maxWeight: document.getElementById("max-weightT").textContent,
      description: document.getElementById("animal-descriptionT").textContent
    };
  
    const animalInfoJSON = JSON.stringify(animalInfo, null, 2);
    const blob = new Blob([animalInfoJSON], { type: "application/json" });
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = fileName;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
  }
  
  // Add event listener to the download button
  const downloadButton = document.getElementById("download-button");
  downloadButton.addEventListener("click", handleDownloadButtonClick);
  