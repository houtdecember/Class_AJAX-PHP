<?php
include "db.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Classes</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div class="header">
        <h1>My Class</h1>
        <div class="">
            <button class="add-btn">+ Add Class</button>
        </div>
    </div>
    <div class="grid" id="card">
        <!-- data- -->
        <?php
        $result = $conn->query("SELECT * FROM classes");
        while ($row = $result->fetch_assoc()):
        ?>

            <div class="card" id="row-<?= $row['id'] ?>" data-id="<?= $row['id'] ?>" data-course="<?= $row['course'] ?>"
                data-lesson="<?= $row['lesson'] ?>" data-status="<?= $row['status'] ?>"
                data-building="<?= $row['building'] ?>" data-floor="<?= $row['floor'] ?>" data-room="<?= $row['room'] ?>"
                data-term="<?= $row['term'] ?>" data-class_time="<?= $row['class_time'] ?>"
                data-image_logo="<?= $row['image_logo'] ?>" data-created_at="<?= $row['created_at'] ?>">
                <div class="card-header">
                    <div class="course-box">
                        <div class="logo">
                            <img src="upload/<?= $row['image_logo'] ?>">
                        </div>
                        <div>
                            <div>
                                <p><?= $row['course'] ?></p>
                            </div>
                            <div class="cid"><?= $row['id'] ?></div>
                        </div>
                    </div>
                    <div class="menu">⋮</div>
                </div>

                <div class="dropdown">
                    <div class="edit">Edit</div>
                    <div class="delete">Delete Class</div>
                </div>

                <div class="card-body" style="margin-top: 15px;">
                    <div class="row"><span>Lesson</span><span><?= $row['lesson'] ?></span></div>
                    <hr>
                    <div class="row" style="margin-top: 15px;">
                        <span>Building</span><span><?= $row['building'] ?></span>
                    </div>
                    <hr>
                    <div class="row" style="margin-top: 15px;"><span>Floor</span><span><?= $row['floor'] ?></span></div>
                    <hr>
                    <div class="row" style="margin-top: 15px;"><span>Room</span><span><?= $row['room'] ?></span></div>
                    <hr>
                    <div class="row" style="margin-top: 15px;"><span>Status</span><span><?= $row['status'] ?></span>
                    </div>
                    <hr>
                    <div class="row" style="margin-top: 15px;"><span>Term</span><span><?= $row['term'] ?></span></div>
                    <hr>
                    <div class="row" style="margin-top: 15px;"><span>Time</span><span><?= $row['class_time'] ?></span>
                    </div>
                </div>
                <div class="view-btn">View Class</div>
            </div>
        <?php endwhile; ?>
    </div>


    <!-- MODAL -->
    <div class="modal" id="opacity"> </div>
    <div class="modal-box">
        <div class="modal-header">
            <h2 id="title">Create Class</h2>
            <div class="close">✕</div>
        </div>

        <div class="modal-body">
            <form id="classForm" enctype="multipart/form-data" method="POST" novalidate>
                <div class="grid-form">
                    <div class="icon-box">
                        <!-- <label>CLASS ICON</label> -->
                        <label class="upload">
                            <img id="preview" src="https://cdn-icons-png.flaticon.com/512/1829/1829586.png">
                            <input type="file" id="logoInput" name="logoInput">
                        </label>
                    </div>

                    <input type="hidden" id="class_id" name="class_id">
                    <input type="hidden" id="old_logo" name="old_logo">

                    <div class="field">
                        <div class="field">
                            <label>COURSE NAME</label>
                            <input id="course" name="course" placeholder="e.g. Advanced Physic">
                        </div>
                        <label style="margin-top: 5px;">LESSON</label>
                        <input id="lesson" name="lesson" placeholder="Module 1">
                    </div>
                    <div class="field">
                        <label>FLOOR</label>
                        <input id="floor" name="floor" type="number" placeholder="1">
                    </div>
                    <div class="field">
                        <label>BUILDING</label>
                        <input id="building" name="building" placeholder="Science Hall">
                    </div>
                    <div class="field">
                        <label>ROOM</label>
                        <input id="room" name="room" placeholder="402-B">
                    </div>

                    <div class="field">
                        <label>STATUS</label>
                        <select id="status" name="status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>TERM</label>
                        <input id="term" name="term" placeholder="Fall 2024">
                    </div>

                    <div class="field">
                        <label>TIME</label>
                        <input id="class_time" name="class_time" type="time" placeholder="10:00 AM">

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="cancel " type="reset">Cancel</button>
                    <button class="create" type="submit">+ Create Class</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>



