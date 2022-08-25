<?php
 session_start();
 $role = $_SESSION['role'];
 $user = $_SESSION['username'];
 if(!isset($_SESSION['username']) || $role!="Chairman"){
   header('Location: /fms');
 }

 include 'head.php';
 include 'nav.php';


 include ('../conn.php');

     $time=date("Y-m-d h:i") ;

     if(isset($_POST['assigndriver'])){
 //collecting form inputs using the specified method
 $driver_name  = mysqli_real_escape_string($db, trim($_POST['driver_name']));
 $plate_number =mysqli_real_escape_string($db, trim($_POST['plate_number']));
 $odometer = mysqli_real_escape_string($db, trim($_POST['odometer']));
 $comment = mysqli_real_escape_string($db, trim($_POST['comment']));
 
 //check for empty field
 if(!empty($driver_name) && !empty($plate_number) && !empty($odometer) && !empty($comments)){
     
     //check for duplicate

     $check= "SELECT COUNT(*) FROM assigndriver WHERE driver_name = '".$driver_name."' && plate_number = '".$plate_number.
     "' && odometer = '".$odometer."' && comment = '".$comment."'";


     $sql = mysqli_query($db,$check);
         
     $row = mysqli_fetch_assoc($sql);  

     if($row['COUNT(*)'] == 0) {

         //insert values 
         $query="INSERT INTO driver (driver_name, email, phone, address, license_no, staff_id, date) 
         VALUES( '$driver_name', '$email', '$email', '$phone', '$address', '$license_no',  '$staff_id', '$time')";
         
         $action= mysqli_query($db, $query);
            if($action){
                $error="<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>
                        VEHICLE - DRIVER ASSIGNMENT  SAVED SUCCESSFULLY <br> 
                    </div> "; 
            }
            else{
                $error="<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>
                      ERROR IN DATA ENTRY  <br>
                       PLEASE CONTACT WEB ADMIN
                    </div>";
                }
        }
        else{
            $error="<div class='alert alert-danger alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              OOPS  DUPLICATION IS NOT ALLOWED <br>
                </div>";
        }
    }
    else{
    
        $error="<div class='alert alert-danger alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
             FILL ALL REQUIRED FIELDS TO MOVE FURTHER
        </div>";

        }
    }


?>
    <section class="content">
        <div class="container-fluid">            

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>VEHICLE-DRIVER ASSIGNMENT</h2>
                        </div>

                            <?php
                                if(isset($error)){
                                    echo $error;
                                }
                            ?>

            `               <div class="body">
                            <form id="form_validation" method="POST" action="assignDriver.php" name="assigndriver">
                                
                                <div class="form-group form-float form-line">
                                    <select class="form-control show-tick" name="driver" required>
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
                                <div class="form-group form-float form-line">
                                    <select class="form- trol show-tick" required>
                                            <option>Please select a Vehicle</option>
                                            <?php
                                                $vehicle = mysqli_query($db, "SELECT plate_number FROM vehicle") ;
                                                
                                                while ($data = mysqli_fetch_array($vehicle)) {
                                                        echo "<option value='".$data['plate_number']. "'>" .$data['vehicle_name']."</option>";
                                                }
                                            ?>
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="odometer" required>
                                        <label class="form-label"> Starting odometer </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="comment" >
                                        <label class="form-label"> Comments </label>
                                    </div>
                                        </div>
                                        <div class="form-group form-float">
                                    <div class="form-line col-lg-6">
                                        <input type="datetime" class="form-control" name="date" value="<?php echo($time) ?>" disabled="">
                                        <label class="form-label">DATE </label>
                                    </div>
                                </div>
                                
                                <button class="btn btn-primary waves-effect" type="submit" name="assigndriver">SAVE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
            
        </div>
    </section>
    <?php
 include '../head/foot.php';
?>