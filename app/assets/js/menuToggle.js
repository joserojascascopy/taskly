const btnMenuToggle = document.getElementById('menuToggle');
const sidebar = document.querySelector('.sidebar');
const main = document.querySelector('.main');

btnMenuToggle.addEventListener('click', () => {
    sidebar.classList.toggle('ocultar');
    sidebar.classList.toggle('mostrar');

    main.classList.toggle('show');
    main.classList.toggle('traslate');
});