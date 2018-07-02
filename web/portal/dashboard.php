<?php include "./includes/header.php"; ?>
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
                            <canvas id="myChart" width="400" height="400"></canvas>
                            <div class="footer">
                                <div class="legend">
                                    <i class="fa fa-circle text-info"></i> Active
                                    <i class="fa fa-circle text-danger"></i> Inactive Over A Week
                                    <i class="fa fa-circle text-warning"></i> Inactive
                                </div>
                            </div>
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
                            <div class="footer">
                                <div class="legend">
                                    <i class="fa fa-circle text-info"></i> Active
                                    <i class="fa fa-circle text-danger"></i> Inactive Over A Week
                                    <i class="fa fa-circle text-warning"></i> Inactive
                                </div>
                            </div>
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
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        datasets: [{
            label: '# of weekly Users',
            data: [12, 19, 3, 5, 2, 3, 7],
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
                    beginAtZero:true
                }
            }]
        }
    }
});

var ctx2 = document.getElementById("myChart2");
var myChart2 = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        datasets: [{
            label: '# of weekly Users',
            data: [12, 19, 3, 5, 2, 3, 7],
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
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>