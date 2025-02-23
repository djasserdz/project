<x-layout>
    <div class="main">
        <form action="{{route("login")}}" method="post">
            @csrf
            <h1>Login</h1>
            @if (session("incorrect"))
                <p class="text-red-500">{{session("incorrect")}}</p>
            @endif
            <input type="text" name="email" placeholder="Email or Username" required minlength="5">
            @error("email")
                <p class="text-red-500">{{$message}}</p>
            @enderror
            <input type="password" name="password" placeholder="Password" minlength="8" required>
            @error('password')
                <p class="text-red-500">{{$message}}</p>
            @enderror
            <input type="submit" value="Submit">
            <div>
                <input type="checkbox" name="remember-me" id="keep-me">
                <label for="keep-me">Remember me</label>
            </div>
            <a href="#">Forgot password?</a>
            <a href="#">Don't have an account?</a>
        </form>
        <div class="logo">
            <img src="{{asset("images/p1.svg")}}" alt="logo">
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap');

        
body{
    font-family: "Cairo", serif;
    background-color: #f4ebe2;
}
.main {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
}
img {
    width: 100%;
    height: 100%;
}
h1 {
    text-align: center;
}
form {
    margin: 50px auto;
    background-color: #e6d4c2;
    width: 90%;
    max-width: 600px;
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
</x-layout>
