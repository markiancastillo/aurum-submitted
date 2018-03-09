 <?php
    $pageTitle = "Attendane";
    include('function.php');
    include(loadHeader());


    if(isset($_POST["Import"])){
            
            $filename=$_FILES["file"]["tmp_name"];      
     
     
             if($_FILES["file"]["size"] > 0)
             {
                $file = fopen($filename, "r");
                while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
                 {
     
     
                   $sql_getAttendance = "INSERT into attendance (accountID,attendanceIn,attendanceOut) 
                       values ('".$getData[0]."','".$getData[1]."','".$getData[2]."')";
                       $stmt_getAttendance = sqlsrv_query($con, $sql_getAttendance);
                    if(!isset($stmt_getAttendance))
                    {
                        echo "<script type=\"text/javascript\">
                                alert(\"Invalid File:Please Upload CSV File.\");
                                window.location = \"attendance.php\"
                              </script>";       
                    }
                    else {
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
        $sql_attendance = "SELECT * FROM attendance";
        $stmt_attendance = sqlsrv_query($con, $sql_attendance);  
        return $stmt_attendance;
     
 
    if (sqlsrv_num_rows($stmt_attendance) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead><tr><th>Account ID</th>
                          <th>Time In</th>
                          <th>Time Out</th>
                        </tr></thead><tbody>";
 
 
     while($row = sqlsrv_fetch_assoc($stmt_attendance)) {
 
         echo "<tr><td>" . $row['accountID']."</td>
                   <td>" . $row['attendanceIn']."</td>
                   <td>" . $row['attendanceOut']."</td></tr>";        
     }
    
     echo "</tbody></table></div>";
     
     }else 
        {
             echo "you have no records";
         } 
    }
?>
