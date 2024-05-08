<?php
    session_start();
    if(isset($_SESSION['sesionIncremento'])){
        $_SESSION['sesionIncremento']=1;
    }
    else{
        ++$_SESSION['sesionIncremento'];
    }

    echo $_SESSION['sesionIncremento'];

?>