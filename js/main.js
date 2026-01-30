document.addEventListener("DOMContentLoaded", () => {

  const btn = document.getElementById("open-chat");
  const frame = document.getElementById("chat-frame");

  if (!btn || !frame) {
    console.error("Botón o iframe del chatbot no encontrados");
    return;
  }

  btn.addEventListener("click", () => {
    if (frame.style.display === "none" || frame.style.display === "") {
      frame.style.display = "block";
    } else {
      frame.style.display = "none";
    }
  });

});
