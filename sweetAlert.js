var aboutButton = document.getElementById("aboutButton");
if (aboutButton) {
    aboutButton.addEventListener("click", function () {
        if (window.Swal && typeof window.Swal.fire === "function") {
            window.Swal.fire({
                title: "",
                html: "<div class=\"about-text\">Developed by<br>Žiga Kranjc<br>4. Rb</div>",
                customClass: { popup: "about-popup" },
                showConfirmButton: true,
                confirmButtonText: "OK",
                customClass: { popup: "about-popup", confirmButton: "about-confirm" }
            });
        }
    });
}