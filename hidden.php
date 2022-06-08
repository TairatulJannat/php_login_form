<?php

session_start();

if(!isset($_SESSION['loggedIN'])){
    header('Location:login.php');
}
?>
<button>
    <a href="logout.php">Log out</a>
</button>
You are in Log in!