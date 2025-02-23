<x-layout>
    <style>
    body{
    font-family: "Cairo", serif;
    background-color: #f4ebe2;
}
.main{
    padding: 15px;
}
.main .todos{
    width: 70%;
    margin: 30px auto;
    background-color: #e6d4c2;
    display: flex;
    flex-flow: wrap row;
    justify-content: center;
    align-content: space-between;
    gap: 10px;
    border-radius: 15px;
    padding: 15px;
}

.main .titles{
    flex-basis: 100%;
    background-color: #f4ebe2;
    border-radius: 5px;
    padding: 5px 15px;
    display: grid;
    grid-template-columns: 5% repeat(4, 1fr) 5%;
    justify-content: space-between;
}
.main .titles div{
    font-weight: bold;
    font-size: 1.2rem;
    color: 796153;
    position: relative;
    padding-left: 15px;
}
.main .titles div:not(:last-child):after{
    content: "";
    position: absolute;
    border-radius: 200px;
    width: 3px;
    height: 80%;
    background-color: #e6d4c2;
    top: calc(50% - 40%);
    right: 0;
}

.main .todos .todo{
    flex-basis: 100%;
    background-color: #f4ebe2;
    border-radius: 5px;
    position: relative;
    display: grid;
    padding: 5px 0;
    grid-template-columns: 5% repeat(4, 1fr) 5%;
    justify-content: space-between;
}
.main .todos .todo div:first-of-type{
    position: relative;
}
.main .todos .todo div:first-of-type input{
    position: absolute;
    top: calc(50% - 10px);
    left: calc(50% - 10px);
}
input[type="checkbox"] {
    width: 18px; 
    height: 18px;
    appearance: none;
    border: 2px solid #796153;
    border-radius: 4px; 
    background-color: transparent;
    cursor: pointer;
    position: relative;
    bottom: 50px;
    margin: 0;
}

input[type="checkbox"]:checked {
    background-color: #796153; 
    border-color: #5a3d2b; 
}

input[type="checkbox"]::after {
    content: "✓";
    font-size: 14px;
    color: white;
    display: none;
    position: absolute;
    left: 3px;
    top: -1px;
}

input[type="checkbox"]:checked::after {
    display: block;
}
.main .todos .todo .task-name{
    color: #5c4336;
    padding: 0 15px;
}
.main .todos .todo .task-time-ending{
    color: #796153;
    padding: 0 15px;
}

.main .todos .todo div span{
    background-color: #796153;
    padding: 0 15px;
    width: auto;
    border-radius: 50px;
    color: white;
}
.main .todos .todo .category{
    text-align: center;
    background-color: #e6d4c2;
    width: 60%;
    border-radius: 50px;
    color: #5c4336;
}
.menu-container {
    position: relative;
}

.menu-button {
    cursor: pointer;
    font-size: 20px;
    padding: 0 10px;
    border-radius: 5px;
}

.menu {
    display: none;
    position: absolute;
    background-color: #e6d4c2; /* Match your palette */
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    right: 0;
    top: 25px;
    min-width: 80px;
    text-align: left;
}

.menu button {
    display: block;
    width: 100%;
    border: none;
    background: none;
    padding: 8px;
    text-align: left;
    font-size: 14px;
    cursor: pointer;
}

.menu button:hover {
    background-color: #c6ac8f; 
}
</style>
<div class="main">
    <h1>To-do list</h1>
    <div class="todos">
        <div class="titles">
            <div><img src="img/task-done-svgrepo-com.svg" alt=""></div>
            <div>
                <i class="fa-solid fa-square-check"></i>
                <span>Task</span>
            </div>
            <div>
                <i class="fa-solid fa-calendar-days"></i>
                <span>Date</span>
            </div>
            <div>
                <i class="fa-solid fa-layer-group"></i>
                <span>Importancy</span> 
            </div>
            <div>
                <i class="fa-solid fa-tags"></i>
                <span>category</span> 
            </div>
            <div style="margin-left: 7px;">⋮</div>
        </div>
        <div class="todo">
            @foreach ($tasks as $task )
            <div><input type="checkbox" name="task"></div>
            <div class="task-name">{{$task->name}}</div>
            <div class="task-time-ending">{{$task->due_date}}</div>
            <div class="importancy"><span>{{$task->Priority}}</span></div>
            <div class="category">
                @foreach ($task->categories as $categorie)
                    <p>{{$categorie->name}}</p>
                @endforeach
            </div>
            <div class="menu-container">
                <div class="menu-button">⋮</div>
                <div class="menu">
                    <button class="edit">Edit</button>
                    <button class="delete">Delete</button>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
    <form action="{{route("task.create")}}" method="get" style="text-align: center; margin-top: 20px;">
        <button style="
            background-color: #796153;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        ">+</button>
    </form>
</x-layout>