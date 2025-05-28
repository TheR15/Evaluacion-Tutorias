<div>
    <div class="w-full absolute">
        <?php include_once __DIR__ . '/../templates/barra.php'; ?>
    </div>
    <div class="flex justify-center items-center h-screen">
        <div class="flex flex-col justify-center gap-5 w-xl mx-auto p-5 bg-white rounded-xl drop-shadow-md border-1 border-gray-200">
            <div class="flex flex-col">
                <h1 class="text-xl font-medium text-blue-700">Comienza a evaluar</h1>
                <p class="my-3 text-gray-600">Una vez que termines de evaluar a tu tutor no podras realizar la evauacion nuevamente.</p>
                <div class="p-3 bg-gray-100 rounded-xl">
                    <h2 class="font-medium mb-2">¿Cómo funciona?</h2>
                    <ol class="flex flex-col gap-3">
                        <li><span class="font-bold">1.</span> Revisa la información del tutor que vas a evaluar para confirmar que es correcto.</li>
                        <li><span class="font-bold">2.</span> Haz clic en el botón "Comenzar Evaluación" para iniciar el proceso.</li>
                        <li><span class="font-bold">3.</span> Responde a todas las preguntas con honestidad basándote en tu experiencia.</li>
                        <li><span class="font-bold">4.</span> Envía tu evaluación al finalizar. Tus respuestas son confidenciales.</li>
                    </ol>
                </div>
            </div>
            <hr class="border-gray-400">
            <div class="flex flex-col">
                <div class="flex justify-between items-center">
                    <h2 class="text-md font-medium text-xl">Tutor :</h2>
                    <label for="" class="font-medium text-xl"><?php echo $maestro->nombre . ' ' . $maestro->apellidos; ?></label>
                </div>
                <a href="/preguntas" class="text-center mt-5 bg-blue-700 text-white px-3 py-2 rounded-xl font-medium cursor-pointer hover:bg-blue-800 transition-all">Comenzar a evaluar</a>
            </div>
        </div>
    </div>
</div>