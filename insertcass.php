<?php
include "db.php";

$course = $_POST['course']??'';
$lesson = $_POST['lesson']??'';
$status = $_POST['status']??'';
$building = $_POST['building']??'';
$floor = $_POST['floor']??'';
$room = $_POST['room']??'';
$term = $_POST['term']??'';
$class_time = $_POST['class_time']??'';
$created_at = $_POST['created_at'] ??date('Y-m-d H:i:s');
$image_logo = "";

if (!empty($_FILES["logoInput"]['name'])) {
    $image_logo = time() . "_" . $_FILES["logoInput"]['name'];
    move_uploaded_file($_FILES["logoInput"]['tmp_name'],"upload/" . $image_logo);
}

$sql = "INSERT INTO `classes`(course, lesson, status, building, floor, room, term, class_time, image_logo, created_at) 
            VALUES ('$course','$lesson','$status','$building','$floor','$room','$term','$class_time','$image_logo','$created_at')";


if ($conn->query($sql)) {
    $id = $conn->insert_id;
    echo json_encode([
        "id" => $id,
        "course" => $course,
        "lesson" => $lesson,
        "status" => $status,
        "building" => $building,
        "floor" => $floor,
        "room" => $room,
        "term" => $term,
        "class_time" => $class_time,
        "created_at" => $created_at,
        "image_logo" => $image_logo,
    ]);
} else {
    echo json_encode(['error' => $conn->error]);
}