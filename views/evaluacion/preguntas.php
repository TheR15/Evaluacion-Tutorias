<div>
    <div class="w-full">
        <?php include_once __DIR__ . '/../templates/barra.php'; ?>
    </div>


    <div class="flex justify-center items-center">
        <?php if ($evaluacion->estado === '0') { ?>
            <div id="mensaje-exito" class="hidden mt-10 container mx-auto p-5 bg-white rounded-xl drop-shadow-md">
                <p class="uppercase text-xl text-green-700 font-bold text-center">La evaluacion se envio correctamente. Ya puedes cerrar la pestaña</p>
            </div>
            <div id="container-preguntas" class="flex flex-col justify-center gap-5 mt-10 container mx-auto">
                <div class="border-1 border-gray-200 p-3 rounded-xl bg-sky-50">
                    <h2 class="font-medium text-xl">Nombre del tutor: <span class="font-bold"><?php echo $maestro->nombre . ' ' . $maestro->apellidos ?></span></h2>
                </div>
                <form method="POST" action="" class="flex flex-col gap-5 mb-20">
                    <!--Pregunta 1-->
                    <div class="flex flex-col gap-5 bg-white p-5 border-1 border-gray-200 rounded-xl">
                        <h2 class="text-xl text-center font-medium text-left">A.- Genera un
                            clima de confianza
                            que permite el
                            logro de los
                            propositos de la
                            tutoria</h2>
                        <hr class="border-gray-400">
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50 active:bg-blue-200">
                            <input type="radio" name="pregunta1" id="A5" class="w-5 h-5" value="5">
                            <label for="A5" class="flex flex-col cursor-pointer"><span class="text-blue-700 font-medium">
                                    5 - Excelente
                                </span>Genera confianza y
                                buena comunicación
                                con todo el grupo. Hace
                                agradable la sesión de
                                tutoría. Escucha con
                                atención todo lo que se
                                lo solicita. Se muestra
                                empático con las </label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta1" id="A4" class="w-5 h-5" value="4">
                            <label for="A4" class="cursor-pointer"><span class="text-blue-700 font-medium">
                                    5 - Muy bueno
                                </span> Genera confianza y
                                buena comunicación
                                con todo el grupo. Hace
                                agradable la sesión de
                                tutoría. Escucha con
                                atención todo lo que se
                                le solicita</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta1" id="A3" class="w-5 h-5" value="3">
                            <label for="A3" class="cursor-pointer"><span class="text-blue-700 font-medium">
                                    3 - Bueno
                                </span>Genera confianza y
                                buena comunicación
                                con todo el grupo. Hace
                                agradable la sesión de
                                tutoría</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta1" id="A2" class="w-5 h-5" value="2">
                            <label for="A2" class="cursor-pointer"><span class="text-blue-700 font-medium">
                                    2 - Regular
                                </span>Genera confianza y
                                buena comunicación
                                con todo el grupo</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta1" id="A1" class="w-5 h-5" value="1">
                            <label for="A1" class="cursor-pointer"><span class="text-blue-700 font-medium">
                                    1 - Insuficiente
                                </span>Se comunica con
                                todo el grupo</label>
                        </div>
                        <hr class="border-gray-400">
                    </div>
                    <!--Pregunta 2-->
                    <div class="flex flex-col gap-5 bg-white p-5 border-1 border-gray-200 rounded-xl">
                        <h2 class="text-xl text-center font-medium text-left">B.- Calidad de la
                            información proporcionada al tutorado</h2>
                        <hr class="border-gray-400">
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50 focus:bg-blue-100">
                            <input type="radio" name="pregunta2" id="B5" class="w-5 h-5" value="5">
                            <label for="B5" class="flex flex-col cursor-pointer"><span class="text-blue-700 font-medium">
                                    5 - Excelente
                                </span>Da información necesaria sobre el programa de tutorías. Provee de la información adecuada para
                                realizar trámites escolares. Proporciona información suficiente sobre los apoyos que requiere el
                                estudiante. Da información y orientación importante que apoye el área personal del tutorado. Informa con
                                precisión sobre las asesorías académicas que ofrecen los docentes de su carrera.</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta2" id="B4" class="w-5 h-5" value="4">
                            <label for="B4" class="flex flex-col cursor-pointer"><span class="text-blue-700 font-medium">
                                    4 - Muy bueno
                                </span>Da información necesaria sobre el programa de tutorías. Provee de la información adecuada para
                                realizar trámites escolares. Proporciona información suficiente sobre los apoyos que requiere el estudiante.
                                Da información y orientación importante que apoye el área personal del tutorado.</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta2" id="B3" class="w-5 h-5" value="3">
                            <label for="B3" class="flex flex-col cursor-pointer"><span class="text-blue-700 font-medium">
                                    3 - Bueno
                                </span>Da información necesaria sobre el programa de tutorías. Provee de la información adecuada para
                                realizar trámites escolares.</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta2" id="B2" class="w-5 h-5" value="2">
                            <label for="B2" class="flex flex-col cursor-pointer"><span class="text-blue-700 font-medium">
                                    2 - Regular
                                </span>Comenta en qué consiste el programa de tutorías.</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta2" id="B1" class="w-5 h-5" value="1">
                            <label for="B1" class="flex flex-col cursor-pointer"><span class="text-blue-700 font-medium">
                                    1 - Insuficiente
                                </span>Se comunica con todo el grupo.</label>
                        </div>
                        <hr class="border-gray-400">
                    </div>
                    <!-- Pregunta 3 -->
                    <div class="flex flex-col gap-5 bg-white p-5 border-1 border-gray-200 rounded-xl">
                        <h2 class="text-xl text-center font-medium text-left">C.- Disponibilidad y calidad en la atención tutorial.</h2>

                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta3" id="C5" class="w-5 h-5" value="5">
                            <label for="C5" class="cursor-pointer">
                                <span class="text-blue-700 font-medium">5 - Excelente</span> Se le puede localizar en cualquier momento. Entregó su horario y localización desde el inicio del semestre. Atiende con amabilidad cada que se le necesita. Canaliza adecuadamente a los tutorados siempre que tienen algún problema y que no pueda resolver. Realiza su función tutorial con disponibilidad y calidad. Le da seguimiento a los tutorados que ha canalizado.
                            </label>
                        </div>

                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta3" id="C4" class="w-5 h-5" value="4">
                            <label for="C4" class="cursor-pointer">
                                <span class="text-blue-700 font-medium">4 - Muy bueno</span> Se le puede localizar en cualquier momento. Entregó su horario y localización desde el inicio del semestre. Atiende con amabilidad cada que se le necesita. Canaliza adecuadamente a los tutorados siempre que tienen algún problema que él no pueda resolver.
                            </label>
                        </div>

                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta3" id="C3" class="w-5 h-5" value="3">
                            <label for="C3" class="cursor-pointer">
                                <span class="text-blue-700 font-medium">3 - Bueno</span> Entregó su horario y localización desde el inicio del semestre. Atiende con amabilidad cada que se le necesita. Canaliza adecuadamente a los tutorados siempre que tienen algún problema y que él no pueda resolver.
                            </label>
                        </div>

                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta3" id="C2" class="w-5 h-5" value="2">
                            <label for="C2" class="cursor-pointer">
                                <span class="text-blue-700 font-medium">2 - Regular</span> Atiende con amabilidad cada que se le necesita. Canaliza adecuadamente a los tutorados siempre que tienen algún problema que él no pueda resolver.
                            </label>
                        </div>

                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta3" id="C1" class="w-5 h-5" value="1">
                            <label for="C1" class="cursor-pointer">
                                <span class="text-blue-700 font-medium">1 - Insuficiente</span> Atiende con amabilidad cada que se le necesita.
                            </label>
                        </div>

                        <hr class="border-gray-400">
                    </div>

                    <!-- Pregunta 4 -->
                    <div class="flex flex-col gap-5 bg-white p-5 border-1 border-gray-200 rounded-xl">
                        <h2 class="text-xl text-center font-medium text-left">D.- Planeación y preparación en los procesos de la Tutoría</h2>

                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta4" id="D5" class="w-5 h-5" value="5">
                            <label for="D5" class="cursor-pointer">
                                <span class="text-blue-700 font-medium">5 - Excelente</span> Muestra tener las herramientas necesarias para atender el grupo y/o individualmente. Realiza la programación de las sesiones considerando los tiempos disponibles de los estudiantes. Muestra evidencia de que planeó las sesiones individuales y grupales con sus tutorados, pues lleva un orden en sus actividades. Realiza sus actividades como tutor respetando los tiempos disponibles para ello, evitando interrupciones que coarten el hilo de la sesión. Planea, ejecuta y evalúa su actividad tutorial continuamente con fines de realimentación.
                            </label>
                        </div>

                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta4" id="D4" class="w-5 h-5" value="4">
                            <label for="D4" class="cursor-pointer">
                                <span class="text-blue-700 font-medium">4 - Muy bueno</span> Muestra tener las herramientas necesarias para atender el grupo y/o individual. Realiza la programación de las sesiones considerando los tiempos disponibles de los estudiantes. Muestra evidencias de que planeó las sesiones individuales y grupales con sus tutorados, pues lleva un orden en sus actividades. Realiza sus actividades como tutor respetando los tiempos disponibles para ello, evitando interrupciones que coarten el hilo de la sesión.
                            </label>
                        </div>

                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta4" id="D3" class="w-5 h-5" value="3">
                            <label for="D3" class="cursor-pointer">
                                <span class="text-blue-700 font-medium">3 - Bueno</span> Muestra tener las herramientas necesarias para atender el grupo y/o individualmente. Realiza la programación de las sesiones considerando los tiempos disponibles de los estudiantes. Muestra evidencias de que planeó las sesiones individuales y grupales con sus tutorados, pues lleva un orden en sus actividades.
                            </label>
                        </div>

                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta4" id="D2" class="w-5 h-5" value="2">
                            <label for="D2" class="cursor-pointer">
                                <span class="text-blue-700 font-medium">2 - Regular</span> Muestra tener las herramientas necesarias para atender el grupo y/o individualmente. Realiza la programación de las sesiones considerando los tiempos disponibles de los estudiantes.
                            </label>
                        </div>

                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer border-1 border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="radio" name="pregunta4" id="D1" class="w-5 h-5" value="1">
                            <label for="D1" class="cursor-pointer">
                                <span class="text-blue-700 font-medium">1 - Insuficiente</span> Muestra tener las herramientas necesarias para atender el grupo y/o individualmente.
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-col gap-5 bg-white p-5 border-1 border-gray-200 rounded-xl">
                        <h2 class="text-lg text-center font-medium">Observaciones o comentarios</h2>
                        <textarea name="comentarios" id="comentarios" placeholder="Observaciones sobre el tutor" class="w-full border-gray-300 border-1 px-5 py-2 rounded-xl"></textarea>
                    </div>
                    <button id="btn-enviar-evaluacion" class="text-center mt-5 bg-blue-700 text-white px-5 py-3 rounded-xl font-medium cursor-pointer hover:bg-blue-800 transition-all">Enviar evaluacion</button>
                </form>
            </div>
        <?php } else { ?>
            <div class="mt-10 container mx-auto p-5 bg-white rounded-xl drop-shadow-md">
                <p class="uppercase text-xl text-green-700 font-bold text-center">Ya realizaste la evaluacion</p>
            </div>
        <?php }; ?>
    </div>
</div>
<script>
    let id = <?php echo json_encode($evaluacion->id); ?>;
    let idAlumno = <?php echo json_encode($evaluacion->idAlumno); ?>;
    let idMaestro = <?php echo json_encode($evaluacion->idMaestro); ?>;
    let tutorias = <?php echo json_encode($evaluacion->tutorias); ?>;
</script>
<script src="build/js/evaluacion.js"></script>