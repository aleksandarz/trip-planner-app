document.addEventListener("DOMContentLoaded", function () {
    document
        .querySelector("#register-btn")
        .addEventListener("click", function (event) {
            event.preventDefault(); // Sprečava podrazumevano slanje forme

            let form = document.querySelector("form");
            let formData = new FormData(form); // Kreiramo FormData objekat

            fetch("../backend/auth/register.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.text()) // Dobijamo odgovor kao plain text
                .then((data) => {
                    console.log("PHP Response:", data); // Prikazujemo odgovor u konzoli

                    if (data.trim() === "success") {
                        window.location.href = "../frontend/index.html"; // Ako je uspešno, preusmeravamo
                    } else {
                        alert(data); // Ako nije, prikaži poruku iz PHP-a
                    }
                })
                .catch((error) => {
                    console.error("Fetch error:", error);
                    alert("There was an error. Check the console.");
                });
        });
});
