<?php 
    include "./includes/header.php";
    $admins = retrieve_admin_users($db);
?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-plain">
                        <div class="header">
                            <h4 class="title">Messenger Error Log</h4>
                            <a href="add_admin.php" class="btn btn-info btn-fill pull-right">Create New User</a>

                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Last Login</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                <?php foreach($admins as $key=>$value){ ?>
                                <tr>
                                    <td><?= $value['id']; ?></td>
                                    <td><?= $value['name']; ?></td>
                                    <td><?= $value['email']; ?></td>
                                    <td><?= $value['last_login']; ?></td>
                                    <td>
                                        <?= ($value['permissions'] == 0 ? 'Deactivated' : 'Active')?>
                                    </td>
                                    <td>
                                        <?php if($value['permissions'] == 0){?>
                                        <a href="" class="btn btn-success btn-xs">Activate</a>
                                        <?php }else{?>
                                        <a href="" class="btn btn-danger btn-xs">Deactivate</a>
                                        <?php }?>   
                                        |
                                        <a href="" class="btn btn-default btn-xs">Edit</a>
                                    </td>
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
