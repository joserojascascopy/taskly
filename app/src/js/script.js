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
            renderTasks(body.tasks);
        } else {
            showMessage();
        }

    } catch (error) {
        console.log(error);
    }
}

// Muestra un mensaje si no hay tareas para mostrar
function showMessage() {
    const projectsDiv = document.querySelector('.projects');

    const mensaje = document.createElement('H3');
    mensaje.textContent = 'No tienes ninguna tarea';
    mensaje.classList.add('mensaje');

    projectsDiv.appendChild(mensaje);
}

// Listar las tareas
function renderTasks(tasks) {
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

// Actualizar el estado de las tareas
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
    try {
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
    } catch(error) {
        console.error('Error actualizando tarea: ', error);
    }
}

// Eliminar una tarea

function deleteTask() {
    const btnEliminar = document.querySelectorAll('.eliminar');

    btnEliminar.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const id = e.target.dataset.idTask;

            Swal.fire({
                title: "Estas seguro que quieres eliminar esta tarea?",
                // text: "You won't be able to revert this!",
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
        
        if(!body.success) {
            console.error('No se pudo eliminar la tarea')
        }

    } catch (error) {
        console.error('Error eliminando tarea: ', error);
    }
}

// Filtrar por las tareas pendientes, completadas y todas las tareas
const inputRadio = document.querySelectorAll('.input-radio');
const userId = document.querySelector('[data-id]')?.dataset.id;

inputRadio.forEach(radio => {
    radio.addEventListener('change', (e) => {
        if (e.target.value === 'pendiente') {
            pending();
        } else if (e.target.value === 'completado') {
            completed();
        } else {
            AllTasks();
        }
    });
});

// Pendientes
async function pending() {
    const url = '/api/task-pending';
    const res = await fetch(url, {
        method: 'POST',
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ userId })
    });

    const body = await res.json();

    if (body.resultado) {
        renderTasks(body.resultado);
    }
};

// Completadas
async function completed() {
    const url = '/api/task-completed';
    const res = await fetch(url, {
        method: 'POST',
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ userId })
    });

    const body = await res.json();

    if (body.resultado) {
        renderTasks(body.resultado);
    }
};