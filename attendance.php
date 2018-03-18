<?php
    $display = "none";
    include('controllers/attendance_controller.php');
?>
<!DOCTYPE html>
<head>
</head>
<body>
    <section id="main-content">
        <section class="wrapper">
            <div class="container">
                <div class="row">
                    <form class="form-horizontal" action="" method="post" name="upload_excel" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Attendance CSV Upload</legend>
                            <?php
                                if(isset($_GET['upload']))
                                {
                                    echo "
                                        <div class='col-lg-10 col-lg-offset-1'>
                                            <div class='alert alert-danger alert-dismissable fade in'>
                                                 <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                                Please upload a valid CSV file.
                                            </div>
                                        </div>
                                    ";
                                }
                            ?>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="filebutton">Select File</label>
                                <div class="col-md-4">
                                    <input type="file" name="file" id="file" class="input-large">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="singlebutton"></label>
                                <div class="col-md-4">
                                    <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div style="display:<?php echo $display ?>">
                <?php
                   get_all_records($con);
                ?>
            </div>
        </div>
    </div>
</body>
 
</html>