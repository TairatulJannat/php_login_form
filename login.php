<?php
session_start();

//if already you are logged in
if(isset($_SESSION['loggedIN'])){
    header('Location:hidden.php');
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname ="login";

// // Create connection
// $conn = new mysqli($servername, $username, $password);

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";

if(isset($_POST['login'])){
    $connection =  new mysqli($servername, $username, $password,$dbname);
    $email = $connection->real_escape_string($_POST['emailphp']) ;
    $password = $connection->real_escape_string($_POST['passwordphp']);

    $data = $connection->query(query:"SELECT id From users WHERE email='$email' AND password='$password'");
    if($data->num_rows > 0){
        $_SESSION['loggedIN'] = '1';
        $_SESSION['email'] = '$email';
        exit('<font color="green">Login successfully</font>');
    }else
        exit('<font color="red">please check your input</font>');

    exit($email ."=" . $password);
}

?>

<html>
    <head>
        <title>jquery Tutorial - Login</title>
    </head>
    <body>
    <form method="post" action="login.php">
        <input type="text" id="email" placeholder="Email..."><br>
        <input type="password" id="password" placeholder="password"><br>
        <input type="button" value="Log In" id="login">
    </form>
    <p id= 'response'></p>

    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#login").on('click',function(){
                var email = $('#email').val();
                var password = $('#password').val();
                    // console.log(email, password)
                if(email == "" || password == "")
                    alert('Please check your inputs')
                else{
                    $.ajax(
                        {
                            url: "login.php",
                            method: "POST",
                            data:{
                                login :1,
                                emailphp: email,
                                passwordphp: password
                            },
                            success: function(response){
                                $("#response").html(response);

                                if(response.indexof('success') >= 0)
                                Window.location ='hidden.php';
                            },
                            dataType: 'text'
                        }
                    )
                }
            });
        });
    </script>

    </body>
</html>