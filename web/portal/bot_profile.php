<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $response = array();
        $posts = array();
        $posts[] = array('name'=> 'Kudakwashe', 'surname'=> 'siziva');
        $response['posts'] = $posts;
        $fp = fopen('results.json', 'w');
        fwrite($fp, json_encode($response));
        fclose($fp);
        http_redirect("index.php");
    }
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
                            <form method="POST" enctype="multipart/form-data" action="bot_profile.php">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bot Name</label>
                                            <input type="text" class="form-control" placeholder="Bot Name" required>
                                        </div>
                                    </div>
                                </div>


                                <div class="#">
                                    <label for="upload" class="#">Bot Image</label>
                                    <input id="upload" class="#" type="file" name="file-upload">
                                </div>

                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

                                    <h4 class="title">Kudakwashe Siziva<br />
                                        <small> Gender : Male</small><br />
                                        <small> Email  : this@that.com</small><br>
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
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <script>
                                                  document.write(new Date())
                                                </script>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Collapsible Group Item #3
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /*****************************************
            upload button styles
        ******************************************/
        .file-upload {
            position: relative;
            display: inline-block;
        }

        .file-upload__label {
            display: block;
            padding: 1em 2em;
            color: #fff;
            background: #222;
            border-radius: .4em;
            transition: background .3s;

        &:hover {
             cursor: pointer;
             background: #000;
         }
        }

        .file-upload__input {
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            font-size: 1;
            width:0;
            height: 100%;
            opacity: 0;
        }
    </style>
<?php include "./includes/footer.php"; ?>