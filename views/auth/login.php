<div class="p-5 flex justify-center items-center bg-linear-to-t from-blue-700 to-blue-600 h-screen">
    <div class="grid md:grid-cols-2 bg-white w-2xl rounded-xl">
        <div class="hidden md:flex items-center p-10">
            <img src="build/img/logo.webp" alt="" class="">
        </div>
        <form method="POST" class="ml-10 md:ml-0 pt-10 pb-10 pr-10">
            <h1 class="text-2xl text-center">Bienvenido de nuevo</h1>
            <?php foreach ($alertas as $alerta) : ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 py-2 px-2 mt-3 font-bold text-center">
                    <p><?= $alerta ?></p>
                </div>
            <?php endforeach; ?>
            <div class="flex flex-col mt-5 gap-2">
                <label for="email">Correo</label>
                <input class="border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500" id="email" type="text" name="email" placeholder="Ingresa tu correo">
            </div>

            <div class="flex flex-col mt-5 gap-2">
                <label for="password">Contraseña</label>
                <input class="border-gray-300 border-1 rounded-xl py-2 px-2 focus:outline-blue-500 focus:bg-blue-50 transition duration-500 ease-in-out outline-blue-500" id="password" type="password" name="password" placeholder="Ingresa tu contraseña">
            </div>
            <input type="submit" class="bg-blue-500 text-white rounded-xl py-2 px-2 mt-5 mb-3 cursor-pointer hover:bg-blue-600 transition duration-500 ease-in-out w-full font-bold" value="Iniciar sesión">
            <hr class="border-gray-300 border-1">    
            <div class="mt-3">
                <a href="<?php echo $client->createAuthUrl(); ?>" class="w-full flex items-center justify-center bg-white py-2 px-4 rounded-xl border-1 border-gray-300 font-bold hover:bg-gray-100 ">
                    <img src="https://www.google.com/favicon.ico" alt="Google" class="w-5 h-5 mr-2">
                    Iniciar sesión con Google
                </a>
            </div>
        </form>
    </div>
</div>