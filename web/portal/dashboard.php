<?php 
    include "./includes/header.php";

    $weekly_users = array();
    // $start_date = date("Y-m-d");
    // $end_date = date("Y-m-d",strtotime('-7 days', strtotime($start_date)));
    $i = 0;
    $j = 1;
    $k = 0;
    while ($k <= 3) {
        // $start_date = date("Y-m-d h:i:sa",strtotime('-'.$i.' days'));
        $weekly_users[] = weekly_messenger_users($i, $j, $db);
        $start_date = date("Y-m-d",strtotime('-7 days', strtotime($start_date)));
        $i++;
        $j++;
        $k++;
    }
    var_dump($weekly_users);
?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">User Statics - Weekly</h4>
                            <p class="category">24 Hours performance</p>
                        </div>
                        <div class="content">
                        <div class="service-container" data-service="<?= $weekly_users; ?>">
                            <canvas id="myChart" width="400" height="400"></canvas>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">User Statics - Monthly</h4>
                            <p class="category">24 Hours performance</p>
                        </div>
                        <div class="content">
                            <canvas id="myChart2" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
            <div class="col-md-6">
                    <div class="card ">
                        <div class="header">
                            <h4 class="title">Frequent search terms - Weekly</h4>
                        </div>
                        <div class="content">
                            <div class="table-full-width">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Send Broadcast Messages?</td>
                                        </tr>
                                        <tr>
                                            <td>Download Weekly Stats?</td>
                                        </tr>
                                        <tr>
                                            <td>Sendly Weekly News Updates?</td>
                                        </tr>
                                        <tr>
                                            <td>Save User Statistics?</td>
                                        </tr>
                                        <tr>
                                            <td>Save User Info?</td>
                                        </tr>
                                        <tr>
                                            <td>Create Weekly Backups?</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-history"></i> Updated 3 minutes ago
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card ">
                        <div class="header">
                            <h4 class="title">Frequent search terms - Monthly</h4>
                        </div>
                        <div class="content">
                            <div class="table-full-width">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Download Weekly Stats?</td>
                                        </tr>
                                        <tr>
                                            <td>Sendly Weekly News Updates?</td>
                                        </tr>
                                        <tr>
                                            <td>Save User Statistics?</td>
                                        </tr>
                                        <tr>
                                            <td>Save User Info?</td>
                                        </tr>
                                        <tr>
                                            <td>Create Weekly Backups?</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-history"></i> Updated 3 minutes ago
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "./includes/footer.php"; ?>
<script>
    var weekly = "<?php echo json_encode($weekly_users);?>";
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
            datasets: [{
                label: '# of weekly Users',
                data: weekly,
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
<!--<script src="./js/dash_charts.js"></script>-->