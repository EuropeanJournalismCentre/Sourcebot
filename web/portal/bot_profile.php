<?php
    include "./includes/header.php";
    $messages = retrieve_bot_messages($db);
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
                                    <img class="avatar border-gray" src="<?= getenv(PROFILE_PIC_URL);?>" alt="..." />

                                    <h4 class="title"><?= getenv(BOT_NAME);?><br />
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
                                        <td><?= $messages[0]['value'];?> - last updated on <?= $messages[0]['last_update'];?></td>
                                    </tr>
                                    <tr>
                                        <td>About</td>
                                        <td><?= $messages[1]['value'];?> - last updated on <?= $messages[1]['last_update'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Feature [0]</td>
                                        <td><?= $messages[2]['value'];?> - last updated on <?= $messages[2]['last_update'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Feature [1]</td>
                                        <td><?= $messages[3]['value'];?> - last updated on <?= $messages[3]['last_update'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Feature [2]</td>
                                        <td><?= $messages[4]['value'];?> - last updated on <?= $messages[4]['last_update'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Article Month</td>
                                        <td><?= $messages[5]['value'];?> - last updated on <?= $messages[5]['last_update'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Article Date</td>
                                        <td><?= $messages[6]['value'];?> - last updated on <?= $messages[6]['last_update'];?></td>
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