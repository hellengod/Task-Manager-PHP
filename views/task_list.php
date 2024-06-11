<?php include 'header.php'; ?>

<div class="container">
    <main>
        <form id="taskForm" action="/task_manager/controllers/TaskController.php" method="POST">
            <table id="taskTable">
                <thead>
                    <tr>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descricação</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../controllers/TaskController.php';
                    $controller = new TaskController();
                    $tasks = $controller->read();

                    while ($row = $tasks->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        echo "<tr data-id='" . strval($id) . "'>
                            <td><input type='text' name='title' value='" . strval($title) . "' aria-label='Task Title' placeholder='Digite titulo' required></td>
                            <td><input type='text' name='description' value='" . strval($description) . "' aria-label='Task Description' placeholder='Digite descricao' required></td>
                            <td>
                                <select name='status' aria-label='Task Status' required>
                                    <option value='pending'" . ($status == 'pending' ? ' selected' : '') . ">pendente</option>
                                    <option value='completed'" . ($status == 'completed' ? ' selected' : '') . ">finalizado</option>
                                </select>
                            </td>
                            <td>
                                <button type='button' class='editBtn' aria-label='Edit Task' title='Edit Task'>
    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
    </svg>
</button>

<button type='button' class='deleteBtn' aria-label='Delete task' title='Delete Task'>
    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
        <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5'/>
    </svg>
</button>
    </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </main>
    <button id="addRowBtn" aria-label="Add a new row"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0"/>
</svg></button>
</div>
<footer>
    <p>&copy; 2024 Task Manager</p>
</footer>
<script>

document.getElementById('addRowBtn').addEventListener('click', function() {
    const table = document.getElementById('taskTable').getElementsByTagName('tbody')[0];
    
    // Verifica se já existe uma linha de adição pendente
    if (table.querySelector('.addRowPending')) {
        alert('Por favor, complete a linha de adição pendente antes de adicionar outra.');
        return;
    }
    
    // Cria uma classe para identificar a linha de adição pendente
    const newRow = table.insertRow();
    newRow.className = 'addRowPending';
    newRow.innerHTML = `
<td><input aria-label='preencher titulo' type='text' name='title' required></td>
<td><input aria-label='preencher descricao' type='text' name='description' required></td>
<td>
    <select name='status' required aria-label='Selecione o status'>
        <option value='pending'>pendente</option>
        <option value='completed'>finalizado</option>
    </select>
</td>
<td>
    <button aria-label='Enviar nova linha' type='button' class='sendBtn'>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"/>
        </svg>
    </button>
    <button aria-label='Remover nova linha' type='button' class='removeBtn'>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
        </svg>
    </button>
</td>

    `;

});

document.querySelector('form').addEventListener('submit', function() {
    document.getElementById('addRowBtn').style.display = 'block'; // Mostra o botão "Add Row" novamente após enviar o formulário
});

document.querySelectorAll('.deleteBtn').forEach(button => {
    button.addEventListener('click', function() {
        const row = this.closest('tr');
        const id = row.getAttribute('data-id');
        fetch('/task_manager/controllers/TaskController.php', {
            method: 'POST',
            body: new URLSearchParams({
                'id': id,
                'delete': true
            })
        }).then(() => location.reload());
    });
});

document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', function() {
        const row = this.closest('tr');
        const id = row.getAttribute('data-id');
        const title = row.querySelector('input[name="title"]').value;
        const description = row.querySelector('input[name="description"]').value;
        const status = row.querySelector('select[name="status"]').value;
        if (title.trim() === "" || description.trim() === "") {
            alert("Title and Description cannot be empty.");
            return;
        }
        fetch('/task_manager/controllers/TaskController.php', {
            method: 'POST',
            body: new URLSearchParams({
                'id': id,
                'title': title,
                'description': description,
                'status': status,
                'update': true
            })
        }).then(() => location.reload());
    });
});

document.querySelector('body').addEventListener('click', function(event) {
    if (event.target.classList.contains('sendBtn')) {
        const row = event.target.closest('tr');
        const title = row.querySelector('input[name="title"]').value;
        const description = row.querySelector('input[name="description"]').value;
        const status = row.querySelector('select[name="status"]').value;
        if (title.trim() === "" || description.trim() === "") {
            alert("Title and Description cannot be empty.");
            return;
        }
        fetch('/task_manager/controllers/TaskController.php', {
            method: 'POST',
            body: new URLSearchParams({
                'title': title,
                'description': description,
                'status': status,
                'create': true
            })
        }).then(() => location.reload());
    }

    if (event.target.classList.contains('removeBtn')) {
        const row = event.target.closest('tr');
        row.remove();
    }
});
</script>
</body>
</html>