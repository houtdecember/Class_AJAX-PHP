<?php
include 'db.php';

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

if ($id > 0) {
    $result = $conn->query("SELECT image_logo FROM classes WHERE id = $id");
    if ($result && $row = $result->fetch_assoc()) {
        $logo = $row['image_logo'];
        $file_path = __DIR__ . "/upload/" . $logo;
        if (!empty($logo) && file_exists($file_path)) {
            unlink($file_path);
        }
    }

    $conn->query("DELETE FROM classes WHERE id = $id");
    echo "success";
} else {
    echo "error";
}
