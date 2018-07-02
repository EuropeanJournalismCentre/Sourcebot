<?php 
    include "./includes/header.php";
    $errors = retrieve_messenger_error_log($db);
?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-plain">
                        <div class="header">
                            <h4 class="title">Messenger Error Log</h4>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Message</th>
                                    <th>Error Code</th>
                                    <th>Error Sub-Code</th>
                                    <th>Error Type</th>
                                    <th>FB Trace Id</th>
                                    <th>Timestamp</th>
                                </thead>
                                <tbody>
                                <?php foreach($errors as $key=>$value){ ?>
                                    <tr>
                                        <td><?= $value['id']; ?></td>
                                        <td><?= $value['message']; ?></td>
                                        <td><?= $value['error_code'];?></td>
                                        <td><?= $value['error_subcode'];?></td>
                                        <td><?= $value['error_type'];?></td>
                                        <td><?= $value['error_timestamp'];?></td>
                                        <td><?= $value['fbtrace_id'];?></td>
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
