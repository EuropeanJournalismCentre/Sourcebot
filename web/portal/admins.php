<?php include "./includes/header.php"; ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-plain">
                        <div class="header">
                            <h4 class="title">Admins</h4>
                            <a href="add_admin.php" class="btn btn-info btn-fill pull-right">Create New User</a>

                        </div>
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
<?php include "./includes/footer.php"; ?>
