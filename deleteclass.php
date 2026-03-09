<?php
include "db.php";
$id = $_POST['id'];
$sql = "DELETE FROM classes WHERE id='$id'";
if ($conn->query($sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => $conn->error]);
}
?>