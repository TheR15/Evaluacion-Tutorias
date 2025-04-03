obtenerEntidades();
document.addEventListener('DOMContentLoaded', function () {
    modal();
    if (entidadSingular === 'evaluacion') {
        eventCambiarTutor();
        eventEliminarEvaluaciones();
    }
});

let entidades = [];
let maestros = [];
let tutorias = [];
let filtradas = [];

function eventEliminarEvaluaciones() {
    const btnEliminar = document.querySelector('#btn-eliminar');
    btnEliminar.addEventListener('click', () => {
        mostrarEntidad(editar = false, cambiar = false, eliminar = true);
    })
}

function eventCambiarTutor() {
    //Cambiar maestro
    const btnCambiarTutor = document.querySelector('#btn-cambiar');
    btnCambiarTutor.addEventListener('click', () => {
        mostrarEntidad(editar = false, cambiar = true, eliminar = false);
    });
}

//Busqueda
const inputBuscar = document.querySelector('#buscar');
inputBuscar.addEventListener('input', buscarSolictud);

function buscarSolictud(e) {
    const busqueda = e.target.value;
    if (busqueda !== '') {
        if (entidadSingular === 'evaluacion') {
            filtradas = entidades.filter(entidad => {
                const nombreCompleto = (entidad.nombreAlumno + " " + entidad.apellidosAlumno).toLowerCase();
                return nombreCompleto.startsWith(busqueda.toLowerCase());
            });
        } else {
            filtradas = entidades.filter(entidad => {
                const nombreCompleto = (entidad.nombre + " " + entidad.apellidos).toLowerCase();
                return nombreCompleto.startsWith(busqueda.toLowerCase());
            });
        }

        if (filtradas.length === 0) {
            //Si no existen solicitudes se muestra un mensaje
            filtradas.length = 1;
            //alerta('error', 'No se encotraron solicitudes', document.querySelector('.input-buscar'));
        }
    } else {
        filtradas = [];
    }

    mostrarEntidades();
}

async function obtenerEntidades() {
    try {
        const url = `/api/${entidadNombre}`;
        const respuesta = await fetch(url);
        const resultado = await respuesta.json();

        entidades = resultado.entidad;
        maestros = resultado.maestros;
        tutorias = resultado.tutorias;
        mostrarEntidades();

    } catch (error) {
        console.log(error);
    }
}

function modal() {
    const btnCrear = document.querySelector('#btn-crear');
    btnCrear.addEventListener('click', function () {
        mostrarEntidad();
    });
}

