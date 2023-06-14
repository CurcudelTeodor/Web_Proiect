// [Deprecated] Assuming you have a class or selector to target the animal images, such as '.animal-image'
var animalImages = document.querySelectorAll('.animal-image');

// Add a click event listener to each animal image
animalImages.forEach(function(image) {
  image.addEventListener('click', function() {
    // Get the animal ID or name from the image's data attribute or any other source
    var animalID = image.dataset.animalId; // Assuming you have a data attribute 'data-animal-id' with the animal ID

    // Construct the URL for the animal page
    var animalPageURL = 'http://localhost/Zoo/Web_Proiect/animal-api.php?id=' + animalID;

    // Redirect the user to the animal page
    window.location.href = animalPageURL;
  });
});
