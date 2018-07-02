<?php 
    include "./includes/header.php";
    $users = retrieve_messenger_users($db);
?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Bot Users</h4>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Full Name</th>
                                    <th>Gender</th>
                                    <th>More...</th>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $key=>$value){ ?>
                                        <tr>
                                            <td><?= $value['id']; ?></td>
                                            <td width="45px"><img src="<?= $value['profile_pic_url'];?>" class="borders avatar-profile"></td>
                                            <td><?= $value['name']; ?></td>
                                            <td><?= ucwords($value['gender']); ?></td>
                                            <td><a href="bot_user.php?id=<?= $value['facebook_id']?>" class="btn btn-default">View more...</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "./includes/footer.php"; ?>