function mostrarEntidad(editar = false, cambiar = false, eliminar = false, entidad = {}) {
    const modal = document.createElement('DIV');
    modal.classList.add('absolute', 'top-0', 'left-0', 'w-full', 'h-full', 'bg-gray-600/50', 'flex', 'justify-center', 'items-center', 'z-30','fixed');
    const options = {
        semestres: [
            "Octavo Semestre",
            "Septimo Semestre",
            "Sexto Semestre",
            "Quinto Semestre",
            "Cuarto Semestre",
            "Tercer Semestre",
            "Segundo Semestre",
            "Primer Semestre"
        ],
        carreras: [
            'Ingenieria en Sistemas Computacionales',
            'Ingenieria en Inovacion Agricola',
            'Ingenieria en Mecatronica',
            'Ingenieria en Industrias Alimentarias',
            'Ingenieria en Administracion',
            'Ingenieria en Geociencias',
        ],
        grupos: [
            'A',
            'B',
            'C',
            'D',
            'E',
            'F'
        ]
    };

    const optionsSemestre = options.semestres.map(semestre => `
        <option value="${semestre}" ${entidad.semestre === semestre ? 'selected' : ''}>${semestre}</option>
    `).join('');

    const optionsCarrera = options.carreras.map(carrera => `
        <option value="${carrera}" ${entidad.carrera === carrera ? 'selected' : ''}>${carrera}</option>
    `).join('');

    const optionsGrupo = options.grupos.map(grupo => `
        <option value="${grupo}" ${entidad.grupo === grupo ? 'selected' : ''}>${grupo}</option>
    `).join('');


    if (entidadSingular === 'maestro') {
        modal.innerHTML = `
        <div id="formulario" class="w-xl bg-white opacity-100 p-5 rounded-lg scale-in-ver-top m-4 md:m-0">
            <h1 id="referencia" class="text-blue-700 font-bold text-xl">Agregar maestro</h1>
            <div class="flex gap-5">
                <div class="flex flex-col gap-2 mt-2 w-full">
                    <label for"nombre" class="">Nombre</label>
                    <input id="nombre" type="text" value="${entidad.nombre ? entidad.nombre : ''}"name="nombre" class="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500 " placeholder="${entidad.nombre ? 'Ingresa el nuevo nombre' : 'Ingresa el nombre del maestro'}">
                </div>
                <div class="flex flex-col gap-2 mt-2 w-full">
                    <label for"apellidos" class="">Apellidos</label>
                    <input type="text" value="${entidad.apellidos ? entidad.apellidos : ''}"name="apellidos" id="apellidos" class="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500 " placeholder="${entidad.apellidos ? 'Ingresa los nuevos apellidos' : 'Ingresa los apellidos'}">
                </div>
            </div>
            <div class="flex gap-5">
                <div class="flex flex-col gap-2 mt-2 w-full">
                    <label for"numero" class="">Numero</label>
                    <input type="number" value="${entidad.numero ? entidad.numero : ''}" name="numero" id="numero" class="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500 " placeholder="${entidad.numero ? 'Ingresa el nuevo numero' : 'Ingresa el numero del maestro'}">
                </div>
            </div>
            <div class="flex mt-3 w-full gap-5">
                <button id="cerrar" class="w-full px-3 py-2 bg-gray-200 hover:bg-gray-300 transition-all rounded-lg cursor-pointer font-medium">Cerrar</button>
                <button id="submit" class="w-full px-3 py-2 bg-blue-600 hover:bg-blue-700 transition-all rounded-lg cursor-pointer font-medium text-white">${editar ? 'Editar' : 'Guardar'}</button>
            </div>
        </div>
    `;
    }
    if (entidadSingular === 'alumno') {
        modal.innerHTML = `
        <div id="formulario" class="w-xl bg-white opacity-100 p-5 rounded-lg scale-in-ver-top m-4 md:m-0">
            <h1 id="referencia" class="text-blue-700 font-bold text-xl">Agregar alumno</h1>
            <div class="flex gap-5">
                <div class="flex flex-col gap-2 mt-2 w-full">
                    <label for"nombre">Nombre</label>
                    <input id="nombre" type="text" value="${entidad.nombre ? entidad.nombre : ''}" name="nombre" class="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500 " placeholder="${entidad.nombre ? 'Ingresa el nuevo nombre' : 'Ingresa el nombre del maestro'}">
                </div>
                <div class="flex flex-col gap-2 mt-2 w-full">
                    <label for"apellidos">Apellidos</label>
                    <input id="apellidos" type="text" value="${entidad.apellidos ? entidad.apellidos : ''}" name="apellidos" class="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500 " placeholder="${entidad.apellidos ? 'Ingresa los nuevos apellidos' : 'Ingresa los apellidos'}">
                </div>
            </div>
            <div class="flex gap-5">
                <div class="flex flex-col gap-2 mt-2 w-full">
                    <label for"numeroControl">Numero de control</label>
                    <input id="numeroControl"type="number" value="${entidad.numeroControl ? entidad.numeroControl : ''}" name="numeroControl" class="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500 " placeholder="${entidad.numeroControl ? 'Ingresa el numero de control' : 'Ingresa el nuevo numero de control'}">
                </div>
            </div>
            <div class="flex gap-5">
                <div class="flex flex-col gap-2 mt-2 w-full">
                    <label for"password">Contraseña</label>
                    <input id="password" type="text" value="${entidad.password ? entidad.password : ''}" name="password" class="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500" placeholder="${entidad.password ? 'Ingresa la contraseña' : 'Ingresa la nueva contraseña'}">
                </div>
            </div>
            <div class="flex flex-col gap-2 mt-2 w-full">
                <label for"semestre">Semestre</label>
                <select id="semestre" name="semestre" class="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500">
                    <option selected disabled value="">Selecciona el semestre</option>
                    ${optionsSemestre}
                </select>
            </div>
            <div class="flex flex-col gap-2 mt-2 w-full">
                <label for"carrera">Carrera</label>
                <select id="carrera" name="carrera" class ="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500">
                    <option selected disabled value="">Selecciona la carrera</option>
                    ${optionsCarrera}
                </select>
            </div>

            <div class="flex flex-col gap-2 mt-2 w-full">
                <label for"grupo">Grupo</label>
                <select id="grupo" name="grupo" class ="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500">
                    <option selected disabled value="">Selecciona el grupo</option>
                    ${optionsGrupo}
                </select>
            </div>

            <div class="flex mt-3 w-full gap-5">
                <button id="cerrar" class="w-full px-3 py-2 bg-gray-200 hover:bg-gray-300 transition-all rounded-lg cursor-pointer font-medium">Cerrar</button>
                <button id="submit" class="w-full px-3 py-2 bg-blue-600 hover:bg-blue-700 transition-all rounded-lg cursor-pointer font-medium text-white">${editar ? 'Editar' : 'Guardar'}</button>
            </div>
        </div>
    `;
    }
    if (entidadSingular === "evaluacion") {
        const optionsMaestros = maestros.map(maestro => `
            <option value="${maestro.id}|${maestro.nombre}|${maestro.apellidos}" ${entidad.idMaestro === maestro.id ? 'selected' : ''}>
                ${maestro.nombre} ${maestro.apellidos}
            </option>
        `).join('');

        const optionsTutorias = tutorias.map(tutoria => `
            <option value="${tutoria.tutorias}">
                ${tutoria.tutorias}
            </option>
        `).join('');
        if (cambiar) {
            modal.innerHTML = `
            <div id="formulario" class="w-xl bg-white opacity-100 p-5 rounded-lg scale-in-ver-top m-4 md:m-0">
                <h1 id="referencia" class="text-blue-700 font-bold text-xl">Cambiar Tutor</h1>
                <p class="text-gray-600 mt-2">Asigna un nuevo tutor de un grupo</p>
                    <fieldset class = "mt-3">
                    <legend class="font-medium text-gray-800">Grupo</legend>
                    <div class="flex flex-col gap-2 mt-2 w-full">
                        <select id="tutorias" name="tutorias" class ="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500">
                            <option selected disabled value="">Selecciona el grupo de tutorias</option>
                            ${optionsTutorias}
                        </select>
                    </div>
                    </fieldset>
                    <fieldset class = "mt-3">
                    <legend class="font-medium text-gray-800">Nuevo Tutor</legend>
                    <div class="flex flex-col gap-2 mt-2 w-full">
                        <select id="maestro" name="idMaestro" class ="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500">
                            <option selected disabled value="">Selecciona el maestro</option>
                            ${optionsMaestros}
                        </select>
                    </div>
                    </fieldset>
                    <div class="flex mt-3 w-full gap-5">
                        <button id="cerrar" class="w-full px-3 py-2 bg-gray-200 hover:bg-gray-300 transition-all rounded-lg cursor-pointer font-medium">Cerrar</button>
                        <button id="submit" class="w-full px-3 py-2 bg-blue-600 hover:bg-blue-700 transition-all rounded-lg cursor-pointer font-medium text-white">${editar ? 'Editar' : 'Guardar'}</button>
                    </div>
            </div>
            `;
        } else
            if (eliminar) {
                modal.innerHTML = `
            <div id="formulario" class="w-xl bg-white opacity-100 p-5 rounded-lg scale-in-ver-top m-4 md:m-0">
                <h1 id="referencia" class="text-blue-700 font-bold text-xl">Eliminar Grupo</h1>
                <p class="text-gray-600 mt-2">Si eliminas un grupo no podras revertir las evaluaciones</p>
                    <fieldset class = "mt-3">
                    <legend class="font-medium text-gray-800">Grupo</legend>
                    <div class="flex flex-col gap-2 mt-2 w-full">
                        <select id="tutorias" name="tutorias" class ="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500">
                            <option selected disabled value="">Selecciona el grupo de tutorias</option>
                            ${optionsTutorias}
                        </select>
                    </div>
                    <div class="flex mt-3 w-full gap-5">
                        <button id="cerrar" class="w-full px-3 py-2 bg-gray-200 hover:bg-gray-300 transition-all rounded-lg cursor-pointer font-medium">Cerrar</button>
                        <button id="submit" class="w-full px-3 py-2 bg-blue-600 hover:bg-blue-700 transition-all rounded-lg cursor-pointer font-medium text-white">${editar ? 'Editar' : 'Guardar'}</button>
                    </div>
            </div>
            `;
            }
            else {
                modal.innerHTML = `
            <div id="formulario" class="w-xl bg-white opacity-100 p-5 rounded-lg scale-in-ver-top m-4 md:m-0">
                <h1 id="referencia" class="text-blue-700 font-bold text-xl">${cambiar ? 'Cambiar' : (eliminar ? 'Eliminar' : 'Asignar')} tutor</h1>
                <p class="text-gray-600 mt-2">Asigna un tutor a todos los alumnos que coincidan con los criterios.</p>
                    <fieldset class="mt-3">
                    <legend class="font-medium text-gray-800">Información del grupo</legend>
                    <div class="flex flex-col gap-2 mt-2 w-full">
                        <label for"semestre">Semestre</label>
                        <select id="semestre" name="semestre" class="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500">
                            <option selected disabled value="">Selecciona el semestre</option>
                            ${optionsSemestre}
                        </select>
                    </div>
                    <div class="flex flex-col gap-2 mt-2 w-full">
                        <label for"carrera">Carrera</label>
                        <select id="carrera" name="carrera" class ="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500">
                            <option selected disabled value="">Selecciona la carrera</option>
                            ${optionsCarrera}
                        </select>
                    </div>
                    <div class="flex flex-col gap-2 mt-2 w-full">
                        <label for"grupo">Grupo</label>
                        <select id="grupo" name="grupo" class ="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500">
                            <option selected disabled value="">Selecciona el grupo</option>
                            ${optionsGrupo}
                        </select>
                    </div>
                    </fieldset>
                    <fieldset class = "mt-3">
                    <legend class="font-medium text-gray-800">Tutor</legend>
                    <div class="flex flex-col gap-2 mt-2 w-full">
                        <label for"grupo">Maestro</label>
                        <select id="maestro" name="idMaestro" class ="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500">
                            <option selected disabled value="">Selecciona el maestro</option>
                            ${optionsMaestros}
                        </select>
                    </div>
                    </fieldset>
                    <div class="flex mt-3 w-full gap-5">
                        <button id="cerrar" class="w-full px-3 py-2 bg-gray-200 hover:bg-gray-300 transition-all rounded-lg cursor-pointer font-medium">Cerrar</button>
                        <button id="submit" class="w-full px-3 py-2 bg-blue-600 hover:bg-blue-700 transition-all rounded-lg cursor-pointer font-medium text-white">${editar ? 'Editar' : 'Guardar'}</button>
                    </div>
            </div>
        `;
            }
    }

    modal.addEventListener('click', function (e) {
        e.preventDefault();
        if (e.target.id === 'cerrar') {
            const formulario = document.querySelector('#formulario');
            formulario.classList.add('scale-in-ver-top-reverse');
            setTimeout(() => {
                modal.remove();
            }, 500);
        }

        if (e.target.id === 'submit') {
            if (entidadSingular === "maestro") {
                validarMaestro(editar, entidad);
            }
            if (entidadSingular === "alumno") {
                validarAlumno(editar, entidad);
            }
            if (entidadSingular === 'evaluacion') {
                validarEvaluacion(entidad, cambiar, eliminar);
            }
        }
    });
    //btnGuardar.addEventListener('click', validarMaestro());
    document.querySelector('body').appendChild(modal);
}

