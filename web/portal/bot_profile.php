<?php
    
    //get bot details from the json file
    $string = file_get_contents('./bot_details.json');
    $bot_details = json_decode($string, true);

    include "./includes/header.php";
 ?>
    <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>

    <div class="content">
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
                                    <img class="avatar border-gray" src="<?= $bot_details['bot_image'];?>" alt="..." />

                                    <h4 class="title"><?php echo $bot_details['bot_name'];?><br />
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
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Help</td>
                                        <td><?= $bot_details['help'];?></td>
                                    </tr>
                                    <tr>
                                        <td>About</td>
                                        <td><?= $bot_details['about'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Feature [0]</td>
                                        <td><?= $bot_details['about'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Feature [1]</td>
                                        <td><?= $bot_details['about'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Feature [2]</td>
                                        <td><?= $bot_details['about'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Article Month</td>
                                        <td><?= $bot_details['about'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Article Date</td>
                                        <td><?= $bot_details['about'];?></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Bot Details</h4>
                        </div>
                        <div class="content">
                            <form method="POST" enctype="multipart/form-data" action="./includes/form_submissions.php">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bot Name</label>
                                            <input type="text" name="bot_name" class="form-control" placeholder="Bot Name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bot Image</label>
                                            <input type="text" name="bot_image" class="form-control" placeholder="Bot image url" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bot Help</label>
                                            <input type="text" name="help" class="form-control" placeholder="Help for using the bot" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>About Bot</label>
                                            <input type="text" name="about" class="form-control" placeholder="About Bot" required>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                <div class="clearfix"></div>
                            </form>
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