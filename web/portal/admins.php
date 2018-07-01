<?php 
    include "./includes/header.php";
    if (isset($_GET["message"])){
        $message = $_GET['message'];
    }
    $admins = retrieve_admin_users($db);
    ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-plain">
                        <div class="header">
                            <h3><?= $message; ?></h3>
                            <h4 class="title">Admins</h4>
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
                                        <a href="./includes/form_submissions.php?id=<?= $value['id'];?>&permission=2" class="btn btn-success btn-xs">Activate</a>
                                        <?php }else{?>
                                        <a href="./includes/form_submissions.php?id=<?= $value['id'];?>&permission=0" class="btn btn-danger btn-xs">Deactivate</a>
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
