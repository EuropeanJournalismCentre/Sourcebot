<?php
    include "./includes/header.php";
    $messages = retrieve_bot_messages($db);
 ?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Bot Details</h4>
                        </div>
                        <div class="content">
                            <form method="POST" enctype="multipart/form-data" action="./includes/form_submissions.php">
                            
                                
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Bot Help</label>
                                        <input type="text" name="help" class="form-control" value="<?= $messages[0]['value'];?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>About Bot</label>
                                        <input type="text" name="about" class="form-control" value="<?= $messages[1]['value'];?>" required>
                                    </div>
                                </div>
                            </div>    
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bot Feature 0</label>
                                            <input type="text" name="bf0" class="form-control" value="<?= $messages[2]['value'];?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bot feature 1</label>
                                            <input type="text" name="bf1" class="form-control" value="<?= $messages[3]['value'];?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bot feature 2</label>
                                            <input type="text" name="bf2" class="form-control" value="<?= $messages[4]['value'];?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Article Month</label>
                                            <input type="text" name="article_month" class="form-control" value="<?= $messages[5]['value'];?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Article Date</label>
                                            <input type="text" name="article_date" class="form-control" value="<?= $messages[6]['value'];?>" required>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="bot_messages" value="yes">
                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "./includes/footer.php"; ?>