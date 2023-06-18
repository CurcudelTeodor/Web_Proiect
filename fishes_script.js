function getMammalOptions() {
    var xhr = new XMLHttpRequest();
    var form = document.getElementById('animal-form');
  
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Handle the response from animals-options.php
        var response = JSON.parse(xhr.responseText);
  
        // Filter the response to get only animals of type Mammal
        var fishesAnimals = response.filter(function (animal) {
          return animal.type === 'Fish';
        });
  
        // Update the page content based on the filtered response
        displayAnimals(fishesAnimals);
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
    