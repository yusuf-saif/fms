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

     if(isset($_POST['service'])){
 //collecting form inputs using the specified method
 $vehicle_name  = mysqli_real_escape_string($db, trim($_POST['vehicle_name']));
 $vendor_name = mysqli_real_escape_string($db, trim($_POST['vendor_name']));
 $odometer = mysqli_real_escape_string($db, trim($_POST['odometer']));
 $comment = mysqli_real_escape_string($db, trim($_POST['comment']));
 
 //check for empty field

 if(!empty($vehicle_name) && !empty($vendor_name) && !empty($odometer) && !empty($comment)){

     //check for duplicate

     $check= "SELECT COUNT(*) FROM service WHERE vehicle_name = '".$vehicle_name."' && vendor_name = 
     '".$vendor_name."' && odometer = '".$odometer."' && comment = '".$comment."'";

     $sql = mysqli_query($db,$check);
         
     $row = mysqli_fetch_assoc($sql);  

     if($row['COUNT(*)'] == 0) {

         //insert values 
         $query="INSERT INTO service (vehicle_name, vendor_name, odometer, comment, user, date) 
         VALUES( '$vehicle_name', '$vendor_name', '$odometer', '$comment', '$user', '$time')";
         
         $action= mysqli_query($db, $query);
            if($action){
                $error="<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>
                        SERVICE  SAVED SUCCESSFULLY <br> 
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
                            <h2>SERVICE REGISTRATION</h2>
                        </div>

                            <?php
                                if(isset($error)){
                                    echo $error;
                                }
                            ?>

                        <div class="body">
                            <form id="form_validation" method="POST" action="service_reg.php" name="service">
                            <div class="form-group form-float form-line">
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
                                </div>
                                <div class="form-group form-float form-line">
                                    <select class="form-control show-tick" name="driver_name" required>
                                        <option >Please select a Driver</option>
                                        <?php
                                            $driver = mysqli_query($db, "SELECT name From driver");  // Use select query here 

                                            while($data = mysqli_fetch_array($driver))
                                            {
                                                echo "<option value='". $data['name'] ."'>" .$data['name'] ."</option>";  // displaying data in option menu
                                            }
                                            // $vendor_name = mysqli_query($db, "SELECT vemdor_name FROM vendor");  // Use select query here 

                                            // while($data = mysqli_fetch_array($vendor_name))
                                            // {
                                            //     echo "<option value='". $data['vendor_name'] ."'>" .$data['vendor_name'] ."</option>";  // displaying data in option menu
                                            // }   
                                            ?>

                                    </select>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="odometer" required>
                                        <label class="form-label">Vehicle Current odometer</label>
                                    </div>                                    
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="comment" required>
                                        <label class="form-label">Comments</label>
                                    </div>                                    
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line col-lg-6">
                                        <input type="datetime" class="form-control" name="date" value="<?php echo($time) ?>" disabled="">
                                        <label class="form-label">DATE </label>
                                    </div>
                                </div>                                
                                <button class="btn btn-primary waves-effect" type="submit" name="service">SAVE</button>
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