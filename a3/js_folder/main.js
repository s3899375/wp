function doMenu() {
    let menu = document.querySelector('.nav-select');
    let url = menu.value;
    
    console.log("Selected URL:", url);  

    const urlMappings = {
        'home': 'index.php',
        'pets': 'pets.php',
        'addpet': 'add.php',
        'gallery': 'gallery.php'
    };

    let fullUrl = urlMappings[url];

    if (fullUrl) {
        console.log("Navigating to:", fullUrl);  
        location.href = fullUrl;  
    }
}



document.addEventListener('DOMContentLoaded', function() {
    const selectElement = document.querySelector('.nav-select');
    
    if (selectElement) {
        selectElement.addEventListener('change', doMenu);
    }


    const imageUpload = document.getElementById('imageUpload');
    if (imageUpload) {
        imageUpload.addEventListener('change', function() {
            validateImageSize(this);
        });
    }
});



function validateDescription() {
    const description = document.getElementById('petDescription').value;
    const words = description.trim().split(/\s+/); 
    const wordLimit = 300;

    if (words.length > wordLimit) {
        document.getElementById('descriptionError').style.display = 'block';
        return false;
    } else {
        document.getElementById('descriptionError').style.display = 'none';
        return true;
    }
}


function validateImageSize(input) {
    const file = input.files[0];
    const imageError = document.getElementById('imageError'); 

    if (file) {
        const img = new Image();
        img.src = URL.createObjectURL(file);
        img.onload = function() {
            if (img.width > 500) {
                imageError.style.display = 'block'; 
                input.value = ''; 
            } else {
                imageError.style.display = 'none'; 
            }
        };
    }
}


function autoResize(textarea) {
    textarea.style.height = 'auto'; 
    textarea.style.height = `${Math.min(textarea.scrollHeight, 200)}px`; 
}


document.getElementById('petDescription').addEventListener('input', validateDescription);
