let tutores = [];
let pregunta1 = 0; // Inicializamos pregunta1 con un valor por defecto
let pregunta2 = 0; // Puedes agregar más variables si necesitas otras preguntas
let pregunta3 = 0;
let pregunta4 = 0;
let opcion5 = '';
let opcion4 = '';
let opcion3 = '';
let opcion2 = '';
let opcion1 = '';
let tutorSeleccionado;
let tutorSeleccionadoId;
let grafica = '';
let promedio = 0;
let comentarios = '';

obtenerDatosTutores();
document.addEventListener('DOMContentLoaded', function () {
  cambiarPregunta();
  cambiarTutor();
  generarPDF();
  enviarReporte();
});

async function obtenerDatosTutores() {
  try {
    const url = `/api/tutores`;
    const respuesta = await fetch(url);
    const resultado = await respuesta.json();

    tutores = resultado.tutores;
    mostrarTutores();

  } catch (error) {
    console.log(error);
  }
}

function mostrarTutores() {
  const selectTutores = document.querySelector('#select-tutores');
  tutores.forEach(tutor => {
    const option = document.createElement('OPTION');
    option.id = tutor.idMaestro;
    option.textContent = tutor.nombreMaestro + ' ' + tutor.apellidosMaestro;
    selectTutores.appendChild(option);
  });
}

