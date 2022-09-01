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
     if(isset($_POST['driver'])){
 //collecting form inputs using the specified method
 $driver_name  = mysqli_real_escape_string($db, trim($_POST['driver_name']));
 $email = mysqli_real_escape_string($db, trim($_POST['email']));
 $phone = mysqli_real_escape_string($db, trim($_POST['phone']));
 $address = mysqli_real_escape_string($db, trim($_POST['address']));
 $license_no = mysqli_real_escape_string($db, trim($_POST['license_no']));
 $staff_id = mysqli_real_escape_string($db, trim($_POST['staff_id']));
 
 //check for empty field
 if(!empty($driver_name) && !empty($email) && !empty($phone) && !empty($address) 
 && !empty($license_no) && !empty($staff_id)){

     
     //check for duplicate
     $check= "SELECT COUNT(*) FROM driver WHERE driver_name = '".$driver_name."' && email = '".$email.
     "' && phone = '".$phone."' && address = '".$address."'&& license_no = '".$license_no."'&& staff_id = '".$staff_id."'";


     $sql = mysqli_query($db,$check);
         
     $row = mysqli_fetch_assoc($sql);  

     if($row['COUNT(*)'] == 0) {

         //insert values 
         $query="INSERT INTO driver (driver_name, email, phone, address, license_no, staff_id, user, date) 
         VALUES( '$driver_name', '$email', '$phone', '$address', '$license_no',  '$staff_id', '$user', '$time')";
         
         $action= mysqli_query($db, $query);
            if($action){
                $error="<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>
                        DRIVER INFORMATION  SAVED SUCCESSFULLY <br> 
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
        }}
    
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
                            <h2>DRIVER REGISTRATION</h2>
                        </div>

                            <?php
                                if(isset($error)){
                                    echo $error;
                                }
                            ?>

                        <div class="body">
                            <form id="form_validation" method="POST" action="driver_reg.php" name="driver">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="driver_name"required>
                                        <label class="form-label"> Driver Name </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email"  >
                                        <label class="form-label"> Driver Email </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="tel" class="form-control" name="phone" required>
                                        <label class="form-label">Driver Phone Number</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="address"  required>
                                        <label class="form-label">Driver Residential Address</label>
                                    </div>                                    
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="license_no" required>
                                        <label class="form-label">Driver Driving License Number</label>
                                    </div>                                    
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="staff_id"  required>
                                        <label class="form-label">Driver Staff Id</label>
                                    </div>                                    
                            </div>
                                <div class="form-group form-float">
                                    <div class="form-line col-lg-6">
                                        <input type="datetime" class="form-control" name="date" value="<?php date_default_timezone_set("Africa/Lagos");
                                        echo($time) ?>" disabled="">
                                        <label class="form-label">DATE </label>
                                    </div>
                                </div>                                
                                <button class="btn btn-primary waves-effect" type="submit" name="driver">SAVE</button>
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