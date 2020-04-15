<?php

session_start();
if (empty($_SESSION['login'])){
    require "header.php";
}
else{
    require "header_auth.php";
}



if(isset($_GET['page'])){
    $page =  preg_replace("/[^a-zA-Z0-9\\/_]/ui", '', $_GET['page']);
    require $page.'.php';
}

require "footer.php";