function cambiarTutor() {
  const tituloGrafica = document.querySelector('#titulo-grafica');
  const selectTutores = document.querySelector('#select-tutores');
  const preguntaDefault = document.querySelector('#pregunta-default');
  const containerPreguntas = document.querySelector('#container-preguntas');
  const containerTotales = document.querySelector('#totales');
  const grupoTutorias = document.querySelector('#grupoTutorias');
  const totalAlumnos = document.querySelector('#totalAlumnos');
  const totalRealizadas = document.querySelector('#totalRealizadas');
  const totalSinRealizar = document.querySelector('#totalSinRealizar');
  const opcionesReporte = document.querySelector('#opciones-reporte');
  const promedioTutor = document.querySelector('#promedioTutor');

  selectTutores.addEventListener('change', (e) => {
    const tutorSelect = e.target.value;
    containerPreguntas.classList.remove('hidden');
    preguntaDefault.selected = true;
    containerTotales.classList.remove('hidden');
    opcionesReporte.classList.remove('hidden');

    tutores.forEach(tutor => {
      if (tutorSelect === tutor.nombreMaestro + ' ' + tutor.apellidosMaestro) {
        tituloGrafica.textContent = tutor.nombreMaestro + ' ' + tutor.apellidosMaestro;
        grupoTutorias.textContent = tutor.grupoTutorias;
        totalAlumnos.textContent = tutor.total_evaluaciones;
        totalRealizadas.textContent = tutor.totalRealizadas;
        totalSinRealizar.textContent = tutor.totalSinRealizar;
        promedioTutor.textContent = tutor.promedio;
        
        tutorSeleccionado = tutorSelect;
        tutorSeleccionadoId = tutor.idMaestro;
        promedio = tutor.promedio;
        comentarios = tutor.comentarios;
        
        pregunta1 = Number.parseInt(tutor.totalPregunta1) || 0;
        pregunta2 = Number.parseInt(tutor.totalPregunta2) || 0;
        pregunta3 = Number.parseInt(tutor.totalPregunta3) || 0;
        pregunta4 = Number.parseInt(tutor.totalPregunta4) || 0;

        totalOpcion5Pregunta1 = Number.parseInt(tutor.totalOpcion5Pregunta1);
        totalOpcion4Pregunta1 = Number.parseInt(tutor.totalOpcion4Pregunta1);
        totalOpcion3Pregunta1 = Number.parseInt(tutor.totalOpcion3Pregunta1);
        totalOpcion2Pregunta1 = Number.parseInt(tutor.totalOpcion2Pregunta1);
        totalOpcion1Pregunta1 = Number.parseInt(tutor.totalOpcion1Pregunta1);

        totalOpcion5Pregunta2 = Number.parseInt(tutor.totalOpcion5Pregunta2);
        totalOpcion4Pregunta2 = Number.parseInt(tutor.totalOpcion4Pregunta2);
        totalOpcion3Pregunta2 = Number.parseInt(tutor.totalOpcion3Pregunta2);
        totalOpcion2Pregunta2 = Number.parseInt(tutor.totalOpcion2Pregunta2);
        totalOpcion1Pregunta2 = Number.parseInt(tutor.totalOpcion1Pregunta2);

        totalOpcion5Pregunta3 = Number.parseInt(tutor.totalOpcion5Pregunta3);
        totalOpcion4Pregunta3 = Number.parseInt(tutor.totalOpcion4Pregunta3);
        totalOpcion3Pregunta3 = Number.parseInt(tutor.totalOpcion3Pregunta3);
        totalOpcion2Pregunta3 = Number.parseInt(tutor.totalOpcion2Pregunta3);
        totalOpcion1Pregunta3 = Number.parseInt(tutor.totalOpcion1Pregunta3);

        totalOpcion5Pregunta4 = Number.parseInt(tutor.totalOpcion5Pregunta4);
        totalOpcion4Pregunta4 = Number.parseInt(tutor.totalOpcion4Pregunta4);
        totalOpcion3Pregunta4 = Number.parseInt(tutor.totalOpcion3Pregunta4);
        totalOpcion2Pregunta4 = Number.parseInt(tutor.totalOpcion2Pregunta4);
        totalOpcion1Pregunta4 = Number.parseInt(tutor.totalOpcion1Pregunta4);

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

function enviarReporte() {
  const btnEnviarReporte = document.querySelector('#btn-enviar-reporte');
  btnEnviarReporte.addEventListener('click', () => {
    enviarDatosReporte();
  })
}

async function enviarDatos() {
  const datos = new FormData();
  datos.append('tipo', tutorSeleccionado);
  datos.append('promedio', promedio);
  datos.append('comentarios', comentarios);
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

    const url = `http://localhost:3000/api/reporte/tutor`;
    const respuesta = await fetch(url, {
      method: 'POST',
      body: datos
    });

    const resultado = await respuesta.blob();
    const urlPDF = window.URL.createObjectURL(resultado);
    const a = document.createElement('a');
    a.href = urlPDF;
    a.download = 'Evaluacion Tutorias del tutor ' + tutorSeleccionado;
    document.body.appendChild(a);
    a.click();
    a.remove();

    // Remover overlay después de completar
    overlay.remove();
    style.remove();

  } catch (error) {
    console.log(error);
  }
}

async function enviarDatosReporte() {
  const datos = new FormData();
  datos.append('tipo', tutorSeleccionado);
  datos.append('promedio', promedio);
  datos.append('comentarios', comentarios);
  datos.append('idTutor', tutorSeleccionadoId);
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
    mensaje.textContent = 'Generando reporte y enviando...';

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

    const url = `http://localhost:3000/api/enviarReporte`;
    const respuesta = await fetch(url, {
      method: 'POST',
      body: datos
    });

    //Remover overlay
    overlay.remove();
    style.remove();


    const resultado = await respuesta.json();
    if (resultado.estado === 'success') {
      var notyf = new Notyf({
        duration: 3000,
        position: {
          x: 'right',
          y: 'top',
        }
      });
      notyf.success('El reporte se ha enviado correctamente.');
    } else {
      notyf.error('El reporte se ha enviado correctamente.');
    }

  } catch (error) {
    console.log(error);
  }
}

const ctx = document.getElementById('myChart');

grafica = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Pregunta 1', 'Pregunta 2', 'Pregunta 3', 'Pregunta 4'],
    datasets: [{
      label: '# of Votes',
      data: [pregunta1, pregunta2, pregunta3, pregunta4],
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
