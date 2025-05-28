<div class="flex">
    <?php include_once __DIR__ . '/../templates/sidebar.php'; ?>
    <div id="contenido" class="bg-white w-full">
        <?php include_once __DIR__ . '/../templates/barra.php'; ?>
        <div class="m-10 bg-white rounded-xl drop-shadow-md z-0 relative">
            <div class="flex justify-between items-center p-5">
                <h1 class="font-bold text-blue-600 text-xl">Configuracion del sistema</h1>
            </div>
        </div>

        <div class="mx-10 border-1 border-gray-200 rounded-xl">
            <div class="bg-green-100">
                <div class="p-5">
                    <h2 class="flex items-center gap-3 text-xl font-medium"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                            <path d="M480-120 200-272v-240L40-600l440-240 440 240v320h-80v-276l-80 44v240L480-120Zm0-332 274-148-274-148-274 148 274 148Zm0 241 200-108v-151L480-360 280-470v151l200 108Zm0-241Zm0 90Zm0 0Z" />
                        </svg>Actualizar Semestre</h2>
                    <p class="text-sm text-gray-600">Avanza a todos los alumnos al siguiente semestre automáticamente</p>
                </div>
            </div>

            <div class="p-5">
                <div class="flex gap-5 bg-yellow-50 p-5 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" height="50px" viewBox="0 -960 960 960" width="50px" fill="#f1c40f">
                        <path d="m40-120 440-760 440 760H40Zm138-80h604L480-720 178-200Zm302-40q17 0 28.5-11.5T520-280q0-17-11.5-28.5T480-320q-17 0-28.5 11.5T440-280q0 17 11.5 28.5T480-240Zm-40-120h80v-200h-80v200Zm40-100Z" />
                    </svg>
                    <div class="flex flex-col">
                        <h3 class="text-yellow-900 font-medium">Importante</h3>
                        <p class="text-yellow-900">Esta acción actualizará el semestre de todos los alumnos activos en el sistema. Los alumnos en último semestre (8vo) serán marcados como egresados.</p>
                    </div>
                </div>
                <div class="p-5 border-1 border-gray-200 rounded-xl mt-5 bg-gray-50">
                    <h3 class="font-medium mb-3">¿Qué hace esta función?</h3>
                    <ul class="flex flex-col gap-3">
                        <li class="flex gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#75FB4C">
                                <path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z" />
                            </svg>
                            <p>Incrementa automáticamente el semestre de todos los alumnos activos</p>
                        </li>
                        <li class="flex gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#75FB4C">
                                <path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z" />
                            </svg>
                            <p>Los alumnos de 1er semestre pasan a 2do, los de 2do a 3ro, y así sucesivamente</p>
                        </li>
                        <li class="flex gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#75FB4C">
                                <path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z" />
                            </svg>
                            <p>Los alumnos que están en 8vo semestre serán marcados como "Egresados"</p>
                        </li>
                    </ul>
                </div>
                <div class="flex gap-5 bg-blue-50 p-5 rounded-xl mt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#0000F5">
                        <path d="M440-280h80v-240h-80v240Zm40-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                    </svg>
                    <div>
                        <h3 class="text-blue-800 font-medium">Recomendación</h3>
                        <p class="text-blue-700">Se recomienda realizar esta acción al finalizar el ciclo escolar, después de haber respaldado todos los datos del sistema.</p>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button id="btn-actualizar-semestre" class="cursor-pointer mt-5 flex gap-3 bg-green-600 hover:bg-green-700 text-white p-3 rounded-xl text-medium"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                            <path d="M480-120 200-272v-240L40-600l440-240 440 240v320h-80v-276l-80 44v240L480-120Zm0-332 274-148-274-148-274 148 274 148Zm0 241 200-108v-151L480-360 280-470v151l200 108Zm0-241Zm0 90Zm0 0Z" />
                        </svg>Avanzar semestre</button>
                </div>

            </div>
        </div>


        <div class="border-1 border-gray-200 rounded-xl mx-10 mt-10 ">
            <div class="bg-red-100">
                <div class="p-5">
                    <h2 class="flex items-center gap-3 text-xl font-medium"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                            <path d="M480-120 200-272v-240L40-600l440-240 440 240v320h-80v-276l-80 44v240L480-120Zm0-332 274-148-274-148-274 148 274 148Zm0 241 200-108v-151L480-360 280-470v151l200 108Zm0-241Zm0 90Zm0 0Z" />
                        </svg>Reestablecer sistema</h2>
                    <p class="text-sm text-gray-600">Elimina todos los datos del sistema (alumnos, maestros y evaluaciones)</p>
                </div>
            </div>
            <div class="flex flex-col md:flex-row gap-5 p-5">
                <div class="bg-white rounded-xl drop-shadow-md border-1 border-gray-200">
                    <div class="bg-blue-100">
                        <div class="p-5">
                            <h2 class="flex items-center gap-3 text-xl font-medium"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                                    <path d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z" />
                                </svg>Alumnos</h2>
                            <p class="text-sm text-gray-600">Elimina todos los registros de alumnos del sistema</p>
                        </div>
                    </div>
                    <p class="text-gray-600 p-5">Esta acción eliminará permanentemente todos los datos de alumnos, incluyendo sus evaluaciones asociadas.</p>
                    <div class="p-5">
                        <button id="btn-eliminar-alumnos" class="fondo-boton cursor-pointer flex justify-center items-center w-full p-3 gap-3 text-white font-medium rounded-xl"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff">
                                <path d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z" />
                            </svg>Borrar Alumnos</button>
                    </div>
                </div>
                <div class="bg-white rounded-xl drop-shadow-md border-1 border-gray-200">
                    <div class="bg-purple-100">
                        <div class="p-5">
                            <h2 class="flex items-center gap-3 text-xl font-medium"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                                    <path d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z" />
                                </svg>Maestros</h2>
                            <p class="text-sm text-gray-600">Elimina todos los registros de maestros del sistema</p>
                        </div>
                    </div>
                    <p class="text-gray-600 p-5">Esta acción eliminará permanentemente todos los datos de maestros, incluyendo sus asignaciones.</p>
                    <div class="p-5">
                        <button id="btn-eliminar-maestros" class="fondo-boton cursor-pointer flex justify-center items-center w-full p-3 gap-3 bg-red-400 text-white font-medium rounded-xl"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff">
                                <path d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z" />
                            </svg>Borrar Maestros</button>
                    </div>
                </div>
                <div class="bg-white rounded-xl drop-shadow-md border-1 border-gray-200">
                    <div class="bg-yellow-100">
                        <div class="p-5">
                            <h2 class="flex items-center gap-3 text-xl font-medium"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                                    <path d="M120-80v-60h100v-30h-60v-60h60v-30H120v-60h120q17 0 28.5 11.5T280-280v40q0 17-11.5 28.5T240-200q17 0 28.5 11.5T280-160v40q0 17-11.5 28.5T240-80H120Zm0-280v-110q0-17 11.5-28.5T160-510h60v-30H120v-60h120q17 0 28.5 11.5T280-560v70q0 17-11.5 28.5T240-450h-60v30h100v60H120Zm60-280v-180h-60v-60h120v240h-60Zm180 440v-80h480v80H360Zm0-240v-80h480v80H360Zm0-240v-80h480v80H360Z" />
                                </svg>Evaluaciones</h2>
                            <p class="text-sm text-gray-600">Elimina todas la evaluaciones del sistema.</p>
                        </div>
                    </div>
                    <p class="text-gray-600 p-5">Esta acción eliminará permanentemente todas las evaluaciones de tutorías, pero mantendrá los registros de alumnos y maestros.</p>
                    <div class="p-5">
                        <button id="btn-eliminar-evaluaciones" class="fondo-boton cursor-pointer flex justify-center items-center w-full p-3 gap-3 bg-red-400 text-white font-medium rounded-xl"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff">
                                <path d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z" />
                            </svg>Borrar Evaluaciones</button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl drop-shadow-md p-5">
                <div class="bg-red-100 rounded-lg">
                    <div class="p-5">
                        <h2 class="flex items-center gap-3 text-xl font-medium"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                                <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                            </svg>Reestablecer todo el sistema</h2>
                        <p class="text-sm text-gray-600">Elimina todos los datos del sistema (alumnos, maestros y evaluaciones)</p>
                    </div>
                </div>
                <p class="text-gray-600 p-5"><span class="font-medium">¡ADVERTENCIA!</span> Esta acción eliminará permanentemente todos los datos del sistema. El sistema volverá a su estado inicial como si acabara de ser instalado.</p>
                <div class="p-5">
                    <button id="btn-reestablecer" class="fondo-boton cursor-pointer flex justify-center items-center w-full p-3 gap-3 bg-red-400 text-white font-medium rounded-xl"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff">
                            <path d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z" />
                        </svg>Reestablecer sistema</button>
                </div>
            </div>
        </div>

        <?php include_once __DIR__ . '/../templates/chatbot.php'; ?>
    </div>
    <script src="build/js/reestablecer.js"></script>