<div class="px-5 mt-5 flex gap-3 relative items-center">
    <h1 class="font-medium">Filtros : </h1>
    <div class="relative">
        <div id="btn-filtro-estado" class="border-gray-300 border-1 px-3 py-1 rounded-xl cursor-pointer hover:bg-gray-200">
            <button class="cursor-pointer">Estado</button>
        </div>
        <div id="drop-menu-estado" class="hidden flex flex-col gap-2 absolute top-10 p-3 bg-white rounded-md drop-shadow-md border-gray-300 border-1 w-60">
            <div class="flex justify-between items-center">
                <label for="buscar-grupo">Selecciona un filtro</label>
                <button id="btn-cerrar-estado" class="cursor-pointer rounded-xl hover:bg-gray-200 p-1"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                        <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                    </svg></button>
            </div>
            <div id="todas" class="flex gap-4">
                <input id="radio-todas" type="radio" value="radio-todas" name="estado" class="accent-blue-700 cursor-pointer">
                <label for="radio-todas" class="cursor-pointer">Todas</label>
            </div>
            <div id="completadas" class="flex gap-4">
                <input id="radio-completadas" type="radio" value="radio-completadas" name="estado" class="accent-blue-700 cursor-pointer">
                <label for="radio-completadas" class="cursor-pointer">Completadas</label>
            </div>
            <div id="noCompletadas" class="flex gap-4">
                <input id="radio-no-completadas" type="radio" value="radio-no-completadas" name="estado" class="accent-blue-700 cursor-pointer">
                <label for="radio-no-completadas" class="cursor-pointer">Sin Completar</label>
            </div>
        </div>
    </div>
    <div class="relative">
        <div id="btn-filtro-grupo" class="relative border-gray-300 border-1 px-3 py-1 rounded-xl cursor-pointer hover:bg-gray-200">
            <button class="cursor-pointer">Grupo</button>
        </div>
        <div id="drop-menu-grupo" class="hidden flex flex-col gap-2 absolute top-10 p-3 bg-white rounded-md drop-shadow-md border-gray-300 border-1 block w-80">
            <div class="">
                <div class="flex justify-between items-center">
                    <label for="buscar-grupo">Ingresa el grupo</label>
                    <button id="btn-cerrar-grupo" class="cursor-pointer rounded-xl hover:bg-gray-200 p-1"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                            <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                        </svg></button>
                </div>
                <input id="buscar-grupo" type="text" class="mt-2 block w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500" placeholder="Buscar">
            </div>
            <div id="listado">

            </div>
        </div>
    </div>
</div>