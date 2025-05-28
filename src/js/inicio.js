obtenerEntidades();
let entidades = [];
let filtradas = [];
let tutorias = [];
let tutoriasFiltradas = [];

document.addEventListener('DOMContentLoaded', () => {
    cerrarFiltros();
});

//Busqueda
const inputBuscar = document.querySelector('#buscar');
inputBuscar.addEventListener('input', buscarSolictud);

//Filtrar por estado completado o no completado
const btnFiltroEstado = document.querySelector('#btn-filtro-estado');
const dropMenu = document.querySelector('#drop-menu-estado');
btnFiltroEstado.addEventListener('click', () => {
    const dropMenu = document.querySelector('#drop-menu-estado');
    const dropMenuGrupo = document.querySelector('#drop-menu-grupo');
    dropMenuGrupo.classList.add('hidden');
    abrirMenuFiltros(dropMenu);
    filtrarEstado();
});

function filtrarEstado() {
    const radioEstado = document.querySelectorAll('[name="estado"]');
    radioEstado.forEach(radio => {
        radio.addEventListener('input', (e) => {
            console.log(e.target.value)
            const estado = e.target.value;
            if (estado === 'radio-completadas') {
                filtradas = entidades.filter(entidad => entidad.estado === "1");
                mostrarEntidades();
            }
            if (estado === 'radio-no-completadas') {
                filtradas = entidades.filter(entidad => entidad.estado === "0");
                mostrarEntidades();
            }
            if (estado === 'radio-todas') {
                filtradas = entidades;
                mostrarEntidades();
            }
        });
    });
}

//Filtra por grupo
const inputBuscarGrupo = document.querySelector('#buscar-grupo');
inputBuscarGrupo.addEventListener('input', buscarGrupo);

function buscarGrupo(e) {
    const busqueda = e.target.value.toLowerCase();
    if (busqueda !== '') {
        tutoriasFiltradas = tutorias.filter(tutoria =>
            tutoria.tutorias.toLowerCase().includes(busqueda)
        );
    } else {
        tutoriasFiltradas = [...tutorias]; // Copia del array original
    }
    mostrarTutorias();
    filtrarGrupo();
}

const btnFiltroGrupo = document.querySelector('#btn-filtro-grupo');
const dropMenuGrupo = document.querySelector('#drop-menu-grupo');
btnFiltroGrupo.addEventListener('click', () => {
    const dropMenuGrupo = document.querySelector('#drop-menu-grupo');
    const dropMenu = document.querySelector('#drop-menu-estado');
    dropMenu.classList.add('hidden');
    abrirMenuFiltros(dropMenuGrupo);
    filtrarGrupo();
});

function filtrarGrupo() {
    const radiosGrupo = document.querySelectorAll('[name="grupo"]');
    radiosGrupo.forEach(radio => {
        radio.addEventListener('input', (e) => {
            const grupoSeleccionado = e.target.value;
            console.log(grupoSeleccionado);
            filtradas = entidades.filter(entidad => entidad.tutorias === grupoSeleccionado);
            mostrarEntidades();
        });
    });
}

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
        tutorias = resultado.tutorias;
        mostrarEntidades();
        mostrarTutorias();

    } catch (error) {
        console.log(error);
    }
}

function mostrarTutorias() {
    const arrayTutorias = tutoriasFiltradas.length > 0 ? tutoriasFiltradas : tutorias;

    const dropMenuGrupo = document.querySelector('#listado');
    dropMenuGrupo.innerHTML = ''; // Limpiar el contenedor

    while (dropMenuGrupo.firstChild) {
        dropMenuGrupo.removeChild(dropMenuGrupo.firstChild);
    }
    arrayTutorias.forEach(tutoria => {
        const contenedor = document.createElement('DIV');
        contenedor.classList.add('flex', 'gap-4', 'p-1');
        contenedor.id = 'grupo';

        const input = document.createElement('INPUT');
        input.type = 'radio';
        input.name = 'grupo';
        input.id = tutoria.tutorias;
        input.value = tutoria.tutorias;
        input.classList.add('accent-blue-700', 'cursor-pointer');

        const label = document.createElement('LABEL');
        label.name = 'grupo';
        label.textContent = tutoria.tutorias;
        label.classList.add('cursor-pointer');
        label.setAttribute('for', tutoria.tutorias);

        const barra = document.createElement('HR');
        barra.classList.add('border-gray-300', 'w-full', 'my-2');
        contenedor.appendChild(input);
        contenedor.appendChild(label);
        dropMenuGrupo.appendChild(contenedor);
        dropMenuGrupo.appendChild(barra);
    });
}

function mostrarEntidades() {
    limpiarEntidades();
    const arrayEntidades = filtradas.length ? filtradas : entidades;
    if (arrayEntidades.length === 0) {
        const table = document.querySelector('#body');
        const div = document.createElement('DIV');
        div.textContent = 'No se encontraron evaluaciones';
        div.classList.add('text-center', 'text-gray-400', 'p-4');
        table.appendChild(div);
        return;
    }

    arrayEntidades.forEach(entidad => {
        const tr = document.createElement('TR');
        tr.classList.add('border-b', 'border-gray-200');
        const alumno = document.createElement('TD');
        alumno.classList.add('p-3');
        alumno.textContent = entidad.nombreAlumno + ' ' + entidad.apellidosAlumno;

        const tutorias = document.createElement('TD');
        tutorias.classList.add('p-3', 'hidden', 'md:table-cell');
        tutorias.textContent = entidad.tutorias;

        const maestro = document.createElement('TD');
        maestro.classList.add('p-3', 'hidden', 'md:table-cell');
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

        document.querySelector('#tbody').appendChild(tr);
    });
}

function limpiarEntidades() {
    const tabla = document.querySelector('#tbody');
    while (tabla.firstChild) {
        tabla.removeChild(tabla.firstChild);
    }
}

function abrirMenuFiltros(dropMenu) {
    if (dropMenu.classList.contains('hidden')) {
        dropMenu.classList.remove('hidden');
        dropMenu.classList.remove('scale-in-ver-top-reverse');
        dropMenu.classList.add('scale-in-ver-top');
    } else {
        dropMenu.classList.remove('scale-in-ver-top');
        dropMenu.classList.add('scale-in-ver-top-reverse');
        setTimeout(() => {
            dropMenu.classList.add('hidden');
        }, 300);
    }
}

function cerrarFiltros(){
    const cerrarFiltroEstado = document.querySelector('#btn-cerrar-estado');
    const cerrarFiltroGrupo = document.querySelector('#btn-cerrar-grupo')

    cerrarFiltroEstado.addEventListener('click', () =>{
        const dropMenuEstado = document.querySelector('#drop-menu-estado');
        dropMenuEstado.classList.add('hidden');
    })

    cerrarFiltroGrupo.addEventListener('click', ()=>{
        const dropMenuGrupo = document.querySelector('#drop-menu-grupo')
        dropMenuGrupo.classList.add('hidden');
    })
}