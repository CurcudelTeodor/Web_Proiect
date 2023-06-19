// Get the animal name from the URL
var searchParams = new URLSearchParams(window.location.search);
var animalName = decodeURIComponent(window.location.search.split('=')[1].replace(/\+/g, ' ')).replace(/_/g, ' ');
var animalId = searchParams.get('animal');

// Fetch the animal data from the server using the animal name
fetch('http://localhost:81/Zoo/Web_Proiect/animal-api.php?name=' + encodeURIComponent(animalName))
  .then(function (response) {
    return response.json();
  })
  .then(function (animal) {
    // Populate the template with the animal data
    document.getElementById('animal-nameT').textContent = animal.name;
    document.getElementById('animal-scientific-nameT').textContent = 'Scientific name: ' + animal.science_name;
    document.getElementById('animal-conservation-statusT').textContent = 'Conservation Status: ' + animal.conservation_status;
    document.getElementById('animal-typeT').textContent = 'Animal type: ' + animal.type;
    document.getElementById('animal-climateT').textContent = 'Climate: ' + animal.climate;
    document.getElementById('animal-descriptionT').textContent = animal.description;

    // Get the animal image and update the HTML
    var animalImageElement = document.getElementById('animal-imageT');
    var animalImage = document.createElement('img');
    animalImage.src = 'images/' + animal.name.toLowerCase().replace(/ /g, '_') + '.jpg';
    animalImage.alt = animal.name;
    animalImageElement.appendChild(animalImage);

    document.getElementById('min-weightT').textContent = 'Minimum weight: ' + animal.min_weight + ' kg';
    document.getElementById('max-weightT').textContent = 'Maximum weight: ' + animal.max_weight + ' kg';

     // Get the animal's region and set the map image based on it
     var region = animal.region;
     var mapElement = document.querySelector('.map');
     var mapImage = document.createElement('img');
     mapImage.src = 'images/' + region.toLowerCase().replace(/ /g, '_') + '.jpg';
     mapImage.alt = region;
     mapElement.appendChild(mapImage);

  })
  .catch(function (error) {
    console.log('Error:', error);
  });
