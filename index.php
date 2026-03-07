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


    <div class="grid">

        <?php foreach ($classes as $c) { ?>

            <div class="card">

                <div class="card-header">

                    <div class="course-box">

                        <div class="logo">
                            <img src="<?php echo $c['logo']; ?>">
                        </div>

                        <div>

                            <div><?php echo $c['course']; ?></div>
                            <div class="cid">Class ID: <?php echo $c['id']; ?></div>

                        </div>

                    </div>

                    <div class="menu">⋮</div>

                </div>

                <div class="dropdown">

                    <div>Edit</div>
                    <div class="end">End Class</div>

                </div>

                <div class="card-body" style="margin-top: 15px;">

                    <div class="row" ><span>Lesson</span><span><?php echo $c['lesson']; ?></span></div><hr>
                    <div class="row" style="margin-top: 15px;"><span>Building</span><span><?php echo $c['building']; ?></span></div><hr>
                    <div class="row" style="margin-top: 15px;"><span>Room</span><span><?php echo $c['room']; ?></span></div><hr>
                    <div class="row"style="margin-top: 15px;"><span>Status</span><span><?php echo $c['status']; ?></span></div><hr>
                    <div class="row"style="margin-top: 15px;"><span>Term</span><span><?php echo $c['term']; ?></span></div><hr>
                    <div class="row"style="margin-top: 15px;"><span>Time</span><span><?php echo $c['time']; ?></span></div>< sthr>

                </div>

                <div class="view-btn">View Class</div>

            </div>

        <?php } ?>

    </div>



    <!-- MODAL -->

    <div class="modal" id="modal">

        <div class="modal-box">

            <div class="modal-header">

                <h2>Create Class</h2>

                <div class="close">✕</div>

            </div>


            <div class="modal-body">

                <form id="classForm">

                    <div class="grid-form">


                        <div class="icon-box">

                            <label>CLASS ICON</label>

                            <label class="upload">

                                <img id="preview" src="https://cdn-icons-png.flaticon.com/512/1829/1829586.png">

                                <input type="file" id="logoInput">

                            </label>

                        </div>


                        <div class="field">

                            <label>COURSE NAME</label>

                            <input name="course" placeholder="e.g. Advanced Physic">

                        </div>


                        <div class="field">

                            <label>LESSON</label>

                            <input name="lesson" placeholder="Module 1">

                        </div>
                        <div class="field">

                            <label>BUILDING</label>

                            <input name="building" placeholder="Science Hall">

                        </div>


                        <div class="field">

                            <label>ROOM</label>

                            <input name="room" placeholder="402-B">

                        </div>


                        <div class="field">

                            <label>STATUS</label>

                            <select name="status">

                                <option>Active</option>
                                <option>Inactive</option>

                            </select>

                        </div>


                        <div class="field">

                            <label>TERM</label>

                            <input name="term" placeholder="Fall 2024">

                        </div>


                        <div class="field">

                            <label>TIME</label>

                            <input name="time" placeholder="10:00 AM">

                        </div>


                    </div>

                </form>

            </div>


            <div class="modal-footer">

                <button class="cancel">Cancel</button>

                <button class="create">+ Create Class</button>

            </div>


        </div>

    </div>



    <script>
        /* OPEN MODAL */

        $(".add-btn").click(function() {

            $("#modal").fadeIn().css("display", "flex");

        });


        /* CLOSE MODAL */

        $(".close,.cancel").click(function() {

            $("#modal").fadeOut();

        });


        /* DROPDOWN */

        $(".menu").click(function(e) {

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


        /* AJAX CREATE */

        $(".create").click(function() {

            let form = $("#classForm").serialize();

            $.post("index.php", form + "&action=createClass", function(res) {

                alert("Class Created");

                $("#modal").fadeOut();

            });

        });
    </script>

</body>

</html>