<script>
    $(document).ready(function() {
        $(document).on("click", ".edit", function() {
            const card = $(this).closest(".card");
            const id = card.data("id");
            const course = card.data("course");
            const lesson = card.data("lesson");
            const building = card.data("building");
            const floor = card.data("floor");
            const room = card.data("room");
            const status = card.data("status");
            const term = card.data("term");
            const class_time = card.data("class_time");
            const image_logo = card.data("image_logo");

            $("#class_id").val(id);
            $("#course").val(course);
            $("#lesson").val(lesson);
            $("#building").val(building);
            $("#floor").val(floor);
            $("#room").val(room);
            $("#status").val(status);
            $("#term").val(term);
            $("#class_time").val(class_time);
            $("#old_logo").val(image_logo);
            $("#preview").attr("src", "upload/" + image_logo);

            $("#opacity").fadeIn(300).css("display", "flex");
            $(".modal-box").fadeIn(300);
            $("#title").text("Edit Class");
            $(".create").text("Update Class");

        });
        /* Delete class */
        $(document).on("click", ".delete", function() {
            if (!confirm("Are you sure you want to delete this class?")) {
                return;
            }
            const card = $(this).closest(".card");
            const id = card.data("id");
            const image_logo = card.data("image_logo");

            $.ajax({
                url: "deleteclass.php",
                method: "POST",
                data: {
                    id: id,
                    image_logo: image_logo
                },
                success: function(res) {
                    let response = res;
                    try {
                        response = JSON.parse(res);
                    } catch (e) {
                        // keep raw response if not JSON
                    }

                    if (response === "success" || (response && response.success)) {
                        $(`#row-${id}`).remove();
                    } else {
                        const err = typeof response === "string" ? response : (response.error ||
                            "Unknown error");
                        alert("Error deleting class: " + err);
                    }
                }
            });
        });

        /* OPEN MODAL */

        $(".add-btn").click(function() {
            // Clear any leftover edit state so it always inserts a new record
            $("#classForm")[0].reset();
            $("#class_id").val("");
            $("#old_logo").val("");
            $("#preview").attr("src", "https://cdn-icons-png.flaticon.com/512/1829/1829586.png");
            $(".create").text("+ Create Class");

            $("#opacity").fadeIn(300).css("display", "flex");
            $(".modal-box").fadeIn(300);
            $("#title").text("Create Class");
        });


        /* CLOSE MODAL */
        $(".close").click(function() {
            $("#opacity").fadeOut(300);
            $(".modal-box").fadeOut(300);
            $("#classForm")[0].reset();
            $("#class_id").val("");
            $("#old_logo").val("");
            $("#preview").attr("src",
                "https://cdn-icons-png.flaticon.com/512/1829/1829586.png");
        });

        $("#opacity").click(function() {
            $("#opacity").fadeOut(300);
            $(".modal-box").fadeOut(300);
            $("#classForm")[0].reset();
            $("#class_id").val("");
            $("#old_logo").val("");
            $("#preview").attr("src",
                "https://cdn-icons-png.flaticon.com/512/1829/1829586.png");
        });


        /* DROPDOWN*/
        $(document).on("click", ".menu", function(e) {
            e.stopPropagation();
            $(".dropdown").hide();
            $(this).closest(".card").find(".dropdown").toggle();

        });


        $(document).click(function() {
            $(".dropdown").hide();
        });


        /* IMAGE PREVIEW */
        $("#logoInput").change(function() {
            let file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $("#preview").attr("src", e.target.result);

                }
                reader.readAsDataURL(file);

            }

        });



        $("#classForm").submit(function(e) {

            e.preventDefault();

            const formdata = new FormData(this);
            const id = $("#class_id").val();

            const url = (id === "") ?
                "insertcass.php" :
                "updateclass.php";
            $.ajax({
                url: url,
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                success: function(res) {
                    // console.log(res);
                    const item = JSON.parse(res);
                    if (id === "") {
                        $("#card").append(`<div class="card" 
                    id="row-${item.id}"
                    data-id="${item.id}"
                    data-course="${item.course}"
                    data-lesson="${item.lesson}" 
                    data-status="${item.status}"
                    data-building="${item.building}" 
                    data-floor="${item.floor}" 
                    data-room="${item.room}"
                    data-term="${item.term}" 
                    data-class_time="${item.class_time}"
                    data-image_logo="${item.image_logo}" 
                    data-created_at="${item.created_at}">


                    <div class="card-header">
                        <div class="course-box">
                            <div class="logo">
                                <img src="upload/${item.image_logo}">
                            </div>
                            <div>
                                <div>
                                    <p>${item.course}</p>
                                </div>
                                <div class="cid">${item.id}</div>
                            </div>
                        </div>
                        <div class="menu">⋮</div>
                    </div>

                    <div class="dropdown">
                        <div class="edit">Edit</div>
                        <div class="delete">Delete Class</div>
                    </div>

                    <div class="card-body" style="margin-top: 15px;">
                        <div class="row"><span>Lesson</span><span>${item.lesson}</span></div>
                        <hr>
                        <div class="row" style="margin-top: 15px;">
                            <span>Building</span><span>${item.building}</span>
                        </div>
                        <hr>
                        <div class="row" style="margin-top: 15px;"><span>Floor</span><span>${item.floor}</span></div>
                        <hr>
                        <div class="row" style="margin-top: 15px;"><span>Room</span><span>${item.room}</span></div>
                        <hr>
                        <div class="row" style="margin-top: 15px;"><span>Status</span><span>${item.status}</span>
                        </div>
                        <hr>
                        <div class="row" style="margin-top: 15px;"><span>Term</span><span>${item.term}</span></div>
                        <hr>
                        <div class="row" style="margin-top: 15px;"><span>Time</span><span>${item.class_time}</span></div>
                    </div>
                    <div class="view-btn">View Class</div>
                </div>`);

                    } else {

                        let card = $(`#row-${item.id}`);

                        card.data("course", item.course);
                        card.data("lesson", item.lesson);
                        card.data("status", item.status);
                        card.data("building", item.building);
                        card.data("floor", item.floor);
                        card.data("room", item.room);
                        card.data("term", item.term);
                        card.data("class_time", item.class_time);
                        card.data("image_logo", item.image_logo);

                        card.find("p").text(item.course);
                        card.find(".row:eq(0) span:eq(1)").text(item.lesson);
                        card.find(".row:eq(1) span:eq(1)").text(item.building);
                        card.find(".row:eq(2) span:eq(1)").text(item.floor);
                        card.find(".row:eq(3) span:eq(1)").text(item.room);
                        card.find(".row:eq(4) span:eq(1)").text(item.status);
                        card.find(".row:eq(5) span:eq(1)").text(item.term);
                        card.find(".row:eq(6) span:eq(1)").text(item.class_time);

                        card.find("img").attr("src", "upload/" + item.image_logo);

                    }

                    $("#opacity").fadeOut(300);
                    $(".modal-box").fadeOut(300);
                    $("#classForm")[0].reset();
                    $("#preview").attr("src",
                        "https://cdn-icons-png.flaticon.com/512/1829/1829586.png");
                }
            })
        });
    });
</script>