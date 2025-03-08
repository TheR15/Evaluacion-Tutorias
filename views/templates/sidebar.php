<div id="sidebar" class="hidden md:block w-3xs bg-linear-to-t from-blue-700 to-blue-600 h-screen transition-all">
    <div class="flex justify-between items-center px-5">
        <h2 class="text-center text-white font-bold uppercase p-4 m-3">Administrador</h2>
        <button class="md:hidden cursor-pointer">
            <svg id="btn-cerrar" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff">
                <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
            </svg>
        </button>
    </div>
    <hr class="mx-4 border-gray-300">
    <div class="menu mt-6 cursor-pointer transition duration-400 ease-in-out p-2">
        <div class="flex gap-2 hover:bg-blue-800 p-3 rounded-xl">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
            </svg>
            <div class="flex justify-between w-full">
                <h3 class="text-white font-bold">Registro</h3>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF" class="flecha transition-all">
                    <path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z" />
                </svg>
            </div>
        </div>
        <div id="lista-registro" class="bg-white mx-4 mt-2 rounded-md transform transition-all duration-300 ease-in-out overflow-hidden max-h-0 drop-shadow-md">
            <ul>
                <div>
                    <li class="my-1"><a class="hover:bg-gray-200 rounded-md p-2 transition duration-200 ease-in-out flex"href="/maestros">Maestros</a></li>
                    <li class="my-1"><a class="hover:bg-gray-200 rounded-md p-2 transition duration-200 ease-in-out flex" href="/materias">Materias</a></li>
                    <li class="my-1"><a class="hover:bg-gray-200 rounded-md p-2 transition duration-200 ease-in-out flex" href="/alumnos">Alumnos</a></li>
                    <li class="my-1"><a class="hover:bg-gray-200 rounded-md p-2 transition duration-200 ease-in-out flex" href="/usuarios">Usuarios</a></li>
                </div>
            </ul>
        </div>
    </div>

    <div id="menu-asignar" class="menu cursor-pointer transition duration-400 ease-in-out p-2">
        <div class="flex gap-2 hover:bg-blue-800 p-3 mt-3 rounded-xl">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                <path d="M400-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM80-160v-112q0-33 17-62t47-44q51-26 115-44t141-18h14q6 0 12 2-8 18-13.5 37.5T404-360h-4q-71 0-127.5 18T180-306q-9 5-14.5 14t-5.5 20v32h252q6 21 16 41.5t22 38.5H80Zm560 40-12-60q-12-5-22.5-10.5T584-204l-58 18-40-68 46-40q-2-14-2-26t2-26l-46-40 40-68 58 18q11-8 21.5-13.5T628-460l12-60h80l12 60q12 5 22.5 11t21.5 15l58-20 40 70-46 40q2 12 2 25t-2 25l46 40-40 68-58-18q-11 8-21.5 13.5T732-180l-12 60h-80Zm40-120q33 0 56.5-23.5T760-320q0-33-23.5-56.5T680-400q-33 0-56.5 23.5T600-320q0 33 23.5 56.5T680-240ZM400-560q33 0 56.5-23.5T480-640q0-33-23.5-56.5T400-720q-33 0-56.5 23.5T320-640q0 33 23.5 56.5T400-560Zm0-80Zm12 400Z" />
            </svg>
            <div class="flex justify-between w-full">
                <h3 class="text-white font-bold">Asignar</h3>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF" class="flecha transition-all">
                    <path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z" />
                </svg>
            </div>
        </div>
        <div id="lista-asignar" class="bg-white mx-4 mt-2 rounded-md transform transition-all duration-300 ease-in-out overflow-hidden max-h-0">
            <ul>
                <div>
                    <li class="my-1"><a href="/evaluaciones" class="hover:bg-gray-200 rounded-md p-2 transition duration-200 ease-in-out flex">Evaluaciones</a></li>
                </div>
            </ul>
        </div>
    </div>
</div>
<script src="build/js/sidebar.js"></script>
<script src="build/js/dropdown.js"></script>