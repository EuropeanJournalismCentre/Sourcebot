<?php
    include "./includes/header.php";
    $messages = retrieve_bot_messages($db);
    var_dump($messages);
 ?>

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
                            <a href="edit_bot_messages.php" class="btn btn-info btn-fill pull-right">Update Profile</a>
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
    </div>
<?php include "./includes/footer.php"; ?>