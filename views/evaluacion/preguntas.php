<div>
    <div class="w-full">
        <?php include_once __DIR__ . '/../templates/barra.php'; ?>
    </div>


    <div class="flex justify-center items-center">
        <?php if ($evaluacion->estado === '0') { ?>
            <div id="mensaje-exito" class="hidden mt-10 container mx-auto p-5 bg-white rounded-xl drop-shadow-md">
                <p class="uppercase text-xl text-green-700 font-bold text-center">La evaluacion se envio correctamente. Ya puedes cerrar la pestaña</p>
            </div>
            <div id="container-preguntas" class="flex flex-col justify-center gap-5 mt-10 container mx-auto p-5 bg-white rounded-xl drop-shadow-md">
                <div class="flex justify-between">
                    <h1 class="text-2xl font-medium">Tutor:</h1>
                    <h1 class="text-2xl font-medium text-blue-600"><?php echo $maestro->nombre . ' ' . $maestro->apellidos; ?></h1>
                </div>
                <hr class="border-gray-400">
                <form method="POST" action="">
                    <!--Pregunta 1-->
                    <div class="flex flex-col gap-5">
                        <h2 class="text-lg text-center font-medium">A.- Genera un
                            clima de confianza
                            que permite el
                            logro de los
                            propositos de la
                            tutoria</h2>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <input type="radio" name="pregunta1" id="A5" class="w-5 h-5" value="5">
                            <label for="A5" class="cursor-pointer">5.- Genera confianza y
                                buena comunicación
                                con todo el grupo. Hace
                                agradable la sesión de
                                tutoría. Escucha con
                                atención todo lo que se
                                lo solicita. Se muestra
                                empático con las </label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <input type="radio" name="pregunta1" id="A4" class="w-5 h-5" value="4">
                            <label for="A4" class="cursor-pointer"> 4.- Genera confianza y
                                buena comunicación
                                con todo el grupo. Hace
                                agradable la sesión de
                                tutoría. Escucha con
                                atención todo lo que se
                                le solicita</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <input type="radio" name="pregunta1" id="A3" class="w-5 h-5" value="3">
                            <label for="A3" class="cursor-pointer">3.- Genera confianza y
                                buena comunicación
                                con todo el grupo. Hace
                                agradable la sesión de
                                tutoría</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <input type="radio" name="pregunta1" id="A2" class="w-5 h-5" value="2">
                            <label for="A2" class="cursor-pointer">2.-Genera confianza y
                                buena comunicación
                                con todo el grupo</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <input type="radio" name="pregunta1" id="A1" class="w-5 h-5" value="1">
                            <label for="A1" class="cursor-pointer"> 1.-Se comunica con
                                todo el grupo</label>
                        </div>
                        <hr class="border-gray-400">
                    </div>
                    <!--Pregunta 2-->
                    <div class="flex flex-col gap-5">
                        <h2 class="text-lg text-center font-medium">B.- Calidad de la
                            información
                            proporcionada al
                            tutorado</h2>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <div>
                                <input type="radio" name="pregunta2" id="B5" class="w-5 h-5" value="5">
                            </div>
                            <label for="B5" class="cursor-pointer">5.-Da informacion necesaria
                                sobre el programa de
                                tutorias. Provee de la
                                informacion adecuada para
                                realizar tramites escolares.
                                Proporciona informacion
                                ssificiente sobre los apoyos
                                que requiere el estudiantes.
                                Da informacion y
                                orientacion importante que
                                apoye el area personal del
                                tutorado. informa con
                                precision sobre las asesorias
                                academicas que ofrece los
                                docentes de su carrera</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <div>
                                <input type="radio" name="pregunta2" id="B4" class="w-5 h-5" value="4">
                            </div>
                            <label for="B4" class="cursor-pointer">4.-Da informacion necesaria
                                sobre el programa de
                                tutorias. Provee de la
                                informacion adecuada
                                parza realizar trèmites
                                escolares. Proporciona
                                informacion suficiente
                                sobre los apoyos que
                                requiere el estudiante, da
                                informacion y orientacion
                                importante que apoye el
                                area personal del tutorado.</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <div>
                                <input type="radio" name="pregunta2" id="B3" class="w-5 h-5" value="3">
                            </div>
                            <label for="B3" class="cursor-pointer">3.-Da informacion necesaria
                                sobre el programa de
                                tutorias. Provee de la
                                informacion adecuada para
                                realizar trámites escolares</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <div>
                                <input type="radio" name="pregunta2" id="B2" class="w-5 h-5" value="2">
                            </div>
                            <label for="B2" class="cursor-pointer">2.-Comenta en que consiste
                                el programa de tutorias.</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <div>
                                <input type="radio" name="pregunta2" id="B1" class="w-5 h-5" value="1">
                            </div>
                            <label for="B1" class="cursor-pointer"> 1.-Se comunica con
                                todo el grupo</label>
                        </div>
                        <hr class="border-gray-400">
                    </div>
                    <!--Pregunta 3-->
                    <div class="flex flex-col gap-5">
                        <h2 class="text-lg text-center font-medium">C.- Disponibilidad y
                            calidad en la
                            atención
                            tutorial.</h2>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <div>
                                <input type="radio" name="pregunta3" id="C5" class="w-5 h-5" value="5">
                            </div>
                            <label for="C5" class="cursor-pointer">5.- Se le puede localizar en
                                cualquier momento.
                                Entrego su horario y
                                localización desde le inicio
                                del semestre. Atiende con
                                amabilidad cada que se le
                                necesita. Canaliza
                                adecuadamente a los
                                tutorados siempre que
                                tienen algún problema y el
                                que no pueda resolver.
                                Realiza su funcion tutorial
                                con disponibilidad y calidad.
                                Le da seguimiento a los
                                tutorados que ha
                                canalizado.</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <div>
                                <input type="radio" name="pregunta3" id="C4" class="w-5 h-5" value="4">
                            </div>
                            <label for="C4" class="cursor-pointer">4.- se le puede localizar en
                                cualquier momento.
                                Entrego su horario y
                                localización desde el inicio
                                del semestre. Aiende con
                                amabilidad cada que se le
                                necesita. Canaliza
                                adecuadamente a los
                                tutorados siempre tienen
                                algun problema y que le no
                                lo pueda resolver.</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <div>
                                <input type="radio" name="pregunta3" id="C3" class="w-5 h-5" value="3">
                            </div>
                            <label for="C3" class="cursor-pointer">3.-Entrego su horario y
                                localizacion desde el incio
                                del semestre. Atiende con
                                amabilidad cada que se le
                                necesita. Canaliza
                                adecuadamente a los
                                tutorados siempre que
                                tienen algun problema y
                                que él no pueda resolver</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <div>
                                <input type="radio" name="pregunta3" id="C2" class="w-5 h-5" value="2">
                            </div>
                            <label for="C2" class="cursor-pointer">2.-Atiende con amabilidad
                                cada que se le necesita.
                                Canaliza adecuadamente a
                                los tutorados siempre que
                                tienen algun problema que
                                él no pueda resolver</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <div>
                                <input type="radio" name="pregunta3" id="C1" class="w-5 h-5" value="1">
                            </div>
                            <label for="C1" class="cursor-pointer">1.-Atiende con amabilidad
                                cada que se le necesita.</label>
                        </div>
                        <hr class="border-gray-400">
                    </div>
                    <!--Pregunta 4-->
                    <div class="flex flex-col gap-5">
                        <h2 class="text-lg text-center font-medium">D.- Planeación y
                            preparación en
                            los procesos de
                            la Tutoria</h2>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <div>
                                <input type="radio" name="pregunta4" id="D5" class="w-5 h-5" value="5">
                            </div>
                            <label for="D5" class="cursor-pointer">5.-Muestra tener las
                                herramientas necesarias
                                para atender el grupo y/o
                                individualmente. Realiza la
                                programación de las
                                sesiones considerando los
                                tiempos disponibles de los
                                estudiantes. Muestra
                                evidencia de qe planeó las
                                sesiones individuales y
                                grupales con sus tutorados
                                pues lleva un orden en sus
                                actividades. Realiza sus
                                actividades como tutor
                                respetando los tiempos
                                disponibles para ello
                                evitando interrupciones que
                                coarten el hilo de la sesión..
                                Planea, ejecuta y evalúa su
                                actividad tutorial
                                continuamente con fines de
                                realimentación.</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <div>
                                <input type="radio" name="pregunta4" id="D4" class="w-5 h-5" value="4">
                            </div>
                            <label for="D4" class="cursor-pointer">4.- Muestra tener las
                                herramientas necesarias
                                para atender el grupo y/o
                                individual . Realiza la
                                programación de las
                                sesiones considerando los
                                tiempos disponibles de los
                                estuduantes . Muestra
                                evidencias de que planeó
                                las sesiones individuales y
                                grupales con sus tutorados
                                pues lleva un orden en sus
                                actividades. Realiza sus
                                actividades como tutor
                                respetando los tiempos
                                disponibles para ello
                                evitando interrupciones que
                                cuarten el hilo de la sesiòn. </label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <div>
                                <input type="radio" name="pregunta4" id="D3" class="w-5 h-5" value="3">
                            </div>
                            <label for="D3" class="cursor-pointer">3.-Muestra tener las
                                herramientas necesarias
                                para atender el grupo y/o
                                individualmente. Realiza
                                la programaciòn de las
                                sesiones considerando los
                                tiempos disponibles de los
                                estudiantes Muestra
                                evidencias de que planeó
                                las sesiones individuales y
                                grupales con sus tutorados
                                pues lleva un orden en sus
                                actividades</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <div>
                                <input type="radio" name="pregunta4" id="D2" class="w-5 h-5" value="2">
                            </div>
                            <label for="D2" class="cursor-pointer">2.- Muestra tener las
                                herramientas necesarias
                                para atender el grupo y/o
                                individualmente . Realiza
                                la programación de las
                                sesiones considerando los
                                tiempos disponibles de los
                                estudiantes.</label>
                        </div>
                        <div class="flex items-center gap-5 accent-blue-700 cursor-pointer">
                            <div>
                                <input type="radio" name="pregunta4" id="D1" class="w-5 h-5" value="1">
                            </div>
                            <label for="D1" class="cursor-pointer">1.- Muestra tener las
                                herramientas necesarias
                                para atender el grupo y/o
                                individualmente.</label>
                        </div>
                        <hr class="border-gray-400">
                    </div>
                    <button id="btn-enviar-evaluacion" class="text-center mt-5 bg-blue-700 text-white px-3 py-2 rounded-xl font-medium cursor-pointer hover:bg-blue-800 transition-all">Enviar evaluacion</button>
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