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
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>More...</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td width="45px"><img src="https://images.pexels.com/photos/375880/pexels-photo-375880.jpeg?auto=compress&cs=tinysrgb&h=350" class="borders avatar-profile"></td>
                                        <td>Kudakwashe</td>
                                        <td>Siziva</td>
                                        <td>Male</td>
                                        <td>this@that.com</td>
                                        <td><a href="#" class="btn btn-default">View more...</a></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><img src="https://avatars3.githubusercontent.com/u/9620622?s=400&u=2ba1016f55802a2afff5fad09a7b4240ef2eb86a&v=4" class="borders avatar-profile"></td>
                                        <td>Kudakwashe</td>
                                        <td>Siziva</td>
                                        <td>Male</td>
                                        <td>this@that.com</td>
                                        <td><a href="bot_user.php" class="btn btn-default">View more...</a></td>
                                    </tr>
                                    <?php foreach($users as $key=>$value){ ?>
                                <tr>
                                    <td><?= $value['id']; ?></td>
                                    <td><?= $value['name']; ?></td>
                                    <td><?= $value['email']; ?></td>
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