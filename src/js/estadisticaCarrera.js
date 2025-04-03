obtenerTutores();
let carreras = [];
let grafica;
let carreraSeleccionada;
document.addEventListener('DOMContentLoaded', function () {
    cambiarCarrera();
    cambiarPregunta();
    generarPDF();
});

async function obtenerTutores() {
    try {
        const url = `/api/carrera`;
        const respuesta = await fetch(url);
        const resultado = await respuesta.json();

        carreras = resultado.carrera;

    } catch (error) {
        console.log(error);
    }
}

function cambiarCarrera() {
    const selectCarreras = document.querySelector('#select-carreras');
    const containerTotales = document.querySelector('#totales');
    const totalAlumnos = document.querySelector('#totalAlumnos');
    const totalRealizadas = document.querySelector('#totalRealizadas');
    const totalSinRealizar = document.querySelector('#totalSinRealizar');
    const containerPreguntas = document.querySelector('#container-preguntas');
    const preguntaDefault = document.querySelector('#pregunta-default');
    const tituloGrafica = document.querySelector('#titulo-grafica');
    const btnGenerarReporte = document.querySelector('#btn-generar-reporte');

    selectCarreras.addEventListener('change', (e) => {
        containerTotales.classList.remove('hidden');
        containerPreguntas.classList.remove('hidden');
        tituloGrafica.classList.remove('hidden');
        btnGenerarReporte.classList.remove('hidden');
        preguntaDefault.selected = true;

        carreras.forEach(carrera => {
            if (e.target.value === carrera.carrera) {
                tituloGrafica.textContent = carrera.carrera;
                totalAlumnos.textContent = carrera.total_alumnos;
                totalRealizadas.textContent = carrera.totalRealizadas;
                totalSinRealizar.textContent = carrera.NoRealizadas;

                carreraSeleccionada = e.target.value;

                pregunta1 = Number.parseInt(carrera.totalPregunta1) || 0;
                pregunta2 = Number.parseInt(carrera.totalPregunta2) || 0;
                pregunta3 = Number.parseInt(carrera.totalPregunta3) || 0;
                pregunta4 = Number.parseInt(carrera.totalPregunta4) || 0;

                totalOpcion5Pregunta1 = Number.parseInt(carrera.p1_op5);
                totalOpcion4Pregunta1 = Number.parseInt(carrera.p1_op4);
                totalOpcion3Pregunta1 = Number.parseInt(carrera.p1_op3);
                totalOpcion2Pregunta1 = Number.parseInt(carrera.p1_op2);
                totalOpcion1Pregunta1 = Number.parseInt(carrera.p1_op1);

                totalOpcion5Pregunta2 = Number.parseInt(carrera.p2_op5);
                totalOpcion4Pregunta2 = Number.parseInt(carrera.p2_op4);
                totalOpcion3Pregunta2 = Number.parseInt(carrera.p2_op3);
                totalOpcion2Pregunta2 = Number.parseInt(carrera.p2_op2);
                totalOpcion1Pregunta2 = Number.parseInt(carrera.p2_op1);

                totalOpcion5Pregunta3 = Number.parseInt(carrera.p3_op5);
                totalOpcion4Pregunta3 = Number.parseInt(carrera.p3_op4);
                totalOpcion3Pregunta3 = Number.parseInt(carrera.p3_op3);
                totalOpcion2Pregunta3 = Number.parseInt(carrera.p3_op2);
                totalOpcion1Pregunta3 = Number.parseInt(carrera.p3_op1);

                totalOpcion5Pregunta4 = Number.parseInt(carrera.p4_op5);
                totalOpcion4Pregunta4 = Number.parseInt(carrera.p4_op4);
                totalOpcion3Pregunta4 = Number.parseInt(carrera.p4_op3);
                totalOpcion2Pregunta4 = Number.parseInt(carrera.p4_op2);
                totalOpcion1Pregunta4 = Number.parseInt(carrera.p4_op1);

                grafica.data.labels = ['Pregunta 1', 'Pregunta 2', 'Pregunta 3', 'Pregunta 4'];
                grafica.data.datasets[0].data = [pregunta1, pregunta2, pregunta3, pregunta4];
                grafica.update();
            }
        });
    });
}

