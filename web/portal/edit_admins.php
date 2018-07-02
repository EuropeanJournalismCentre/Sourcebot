<?php 
    include "./includes/header.php";
    // $admin = retrieve_admin_user($_GET['id'], $db);
    var_dump(retrieve_admin_user($_GET['id'], $db));
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
                                            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email"  name="email" class="form-control" placeholder="Email" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password"  name="password" class="form-control" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="form-control" name="role">
                                                <option value="2">Super Admin</option>
                                                <option value="1">General Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="add_admin" value="yes"> 
                                <button type="submit" class="btn btn-info btn-fill pull-right">Add Admin</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "./includes/footer.php"; ?>