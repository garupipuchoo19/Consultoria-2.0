document.getElementById("formLogin").addEventListener("submit", function(e) {
    e.preventDefault();

    const correo = document.getElementById("correo").value.trim();
    const respuesta = document.getElementById("respuesta");

    if (correo === "") {
        respuesta.innerHTML = "El correo es obligatorio";
        return;
    }

    fetch("enviar_correo.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "correo=" + encodeURIComponent(correo)
    })
    .then(res => res.text())
    .then(data => {
        if (data === "ok") {
            window.location.href = "dashboard.php";
        } else {
            respuesta.innerHTML = data;
        }
    });
});
