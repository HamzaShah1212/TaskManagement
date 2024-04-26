<!-- resources/views/tasks/index.blade.php -->


<h1 class="text-2xl font-bold mb-4">Task List</h1>
<table class="table-auto w-full">
    <thead>
        <tr>
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Description</th>
            <th class="px-4 py-2">Priority</th>
            <th class="px-4 py-2">Due Date</th>
            <th class="px-4 py-2">Completed</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td class="border px-4 py-2">{{ $task->title }}</td>
                <td class="border px-4 py-2">{{ $task->description }}</td>
                <td class="border px-4 py-2">{{ $task->priority }}</td>
                <td class="border px-4 py-2">{{ $task->due_date }}</td>
                <td class="border px-4 py-2">{{ $task->completed ? 'Yes' : 'No' }}</td>
                <td class="border px-4 py-2">
                    <button onclick="editTask({{ $task->id }})"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>

                    <button onclick="deleteTask({{ $task->id }})"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    function deleteTask(taskId) {
        if (confirm("Are you sure you want to delete this task?")) {
            $.ajax({
                url: '/api/delete/task/' + taskId,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    window.location.reload();
                },

                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Error deleting task.");
                }
            });
        }
    }

    function editTask(taskId) {



    }
</script>
