 <?php
    $pageTitle = "Attendance";
    include('function.php');
    include(loadHeader());

    if(isset($_POST["Import"]))
    {
        $filename=$_FILES["file"]["tmp_name"];      
            if($_FILES["file"]["size"] > 0)
            {
                $file = fopen($filename, "r");
                while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
                {
                    $sql_attendance = "INSERT INTO attendance (accountID,attendanceIn,attendanceOut,attendanceDate) 
                                       VALUES ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."')";
                    $stmt_getAttendance = sqlsrv_query($con, $sql_getAttendance);
                    if(!isset($stmt_getAttendance))
                    {
                        echo "<script type=\"text/javascript\">
                                alert(\"Invalid File:Please Upload CSV File.\");
                                window.location = \"attendance.php\"
                            </script>";       
                    }
                    else 
                    {
                        echo "<script type=\"text/javascript\">
                                alert(\"CSV File has been successfully Imported.\");
                                window.location = \"attendance.php\"
                            </script>";
                    }
                }
                fclose($file); 
            }
    }   

    function get_all_records($con)
    {
        $sql_attendance = "SELECT accountID, attendanceIn, attendanceOut, attendanceDate FROM attendance";
        $result = sqlsrv_query($con, $sql_getAttendance);  
     
        if (sqlsrv_num_rows($stmt_attendance) > 0) 
        {
            echo "<div class='table-responsive'>
                    <table id='myTable' class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Account ID</th>
                                <th>Time in</th>
                                <th>Time out</th>
                                <th>Date</th>                         
                            </tr>
                        </thead>
                        <tbody>";

            while($row = sqlsrv_fetch_array($result)) 
            {
                echo "<tr>
                        <td>" . $row['accountID']."</td>
                        <td>" . $row['attendanceIn']."</td>
                        <td>" . $row['attendanceOut']."</td>
                        <td>" . $row['attendanceDate']."</td>
                    </tr>";        
            }
            echo "</tbody></table></div>";
        } 
        else 
        {
           echo "you have no records";
        }
    }    
?>
