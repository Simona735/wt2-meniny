<?php
require_once "../../Database.php";
header('Content-Type: application/json');
$conn = (new Database())->getConnection();

$stmt = $conn->query("SELECT days.day as day, days.month as month, records.value as value FROM records JOIN days ON days.id=records.day_id JOIN countries ON countries.code='CZ' WHERE records.type='holiday' ORDER BY days.month, days.day");


$CZsviatky = [];
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($CZsviatky, [$row["day"].".".$row["month"].".", $row["value"]]);
}



//var_dump($CZsviatky);
echo json_encode($CZsviatky, JSON_UNESCAPED_UNICODE);

?>