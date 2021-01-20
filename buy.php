<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();
        $host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "piekarnia";
        $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
        $polaczenie->set_charset("utf8");
        $cenaCalkowita = 0;
        if(isset($_POST["produkt1"]) || isset($_POST["produkt2"]) || isset($_POST["produkt3"])){
            if(isset($_POST["produkt1"])){
                $prod1Id = $_POST["produkt1"];
                $prod1Amount = $_POST["ilosc1"];
                $prodInfo = $polaczenie->query("SELECT * FROM wypieki WHERE id='$prod1Id'");
                $row = $prodInfo->fetch_array();
                $cena = $row["cena"] * $prod1Amount;
                $cenaCalkowita = $cenaCalkowita + $cena;
            }
            if(isset($_POST["produkt2"])){
                $prod2Id = $_POST["produkt2"];
                $prod2Amount = $_POST["ilosc2"];
                $prodInfo = $polaczenie->query("SELECT * FROM wypieki WHERE id='$prod2Id'");
                $row = $prodInfo->fetch_array();
                $cena = $row["cena"] * $prod2Amount;
                $cenaCalkowita = $cenaCalkowita + $cena;
            }
            if(isset($_POST["produkt3"])){
                $prod3Id = $_POST["produkt3"];
                $prod3Amount = $_POST["ilosc3"];
                $prodInfo = $polaczenie->query("SELECT * FROM wypieki WHERE id='$prod3Id'");
                $row = $prodInfo->fetch_array();
                $cena = $row["cena"] * $prod3Amount;
                $cenaCalkowita = $cenaCalkowita + $cena;
            }
            echo("Złożono zamówienie na kwotę ".$cenaCalkowita."zł");
            $klientId=$_SESSION["id"];
            $info = $_POST["szczegoly"];
            $polaczenie->query("INSERT INTO zamowienia (klient, produkt_1, ilosc_produkt_1, produkt_2, ilosc_produkt_2, produkt_3, ilosc_produkt_3, szczegoly_zamowienia, cena_calkowita) VALUES('$klientId', '$prod1Id', '$prod1Amount', '$prod2Id', '$prod2Amount', '$prod3Id', '$prod3Amount', '$info', '$cenaCalkowita');");
        }
    ?>
</body>
</html>