function validarMaestro(editar, entidad) {
    const nombre = document.querySelector('#nombre').value.trim();
    const apellidos = document.querySelector('#apellidos').value.trim();
    const numero = document.querySelector('#numero').value.trim();

    if (nombre === "" | apellidos === "" || numero === "") {
        alerta('error', 'Todos los campos son obligatorios', document.querySelector('#referencia'));
        return;
    }

    if (nombre === "") {
        alerta('error', 'El nombre es obligatorio', document.querySelector('#referencia'));
        return;
    }

    if (apellidos === "") {
        alerta('error', 'Ingrese los apellidos', document.querySelector('#referencia'));
        return;
    }

    if (numero === "") {
        alerta('error', 'El numero es obligatorio', document.querySelector('#referencia'));
        return;
    }

    const modal = document.querySelector('.modal');
    const datosEntidad = {
        nombre: nombre,
        apellidos: apellidos,
        numero: numero
    }

    if (editar) {
        entidad.nombre = nombre;
        entidad.apellidos = apellidos;
        entidad.numero = numero;
        actualizarEntidad(`http://localhost:3000/api/${entidadSingular}/actualizar`, entidad);
        modal.remove();
    } else {
        agregar(datosEntidad, `http://localhost:3000/api/${entidadSingular}`);
        modal.remove();
    }

}

