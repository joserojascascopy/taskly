const inputRadio = document.querySelectorAll('.input-radio');

inputRadio.forEach(radio => {
    radio.addEventListener('change', (e) => {
        if (e.target.value === 'pendiente') {
            pendientes();
        } else if (e.target.value === 'completado') {
            console.log('Completados...');
        } else {
            console.log('Todos...');
        }
    });
});

async function pendientes() {
    const userId = document.querySelector('[data-id]').dataset.id;

    const url = '/api/task-pending';
    const res = await fetch(url, {
        method: 'POST',
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ userId })
    });

    const body = await res.json();

    if (body.resultado) {
        showPending(body.resultado);
    }
};

function showPending(pendingTask) {
    const projectsContainer = document.querySelector('.projects-container');
    projectsContainer.innerHTML = '';

    pendingTask.forEach(task => {
        const { id, titulo, descripcion, estado } = task;

        const projectCard = document.createElement('DIV');
        projectCard.classList.add('project-card');

        const cardHeader = document.createElement('DIV');
        cardHeader.classList.add('card-header');
        cardHeader.classList.add(estado);

        const cardTitle = document.createElement('H2');
        cardTitle.textContent = titulo;

        const divAcciones = document.createElement('DIV');
        divAcciones.classList.add('acciones-container');

        let divEstado = null;

        if (estado === 'completado') {
            divEstado = document.createElement('SPAN');
            divEstado.textContent = estado;
            divEstado.classList.add('estado');
        } else {
            divEstado = document.createElement('div')
            divEstado.classList.add('tooltip');

            const btnEstado = document.createElement('BUTTON');
            btnEstado.classList.add('estado', 'pending');
            btnEstado.textContent = estado;
            btnEstado.dataset.idTask = id;
            btnEstado.type = 'button';

            const span = document.createElement('SPAN');
            span.classList.add('tooltiptext');
            span.textContent = 'Haz doble click para marcar como completado';

            divEstado.appendChild(btnEstado);
            divEstado.appendChild(span);
        }

        const btnEliminar = document.createElement('BUTTON');
        btnEliminar.classList.add('eliminar');
        btnEliminar.dataset.idTask = id;
        btnEliminar.textContent = 'ELIMINAR';

        projectCard.appendChild(cardHeader);
        cardHeader.appendChild(cardTitle);
        cardHeader.appendChild(divAcciones);
        divAcciones.appendChild(divEstado);
        divAcciones.appendChild(btnEliminar);

        const descripcionParrafo = document.createElement('P');
        descripcionParrafo.textContent = descripcion;

        projectCard.appendChild(descripcionParrafo);

        projectsContainer.appendChild(projectCard);
    });

    actualizarEstado();
    deleteTask();
}