document.addEventListener('DOMContentLoaded', function () {
    cargarPreguntas();
    enviarEvaluacion();
});

let valorPregunta1 = '';
let valorPregunta2 = '';
let valorPregunta3 = '';
let valorPregunta4 = '';

function cargarPreguntas() {
    const pregunta1 = document.querySelectorAll('[name="pregunta1"]');
    pregunta1.forEach(opcion => {
        opcion.addEventListener('input', (e) => {
            valorPregunta1 = e.target.value;
            console.log(valorPregunta1);
        });
    });
    const pregunta2 = document.querySelectorAll('[name="pregunta2"]');
    pregunta2.forEach(opcion => {
        opcion.addEventListener('input', (e) => {
            valorPregunta2 = e.target.value;
            console.log(valorPregunta2);
        });
    });
    const pregunta3 = document.querySelectorAll('[name="pregunta3"]');
    pregunta3.forEach(opcion => {
        opcion.addEventListener('input', (e) => {
            valorPregunta3 = e.target.value;
            console.log(valorPregunta3);
        });
    });
    const pregunta4 = document.querySelectorAll('[name="pregunta4"]');
    pregunta4.forEach(opcion => {
        opcion.addEventListener('input', (e) => {
            valorPregunta4 = e.target.value;
            console.log(valorPregunta4);
        });
    });
}

function enviarEvaluacion() {
    const btnEnviar = document.querySelector('#btn-enviar-evaluacion');
    btnEnviar.addEventListener('click', (e) => {
        e.preventDefault();
        validar();
    });
}

function validar() {
    if (valorPregunta1 === '') {
        var notyf = new Notyf({
            duration: 5000,
            position: {
                x: 'right',
                y: 'top',
            }
        });
        notyf.error('No has seleccionado ninguna respuesta en la pregunta 1');
        return;
    }
    if (valorPregunta2 === '') {
        var notyf = new Notyf({
            duration: 5000,
            position: {
                x: 'right',
                y: 'top',
            }
        });
        notyf.error('No has seleccionado ninguna respuesta en la pregunta 2');
        return;
    }
    if (valorPregunta3 === '') {
        var notyf = new Notyf({
            duration: 5000,
            position: {
                x: 'right',
                y: 'top',
            }
        });
        notyf.error('No has seleccionado ninguna respuesta en la pregunta 3');
        return;
    }
    if (valorPregunta4 === '') {
        var notyf = new Notyf({
            duration: 4000,
            position: {
                x: 'right',
                y: 'top',
            }
        });
        notyf.error('No has seleccionado ninguna respuesta en la pregunta 4');
        return;
    }
    let idNuevo = Number.parseInt(id);
    let respuesta1 = Number.parseInt(valorPregunta1);
    let respuesta2 = Number.parseInt(valorPregunta2);
    let respuesta3 = Number.parseInt(valorPregunta3);
    let respuesta4 = Number.parseInt(valorPregunta4);

    const respuestas = {
        id: idNuevo,
        pregunta1: respuesta1,
        pregunta2: respuesta2,
        pregunta3: respuesta3,
        pregunta4: respuesta4,
        estado: 1,
        idAlumno: idAlumno,
        idMaestro: idMaestro,
        tutorias: tutorias
    }
    console.log(respuestas);
    guardarEvaluacion(respuestas);
}

async function guardarEvaluacion(respuestas) {
    const datos = new FormData();
    for (const key in respuestas) {
        datos.append(key, respuestas[key]);
    }

    try {
        const url = `/api/evaluacion/actualizar`;
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();

        if (resultado.tipo === 'exito') {
            const containerPreguntas = document.querySelector('#container-preguntas');
            containerPreguntas.classList.add('hidden');

            const mensajeExito = document.querySelector('#mensaje-exito');
            mensajeExito.classList.remove('hidden');
        }
    } catch (error) {
        console.log(error);
    }
}
