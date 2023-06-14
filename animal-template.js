// Get the animal name from the URL
var searchParams = new URLSearchParams(window.location.search);
var animalName = decodeURIComponent(window.location.search.split('=')[1].replace(/\+/g, ' ')).replace(/_/g, ' ');
var animalId = searchParams.get('animal');

// Fetch the animal data from the server using the animal name
fetch('http://localhost/Zoo/Web_Proiect/animal-api.php?name=' + encodeURIComponent(animalName))
  .then(function(response) {
    return response.json();
  })
  .then(function(animal) {
    // Populate the template with the animal data
    document.getElementById('animal-name').textContent = animal.name;
    document.getElementById('animal-scientific-name').textContent = animal.scientific_name;
    document.getElementById('animal-conservation-status').textContent = 'Conservation Status: ' + animal.conservation_status;
    document.getElementById('animal-type').textContent = 'Type: ' + animal.type;
    document.getElementById('animal-climate').textContent = 'Climate: ' + animal.climate;
    document.getElementById('animal-description').textContent = animal.description;
  })
  .catch(function(error) {
    console.log('Error:', error);
  });
