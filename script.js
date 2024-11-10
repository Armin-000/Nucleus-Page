// Animacija za navigacijski meni
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('mouseover', () => {
        link.style.transform = 'scale(1.1)';
    });
    link.addEventListener('mouseleave', () => {
        link.style.transform = 'scale(1)';
    });
});



window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.custom-navbar');
    if (window.scrollY > 50) { // Možete prilagoditi visinu skrola
        navbar.classList.add('navbar-scrolled');
    } else {
        navbar.classList.remove('navbar-scrolled');
    }
});


// Hamburger menu animacija
const navbarToggler = document.querySelector('.navbar-toggler');
navbarToggler.addEventListener('click', () => {
    navbarToggler.classList.toggle('collapsed');
});







// EMAIL JS

// Inicijalizacija EmailJS s vašim javnim ključem
(function() {
    emailjs.init("vlvxYEJV5MK74v4KX"); // Zamijenite "vlvxYEJV5MK74v4KX" s vašim pravim javnim ključem
})();

// Dodavanje event listener-a na submit događaj forme
document.getElementById("contactForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Sprječava osvježavanje stranice

    // Slanje forme putem EmailJS
    emailjs.sendForm("service_x4ryp18", "template_82pqfrs", this)
        .then(function() {
            alert("Poruka uspješno poslana!"); // Ako je uspješno
        }, function(error) {
            alert("Došlo je do pogreške pri slanju poruke. Pokušajte ponovo."); // Ako postoji greška
            console.error("EmailJS Error:", error); // Ispisuje grešku u konzolu za dodatne informacije
        });
});



// POTVRDA SLANJA PORUKE

document.getElementById("contactForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    fetch("process.php", {
        method: "POST",
        body: new FormData(this)
    })
    .then(response => response.text())
    .then(data => {
        alert(data);  // Prikazuje poruku iz PHP skripte
        this.reset(); // Resetira formu nakon slanja
    })
    .catch(error => {
        console.error("Greška:", error);
    });
});







$(document).ready(function() {
    $.ajax({
        url: 'get_user.php',
        type: 'GET',
        success: function(response) {
            if (response !== "Gost") {
                $('#welcomeMessage').html('Dobrodošli, ' + response);
                $('#logoutLink').show();
                $('#loginLink').hide();
            } else {
                $('#welcomeMessage').html('Dobrodošli, Gost');
                $('#logoutLink').hide();
                $('#loginLink').show();
            }
        }
    });
});




