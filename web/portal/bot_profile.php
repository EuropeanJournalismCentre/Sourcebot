<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $target_dir = "img/bot-images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        $response = array();
        $posts = array();
        $posts[] = array('bot_name' => $_POST['bot_name'], 'bot_image' => $_POST['bot_image']);
        $response['posts'] = $posts;
        $fp = fopen('bot_details.json', 'w');
        fwrite($fp, json_encode($response, JSON_PRETTY_PRINT));
        fclose($fp);

    }
    include "./includes/header.php";
    ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Bot Details</h4>
                        </div>
                        <div class="content">
                            <form method="POST" enctype="multipart/form-data" action="bot_profile.php">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bot Name</label>
                                            <input type="text" name="bot_name" class="form-control" id="fileToUpload" placeholder="Bot Name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="#">
                                    <label for="upload" class="#">Bot Image</label>
                                    <input id="upload" class="#" type="file" name="bot_image">
                                </div>

                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="image">
                            <img src="./img/sourcebot_wide.png" alt="..." />
                        </div>
                        <div class="content">
                            <div class="author">
                                <a href="#">
                                    <img class="avatar border-gray" src="data:image/jpeg;base64,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" alt="..." />

                                    <h4 class="title">Source Bot<br />
                                    </h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Auto Responses</h4>
                        </div>
                        <div class="content">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
                                    <thead>
                                    <th>Topic</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Help</td>
                                        <td>Sourcebot is an open source newsbot to help African news organisations deliver personalized news and engage more effectively via messaging platforms.</td>
                                        <td><a href="" class="btn btn-default btn-xs">Edit</a></td>
                                    </tr>
                                    <tr>
                                        <td>About</td>
                                        <td>An open source newsbot to help African news organisations deliver personalized news and engage more effectively via messaging platforms.</td>
                                        <td><a href="" class="btn btn-default btn-xs">Edit</a></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /*****************************************
            upload button styles
        ******************************************/
        .file-upload {
            position: relative;
            display: inline-block;
        }

        .file-upload__label {
            display: block;
            padding: 1em 2em;
            color: #fff;
            background: #222;
            border-radius: .4em;
            transition: background .3s;

        &:hover {
             cursor: pointer;
             background: #000;
         }
        }

        .file-upload__input {
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            font-size: 1;
            width:0;
            height: 100%;
            opacity: 0;
        }
    </style>
<?php include "./includes/footer.php"; ?>