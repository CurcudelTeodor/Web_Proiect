function getSuggestions(searchQuery) {
    var xhr = new XMLHttpRequest();
  
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var suggestions = JSON.parse(xhr.responseText);
        displaySuggestions(suggestions);
      }
    };
  
    // Only send the request if the searchQuery is not empty
    if (searchQuery.trim() !== '') {
      xhr.open('POST', 'get-suggestions.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');
      xhr.send('searchQuery=' + encodeURIComponent(searchQuery));
    } else {
      displaySuggestions([]); // Clear the suggestions when searchQuery is empty
    }
  }

// Add the event listener for the 'input' event
var searchInput = document.getElementById('search-input');
searchInput.addEventListener('input', function() {
  var searchQuery = this.value;
  getSuggestions(searchQuery);
});

  
  function displaySuggestions(suggestions) {
    var suggestionsContainer = document.getElementById('suggestions-container');
    suggestionsContainer.innerHTML = '';
  
    if (suggestions.length > 0) {
      for (var i = 0; i < suggestions.length; i++) {
        var suggestion = suggestions[i];
  
        var suggestionItem = document.createElement('div');
        suggestionItem.textContent = suggestion.name;
        suggestionItem.classList.add('suggestion-item');
        suggestionItem.setAttribute('onclick', 'selectSuggestion(this.textContent)');
  
        suggestionsContainer.appendChild(suggestionItem);
      }
    }
  }
  
  function selectSuggestion(suggestion) {
    document.getElementById('search-input').value = suggestion;
    document.getElementById('suggestions-container').innerHTML = '';
  }
  