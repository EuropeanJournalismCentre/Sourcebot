<?php
    include "./includes/header.php";
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
                                            <label>Bot Feature 0</label>
                                            <input type="text" name="bot_name" class="form-control" placeholder="Bot Name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bor feature 1</label>
                                            <input type="text" name="bot_image" class="form-control" placeholder="Bot image url" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bor feature 2</label>
                                            <input type="text" name="bot_image" class="form-control" placeholder="Bot image url" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Article Month</label>
                                            <input type="text" name="bot_image" class="form-control" placeholder="Bot image url" required>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Article Date</label>
                                            <input type="text" name="bot_image" class="form-control" placeholder="Bot image url" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bot Help</label>
                                            <input type="text" name="help" class="form-control" placeholder="Help for using the bot" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>About Bot</label>
                                            <input type="text" name="about" class="form-control" placeholder="About Bot" required>
                                        </div>
                                    </div>
                                </div>

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