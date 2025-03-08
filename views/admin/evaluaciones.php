<div class="flex">
    <?php include_once __DIR__ . '/../templates/sidebar.php'; ?>
    <div id="contenido" class="bg-slate-100 w-full">
        <?php include_once __DIR__ . '/../templates/barra.php'; ?>
        <div class="m-10 bg-white rounded-xl drop-shadow-md">
            <div class="flex justify-between items-center p-5">
                <h1 class="font-bold text-blue-600 text-xl">Asignar evaluaciones</h1>
                <button id="btn-crear" class="bg-blue-600 px-3 py-2 rounded-xl text-white font-bold cursor-pointer hover:bg-blue-700 hover:scale-110 transition-all">Asignar por grupo</button>
            </div>
            <?php include_once __DIR__ . '/../templates/buscar.php'; ?>
            <div class="mt-5 px-5">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-700 border-b-1 border-gray-300">
                            <th class="p-3">Alumno</th>
                            <th class="p-3">Tutor</th>
                            <th class="p-3">Estado</th>
                            <th class="p-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    const entidadNombre = 'evaluaciones';
    const entidadSingular = 'evaluacion';
</script>
<script src="build/js/crud.js"></script>