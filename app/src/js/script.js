document.addEventListener('DOMContentLoaded', () => {
    AllTasks();
})

// Nos trae todas las tareas desde el backend por el user_id
async function AllTasks() {
    const user_id = document.querySelector('[data-id]').dataset.id;
    try {
        const url = '/api/tasks';
        const res = await fetch(url, {
            method: 'POST',
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ user_id })
        });

        const body = await res.json();

        if (body.success == true) {
            mostrarTasks(body.tasks);
        } else {
            showMessage();
        }

    } catch (error) {
        console.log(error);
    }
}

// Nos muestra las tareas en el html
function mostrarTasks(tasks) {
    const projectsContainer = document.querySelector('.projects-container');
    projectsContainer.innerHTML = '';

    tasks.forEach(task => {
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

function actualizarEstado() {
    const btnUpdate = document.querySelectorAll('.pending');
    btnUpdate.forEach(btn => {
        // Para versión móvil
        let touchCount = 0;

        btn.addEventListener('touchstart', (e) => {
            touchCount++;
            setTimeout(() => { touchCount = 0; }, 500); // Resetea después de 500ms

            if (touchCount === 2) {
                const id = e.target.dataset.idTask;
                actualizar(id);
            }
        });

        // El dblclick funciona en escritorio, se mantiene
        btn.addEventListener('dblclick', (e) => {
            const id = e.target.dataset.idTask;

            actualizar(id);
        });
    });
}

async function actualizar(id) {
    const url = '/api/task-update';
    const res = await fetch(url, {
        method: 'POST',
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id })
    });

    const data = await res.json();

    if (data.success) {
        location.reload();
    }
}

function showMessage() {
    const projectsDiv = document.querySelector('.projects');

    const mensaje = document.createElement('H3');
    mensaje.textContent = 'No tienes ninguna tarea';
    mensaje.classList.add('mensaje');

    projectsDiv.appendChild(mensaje);
}

function deleteTask() {
    const btnEliminar = document.querySelectorAll('.eliminar');

    btnEliminar.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const id = e.target.dataset.idTask;

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminar(id).then(() => {
                        Swal.fire({
                            title: "Deleted!",
                            text: "La tarea ha sido eliminada",
                            icon: "success"
                        }).then(() => {
                            e.target.closest('.project-card').remove(); // Para evitar la recarga de la página, el método .closest(selector) busca en el DOM hacia arriba, es decir, del elemento actual hacia sus padres, abuelos, bisabuelos, etc., hasta encontrar el primer ancestro que coincida con el selector que le indiques
                        })
                    })
                };
            })
        });
    });
}

async function eliminar(id) {
    try {
        const url = '/api/task-delete';
        const res = await fetch(url, {
            method: 'POST',
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id })
        });

        const body = await res.json();
    } catch (error) {
        console.error('Error eliminando tarea: ', error);
    }
}