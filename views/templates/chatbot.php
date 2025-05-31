<div class="absolute fixed bottom-0 right-0 m-5 z-50">
    <button id="btn-abrir-gemma" class="w-15 h-15 bg-white rounded-full cursor-pointer drop-shadow-xl hover:drop-shadow-2xl hover:bg-blue-50 transition-all duration-300 ease-in-out">
        <img src="build/img/icon_gemmini.webp" alt="">
    </button>

    <div id="chat-gemma" class="w-full md:w-md flex flex-col gap-3 hidden bg-white p-5 drop-shadow-2xl rounded-md">
        <div class="flex justify-between items-center">
            <h1 class="text-blue-700 font-medium text-xl">Bienvenido a gemini</h1>
            <button id="cerrar-gemma" class="cursor-pointer"><svg id="icono-enviar" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#999999">
                    <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                </svg>
                <svg id="icono-spinner" class="hidden" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                    <path d="M480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-155.5t86-127Q252-817 325-848.5T480-880q17 0 28.5 11.5T520-840q0 17-11.5 28.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160q133 0 226.5-93.5T800-480q0-17 11.5-28.5T840-520q17 0 28.5 11.5T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Z" />
                </svg>
            </button>
        </div>
        <div id="chatbox" class="overflow-y-scroll w-full h-100 border-1 rounded-md p-3 border-gray-200 drop-shadow-md">
            <p><span class="text-blue-700 font-medium">Gemini:</span> Bienvenido al asistente de la evaluacion de tutorias en que puedo ayudarte?</p>
        </div>
        <div class="flex justify-between items-center gap-2">
            <input class="w-full px-1 py-2 border-1 border-gray-200 rounded-md focus:outline-blue-700" type="text" id="userInput" placeholder="Escribe tu mensaje...">
            <button id="btn-enviar" class="bg-blue-700 text-white px-4 py-2 rounded-md cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                    <path d="M440-160v-487L216-423l-56-57 320-320 320 320-56 57-224-224v487h-80Z" />
                </svg></button>
        </div>
    </div>
</div>