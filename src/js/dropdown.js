document.addEventListener('DOMContentLoaded', function () {
    perfilNavegacion();
});

function perfilNavegacion() {
    const btnPerfil = document.querySelector('#dropdown');
    const flechaDropdown = document.querySelector('.flecha-dropdown');
    btnPerfil.addEventListener('click', () => {
        const dropMenu = document.querySelector('#drop-menu');
        if (dropMenu.classList.contains('hidden')) {
            dropMenu.classList.remove('hidden');
            dropMenu.classList.remove('scale-in-ver-top-reverse');
            flechaDropdown.classList.add('rotate-90');
            dropMenu.classList.add('scale-in-ver-top');
        } else {
            dropMenu.classList.remove('scale-in-ver-top');
            dropMenu.classList.add('scale-in-ver-top-reverse');
            flechaDropdown.classList.remove('rotate-90');
            setTimeout(() => {
                dropMenu.classList.add('hidden');
            }, 300); // Adjust the timeout to match the duration of the reverse animation
        }
    });
}