function validarAlumno(editar, entidad) {
    const nombre = document.querySelector('#nombre').value.trim();
    const apellidos = document.querySelector('#apellidos').value.trim();
    const numeroControl = document.querySelector('#numeroControl').value.trim();
    const password = document.querySelector('#password').value.trim();
    const semestre = document.querySelector('#semestre').value.trim();
    const carrera = document.querySelector('#carrera').value.trim();
    const grupo = document.querySelector('#grupo').value.trim();

    if (nombre === "" && apellidos === "" && numeroControl === ""  &&
        password === "" && semestre === "" && carrera === "" && grupo === ""
    ) {
        alerta('error', 'Todos los campos son obligatorios', document.querySelector('#referencia'));
        return;
    }
    if (nombre === "") {
        alerta('error', 'El nombre es obligatorio', document.querySelector('#referencia'));
        return;
    }
    if (apellidos === "") {
        alerta('error', 'Los apellidos son obligatorios', document.querySelector('#referencia'));
        return;
    }
    if (numeroControl === "") {
        alerta('error', 'Ingresa el numero de control', document.querySelector('#referencia'));
        return;
    }
    if (password === "") {
        alerta('error', 'Ingresa el password', document.querySelector('#referencia'));
        return;
    }
    if (semestre === "") {
        alerta('error', 'Selecciona un semestre', document.querySelector('#referencia'));
        return;
    }
    if (carrera === "") {
        alerta('error', 'Selecciona una carrera', document.querySelector('#referencia'));
        return;
    }
    if (grupo === "") {
        alerta('error', 'Selecciona un grupo', document.querySelector('#referencia'));
        return;
    }
    const correo = numeroControl + '@itstacambaro.edu.mx';

    const modal = document.querySelector('.modal');
    const datosEntidad = {
        nombre: nombre,
        apellidos: apellidos,
        numeroControl: numeroControl,
        correo: correo,
        password: password,
        semestre: semestre,
        carrera: carrera,
        grupo: grupo
    }
    if (editar) {
        entidad.nombre = nombre;
        entidad.apellidos = apellidos;
        entidad.numeroControl = numeroControl;
        entidad.correo = correo;
        entidad.password = password;
        entidad.semestre = semestre;
        entidad.carrera = carrera;
        entidad.grupo = grupo;

        actualizarEntidad(`http://localhost:3000/api/${entidadSingular}/actualizar`, entidad);
        modal.remove();
    } else {
        agregar(datosEntidad, `http://localhost:3000/api/${entidadSingular}`);
        modal.remove();
    }
}

