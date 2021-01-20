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
            align-items: center;
        }

        select, textarea{
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
            margin-bottom: 20px;
        }

        table{
            border-collapse: collapse;
            margin: 0px auto;
        }

        td{
            width: 100px;
            border: 1px solid black;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        if (!(isset($_SESSION['logged'])) || ($_SESSION['logged']==false))
        {
            header('Location: index.php');
            exit();
        }
    ?>
    <div id="main"> 
    <p> Zamów produkt </p>
        <form method="POST" action="buy.php">
        <p>Wybierz od jednego do trzech rodzajów produktów oraz ich ilość</p>
            <?php
                $host = "localhost";
                $db_user = "root";
                $db_password = "";
                $db_name = "piekarnia";
                $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
                $polaczenie->set_charset("utf8");
                for($i = 0; $i < 3; $i++){
                    echo("<label>Wybierz ".($i+1)." produkt</label>");
                    echo("<select name='produkt".($i+1)."'>");
                    $products = $polaczenie->query("SELECT * FROM wypieki INNER JOIN kategorie_wypiekow ON wypieki.kategoria = kategorie_wypiekow.id");
                    $row = $products->fetch_array();
                    // print_r($row);
                    echo("<option disabled selected value> -- wybierz -- </option>");
                    while($row){

                        echo("<option value='".$row["0"]."'>".$row["nazwa_wypieku"]."- ".$row["cena"]."zł</option>");
                        echo($row["wypieki.id"]);
                        $row = $products->fetch_array();
                    }
                    echo("</select><br/>");
                    echo("<label>Wybierz ilość produktu</label>");
                    echo("<select name='ilosc".($i+1)."'>");
                    for($j =0; $j < 10; $j++){
                        echo("<option value='".($j+1)."'>".($j+1)."</option>");
                    }
                    echo("</select>");
                    echo("<br/>");
                }
                echo("<p>Podaj szczegóły zamówienia</p>");
                echo("<textarea name='szczegoly'></textarea>");
                echo("<br/>")
            ?>
            <button type="submit">Zamów</button>
        </form>
        <p>Twoje zamowienia</p>
        <table>
                <tr>
                    <td> 
                        Nazwa produktu
                    </td>
                    <td> 
                        Ilosc
                    </td>
                    <td> 
                        Nazwa produktu
                    </td>
                    <td> 
                        Ilosc
                    </td>
                    <td> 
                        Nazwa produktu
                    </td>
                    <td> 
                        Ilosc
                    </td>
                    <td>
                        Szczegóły zamówienia
                    </td>
                    <td>
                        Cena całkowita
                    </td>
                </tr>
                <?php
                    $host = "localhost";
                    $db_user = "root";
                    $db_password = "";
                    $db_name = "piekarnia";
                    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
                    $polaczenie->set_charset("utf8");
                    $idToFind = $_SESSION["id"];
                    $result = $polaczenie->query("SELECT ilosc_produkt_1, ilosc_produkt_2, ilosc_produkt_3, jeden.nazwa_wypieku AS produkt_1, dwa.nazwa_wypieku AS produkt_2, trzy.nazwa_wypieku AS produkt_3, cena_calkowita, szczegoly_zamowienia FROM zamowienia  INNER JOIN wypieki AS jeden ON jeden.id=zamowienia.produkt_1 INNER JOIN wypieki AS dwa ON dwa.id=zamowienia.produkt_2 INNER JOIN wypieki AS trzy ON trzy.id=zamowienia.produkt_3 WHERE klient='$idToFind';");
                    $row = $result->fetch_array();
                    while($row){
                        echo("<tr>");
                            echo("<td>");
                            echo($row["produkt_1"]);
                            echo("</td>");
                            echo("<td>");
                            echo($row["ilosc_produkt_1"]);
                            echo("</td>");
                            echo("<td>");
                            echo($row["produkt_2"]);
                            echo("</td>");
                            echo("<td>");
                            echo($row["ilosc_produkt_2"]);
                            echo("</td>");
                            echo("<td>");
                            echo($row["produkt_3"]);
                            echo("</td>");
                            echo("<td>");
                            echo($row["ilosc_produkt_3"]);
                            echo("</td>");
                            echo("<td>");
                            echo($row["szczegoly_zamowienia"]);
                            echo("</td>");
                            echo("<td>");
                            echo($row["cena_calkowita"]);
                            echo(" zł");
                            echo("</td>");
                        echo("</tr>");
                        $row = $result->fetch_array();
                    }
                ?>
        </table>
        <a href="logout.php">Wyloguj</a>
    </div>
</body>
</html>