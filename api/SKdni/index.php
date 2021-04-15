<?php
require_once "../../Database.php";
header('Content-Type: application/json');
$conn = (new Database())->getConnection();

$stmt = $conn->query("SELECT days.day as day, days.month as month, records.value as value FROM records JOIN days ON days.id=records.day_id JOIN countries ON countries.id=records.country_id WHERE records.type='memorial' AND countries.code='SK' ORDER BY days.month, days.day");

$SKdni = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($SKdni, [$row["day"] . "." . $row["month"] . ".", $row["value"]]);
}
echo json_encode($SKdni, JSON_UNESCAPED_UNICODE);

