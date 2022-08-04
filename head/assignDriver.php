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
         $query="INSERT INTO driver (driver_name, email, phone, address, license_no, staff_id, date) 
         VALUES( '$driver_name', '$email', '$email', '$phone', '$address', '$license_no',  '$staff_id', '$time')";
         
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

<div class="body">
                            <form id="form_validation" method="POST" action="indicate_2.php" name="indicate">
                                
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
                                    <select class="form-control show-tick" required>
                                            <option>Please select a Vehicle</option>
                                            <?php
                                                $vehicle = mysqli_query($db, "SELECT vehicle_name FROM vehicle") ;
                                                
                                                while ($data = mysqli_fetch_array($vehicle)) {
                                                        echo "<option value='".$data['vehicle_name']. "'>" .$data['vehicle_name']."</option>";
                                                }
                                            ?>
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="odometer" required>
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
                                        <input type="datetime" class="form-control" name="date" value="<?php date_default_timezone_set("Africa/Lagos");
                                        echo($time) ?>" disabled="">
                                        <label class="form-label">START DATE </label>
                                    </div>
                                </div>     
                                <div class="row" style="margin-top:10px;">
                            <div class="col-md-3">
                                &nbsp;
                            </div>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <button type="reset" class="btn btn-danger" style="margin-right: 30px; width: 100px;">
                                        <i class="fa fa-remove"> </i> Reset
                                    </button>    
                                      <button class="btn btn-primary waves-effect"style="margin-left: 50px; width: 100px; type="submit" name="indicate">SAVE</button>

                                </div>
                            </div>
                        </div>         
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
            
        </div>
    </section>
<?php mysqli_close($db);  // close connection ?>
    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Bootstrap Colorpicker Js -->
    <script src="../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

    <!-- Dropzone Plugin Js -->
    <script src="../plugins/dropzone/dropzone.js"></script>

    <!-- Input Mask Plugin Js -->
    <script src="../plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

    <!-- Multi Select Plugin Js -->
    <script src="../plugins/multi-select/js/jquery.multi-select.js"></script>

    <!-- Jquery Spinner Plugin Js -->
    <script src="../plugins/jquery-spinner/js/jquery.spinner.js"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="../plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- noUISlider Plugin Js -->
    <script src="../plugins/nouislider/nouislider.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/forms/advanced-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>

</html> 