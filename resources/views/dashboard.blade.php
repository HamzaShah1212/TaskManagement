<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- resources/views/task-form.blade.php -->

                    <form id="taskForm" class="max-w-sm mx-auto mt-6 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="title" name="title" type="text" placeholder="Title">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2"
                                for="description">Description</label>
                            <textarea
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="description" name="description" placeholder="Description"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="priority">Priority</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="priority" name="priority" type="number" placeholder="Priority">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="due_date">Due Date</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="due_date" name="due_date" type="date">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="completed">
                                <input class="mr-2 leading-tight" id="completed" name="completed" type="checkbox">
                                <span class="text-sm">Completed</span>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <button id="submitBtn"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit">
                                Submit
                            </button>
                        </div>
                    </form>


                    <div class="" id="show_task"></div>


                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#submitBtn").on("click", function() {
                var formData = {
                    title: $("#title").val(),
                    description: $("#description").val(),
                    priority: $("#priority").val(),
                    due_date: $("#due_date").val(),
                    completed: $("#completed").prop('checked') ? 1 :
                    0, // Convert checkbox value to 1 or 0
                };

                $.ajax({
                    url: "{{ route('store') }}", // Laravel route name
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Handle the response here
                        console.log(response);
                        // Example: Show success message
                        alert("Task created successfully");
                        loadTasks();
                        // You can redirect or do any other action here
                    },
                    error: function(xhr, status, error) {
                    // If validation fails, display validation errors
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';
                    for (var key in errors) {
                        errorMessage += errors[key][0] + '\n'; // Assuming you want to display only the first error message for each field
                    }
                    alert(errorMessage);
                }

                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Function to fetch tasks from the server and display them in a table
            function loadTasks() {
                $.ajax({
                    url: "{{ route('getTask') }}", // Laravel route for fetching tasks
                    type: "GET",
                    success: function(response) {
                        console.log('data are ', response);
                        $('#show_task').html(response.html);

                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }

            // Call the loadTasks function when the window is loaded
            $(window).on("load", function() {
                loadTasks();
            });
        });
    </script>


</x-app-layout>