function validarEvaluacion(entidad, cambiar = false, eliminar = false) {
    const modal = document.querySelector('.modal');

    if (cambiar) {
        const valorSeleccionado = document.querySelector('#maestro').value;
        const [maestro, nombreMaestro, apellidosMaestro] = valorSeleccionado.split('|');
        const tutorias = document.querySelector('#tutorias').value.trim();
        if (tutorias === "") {
            alerta('error', 'Seleccione un grupo de tutorias', document.querySelector('#referencia'));
            return;
        }
        if (maestro === "") {
            alerta('error', 'Seleccione un maestro', document.querySelector('#referencia'));
            return;
        }
        const datosEntidad = {
            tutorias: tutorias,
            maestro: maestro,
            nombreMaestro: nombreMaestro,
            apellidosMaestro: apellidosMaestro
        }

        confirmarCambiarTutor(datosEntidad);
        modal.remove();
        return;
    }

    if (eliminar) {
        const tutorias = document.querySelector('#tutorias').value.trim();
        if (tutorias === "") {
            alerta('error', 'Seleccione un grupo de tutorias', document.querySelector('#referencia'));
            return;
        }
        const datosEntidad = {
            tutorias: tutorias
        }

        confirmarEliminarEvaluaciones(datosEntidad, entidad);
        modal.remove();
        return;
    }

    const semestre = document.querySelector('#semestre').value.trim();
    const carrera = document.querySelector('#carrera').value.trim();
    const grupo = document.querySelector('#grupo').value.trim();
    const valorSeleccionado = document.querySelector('#maestro').value;
    const [maestro, nombreMaestro, apellidosMaestro] = valorSeleccionado.split('|');

    if (semestre === "") {
        alerta('error', 'Selecciona un semestre', document.querySelector('#referencia'));
        return;
    }
    if (carrera === "") {
        alerta('error', 'Selecciona una carrera', document.querySelector('#referencia'));
        return;
    }
    if (grupo === "") {
        alerta('error', 'Selecciona un grupo', document.querySelector('#referencia'));
        return;
    }
    if (maestro === "") {
        alerta('error', 'Seleccione un maestro', document.querySelector('#referencia'));
        return;
    }

    let matchCarrera = carrera.match(/[A-Z]/g);
    let carreraFormated = matchCarrera ? matchCarrera.join('') : '';
    let semestreFormated = '';

    switch (semestre) {
        case "Octavo Semestre":
            semestreFormated = "8";
            break;
        case "Septimo Semestre":
            semestreFormated = "7";
            break;
        case "Sexto Semestre":
            semestreFormated = "6";
            break;
        case "Quinto Semestre":
            semestreFormated = "5";
            break;
        case "Cuarto Semestre":
            semestreFormated = "4";
            break;
        case "Tercer Semestre":
            semestreFormated = "3";
            break;
        case "Segundo Semestre":
            semestreFormated = "2";
            break;
        case "Primer Semestre":
            semestreFormated = "1";
            break;
    }
    let tutorias = "";
    tutorias = tutorias.concat(carreraFormated, '-', semestreFormated, '-', grupo);

    const datosEntidad = {
        semestre: semestre,
        carrera: carrera,
        grupo: grupo,
        tutorias: { tutorias },
        maestro: maestro,
        nombreMaestro: nombreMaestro,
        apellidosMaestro: apellidosMaestro
    }

    agregar(datosEntidad, `http://localhost:3000/api/${entidadSingular}`);
    modal.remove();
}

