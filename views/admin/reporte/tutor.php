<div class="flex">
    <?php include_once __DIR__ . '/../../templates/sidebar.php'; ?>
    <div id="contenido" class="bg-slate-100 w-full">
        <?php include_once __DIR__ . '/../../templates/barra.php'; ?>
        <div class="flex justify-between items-center m-10 bg-white rounded-xl drop-shadow-md z-0 relative">
            <div class="flex flex-col p-5">
                <h1 class="font-bold text-blue-600 text-xl">Reporte de tutores</h1>
                <p class="text-gray-600">Visualiza estadísticas y métricas de desempeño de tutores.</p>
            </div>
        </div>
        <div class="flex flex-col md:flex-row gap-5 m-10">
            <div class="bg-white rounded-xl drop-shadow-md p-5 w-auto">
                <div class="flex flex-col h-full gap-5">
                    <div class="flex flex-col gap-5">
                        <div class="flex flex-col gap-3">
                            <h1 class="font-medium text-xl">Estadisticas por tutor</h1>
                            <p class="text-gray-600">Elige un tutor para ver sus estadísticas</p>
                            <h2>Tutor</h2>
                        </div>
                        <select id="select-tutores" name="tutores" class="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500">
                            <option selected disabled value="">Selecciona el tutor</option>
                        </select>
                        <div id="container-preguntas" class="hidden flex flex-col gap-3">
                            <h2>Pregunta</h2>
                            <select id="select-preguntas" name="tutor" class="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500">
                                <option selected disabled value="" id='pregunta-default'>Selecciona la pregunta</option>
                                <option value="A">Pregunta A</option>
                                <option value="B">Pregunta B</option>
                                <option value="C">Pregunta C</option>
                                <option value="D">Pregunta D</option>
                            </select>
                        </div>
                        <div id="totales" class="flex flex-col gap-3 hidden">
                            <div class="flex justify-between">
                                <h2>Grupo</h2>
                                <h2 id="grupoTutorias" class="text-center font-medium text-xl"></h2>
                            </div>
                            <h2>Estadísticas</h2>
                            <div class="flex justify-between py-2 items-center bg-gray-50 px-3 py-1 rounded-md border-1 border-gray-200 text-gray-600 font-medium">
                                <h3 class="flex items-centerc gap-2"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#999999">
                                        <path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                                    </svg>Total de alumnos</h3>
                                <label for="" id="totalAlumnos" class="text-gray-600 font-bold"></label>
                            </div>
                            <div class="flex justify-between py-2 items-center bg-green-50 px-3 py-1 rounded-md border-1 border-gray-200 text-green-600 font-medium">
                                <h3 class="flex items-centerc gap-2"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#2ecc71">
                                        <path d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                    </svg>Total realizadas</h3>
                                <label for="" id="totalRealizadas" class="text-green-600 font-bold"></label>
                            </div>
                            <div class="flex justify-between py-2 items-center bg-red-50 px-3 py-1 rounded-md border-1 border-red-200 text-red-600 font-medium">
                                <h3 class="flex items-centerc gap-2"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#c0392b">
                                        <path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                    </svg>Total sin realizar</h3>
                                <label for="" id="totalSinRealizar" class="text-red-600 font-bold"></label>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <button id="btn-generar-reporte" class="hidden flex justify-center gap-2 w-full bg-blue-600 px-3 py-2 rounded-xl text-white font-bold cursor-pointer hover:bg-blue-700 hover:scale-110 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                                <path d="M360-460h40v-80h40q17 0 28.5-11.5T480-580v-40q0-17-11.5-28.5T440-660h-80v200Zm40-120v-40h40v40h-40Zm120 120h80q17 0 28.5-11.5T640-500v-120q0-17-11.5-28.5T600-660h-80v200Zm40-40v-120h40v120h-40Zm120 40h40v-80h40v-40h-40v-40h40v-40h-80v200ZM320-240q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320Zm0-80h480v-480H320v480ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Zm160-720v480-480Z" />
                            </svg>Generar reporte</button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl drop-shadow-md flex-1 p-5 flex flex-col min-h-[400px]">
                <div class="flex flex-col flex-1">
                    <div class="flex items-center justify-between">
                        <h1 class="font-medium text-xl mb-4" id="titulo-grafica"></h1>
                    </div>
                    <div class="flex-1 relative"> <!-- Contenedor flexible para la gráfica -->
                        <canvas id="myChart" class="w-full h-full"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="build/js/estadisticasTutor.js"></script>