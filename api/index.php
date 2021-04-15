<?php
require_once "../Database.php";
$conn = (new Database())->getConnection();

var_dump($_GET);

$codes = ["SK", "CZ", "AT", "HU", "PL",];

if(isset($_GET["code"])){
    $country_code = strtoupper($_GET["code"]);

    if(!in_array($country_code, $codes)){
        echo "invalid state";
        return;
    }

    if(isset($_GET["name"])){
        $name = ucfirst(strtolower($_GET["name"]));

        $stmt = $conn->query("SELECT days.day as day, days.month as month FROM records JOIN countries ON records.country_id=countries.id JOIN days ON records.day_id=days.id WHERE countries.code='".$country_code."' and records.value='".$name."'");
        $date = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($date == null){
            echo "nobody found";
        }else{
            echo $date["day"].".".$date["month"].".";
        }
    }else if(isset($_GET["date"])){
        $day = substr($_GET["date"], 0, 2);
        $month = substr($_GET["date"], 2, 2);
        $stmt = $conn->query("SELECT records.type as type, records.value as value FROM records JOIN countries ON records.country_id=countries.id JOIN days ON days.id=records.day_id WHERE days.day=".$day." AND days.month=".$month." AND countries.code='".$country_code."'");

        $records = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            if (!strcmp($row["type"],"name" )){
                array_push($records, $row["value"]);
            }
        }
        if (count($records) == 0){
            array_push($records, "Nikto nemá meniny");
        }
        echo json_encode($records, JSON_UNESCAPED_UNICODE);
    }

}else if (isset($_POST["name"]) && isset($_POST["date"])){
    $stmt = $conn->query("SELECT id FROM countries WHERE countries.code='SK'");
    $SKid = ($stmt->fetch(PDO::FETCH_ASSOC))["id"];

    $day = substr($_POST["date"], 0, 2);
    $month = substr($_POST["date"], 2, 2);

    $stmt = $conn->query("SELECT id FROM days WHERE day=".$day." and month=".$month);
    $dayId = ($stmt->fetch(PDO::FETCH_ASSOC))["id"];

    $stmt = $conn->query("INSERT INTO `records`(`day_id`, `country_id`, `type`, `value`) VALUES (".$dayId.",".$SKid.",'name','".$_POST["name"]."')");
    //echo $dayId.",".$SKid.",'name',".$_POST["name"];
    echo "success";
} else{
    echo "you fucked up";
}

