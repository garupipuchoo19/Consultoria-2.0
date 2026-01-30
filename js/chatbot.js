let clienteId = null;
let ultimaRespuestaAdmin = null;

/* ===== Utilidad para mostrar mensajes ===== */
function addMsg(text, type){
  const box = document.getElementById("chat-messages");
  const div = document.createElement("div");
  div.className = "msg " + type;
  div.innerText = text;
  box.appendChild(div);
  box.scrollTop = box.scrollHeight;
}

/* ===== Validar e iniciar chat ===== */
document.getElementById("btnConfirmar").addEventListener("click", () => {
  const correo = document.getElementById("correo").value.trim();
  const telefono = document.getElementById("telefono").value.trim();

  if (!correo || !telefono) {
    alert("Debes ingresar correo y teléfono para continuar.");
    return;
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(correo)) {
    alert("Ingresa un correo válido.");
    return;
  }

  // GUARDAR LEAD Y DESBLOQUEAR CHAT
  fetch("api/guardar_lead.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ correo, telefono })
  })
  .then(r => r.json())
  .then(d => {
    if (d.ok) {
      clienteId = d.cliente_id;

      // 🔓 DESBLOQUEO REAL
      document.getElementById("lead-form").classList.add("hidden");
      document.getElementById("chat-input").classList.remove("hidden");

      document.getElementById("mensaje").disabled = false;
      document.getElementById("btnEnviar").disabled = false;

      addMsg(
        "Hola 👋 Hemos confirmado tus datos. ¿En qué podemos ayudarte?",
        "bot"
      );
    }
  });
});

/* ===== Enviar mensaje ===== */
document.getElementById("btnEnviar").addEventListener("click", () => {
  const msgInput = document.getElementById("mensaje");
  const msg = msgInput.value.trim();
  if (!msg || !clienteId) return;

  addMsg(msg, "user");
  msgInput.value = "";

  fetch("api/enviar_mensaje.php",{
    method:"POST",
    headers:{ "Content-Type":"application/json" },
    body: JSON.stringify({ cliente_id: clienteId, mensaje: msg })
  })
  .then(r => r.json())
  .then(d => {
    if (d.respuesta_bot) {
      addMsg(d.respuesta_bot, "bot");
    }
  });
});

/* ===== Consultar respuestas del admin ===== */
setInterval(() => {
  if (!clienteId) return;

  fetch("api/consultar_respuesta_admin.php?cliente_id=" + clienteId)
    .then(r => r.json())
    .then(data => {
      if (data.respuesta && data.respuesta !== ultimaRespuestaAdmin) {
        ultimaRespuestaAdmin = data.respuesta;
        addMsg("Soporte: " + data.respuesta, "admin");
      }
    });
}, 5000);
