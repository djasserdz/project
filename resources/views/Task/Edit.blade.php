<x-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Task</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

        <style>
            body {
                font-family: "Cairo", serif;
                background-color: #f4ebe2;
            }
            .main {
                padding: 15px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .form-container {
                width: 50%;
                background-color: #e6d4c2;
                padding: 20px;
                border-radius: 15px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }
            .form-group {
                display: flex;
                flex-direction: column;
                margin-bottom: 15px;
            }
            label {
                font-weight: bold;
                margin-bottom: 5px;
                color: #5c4336;
            }
            input, select, textarea {
                width: 100%;
                padding: 10px;
                border-radius: 5px;
                border: 2px solid #796153;
                background-color: #f4ebe2;
                font-size: 1rem;
                color: #5c4336;
            }
            textarea {
                resize: vertical;
            }
            .submit-btn {
                width: 100%;
                padding: 10px;
                background-color: #796153;
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 1.2rem;
                cursor: pointer;
            }
            .submit-btn:hover {
                background-color: #5a3d2b;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Edit Task</h2>
            <form action="{{ route('task.edit', $task->id) }}" method="POST">
                @csrf
        
                <div class="mb-3">
                    <label for="name" class="form-label">Task Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $task->name) }}" required>
                    @error("name")
                            <p class=" text-red-500">{{$message}}</p>
                        @enderror
                </div>
        
                <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="date" class="form-control" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}" required>
                    @error("due_date")
                            <p class=" text-red-500">{{$message}}</p>
                        @enderror
                </div>
        
                <div class="mb-3">
                    <label for="Priority" class="form-label">Priority</label>
                    <select class="form-control" name="Priority" id="Priority">
                        <option value="Low" {{ $task->Priority == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ $task->Priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ $task->Priority == 'High' ? 'selected' : '' }}>High</option>
                    </select>
                    @error("Priority")
                            <p class=" text-red-500">{{$message}}</p>
                        @enderror
                </div>
        
                <div class="mb-3">
                    <label for="categories" class="form-label">Categories</label>
                    <select class="form-control" name="categorie_id[]" id="categories" multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ in_array($category->id, $task->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error("categorie_id")
                            <p class=" text-red-500">{{$message}}</p>
                        @enderror
                </div>
        
                <button type="submit" class="btn btn-primary">Update Task</button>
            </form>
        </div>
        <script>
            $(document).ready(function() {
                $('#category').select2({
                    placeholder: "Select categories",
                    allowClear: true
                });
            });
        </script>
    </body>
    </html>
</x-layout>
