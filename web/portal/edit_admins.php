<?php 
    include "./includes/header.php";
    $admin = retrieve_admin_user($_GET['id'], $db);
?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Add Admin</h4>
                        </div>
                        <div class="content">
                            <form action="./includes/form_submissions.php" enctype="multipart/form-data" method="POST">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="name" class="form-control" value="<?= $admin[1];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email"  name="email" class="form-control" value="<?= $admin[2];?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="form-control" name="role">
                                                <option value="1">General Admin</option>
                                                <option value="2">Super Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="update_admin" value="yes">
                                <input type="hidden" name="id" value="<?= $admin[0];?>"> 
                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Admin</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "./includes/footer.php"; ?>