<?php
include('controllers/payroll_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
    <section id="main-content">
        <section class="wrapper">
            <div class="container">
              <div class="row">
                <div class="form-panel">
                    <fieldset>
                        <div class="col-lg-10 col-lg-offset-1">
                            <h1 class="text-center">Manage Payroll</h1>
                            <br>
                            <form class="form-horizontal" method="POST">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">Choose Period</label>
                                        <div class="col-xs-4">
                                            <input type="date" id="payStartingDate" name="payStartingDate" class="form-control" required="true" />
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="date" id="payEndingDate" name="payEndingDate" class="form-control"  required="true" />
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="col-lg-10 col-lg-offset-1">
                                    <?php echo $msgDisplay; ?>
                                </div>
                                <br />
                                <table id="listTable" name="listTable" class="table table-hover">
                                    <thead>
                                        <th class="text-center"></th>
                                        <th class="text-center">Employee Name</th>
                                        <th class="text-center">Position</th>
                                        <th class="text-center">Department</th>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <?php
                                        if($rowCount <= 0)
                                        {
                                            echo "
                                            <tr>
                                            <td colspan='5' class='text-center'><h3>There are no accounts to display.</h3></td>
                                            </tr>
                                            ";
                                        }
                                        else 
                                        {
                                            echo $displayList;
                                        } 
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-lg-6 col-lg-offset-6">
                                <div class="form-group">
                                    <div class="col-lg-4 col-lg-offset-7">
                                        <button type="submit" id="btnGenerate" name="btnGenerate" class="btn btn-primary btn-block pull-right">Generate</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</section>
</section>
</body>
</html>