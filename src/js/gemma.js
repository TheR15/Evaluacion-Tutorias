document.addEventListener("DOMContentLoaded", function () {
    abrirGemma();
});

function abrirGemma() {
    const btnAbrirGemma = document.querySelector('#btn-abrir-gemma');
    const btnEnviar = document.getElementById("btn-enviar");
    const gemma = document.querySelector('#chat-gemma');

    btnAbrirGemma.addEventListener('click', function () {
        btnAbrirGemma.classList.add('hidden');
        gemma.classList.remove('hidden');
        btnEnviar.addEventListener("click", function () {
            sendMessage();
        });
    })

    const cerrarGemma = document.querySelector('#cerrar-gemma');
    cerrarGemma.addEventListener('click', function () {
        gemma.classList.add('hidden');
        btnAbrirGemma.classList.remove('hidden');
    });
}

async function sendMessage() {
    const userInput = document.getElementById("userInput").value;
    const chatbox = document.getElementById("chatbox");

    chatbox.innerHTML += `<p class="text-right mt-2 mb-2"><strong>Tú: </strong> ${userInput}</p>`;

    try {
        const response = await fetch("http://localhost:8000/chat", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ message: userInput }),
        });

        const data = await response.json();

        if (data.response) {
            // Respuesta tipo charla
            chatbox.innerHTML += `
                <p class="mt-2 mb-2" ><strong class="text-blue-700 font-medium ">Gemma: </strong> ${data.response}</p>
            `;
        }

    } catch (error) {
        chatbox.innerHTML += `<p style="color: red;">Error: ${error.message}</p>`;
    }

    document.getElementById("userInput").value = "";  // Limpia el input
}