function cambiarPregunta() {
    const selectPreguntas = document.querySelector('#select-preguntas');
    const tituloGrafica = document.querySelector('#titulo-grafica');
    selectPreguntas.addEventListener('change', (e) => {
        if (e.target.value === 'A') {
            tituloGrafica.textContent = 'A.- Genera un clima de confianza que permite el logro de los propositos de la tutoria';
            grafica.data.datasets[0].data = [totalOpcion5Pregunta1, totalOpcion4Pregunta1, totalOpcion3Pregunta1, totalOpcion2Pregunta1, totalOpcion1Pregunta1];
        }
        if (e.target.value === 'B') {
            tituloGrafica.textContent = 'B.- Calidad de la informacion proporcionada al tutorado';
            grafica.data.datasets[0].data = [totalOpcion5Pregunta2, totalOpcion4Pregunta2, totalOpcion3Pregunta2, totalOpcion2Pregunta2, totalOpcion1Pregunta2];
        }

        if (e.target.value === 'C') {
            tituloGrafica.textContent = 'C.- Disponibilidad y calidad en la atención tutorial';
            grafica.data.datasets[0].data = [totalOpcion5Pregunta3, totalOpcion4Pregunta3, totalOpcion3Pregunta3, totalOpcion2Pregunta3, totalOpcion1Pregunta3];
        }

        if (e.target.value === 'D') {
            tituloGrafica.textContent = 'D.- Planeacoón y preparación en los procesos de la Tutoria';
            grafica.data.datasets[0].data = [totalOpcion5Pregunta4, totalOpcion4Pregunta4, totalOpcion3Pregunta4, totalOpcion2Pregunta4, totalOpcion1Pregunta4];
        }
        grafica.data.labels = ['Opcion 5', 'Opcion 4', 'Opcion 3', 'Opcion 2', 'Opcion 1'];
        grafica.update();
    });
}

function generarPDF() {
    const btnGenerarReporte = document.querySelector('#btn-generar-reporte');
    btnGenerarReporte.addEventListener('click', () => {
        enviarDatos();
    });
}

async function enviarDatos() {
    const datos = new FormData();
    datos.append('tipo', carreraSeleccionada);
    datos.append('totalOpcion5Pregunta1', totalOpcion5Pregunta1);
    datos.append('totalOpcion4Pregunta1', totalOpcion4Pregunta1);
    datos.append('totalOpcion3Pregunta1', totalOpcion3Pregunta1);
    datos.append('totalOpcion2Pregunta1', totalOpcion2Pregunta1);
    datos.append('totalOpcion1Pregunta1', totalOpcion1Pregunta1);

    datos.append('totalOpcion5Pregunta2', totalOpcion5Pregunta2);
    datos.append('totalOpcion4Pregunta2', totalOpcion4Pregunta2);
    datos.append('totalOpcion3Pregunta2', totalOpcion3Pregunta2);
    datos.append('totalOpcion2Pregunta2', totalOpcion2Pregunta2);
    datos.append('totalOpcion1Pregunta2', totalOpcion1Pregunta2);

    datos.append('totalOpcion5Pregunta3', totalOpcion5Pregunta3);
    datos.append('totalOpcion4Pregunta3', totalOpcion4Pregunta3);
    datos.append('totalOpcion3Pregunta3', totalOpcion3Pregunta3);
    datos.append('totalOpcion2Pregunta3', totalOpcion2Pregunta3);
    datos.append('totalOpcion1Pregunta3', totalOpcion1Pregunta3);

    datos.append('totalOpcion5Pregunta4', totalOpcion5Pregunta4);
    datos.append('totalOpcion4Pregunta4', totalOpcion4Pregunta4);
    datos.append('totalOpcion3Pregunta4', totalOpcion3Pregunta4);
    datos.append('totalOpcion2Pregunta4', totalOpcion2Pregunta4);
    datos.append('totalOpcion1Pregunta4', totalOpcion1Pregunta4);

    try {
        const overlay = document.createElement('div');
        overlay.classList.add('fixed', 'top-0', 'left-0', 'w-full', 'h-full', 'flex', 'flex-col', 'justify-center', 'items-center', 'z-9999', 'text-white', 'text-xl', 'font-bold');
        overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';

        const mensaje = document.createElement('div');
        mensaje.textContent = 'Generando reporte...';

        const spinner = document.createElement('div');
        spinner.style.border = '5px solid #f3f3f3';
        spinner.style.borderTop = '5px solid #3498db';
        spinner.style.borderRadius = '50%';
        spinner.style.width = '50px';
        spinner.style.height = '50px';
        spinner.style.animation = 'spin 1s linear infinite';
        spinner.style.marginBottom = '20px';

        // Agregar animación CSS para el spinner
        const style = document.createElement('style');
        style.textContent = `
          @keyframes spin {
              0% { transform: rotate(0deg); }
              100% { transform: rotate(360deg); }
          }
      `;
        document.head.appendChild(style);

        overlay.appendChild(spinner);
        overlay.appendChild(mensaje);
        document.body.appendChild(overlay);

        const url = `/api/reporte/carrera`;
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.blob();
        const urlPDF = window.URL.createObjectURL(resultado);
        const a = document.createElement('a');
        a.href = urlPDF;
        a.download = 'Evaluacion Tutorias de la carrera de ' + carreraSeleccionada;
        document.body.appendChild(a);
        a.click();
        a.remove();

        // Remover overlay después de completar
        overlay.remove();
        style.remove();

    } catch (error) {
        console.log(error);
        // Asegurarse de remover el overlay si hay error
        if (overlay) overlay.remove();
        if (style) style.remove();
    }
}


const ctx = document.getElementById('myChart');

grafica = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Opcion 5', 'Opcion 4', 'Opcion 3', 'Opcion 2', 'Opcion 1'],
        datasets: [{
            label: '# of Votes',
            data: [0, 0, 0, 0],
            backgroundColor: 'rgba(21, 93, 251, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // Permite que la gráfica se ajuste al contenedor
        plugins: {
            legend: {
                position: 'top',
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});