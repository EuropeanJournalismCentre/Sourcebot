<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $response = array();
        $posts = array();
        $posts[] = array('name'=> 'Kudakwashe', 'surname'=> 'siziva');
        $response['posts'] = $posts;
        $fp = fopen('results.json', 'w');
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
                                            <input type="text" class="form-control" placeholder="Bot Name" required>
                                        </div>
                                    </div>
                                </div>


                                <div class="#">
                                    <label for="upload" class="#">Bot Image</label>
                                    <input id="upload" class="#" type="file" name="file-upload">
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
                                    <img class="avatar border-gray" src="https://avatars3.githubusercontent.com/u/9620622?s=400&u=2ba1016f55802a2afff5fad09a7b4240ef2eb86a&v=4" alt="..." />

                                    <h4 class="title">Bot Name: <br />
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
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Kudakwashe</td>
                                        <td>Siziva</td>
                                        <td>Active</td>
                                        <td>
                                            <a href="" class="btn btn-success btn-xs">Activate</a> |
                                            <a href="" class="btn btn-default btn-xs">Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Kudakwashe</td>
                                        <td>Siziva</td>
                                        <td>Active</td>
                                        <td>
                                            <a href="" class="btn btn-danger btn-xs">Deactivate</a> |
                                            <a href="" class="btn btn-default btn-xs">Edit</a>
                                        </td>
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