<?php
    session_start();
    $role = $_SESSION['role'];
    if(!isset($_SESSION['username']) || $role!="officer"){
      header('Location: /FMS/driver');
    }

    include 'headDriver.php';
    include 'nav.php';
    include '../count.php';

 include ('../conn.php');

     $time=date("Y-m-d h:i") ;

     if(isset($_POST['issue_vehicle'])){

 //collecting form inputs using the specified method

 $vehicle_name  = mysqli_real_escape_string($db, trim($_POST['vehicle_name']));
 $driver_name  = mysqli_real_escape_string($db, trim($_POST['driver_name']));
 $issue_title = mysqli_real_escape_string($db, trim($_POST['issue_title']));
 $issue_description = mysqli_real_escape_string($db, trim($_POST['issue_description']));

 
 //check for empty field

 if(!empty($vehicle_name) && !empty($driver_name) && !empty($issue_title) && !empty($issue_description)){

     
     //check for duplicate

     $check= "SELECT COUNT(*) FROM issue_vehicle WHERE vehicle_name = '".$vehicle_name."' && driver_name = '".$driver_name.
     "' && issue_title = '".$issue_title."' && issue_description = '".$issue_description."'";

     $sql = mysqli_query($db,$check);
         
     $row = mysqli_fetch_assoc($sql);  

     if($row['COUNT(*)'] == 0) {

         //insert values 
         
         $query="INSERT INTO issue_vehicle (vehicle_name, driver_name, issue_title, issue_description, date user) VALUES('$vehicle_name', '$driver_name', '$issue_title', '$issue_description', '$time', '$user')";
         
         $action= mysqli_query($db, $query);
            if($action){
                $error="<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>
                        VEHICLE ISSUE  SAVED SUCCESSFULLY <br> 
                    </div> "; 
            }
            else{
                $error="<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>
                       Error in Data Entry <br>
                       Please Contact The Web Admin
                    </div>";
                }
        }
        else{
            $error="<div class='alert alert-danger alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                SORRY DUPLICATION IS NOT ALLOWED <br>
                </div>";
        }
    }
    else{
    
        $error="<div class='alert alert-danger alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            PLEASE KINDLY FILL ALL REQUIRED FIELDS
        </div>";

        }
    }


?>
?>
    <section class="content">
        <div class="container-fluid">            

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>ADD VEHICLE ISSUE</h2>
                        </div>

                            <?php
                                if(isset($error)){
                                    echo $error;
                                }
                            ?>

                        <div class="body">
                            <form id="form_validation" method="POST" action="add_issue.php" name="addIssue">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="issue_name" required>
                                        <label class="form-label">Issue tittle  </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="textarea" class="form-control" name="issue_description" >
                                        <label class="form-label"> Desciption </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line col-lg-6">
                                        <input type="datetime" class="form-control" name="date" value="<?php echo($time) ?>" disabled="">
                                        <label class="form-label">DATE </label>
                                    </div>
                                </div>
                                
                                <button class="btn btn-primary waves-effect" type="submit" name="issue_vehicle">SAVE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
            
        </div>
    </section>
    <?php
    // foreach ($_POST as $key => $value) {
    //     echo "<tr>";
    //     echo "<td>";
    //     echo $key;
    //     echo "</td> <br>"; 
    //     echo "<td>";
    //     echo $value;
    //     echo "</td> <br>";
    //     echo "<td>";
    //     echo $key;
    //     echo "</td> <br>";
    //     echo "<td>";
    //     echo $value;
    //     echo "</td> <br>";
    //      echo "</tr>";
    // }
?>
<?php
 include '../driver/foot.php';
?>