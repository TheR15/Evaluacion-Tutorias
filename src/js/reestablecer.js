document.addEventListener("DOMContentLoaded", function () {
    eliminar();
    actualizarSemestre();
});

function actualizarSemestre(){
    const btnActualizarSemestre = document.querySelector('#btn-actualizar-semestre');

    btnActualizarSemestre.addEventListener('click', () => {
        confirmarActualizarSemestre();
    });
}

function eliminar() {
    const btnEliminarAlumnos = document.querySelector('#btn-eliminar-alumnos');
    const btnEliminarMaestros = document.querySelector('#btn-eliminar-maestros');
    const btnEliminarEvaluaciones = document.querySelector('#btn-eliminar-evaluaciones');
    const btnReestablecer = document.querySelector('#btn-reestablecer');

    btnEliminarAlumnos.addEventListener('click', () => {
        confirmarEliminarAlumnos();
    })

    btnEliminarMaestros.addEventListener('click', () => {
        confirmarEliminarMaestros();
    })

    btnEliminarEvaluaciones.addEventListener('click', () => {
        confirmarEliminarEvaluaciones();
    })

    btnReestablecer.addEventListener('click', () => {
        confirmarReestablecerSistema();
    })
}

function confirmarEliminarAlumnos() {
    Swal.fire({
        title: `¿Estas seguro de eliminar todos los registros de alumnos del sistema?`,
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        text: `Esta acción eliminará permanentemente todos los datos de alumnos, incluyendo sus evaluaciones asociadas.`,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#99a3a4',
        confirmButtonColor: '#000fff'
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            eliminarAll('alumnos/eliminar');
        }
    });
}

function confirmarEliminarMaestros() {
    Swal.fire({
        title: `¿Estas seguro de eliminar todos los registros de maestros del sistema?`,
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        text: `Esta acción eliminará permanentemente todos los datos de maestros, incluyendo sus asignaciones.`,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#99a3a4',
        confirmButtonColor: '#000fff'
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            eliminarAll('maestros/eliminar');
        }
    });
}

function confirmarEliminarEvaluaciones() {
    Swal.fire({
        title: `¿Estas seguro de eliminar todas las evaluaciones del sistema?`,
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        text: `Esta acción eliminará permanentemente todas las evaluaciones de tutorías, pero mantendrá los registros de alumnos y maestros.`,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#99a3a4',
        confirmButtonColor: '#000fff'
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            eliminarAll('evaluaciones/eliminar');
        }
    });
}

function confirmarReestablecerSistema() {
    Swal.fire({
        title: `¿Estas seguro de eliminar todos los datos del sistema (alumnos, maestros y evaluaciones)?`,
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        text: `¡ADVERTENCIA! Esta acción eliminará permanentemente todos los datos del sistema.`,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#99a3a4',
        confirmButtonColor: '#000fff'
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            eliminarAll('reestablecer');
        }
    });
}

function confirmarActualizarSemestre(){
        Swal.fire({
        title: `¿Estas seguro de actualizar el semestre de todos los alumnos?`,
        showCancelButton: true,
        confirmButtonText: "Actualizar",
        text: `¡ADVERTENCIA! Esta acción no se podra revertir.`,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#99a3a4',
        confirmButtonColor: '#000fff'
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            actualizar();
        }
    });
}

async function actualizar() {
    try {
        const url = `/api/semestre/actualizar`;
        const respuesta = await fetch(url, {
            method: 'POST'
        });

        const resultado = await respuesta.json();
        console.log(respuesta);

    } catch (error) {
        console.log(error);
    }
}

async function eliminarAll(entidad) {
    try {
        const url = `/api/${entidad}`;
        const respuesta = await fetch(url);
        const resultado = await respuesta.json();
        if (resultado.tipo == 'exito') {
            var notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top',
                }
            });
            notyf.success(resultado.mensaje);
        }
    } catch (error) {
        console.log(error);
    }
}