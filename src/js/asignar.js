obtenerEvaluaciones();
document.addEventListener('DOMContentLoaded', function () {
    modal();
});
let evaluaciones = [];
let maestros = []; 
let filtradas = [];

function modal() {
    const btnCrear = document.querySelector('#btn-crear');
    btnCrear.addEventListener('click', function () {
        mostrarEntidad();
    });
}

function mostrarEntidad(editar = false, entidad = {}) {
    const modal = document.createElement('DIV');
    modal.classList.add('absolute', 'top-0', 'left-0', 'w-full', 'h-full', 'bg-gray-600/50', 'flex', 'justify-center', 'items-center', 'modal', 'z-30');
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
            'Ingenieria Industrias Alimentarias',
            'Ingenieria Administracion'
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
    const optionsMaestros = maestros.map(maestro => `
       <option value="${maestro.id}">${maestro.nombre} ${maestro.apellidos}</option>
    `).join('');
    modal.innerHTML = `
        <div id="formulario" class="w-xl bg-white opacity-100 p-5 rounded-lg scale-in-ver-top">
            <h1 id="referencia" class="text-blue-700 font-bold text-xl">Asignar tutor</h1>
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
                <div class="flex flex-col gap-2 mt-2 w-full">
                    <label for"grupo">Maestro</label>
                    <select id="maestro" name="idMaestro" class ="w-full border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500">
                        <option selected disabled value="">Selecciona el maestro</option>
                        ${optionsMaestros}
                    </select>
                </div>
                <div class="flex mt-3 w-full gap-5">
                    <button id="cerrar" class="w-full px-3 py-2 bg-gray-200 hover:bg-gray-300 transition-all rounded-lg cursor-pointer font-medium">Cerrar</button>
                    <button id="submit" class="w-full px-3 py-2 bg-blue-600 hover:bg-blue-700 transition-all rounded-lg cursor-pointer font-medium text-white">${editar ? 'Editar' : 'Guardar'}</button>
                </div>
        </div>
    `;

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
            validacion();
        }
    });
    //btnGuardar.addEventListener('click', validarMaestro());
    document.querySelector('body').appendChild(modal);
}

function validacion(){
    const semestre = document.querySelector('#semestre').value;
    const carrera = document.querySelector('#carrera').value;
    const grupo = document.querySelector('#grupo').value;
    const maestro = document.querySelector('#maestro').value;

    if(semestre === ""){
        alerta('error', 'Seleccione el semestre', document.querySelector('#referencia'));
        return;
    }
    
    if(carrera === ""){
        alerta('error', 'Seleccione la carrera', document.querySelector('#referencia'));
        return;
    }
    
    if(grupo === ""){
        alerta('error', 'Seleccione el grupo', document.querySelector('#referencia'));
        return;
    }
    
    if(maestro === ""){
        alerta('error', 'Seleccione el maestro', document.querySelector('#referencia'));
        return;
    }
    const modal = document.querySelector('.modal');
    agregar(semestre, carrera, grupo, maestro);
    modal.remove();
}

async function obtenerEvaluaciones() {
    try {
        const url = `/api/evaluaciones`;
        const respuesta = await fetch(url);
        const resultado = await respuesta.json();

        evaluaciones = resultado.evaluaciones;
        maestros = resultado.maestros;
        mostrarEvaluaciones();

    } catch (error) {
        console.log(error);
    }
}

async function agregar(semestre, carrera, grupo, maestro) {
    const datos = new FormData();
    datos.append('semestre', semestre);
    datos.append('carrera', carrera);
    datos.append('grupo', grupo);
    datos.append('maestro', maestro);

    try {
        const respuesta = await fetch(`http://localhost:3000/api/evaluacion`, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();

        if(resultado.tipo === "error"){
            var notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top',
                }
            });
            notyf.error(resultado.mensaje);
        }
        if(resultado.tipo === "exito"){
            var notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top',
                }
            });
            mostrarEvaluaciones();
        }


    } catch (error) {
        console.log(error);
    }
}

function mostrarEvaluaciones() {
    limpiarEvaluaciones();

    const arrayevaluaciones = filtradas.length ? filtradas : evaluaciones;
    if (arrayevaluaciones.length === 0) {
        return;
    }

    arrayevaluaciones.forEach(entidad => {
        const tr = document.createElement('TR');
        tr.classList.add('border-b', 'border-gray-200');

        const nombre = document.createElement('TD');
        nombre.classList.add('p-3');
        nombre.textContent = entidad.nombre + ' ' + entidad.apellidos;

        const numero = document.createElement('TD');
        numero.classList.add('p-3');
        numero.textContent = entidad.numero;

        const asignacion = document.createElement('TD');
        asignacion.classList.add('p-3');
        asignacion.textContent = entidad.asignacion;

        tr.appendChild(nombre);
        tr.appendChild(numero);
        tr.appendChild(asignacion);


        const acciones = document.createElement('TD');
        acciones.classList.add('flex', 'gap-3', 'items-center', 'p-3');

        const btnEditar = document.createElement('BUTTON');
        btnEditar.classList.add('cursor-pointer');
        btnEditar.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#2835ff">
            <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
        </svg>
        `;
        btnEditar.addEventListener('click', function () {
            mostrarEntidad(editar = true, { ...entidad });
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

        tr.appendChild(acciones);

        document.querySelector('#tbody').appendChild(tr);
    });
}


function limpiarEvaluaciones() {
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