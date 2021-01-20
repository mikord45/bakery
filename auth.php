<?php
    session_start();
    if(isset($_POST["login"]) && isset($_POST["password"])){
        $host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "piekarnia";
        $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
        $polaczenie->set_charset("utf8");
        $loginFromWeb = $_POST["login"];
        $passwordFromWeb = $_POST["password"];
        $passwordFromDb = $polaczenie->query("SELECT * FROM klienci WHERE login='$loginFromWeb'");
        $row=$passwordFromDb->fetch_array();
        while($row){
            // print_r($row["haslo"]);
            if(password_verify($passwordFromWeb, $row["haslo"])){
                echo("Zalogowano");
                $_SESSION['logged'] = true;
				$_SESSION['id'] = $row['id'];
                $_SESSION['user'] = $row['login'];
                header('Location: menu.php');
            }
            else{
                echo("Błędne dane logowania");
            }
            $row = $passwordFromDb->fetch_array();
        }
    }
    else{
        echo("Błędne dane logowania");
    }
?>