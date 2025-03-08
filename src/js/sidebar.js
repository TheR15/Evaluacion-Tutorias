document.addEventListener('DOMContentLoaded', function () {
    menu();
    menuResponsive();
});

function menu() {
    const menus = document.querySelectorAll('.menu');
    menus.forEach(menu => {
        menu.addEventListener('click', function (e) {
            abrirMenu(e);
        });
    });
}

function abrirMenu(e) {
    const menuClicked = e.currentTarget;
    const listaMenu = menuClicked.querySelector('div[id^="lista-"]');
    const flecha = menuClicked.querySelector('.flecha');
    if (listaMenu.classList.contains('max-h-0')) {
        flecha.classList.add('rotate-90');
        listaMenu.classList.remove('max-h-0');
        listaMenu.classList.add('max-h-96', 'p-3');

        const otrosMenus = document.querySelectorAll('div[id^="lista-"]:not(.max-h-0)');
        otrosMenus.forEach(otroMenu => {
            if (otroMenu !== listaMenu) {
                otroMenu.classList.remove('max-h-96', 'p-3');
                otroMenu.classList.add('max-h-0');

                const otraFlecha = otroMenu.closest('.menu').querySelector('.flecha');
                otraFlecha.classList.remove('rotate-90');
                otraFlecha.classList.add('rotate-0');
            }
        });
    } else {
        flecha.classList.remove('rotate-90');
        listaMenu.classList.remove('max-h-96', 'p-3');
        listaMenu.classList.add('max-h-0');
    }
}

function menuResponsive() {
    const menuBtn = document.querySelector('#btn-menu');
    const btnCerrar = document.querySelector('#btn-cerrar');
    const contenido = document.querySelector('#contenido');
    const sidebar = document.querySelector('#sidebar');

    const abrirMenu = () => {
        contenido.classList.add('hidden', 'md:block');
        sidebar.classList.remove('hidden', 'slide-out-left');
        sidebar.classList.add('slide-in-left', 'w-full', 'md:w-3xs');
    };

    const cerrarMenu = () => {
        sidebar.classList.add('sm:slide-out-left');
        contenido.classList.add('slide-in-right');

        setTimeout(() => {
            sidebar.classList.add('hidden');
            contenido.classList.remove('hidden');
            sidebar.classList.remove('slide-in-left', 'slide-out-left');
        }, 120); // Ajusta el tiempo según la duración de tu animación CSS
    };

    menuBtn.addEventListener('click', abrirMenu);
    btnCerrar.addEventListener('click', cerrarMenu);
}