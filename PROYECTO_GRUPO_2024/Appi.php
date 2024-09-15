document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('topicForm');
    const topicsTable = document.getElementById('topicsTable').getElementsByTagName('tbody')[0];
    let topicId = 1;  // Simulación de ID único para cada tema
    
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const topicName = document.getElementById('topicName').value;
        await addTopicToServer(topicName);
        addTopicToTable(topicId++, topicName);
        form.reset();
    });

    function addTopicToTable(id, name) {
        const row = topicsTable.insertRow();
        row.insertCell(0).textContent = id;
        row.insertCell(1).textContent = name;
        const actionsCell = row.insertCell(2);
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Eliminar';
        deleteButton.addEventListener('click', async () => {
            await deleteTopicFromServer(id);
            topicsTable.deleteRow(row.rowIndex - 1);
        });
        actionsCell.appendChild(deleteButton);
    }

    async function addTopicToServer(name) {
        const response = await fetch('/api/topics', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name })
        });
        const result = await response.json();
        // Maneja la respuesta según sea necesario
    }

    async function deleteTopicFromServer(id) {
        await fetch(`/api/topics/${id}`, {
            method: 'DELETE'
        });
        // Maneja la respuesta según sea necesario
    }
});
