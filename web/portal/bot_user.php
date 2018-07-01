<?php 
    include "./includes/header.php";
    $facebook_id = $_GET['id'];
    $user = retrieve_messenger_user($facebook_id, $db);
    $messages = retrieve_messenger_messages($db);
    // var_dump($messages);
?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="image">
                            <img src="./img/sourcebot_wide.png" alt="..." />
                        </div>
                        <div class="content">
                            <div class="author">
                                <a href="#">
                                    <img class="avatar border-gray" src="https://avatars3.githubusercontent.com/u/9620622?s=400&u=2ba1016f55802a2afff5fad09a7b4240ef2eb86a&v=4" alt="..." />

                                    <h4 class="title"><?= $user[1];?><br />
                                        <small> Gender : <?= ucwords($user[6]);?></small><br />
                                        <small> Date Joined : <?= $user[8];?></small><br />
                                    </h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Messages</h4>
                        </div>
                        <div class="content">
                            <div id="accordion" style="overflow:scroll; height:750px;">
                                <?php foreach($messages as $key=>$value){ ?>
                                    <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#<?= $value['id'];?>" aria-expanded="false" aria-controls="collapseTwo">
                                                <?= $value['log_timestamp'];?>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="<?= $value['id'];?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                        <?= $value['message'];?>                                        
                                    </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "./includes/footer.php"; ?>

