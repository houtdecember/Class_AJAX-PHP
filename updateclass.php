<?php
include "db.php";

$id = $_POST['class_id'];
$course = $_POST['course'];
$lesson = $_POST['lesson'];
$building = $_POST['building'];
$floor = $_POST['floor'];
$room = $_POST['room'];
$status = $_POST['status'];
$term = $_POST['term'];
$class_time = $_POST['class_time'];
$old_logo = $_POST['old_logo'];

$image_logo = $old_logo;

if (!empty($_FILES['logoInput']['name'])) {

    $image_logo = time() . "_" . $_FILES['logoInput']['name'];

    move_uploaded_file(
        $_FILES['logoInput']['tmp_name'],
        "upload/" . $image_logo
    );

    if (file_exists("upload/" . $old_logo)) {
        unlink("upload/" . $old_logo);
    }
}

$sql = "UPDATE classes SET
    course='$course',
    lesson='$lesson',
    building='$building',
    floor='$floor',
    room='$room',
    status='$status',
    term='$term',
    class_time='$class_time',
    image_logo='$image_logo'
    WHERE id='$id'";

if ($conn->query($sql)) {

    echo json_encode([
        "id" => $id,
        "course" => $course,
        "lesson" => $lesson,
        "building" => $building,
        "floor" => $floor,
        "room" => $room,
        "status" => $status,
        "term" => $term,
        "class_time" => $class_time,
        "image_logo" => $image_logo
    ]);
}