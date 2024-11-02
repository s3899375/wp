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

    showLoginErrorModal();

    showRegistrationModal();
});




function showLoginErrorModal() {
    const loginErrorModal = document.getElementById('loginErrorModal');
    const errorMessage = loginErrorModal.getAttribute('data-error-message');
    
    if (errorMessage) {
        const bootstrapModal = new bootstrap.Modal(loginErrorModal);
        

        bootstrapModal.show();

        loginErrorModal.addEventListener('hidden.bs.modal', function () {
            document.body.classList.remove('modal-open');
            const modalBackdrop = document.querySelector('.modal-backdrop');
            if (modalBackdrop) {
                modalBackdrop.remove();
            }
        });
    }
}

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

document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    navLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            navLinks.forEach(nav => {
                nav.classList.remove('active');
                nav.style.color = 'grey';
            });
            this.classList.add('active');
            this.style.color = 'white';
        });
    });
});

function togglePassword() {
    const passwordField = document.getElementById('password');
    const showPassword = document.querySelector('.show-password');
    if (passwordField.type === "password") {
        passwordField.type = "text";
        showPassword.textContent = "hide";
    } else {
        passwordField.type = "password";
        showPassword.textContent = "show";
    }
}

function filterPets() {
    var filterValue = document.getElementById("petFilter").value;
    var petCards = document.querySelectorAll(".pet-card");
    
    petCards.forEach(function(card) {
        if (filterValue === "all" || card.getAttribute("data-type") === filterValue) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
}


// scripts.js

function confirmDelete(petId) {
    if (confirm("Are you sure you want to delete this pet?")) {
        window.location.href = "delete.php?id=" + petId;
    }
}
