document.getElementById("formMensaje").addEventListener("submit", function (e) {
    e.preventDefault();

    const servicio = document.getElementById("servicio").value;
    const mensaje = document.getElementById("mensaje").value.trim();
    const respuesta = document.getElementById("respuesta");

    if (servicio === "" || mensaje === "") {
        respuesta.innerHTML = "<div class='mensaje-error'>Todos los campos son obligatorios.</div>";
        return;
    }

    const datos = new URLSearchParams();
    datos.append("servicio", servicio);
    datos.append("mensaje", mensaje);

    fetch("mensaje_backend.php", {
        method: "POST",
        body: datos
    })
    .then(res => res.text())
    .then(data => {
        respuesta.innerHTML = data;
        document.getElementById("formMensaje").reset();
    })
    .catch(() => {
        respuesta.innerHTML = "<div class='mensaje-error'>Error de conexión.</div>";
    });
});
