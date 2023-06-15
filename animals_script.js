function getAnimalOptions() {
    var xhr = new XMLHttpRequest();
    var form = document.getElementById('animal-form');
  
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Handle the response from animals-options.php
        var response = JSON.parse(xhr.responseText);
  
        // Update the page content based on the response
        // You can modify this part to suit your needs
        var animalList = document.getElementById('animal-list');
        animalList.innerHTML = ''; // Clear previous content
  
        for (var i = 0; i < response.length; i++) {
          var animal = response[i];
  
          // Create a container for the animal item
          var animalItem = document.createElement('div');
          animalItem.classList.add('animal-item');
  
          // Create an anchor element for the animal image link
          var imageLink = document.createElement('a');
          imageLink.href = 'Animal-template.html?animal=' + encodeURIComponent(animal.name.replace(/ /g, '_')); // Replace spaces with underscores
          imageLink.classList.add('animal-link');
  
          // Create an image element for the animal's picture
          var image = document.createElement('img');
          image.src = 'images/' + animal.name.replace(/ /g, '_').toLowerCase() + '.jpg'; // Replace spaces with underscores
          image.alt = animal.name;
          image.classList.add('animal-image'); // Add the 'animal-image' class
          image.dataset.animalId = animal.id; // Set the 'data-animal-id' attribute with the animal ID

          // Append the image element to the link element
          imageLink.appendChild(image);
  
          // Append the link element to the animal item container
          animalItem.appendChild(imageLink);
  
          // Create a heading element for the animal's name
          var heading = document.createElement('h3');
          heading.textContent = animal.name;
  
          // Append the heading element to the animal item container
          animalItem.appendChild(heading);
  
          // Append the animal item container to the animal list
          animalList.appendChild(animalItem);
        }
      }
    };
  
    xhr.open('POST', 'animals-options.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');
    xhr.send(new URLSearchParams(new FormData(form)).toString());
  }
  
  function searchAnimals() {
    var xhr = new XMLHttpRequest();
    var form = document.getElementById('animal-form');
    var searchQuery = document.querySelector('.search_box input').value;
  
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        displayAnimals(response);
      }
    };
  
    xhr.open('POST', 'search-animals.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');
    xhr.send('searchQuery=' + encodeURIComponent(searchQuery));
  }
  function displayAnimals(animals) {
    var animalList = document.getElementById('animal-list');
    animalList.innerHTML = '';
  
    if (animals.length === 0) {
      animalList.innerHTML = '<p>Nu s-au găsit animale.</p>';
    } else {
      for (var i = 0; i < animals.length; i++) {
        var animal = animals[i];
  
        var animalItem = document.createElement('div');
        animalItem.classList.add('animal-item');
  
        var imageLink = document.createElement('a');
        imageLink.href = 'Animal-template.html?animal=' + encodeURIComponent(animal.name.replace(/ /g, '_'));
        imageLink.classList.add('animal-link');
  
        var image = document.createElement('img');
        image.src = 'images/' + animal.name.replace(/ /g, '_').toLowerCase() + '.jpg';
        image.alt = animal.name;
        image.classList.add('animal-image');
        image.dataset.animalId = animal.id;
  
        imageLink.appendChild(image);
        animalItem.appendChild(imageLink);
  
        var heading = document.createElement('h3');
        heading.textContent = animal.name;
  
        animalItem.appendChild(heading);
  
        animalList.appendChild(animalItem);
      }
    }
  }
  