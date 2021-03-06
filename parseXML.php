<?php
require_once "Database.php";

$xml = simplexml_load_file("meniny.xml");

$countries = [
    "SK" => ["title" => "Slovensko"],
    "CZ" => ["title" => "Česká republika"],
    "AT" => ["title" => "Rakúsko"],
    "HU" => ["title" => "Maďarsko"],
    "PL" => ["title" => "Poľsko"],
];

$conn = (new Database())->getConnection();

$day = "";
$month = "";
$stmtDays = $conn->prepare("INSERT IGNORE INTO days (day, month) VALUES (:day, :month)");
$stmtDays->bindParam(':day', $day);
$stmtDays->bindParam(':month', $month);

$code = "";
$title = "";
$stmtCountries = $conn->prepare("INSERT IGNORE INTO countries (code, title) VALUES (:code, :title)");
$stmtCountries->bindParam(':code', $code);
$stmtCountries->bindParam(':title', $title);

$day_id = "";
$country_id = "";
$value = "";
$type = "";
$stmtRecords = $conn->prepare("INSERT IGNORE INTO records (day_id, country_id, value, type) VALUES (:day_id, :country_id, :value, :type)");
$stmtRecords->bindParam(':day_id', $day_id);
$stmtRecords->bindParam(':country_id', $country_id);
$stmtRecords->bindParam(':value', $value);
$stmtRecords->bindParam(':type', $type);

foreach ($xml->children() as $row){
    $day = substr($row->den, 2, 2);
    $month = substr($row->den, 0, 2);
    $stmtDays->execute();

    $d = $conn->prepare("SELECT id FROM days WHERE day=".$day." and month=".$month);
    $d->execute();
    $day_id = $d->fetchColumn();

    foreach (array_keys(((array) $row)) as $item){

        if(array_key_exists($item, $countries)){                       //ak meniny
            addNames($item, $row->$item);
        }
        elseif(!strcmp($item,"SKd")){                           //ak SK doplnkove meniny
            addNames("SK", $row->$item);
        }
        elseif(!strcmp($item,"SKsviatky")){                     //ak SK sviatok
            addDays("SK", "holiday", $row->$item);
        }
        elseif(!strcmp($item,"CZsviatky")){                     //ak CZ sviatok
            addDays("CZ", "holiday", $row->$item);
        }
        elseif(!strcmp($item,"SKdni")){                         //ak SK pamatny den
            addDays("SK", "memorial", $row->$item);
        }
    }
}

function handleCountry($item){
    global $countries, $code, $title, $stmtCountries, $conn;
    if(!isset($countries[$item]["id"])){

        $code = $item;
        $title = $countries[$item]["title"];
        $stmtCountries->execute();

        $c = $conn->prepare("SELECT id FROM countries WHERE code='".$code."'");
        $c->execute();
        $countries[$item]["id"] = $c->fetchColumn();
    }
}

function addDays($country, $typeName, $content){
    global $countries, $country_id, $value, $type, $stmtRecords;

    handleCountry($country);

    $country_id = $countries[$country]["id"];
    $value = trim($content);
    $type = $typeName;
    $stmtRecords->execute();
}

function addNames($country, $content){
    global $type, $countries, $country_id, $value, $stmtRecords;

    handleCountry($country);

    $type = "name";
    $country_id = $countries[$country]["id"];
    foreach (explode(",", $content) as $name){
        $value = trim($name);
        if(!empty($value) && strcmp($value,"-")){
            $stmtRecords->execute();
        }
    }
}
//header('Location:index.php');