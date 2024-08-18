// menu.js

function doMenu() {
    // Get the select element
    let menu = document.querySelector('.nav-select');
    
    // Get the selected value
    let url = menu.value;
    
    // Define URL mappings for each option
    const urlMappings = {
        'home': 'index.html',
        'pets': 'pets.html',
        'addpet': 'add.html',
        'gallery': 'gallery.html'
    };
    
    // Get the full URL from the mapping
    let fullUrl = urlMappings[url];
    
    if (fullUrl) {
        if (fullUrl.includes("http")) {
            window.open(fullUrl); 
        } else {
            location.href = fullUrl;
        }
    }
}

// code generated in chatgpt \/\/\/\/\/ 
function navigatePage() {
    const selectElement = document.querySelector('.nav-select');
    const selectedValue = selectElement.value;
    if (selectedValue) {
        window.location.href = selectedValue;
    }
}


// Attach event listener to the select element once the document is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.nav-select').addEventListener('change', doMenu);
});
