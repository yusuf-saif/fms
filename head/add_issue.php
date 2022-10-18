<?php
 session_start();
 $role = $_SESSION['role'];
 $user = $_SESSION['username'];
 if(!isset($_SESSION['username']) || $role!="Chairman"){
   header('Location: /FMS');
 }

 include 'head.php';
 include 'nav.php';


 include ('../conn.php');

     $time=date("Y-m-d h:i") ;

     if(isset($_POST['issue_vehicle'])){

 //collecting form inputs using the specified method

 $plate_number  = mysqli_real_escape_string($db, trim($_POST['plate_name']));
 $driver_name  = mysqli_real_escape_string($db, trim($_POST['driver_name']));
 $issue_title = mysqli_real_escape_string($db, trim($_POST['issue_title']));
 $issue_description = mysqli_real_escape_string($db, trim($_POST['issue_description']));

 
 //check for empty field

 if(!empty($plate_number) && !empty($driver_name) && !empty($issue_title) && !empty($issue_description)){

     
     //check for duplicate

     $check= "SELECT COUNT(*) FROM issue_vehicle WHERE plate_number = '".$plate_number."' && driver_name = '".$driver_name.
     "' && issue_title = '".$issue_title."' && issue_description = '".$issue_description."'";

     $sql = mysqli_query($db,$check);
         
     $row = mysqli_fetch_assoc($sql);  

     if($row['COUNT(*)'] == 0) {

         //insert values 
         
         $query="INSERT INTO issue_vehicle (plate_number, driver_name, issue_title, issue_description, user, date)
          VALUES('$plate_number', '$driver_name', '$issue_title', '$issue_description', '$user', '$time')";
         
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
                                
                                <!-- <div class="form-group form-float form-line">
                                    <select class="form-control show-tick" name="vehicle_name" required>
                                        <option >Please select a vehicle</option>
                                        <?php
                                            // $vehicle = mysqli_query($db, "SELECT name FROM vehicle");  // Use select query here 

                                            // while($data = mysqli_fetch_array($vehicle))
                                            // {
                                            //     echo "<option value='". $data['name'] ."'>" .$data['name'] ."</option>";  // displaying data in option menu
                                            // }   
                                            // $vehicle = mysqli_query($db, "SELECT vehicle_name FROM vehicle") ;
                                                
                                            // while ($data = mysqli_fetch_array($vehicle)) {
                                            //         echo "<option value='".$data['vehicle_name']. "'>" .$data['vehicle_name']."</option>";
                                            // }
                                            ?>

                                    </select>
                                </div> -->
                                <!-- <div class="form-group form-float form-line">
                                    <select class="form-control show-tick" name="driver_name" required>
                                        <option >Please select a Driver</option>
                                        <?php
                                            // $driver = mysqli_query($db, "SELECT name From driver");  // Use select query here 

                                            // while($data = mysqli_fetch_array($driver))
                                            // {
                                             //     echo "<option value='". $data['name'] ."'>" .$data['name'] ."</option>";  // displaying data in option menu
                                            // }
                                            // $driver = mysqli_query($db, "SELECT driver_name FROM driver");  // Use select query here 

                                            // while($data = mysqli_fetch_array($driver))
                                            // {
                                            //     echo "<option value='". $data['driver_name'] ."'>" .$data['driver_name'] ."</option>";  // displaying data in option menu
                                            // }   
                                            ?>

                                    </select>
                                </div> -->
                              
                                <div class="form-group form-float form-line">
                                    <select class="form-control show-tick" name="plate_number" required>
                                        <option >Please select a Vehicle</option>
                                        <?php
                                            $plate_number = mysqli_query($db, "SELECT plate_number FROM vehicle");  // Use select query here 

                                            while($data = mysqli_fetch_array($plate_number))
                                            {
                                                echo "<option value='". $data['plate_number'] ."'>" .$data['plate_number'] ."</option>";  // displaying data in option menu
                                            }   
                                            ?>

                                    </select>
                                </div>
                                <div class="form-group form-float form-line">
                                    <select class="form-control show-tick" name="driver_name" required>
                                        <option >Please select a driver</option>
                                        <?php
                                            $driver = mysqli_query($db, "SELECT driver_name FROM driver");  // Use select query here 

                                            while($data = mysqli_fetch_array($driver))
                                            {
                                                echo "<option value='". $data['driver_name'] ."'>" .$data['driver_name'] ."</option>";  // displaying data in option menu
                                            }   
                                            ?>

                                    </select>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="issue_title" required>
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
                                
                                <button class="btn btn-success waves-effect" type="submit" name="issue_vehicle">SAVE</button>
                                <input type="reset" class="btn btn-danger"/>
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
 include '../head/foot.php';
?>