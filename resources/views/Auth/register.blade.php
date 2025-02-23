<x-layout>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="styles/signup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:slnt,wght@-11..11,200..1000&display=swap" rel="stylesheet">
</head>
<style>

body{
    font-family: "Cairo", serif;
    background-color: #f4ebe2;
}
main {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
}
img {
    width: 40%;
    height: 80%;
}
h1 {
    justify-self: center;
}

form {
    margin: 50px auto;
    background-color: #e6d4c2;
    width: 90%;
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    display: flex;
    flex-flow: wrap row;
    gap: 15px;
    justify-content: center;
    align-items: center;
    border-radius: 20px;
}
form input:not([type="submit"], [type="checkbox"]) {
    flex-basis: 100%;
    height: 30px;
    border-color: transparent;
    border-bottom: #000 2px solid;
    background-color: transparent;
    outline: none;
    padding: 5px;
    border-radius: 5px;
}
form input[type="submit"] {
    width: 50%;
    height: 40px;
    border: none;
    background-color: #c6ac8f;
    color: #000;
    font-size: 16px;
    font-weight: bold;
    padding: 20px;
    line-height: 0;
    border-radius: 5px;
}
form input[type="submit"]:hover {
    cursor: pointer;
    background-color: #d3bca0;
}
form div{
    flex-basis: 100%;
}
form a {
    margin: 0 5px;
    cursor: pointer;
    color: #796153;
    text-decoration: none;
}


</style>
<body>
    <div class="main">
        <form action="{{route("register")}}" method="post">
            @csrf
            <h1>Signup</h1>
            <input type="text" placeholder="Username" name="username" >
            @error("username")
                <p class="text-red-500">{{$message}}</p>
            @enderror
            <input type="email" placeholder="E-mail" name="email">
            @error("email")
                <p class="text-red-500">{{$message}}</p>
            @enderror
            <input type="password" placeholder="Password" name="password" >
            @error("password")
                <p class="text-red-500">{{$message}}</p>
            @enderror
            <input type="password" placeholder="Confirm Password" name="password_confirmation">
            @error("password_confirmation")
                <p class="text-red-500">{{$message}}</p>
            @enderror
            <input type="submit" value="Submit">
            <div>
                <input type="checkbox" name="keep-me" id="keep-me">
                <label for="keep-me">Remember me</label>
            </div>
            <a href="">Forgot password?</a>
            <a href="">Already have an account?</a>
        </form>
        <div class="logo">
            <img src="{{asset("images/Task-bro.svg")}}" alt="logo">
        </div>
    </div>
</body>
</html>
</x-layout>