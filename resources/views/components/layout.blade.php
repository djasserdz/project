<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body {
    font-family: "Cairo", serif;
    background-color: #f4ebe2;
    margin: 0;
    padding: 0;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #e6d4c2;
    padding: 10px 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.navbar .logo {
    font-size: 1.5rem;
    font-weight: bold;
    color: #5c4336;
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 20px;
    padding: 0;
    margin: 0;
}

.nav-links li {
    display: inline;
}

.nav-links a {
    text-decoration: none;
    font-size: 1.2rem;
    color: #5c4336;
    padding: 5px 10px;
}

.nav-links a:hover {
    color: #796153;
}

#auth-container {
    display: flex;
    align-items: center;
    gap: 10px;
}

#auth-container a {
    text-decoration: none;
    font-size: 1.2rem;
    padding: 5px 10px;
    border-radius: 5px;
}

.login {
    color: #5c4336;
    border: 2px solid #5c4336;
}

.register {
    color: white;
    background-color: #5c4336;
}

.register:hover {
    background-color: #796153;
}

.dropdown {
    position: relative;
}

.dropbtn {
    background-color: #5c4336;
    color: white;
    border: none;
    padding: 10px 15px;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 5px;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: #e6d4c2;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    min-width: 100px;
    z-index: 1;
}

.dropdown-content a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #5c4336;
}

.dropdown-content a:hover {
    background-color: #c6ac8f;
}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
<body>
    <nav class="navbar">
        <div class="logo">To-Do</div>
        <ul class="nav-links">
            <li><a href="{{route("home")}}">Home</a></li>
            <li><a href="{{route("task.index")}}">Tasks</a></li>
            <li><a href="#">Categories</a></li>
        </ul>
        <div id="auth-container">
            @guest
            <a href="{{route("login")}}" class="login">Login</a>
            <a href="{{route("register")}}" class="register">Register</a>
            @endguest
            @auth
            <div class="dropdown">
                <button class="dropbtn">{{auth()->user()->username}}</button>
                <form action="{{route("logout")}}" method="post">
                    @csrf
                    <button>logout</button>
                </form>
            </div>
            @endauth
        </div>
    </nav>
    <main>{{$slot}}</main>
</body>
</html>