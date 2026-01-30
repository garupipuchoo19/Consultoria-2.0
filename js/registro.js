document.getElementById("formRegistro").addEventListener("submit", function(e) {
    e.preventDefault();

    const datos = new URLSearchParams({
        nombre: document.getElementById("nombre").value,
        correo: document.getElementById("correo").value,
        telefono: document.getElementById("telefono").value
    });

    fetch("registro_backend.php", {
        method: "POST",
        body: datos
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById("respuesta").innerHTML = data;
    });
});
