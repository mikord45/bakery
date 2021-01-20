<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #main{
            width: 100vw;
            height: 100vh;
        }

        form{
            display: flex;
            flex-direction: column;
        }

        .partOfForm{
            width: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0px auto;
            margin-bottom: 20px;
        }

        input{
            width: 200px;
        }

        label{
            display: block;
            width: 500px !important;
            text-align: center;
        }

        p{
            text-align: center;
        }

        button{
            width: 200px;
            margin: 0px auto;
        }
    </style>
</head>
<body>
<?php
    session_start();
    if ((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
    {
        header('Location: menu.php');
    }
?>
<div id="main">
    <form method="POST" action="auth.php">
        <p>Zaloguj się</p>
        <div class="partOfForm">
            <label>Login: </label>
            <input name="login" type="text">
        </div>
        <div class="partOfForm">
            <label>Password: </label>
            <input name="password" type="password">
        </div>
        <button type="submit"> Zaloguj </button>
    </form>
</div>
    
</body>
</html>