function mostrarEntidades() {
    limpiarEntidades();

    const arrayEntidades = filtradas.length ? filtradas : entidades;
    if (arrayEntidades.length === 0) {

        return;
    }

    arrayEntidades.forEach(entidad => {
        const tr = document.createElement('TR');
        tr.classList.add('border-b', 'border-gray-200');

        if (entidadNombre === 'maestros') {
            const nombre = document.createElement('TD');
            nombre.classList.add('p-3');
            nombre.textContent = entidad.nombre + ' ' + entidad.apellidos;

            const numero = document.createElement('TD');
            numero.classList.add('p-3');
            numero.textContent = entidad.numero;

            tr.appendChild(nombre);
            tr.appendChild(numero);
        }

        if (entidadNombre === "alumnos") {
            const nombre = document.createElement('TD');
            nombre.classList.add('p-3');
            nombre.textContent = entidad.nombre + ' ' + entidad.apellidos;

            const numeroControl = document.createElement('TD');
            numeroControl.classList.add('p-3');
            numeroControl.textContent = entidad.numeroControl;

            const correo = document.createElement('TD');
            correo.classList.add('p-3','md:table-cell', 'hidden');
            correo.textContent = entidad.correo;

            const semestre = document.createElement('TD');
            semestre.classList.add('p-3','md:table-cell', 'hidden');
            semestre.textContent = entidad.semestre;

            tr.appendChild(nombre);
            tr.appendChild(numeroControl);
            tr.appendChild(correo);
            tr.appendChild(semestre);
        }

        if (entidadNombre === "evaluaciones") {
            const alumno = document.createElement('TD');
            alumno.classList.add('p-3');
            alumno.textContent = entidad.nombreAlumno + ' ' + entidad.apellidosAlumno;

            const tutorias = document.createElement('TD');
            tutorias.classList.add('p-3');
            tutorias.textContent = entidad.tutorias;

            const maestro = document.createElement('TD');
            maestro.classList.add('p-3');
            maestro.textContent = entidad.nombreMaestro + ' ' + entidad.apellidosMaestro;

            const estado = document.createElement('TD');
            const textEstado = document.createElement('P');
            estado.classList.add('p-3');
            estado.appendChild(textEstado);

            if (Number.parseInt(entidad.estado) === 0) {
                textEstado.textContent = "Sin realizar";
                textEstado.classList.add('bg-red-50', 'px-3', 'py-1', 'inline', 'rounded-md', 'border-1', 'border-red-200', 'text-red-600', 'font-medium');
            } else {
                textEstado.textContent = "Realizada";
                textEstado.classList.add('bg-green-50', 'px-3', 'py-1', 'inline', 'rounded-md', 'border-1', 'border-green-200', 'text-green-600', 'font-medium')
            }

            tr.appendChild(alumno);
            tr.appendChild(tutorias);
            tr.appendChild(maestro);
            tr.appendChild(estado);
        }

        const acciones = document.createElement('TD');
        acciones.classList.add('md:flex-row', 'flex-col','flex', 'gap-3', 'items-center', 'p-3');


        if (entidadNombre !== "evaluaciones") {
            const btnEditar = document.createElement('BUTTON');
            btnEditar.classList.add('cursor-pointer');
            btnEditar.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#2835ff">
            <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
        </svg>
        `;
            btnEditar.addEventListener('click', function () {
                console.log(entidad);
                mostrarEntidad(editar = true, cambiar = false, eliminar = false, { ...entidad });
            });

            const btnEliminar = document.createElement('BUTTON');
            btnEliminar.classList.add('cursor-pointer');
            btnEliminar.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#8B1A10">
            <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
        </svg>
        `;
            btnEliminar.ondblclick = function () {
                confirmarEliminarEntidad({ ...entidad });
            }

            acciones.appendChild(btnEditar);
            acciones.appendChild(btnEliminar);
        }


        tr.appendChild(acciones);

        document.querySelector('#tbody').appendChild(tr);
    });
}

