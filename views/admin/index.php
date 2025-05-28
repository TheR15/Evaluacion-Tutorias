<div class="flex">
    <?php include_once __DIR__ . '/../templates/sidebar.php'; ?>
    <div id="contenido" class="bg-white w-full">
        <?php include_once __DIR__ . '/../templates/barra.php'; ?>
        <div class="m-10 bg-white rounded-xl drop-shadow-md">
            <div class="flex justify-between items-center p-5">
                <h1 class="font-bold text-blue-600 text-xl">Evaluaciones</h1>
            </div>
            <?php include_once __DIR__ . '/../templates/buscar.php'; ?>
            <?php include_once __DIR__ . '/../templates/filtros.php'; ?>
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
<script src="build/js/inicio.js"></script>
<script src="build/js/gemma.js"></script>