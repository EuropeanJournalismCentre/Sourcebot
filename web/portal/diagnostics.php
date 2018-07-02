<?php 
    include "./includes/header.php";
    $errors = retrieve_messenger_error_log($db);
    var_dump($errors);
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
