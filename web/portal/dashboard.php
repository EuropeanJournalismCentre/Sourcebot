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
                            <div id="chartHours" class="ct-chart"></div>
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
                            <div id="chartHours" class="ct-chart"></div>
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
                                            <td>
                                                <div class="checkbox">
                                                    <input id="checkbox1" type="checkbox">
                                                    <label for="checkbox1"></label>
                                                </div>
                                            </td>
                                            <td>Send Broadcast Messages?</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <input id="checkbox2" type="checkbox" checked>
                                                    <label for="checkbox2"></label>
                                                </div>
                                            </td>
                                            <td>Download Weekly Stats?</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <input id="checkbox3" type="checkbox">
                                                    <label for="checkbox3"></label>
                                                </div>
                                            </td>
                                            <td>Sendly Weekly News Updates?</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <input id="checkbox4" type="checkbox" checked>
                                                    <label for="checkbox4"></label>
                                                </div>
                                            </td>
                                            <td>Save User Statistics?</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <input id="checkbox5" type="checkbox">
                                                    <label for="checkbox5"></label>
                                                </div>
                                            </td>
                                            <td>Save User Info?</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <input id="checkbox6" type="checkbox" checked>
                                                    <label for="checkbox6"></label>
                                                </div>
                                            </td>
                                            <td>Create Weekly Backups?</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            </td>
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
                                            <td>
                                                <div class="checkbox">
                                                    <input id="checkbox1" type="checkbox">
                                                    <label for="checkbox1"></label>
                                                </div>
                                            </td>
                                            <td>Send Broadcast Messages?</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <input id="checkbox2" type="checkbox" checked>
                                                    <label for="checkbox2"></label>
                                                </div>
                                            </td>
                                            <td>Download Weekly Stats?</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <input id="checkbox3" type="checkbox">
                                                    <label for="checkbox3"></label>
                                                </div>
                                            </td>
                                            <td>Sendly Weekly News Updates?</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <input id="checkbox4" type="checkbox" checked>
                                                    <label for="checkbox4"></label>
                                                </div>
                                            </td>
                                            <td>Save User Statistics?</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <input id="checkbox5" type="checkbox">
                                                    <label for="checkbox5"></label>
                                                </div>
                                            </td>
                                            <td>Save User Info?</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <input id="checkbox6" type="checkbox" checked>
                                                    <label for="checkbox6"></label>
                                                </div>
                                            </td>
                                            <td>Create Weekly Backups?</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            </td>
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