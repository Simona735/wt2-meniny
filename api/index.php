<?php
require_once "../Database.php";
$conn = (new Database())->getConnection();

var_dump($_GET);

$codes = ["SK", "CZ", "AT", "HU", "PL",];

if(isset($_GET["code"])){
    $country_code = strtoupper($_GET["code"]);

    if(!in_array($country_code, $codes)){
        echo("invalid state");
        return;
    }

    if(isset($_GET["name"])){
        $name = ucfirst(strtolower($_GET["name"]));

        $stmt = $conn->query("SELECT days.day as day, days.month as month FROM records JOIN countries ON records.country_id=countries.id JOIN days ON records.day_id=days.id WHERE countries.code='".$country_code."' and records.value='".$name."'");
        $date = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($date == null){
            echo("nobody found");
        }else{
            echo $date["day"].".".$date["month"].".";
        }
    }else if(isset($_GET["date"])){
        //TODO based on form
    }

}else{
    echo("you fucked up");
}

//TODO correct outputs as json