async function agregar(datosEntidad, URL) {
    const datos = new FormData();
    for (const key in datosEntidad) {
        datos.append(key, datosEntidad[key]);
    }

    try {
        const respuesta = await fetch(URL, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();

        if (resultado.tipo === 'exito') {
            var notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top',
                }
            });
            notyf.success(resultado.mensaje);
            if (entidadSingular === 'evaluacion') {
                console.log(datosEntidad.tutorias);
                console.log(tutorias);
                tutorias = [...tutorias, datosEntidad.tutorias];
                console.log(tutorias);
                // Agregar todos los registros de evaluaciones a entidades
                resultado.evaluaciones.forEach(evaluacion => {
                    evaluacion.tutorias = datosEntidad.tutorias.tutorias;
                    entidades = [...entidades, evaluacion];
                });
                // Actualizar la vista con todos los registros
                mostrarEntidades();
            } else {
                datosEntidad.id = String(resultado.id);
                entidades = [...entidades, datosEntidad];
                mostrarEntidades();
            }
        }

        if (resultado.tipo === 'error') {
            var notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top',
                }
            });
            notyf.error(resultado.mensaje);
        }

    } catch (error) {
        console.log(error);
    }
}

async function actualizarEntidad(URL, entidad) {
    console.log(entidad);
    const datos = new FormData();
    for (const key in entidad) {
        datos.append(key, entidad[key]);
    }

    try {
        const respuesta = await fetch(URL, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();

        if (resultado.tipo === 'exito') {
            var notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf.success(resultado.mensaje);

            let entidadMemoria = [];

            for (const key in entidad) {
                entidadMemoria.push(key);
            }

            entidades = entidades.map(entidadMemoria => {
                if (entidadMemoria.id === entidad.id) {
                    entidadMemoria = entidad;
                }
                return entidadMemoria;
            });
            mostrarEntidades();
        }

    } catch (error) {
        console.log(error);
    }
}

async function eliminarEntidad(entidad) {
    const datos = new FormData();
    for (const key in entidad) {
        datos.append(key, entidad[key]);
    }

    try {
        const url = `http://localhost:3000/api/${entidadSingular}/eliminar`;
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();

        if (resultado.tipo === 'exito') {
            var notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top',
                }
            });
            notyf.success(resultado.mensaje);
            entidades = entidades.filter(entidadMemoria => entidadMemoria.id !== entidad.id)
            mostrarEntidades();
        }

    } catch (error) {
        console.log(error);
    }
}

