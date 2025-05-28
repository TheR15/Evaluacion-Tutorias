<div class="flex">
    <?php include_once __DIR__ . '/../templates/sidebar.php'; ?>
    <div id="contenido" class="bg-white w-full">
        <?php include_once __DIR__ . '/../templates/barra.php'; ?>
        <div class="m-10 bg-white rounded-xl drop-shadow-md">
            <div class="flex flex-col md:flex-row justify-between items-center p-5">
                <h1 class="font-bold text-blue-600 text-xl">Asignar evaluaciones</h1>
                <div class="flex flex-col mt-3 w-full md:w-auto md:mt-0 md:flex-row gap-5">
                    <button id="btn-eliminar" class="flex items-center justify-center md:w-auto w-full gap-2 bg-white px-3 py-2 rounded-xl font-medium border-1 border-gray-300 cursor-pointer hover:bg-red-200 hover:border-red-300 transition-all"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#8B1A10">
                            <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                        </svg>Eliminar grupo</button>
                    <button id="btn-cambiar" class="flex items-center justify-center gap-2 bg-white px-3 py-2 rounded-xl font-medium border-1 border-gray-300 cursor-pointer hover:bg-gray-100 transition-all"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#B7B7B7">
                            <path d="M480-160q-134 0-227-93t-93-227q0-134 93-227t227-93q69 0 132 28.5T720-690v-110h80v280H520v-80h168q-32-56-87.5-88T480-720q-100 0-170 70t-70 170q0 100 70 170t170 70q77 0 139-44t87-116h84q-28 106-114 173t-196 67Z" />
                        </svg> Cambiar tutor</button>
                    <button id="btn-crear" class="bg-blue-600 px-3 py-2 rounded-xl text-white font-bold cursor-pointer hover:bg-blue-700 hover:scale-110 transition-all">Asignar por grupo</button>
                </div>
            </div>
            <?php include_once __DIR__ . '/../templates/buscar.php'; ?>
            <div class="mt-5 px-5">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-700 border-b-1 border-gray-300">
                            <th class="p-3">Alumno</th>
                            <th class="md:table-cell hidden p-3">Tutorias</th>
                            <th class="md:table-cell hidden p-3">Tutor</th>
                            <th class="p-3">Estado</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                </table>
            </div>
        </div>
    </div>
    <?php include_once __DIR__ . '/../templates/chatbot.php'; ?>
</div>
<script>
    const entidadNombre = 'evaluaciones';
    const entidadSingular = 'evaluacion';
</script>
<script src="build/js/crud.js"></script>
<script src="build/js/gemma.js"></script>