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
        <div class="main">
            <h1>Create a New Task</h1>
            @if (session("false"))
                <p class=" text-red-500">{{session("false")}}</p>
            @endif
            <div class="form-container">
                <form action="{{route("task.create")}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="task_name">Task Name:</label>
                        <input type="text" id="task_name" name="name" >
                        @error("name")
                            <p class=" text-red-500">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="due_date">Due Date:</label>
                        <input type="date" id="due_date" name="due_date" >
                        @error("due_date")
                             <p class=" text-red-500">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="importance">Importance:</label>
                        <select id="importance" name="Priority" >
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                        @error("Priority")
                            <p class=" text-red-500">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category" class="block font-semibold text-gray-700">Category:</label>
                        <select id="category" name="categorie_id[]" multiple 
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-500">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('categorie_id')
                            <p class=" text-red-500">{{$message}}</p>
                        @enderror
                    </div>
                    
                    

                    <button type="submit" class="submit-btn">Create Task</button>
                </form>
            </div>
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
