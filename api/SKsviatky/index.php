<?php
require_once "../../Database.php";
header('Content-Type: application/json');
$conn = (new Database())->getConnection();

$stmt = $conn->query("SELECT days.day as day, days.month as month, records.value as value FROM records JOIN days ON days.id=records.day_id JOIN countries ON countries.id=records.country_id WHERE records.type='holiday' AND countries.code='SK' ORDER BY days.month, days.day");

$SKsviatky = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($SKsviatky, [$row["day"] . "." . $row["month"] . ".", $row["value"]]);
}
echo json_encode($SKsviatky, JSON_UNESCAPED_UNICODE);