async function eliminarEvaluaciones(entidad) {
    const datos = new FormData();
    for (const key in entidad) {
        datos.append(key, entidad[key]);
    }
    try {
        const url = `http://localhost:3000/api/${entidadSingular}/eliminarEvaluaciones`;
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();

        if (resultado.tipo === 'success') {
            var notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top',
                }
            });
            notyf.success(resultado.mensaje);
            entidades = entidades.filter(entidadMemoria => entidadMemoria.tutorias !==
                entidad.tutorias);
            mostrarEntidades();
        }

        if (resultado.tipo === 'error') {
            var notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top',
                }
            });
            notyf.error(resultado.mensaje);
        }

    } catch (error) {
        console.log(error);
    }
}

async function actualizarTutor(entidad) {
    const datos = new FormData();
    for (const key in entidad) {
        datos.append(key, entidad[key]);
    }

    try {
        const url = `http://localhost:3000/api/${entidadSingular}/actualizarTutor`
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();
        if (resultado.tipo === 'exito') {
            var notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top',
                }
            });
            notyf.success(resultado.mensaje);
            entidades.forEach(entidadMemoria => {
                if (entidadMemoria.tutorias === entidad.tutorias) {
                    entidadMemoria.idMaestro = entidad.idMaestro;
                    entidadMemoria.nombreMaestro = entidad.nombreMaestro;
                    entidadMemoria.apellidosMaestro = entidad.apellidosMaestro;
                }
            });
            mostrarEntidades();
        }

        if (resultado.tipo === 'error') {
            var notyf = new Notyf({
                duration: 4000,
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf.error(resultado.mensaje);
        }

    } catch (error) {
        console.log(error);
    }
}

function confirmarEliminarEntidad(entidad) {
    Swal.fire({
        title: `¿Eliminar ${entidadSingular}?`,
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        text: `Estas seguro de eliminar al ${entidadSingular} ${entidad.nombre + ' ' + entidad.apellidos}`,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#99a3a4',
        confirmButtonColor: '#000fff'
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            eliminarEntidad(entidad);
        }
    });
}

function confirmarCambiarTutor(datosEntidad) {
    Swal.fire({
        title: `¿Asignar un nuevo tutor?`,
        showCancelButton: true,
        confirmButtonText: "Cambiar tutor",
        text: `¿Deseas asignar el tutor ${datosEntidad.nombreMaestro + " " + datosEntidad.apellidosMaestro} al grupo ${datosEntidad.tutorias}?`,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#99a3a4',
        confirmButtonColor: '#000fff'
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            actualizarTutor(datosEntidad);
        }
    });
}

function confirmarEliminarEvaluaciones(datosEntidad) {
    Swal.fire({
        title: `¿Eliminar grupo?`,
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        text: `Estas seguro de eliminar el grupo ${datosEntidad.tutorias}, no podras revertir las evaluaciones`,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#99a3a4',
        confirmButtonColor: '#000fff'
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            eliminarEvaluaciones(datosEntidad);
        }
    });
}

function limpiarEntidades() {
    const tabla = document.querySelector('#tbody');
    while (tabla.firstChild) {
        tabla.removeChild(tabla.firstChild);
    }
}

function alerta(tipo, mensaje, referencia) {
    const alertPrevia = document.querySelector('.alerta');
    if (alertPrevia) {
        alertPrevia.remove();
    }

    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('px-1', 'py-2', 'bg-red-500', 'text-white', 'font-bold', 'rounded-lg', 'my-2', 'text-center', 'alerta');

    referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);

    //Eliminar Alerta
    setTimeout(() => {
        alerta.remove();
    }, 3500);
}