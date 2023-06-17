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
    description: document.getElementById("animal-descriptionT").textContent,
  };

  const animalInfoJSON = JSON.stringify(animalInfo, null, 2);
  const blob = new Blob([animalInfoJSON], { type: "application/json" });
  const url = URL.createObjectURL(blob);

  const a = document.createElement("a");
  a.href = url;
  a.download = fileName;

  // Append the button text
  const buttonText = document.createElement("span");
  buttonText.classList.add("title2");
  buttonText.textContent = "Download";

  // Append the button icon
  const buttonIcon = document.createElement("span");
  buttonIcon.classList.add("circle2");
  // Insert your SVG path here for the custom icon
  buttonIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Insert your SVG path here --></svg>';

  // Append the button elements
  a.appendChild(buttonIcon);
  a.appendChild(buttonText);
  document.body.appendChild(a);

  // Simulate a click event on the link to trigger the download
  a.click();

  // Cleanup the temporary link
  document.body.removeChild(a);
  URL.revokeObjectURL(url);
}

// Add event listener to the download button
const downloadButton = document.getElementById("download-button");
downloadButton.addEventListener("click", handleDownloadButtonClick);