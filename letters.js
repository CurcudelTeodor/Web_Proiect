// [NOT USING RN]Get the animal name element
const animalNameElement = document.getElementById("animal-nameT");

// Get the animal name
const animalName12 = animalNameElement.textContent;

// Create a new HTML string with each letter wrapped in a span element
const wrappedName = animalName12
  .split("")
  .map((letter) => `<span>${letter}</span>`)
  .join("");


// Replace the content of the animal name element with the wrapped name
animalNameElement.innerHTML = wrappedName;
