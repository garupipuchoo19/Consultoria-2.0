document.addEventListener("DOMContentLoaded", () => {

  let clienteId = null;
  let ultimaRespuestaAdmin = null;

  /* =========================
     UTILIDAD: MOSTRAR MENSAJES
     ========================= */
  function addMsg(text, type) {
    const box = document.getElementById("chat-messages");
    if (!box) return;

    const div = document.createElement("div");
    div.className = "msg " + type;
    div.innerText = text;
    box.appendChild(div);
    box.scrollTop = box.scrollHeight;
  }

  /* =========================
     GUARDAR DATOS (OPCIONAL)
     ========================= */
  const btnGuardar = document.getElementById("btnGuardar");
  if (btnGuardar) {
    btnGuardar.addEventListener("click", () => {
      const correo = document.getElementById("correo").value.trim();
      const telefono = document.getElementById("telefono").value.trim();

      if (!correo && !telefono) {
        addMsg("Puedes escribir sin guardar tus datos 👍", "bot");
        return;
      }

      fetch("api/guardar_lead.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ correo, telefono })
      })
      .then(r => r.json())
      .then(d => {
        if (d.ok) {
          clienteId = d.cliente_id;
          addMsg("Datos guardados correctamente 👍", "bot");
        } else {
          addMsg("No se pudieron guardar los datos.", "bot");
        }
      })
      .catch(() => {
        addMsg("⚠️ Error al guardar los datos.", "bot");
      });
    });
  }

  /* =========================
     ENVIAR MENSAJE (SIEMPRE ACTIVO)
     ========================= */
  const btnEnviar = document.getElementById("btnEnviar");
  if (btnEnviar) {
    btnEnviar.addEventListener("click", () => {
      const msgInput = document.getElementById("mensaje");
      if (!msgInput) return;

      const msg = msgInput.value.trim();
      if (!msg) return;

      addMsg(msg, "user");
      msgInput.value = "";

      fetch("api/enviar_mensaje.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          cliente_id: clienteId || 0,
          mensaje: msg
        })
      })
      .then(r => r.json())
      .then(d => {
        if (d.ok && d.respuesta_bot) {
          addMsg(d.respuesta_bot, "bot");
        } else {
          addMsg("⚠️ No se pudo procesar el mensaje.", "bot");
        }
      })
      .catch(() => {
        addMsg("⚠️ Error de comunicación con el servidor.", "bot");
      });
    });
  }

  /* =========================
     RESPUESTAS DEL ADMIN (POLLING)
     ========================= */
  setInterval(() => {
    if (!clienteId) return;

    fetch("api/consultar_respuesta_admin.php?cliente_id=" + clienteId)
      .then(r => r.json())
      .then(data => {
        if (data.respuesta && data.respuesta !== ultimaRespuestaAdmin) {
          ultimaRespuestaAdmin = data.respuesta;
          addMsg("Soporte: " + data.respuesta, "admin");
        }
      })
      .catch(() => {
        // silencioso para no molestar al usuario
      });
  }, 5000);

});
