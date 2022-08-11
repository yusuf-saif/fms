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
     extract($_POST);
if(isset($submit))
{

$sql=mysqli_query($conn,"SELECT * FROM  WHERE group_name='$g_name' OR registration_number='$reg_no'");
$r=mysqli_num_rows($sql);
		if($r!=true)
		{
		mysqli_query($conn,"INSERT INTO groups VALUES('','$g_name','$address','$reg_no','$meeting_day','$members','$leader',now())");
		
$err="<font color='blue'>Congrates new Group added successfully</font>";
		}
		
		else
		{

	$err="<font color='red'>This Group name or Registration number already exists choose diff group name</font>";
		
	
	}
}

//      if(isset($_POST['driver'])){
//  //collecting form inputs using the specified method
// //  $driver_name  = mysqli_real_escape_string($db, trim($_POST['driver_name']));
// //  $email = mysqli_real_escape_string($db, trim($_POST['email']));
// //  $phone = mysqli_real_escape_string($db, trim($_POST['phone']));
// //  $address = mysqli_real_escape_string($db, trim($_POST['address']));
// //  $license_no = mysqli_real_escape_string($db, trim($_POST['license_no']));
// //  $staff_id = mysqli_real_escape_string($db, trim($_POST['staff_id']));
 
//  //check for empty field
// //  if(!empty($driver_name) && !empty($email) && !empty($phone) && !empty($address) 
// //  && !empty($license_no) && !empty($staff_id)){

     
//      //check for duplicate
//     //  $check= "SELECT COUNT(*) FROM driver WHERE driver_name = '".$driver_name."' && email = '".$email.
//     //  "' && phone = '".$phone."' && address = '".$address."'&& license_no = '".$license_no."'&& staff_id = '".$staff_id."'";


//      $sql = mysqli_query($db,$check);
         
//      $row = mysqli_fetch_assoc($sql);  

//      if($row['COUNT(*)'] == 0) {

//          //insert values 
//          $query="INSERT INTO driver (driver_name, email, phone, address, license_no, staff_id, date) 
//          VALUES( '$driver_name', '$email', '$phone', '$address', '$license_no',  '$staff_id', '$time')";
         
//          $action= mysqli_query($db, $query);
//             if($action){
//                 $error="<div class='alert alert-success alert-dismissable'>
//                 <button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>
//                         DRIVER INFORMATION  SAVED SUCCESSFULLY <br> 
//                     </div> "; 
//             }
//             else{
//                 $error="<div class='alert alert-danger alert-dismissable'>
//                 <button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>
//                       ERROR IN DATA ENTRY  <br>
//                        PLEASE CONTACT WEB ADMIN
//                     </div>";
//                 }
//         }
//         else{
//             $error="<div class='alert alert-danger alert-dismissable'>
//             <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
//               OOPS  DUPLICATION IS NOT ALLOWED <br>
//                 </div>";
//         }}
    //}
    // else{
    
    //     $error="<div class='alert alert-danger alert-dismissable'>
    //         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    //          FILL ALL REQUIRED FIELDS TO MOVE FURTHER
    //     </div>";

    //     }
  //  }


?>
    <section class="content">
        <div class="container-fluid">            

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>VENDOR REGISTRATION</h2>
                        </div>

                            <?php
                                if(isset($error)){
                                    echo $error;
                                }
                            ?>

                        <div class="body">
                            <form id="form_validation" method="POST" action="vendor_view.php" name="vendor">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="vendor_name"required>
                                        <label class="form-label"> Vendor Name </label>
                                    </div>
                                </div>
                                <!-- <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email"  >
                                        <label class="form-label"> Driver Email </label>
                                    </div>
                                </div> -->
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="contact_personname" required>
                                        <label class="form-label">Vendor Contact Person FullName</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="contact_personnumber"  required>
                                        <label class="form-label">Vendor Contact Perosn Phone </label>
                                    </div>                                    
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="email" required>
                                        <label class="form-label">Vendor Official Email</label>
                                    </div>                                    
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="address"  required>
                                        <label class="form-label">Vendor Official Address</label>
                                    </div>                                    
                            </div>
                                <div class="form-group form-float">
                                    <div class="form-line col-lg-6">
                                        <input type="datetime" class="form-control" name="date" value="<?php date_default_timezone_set("Africa/Lagos");
                                        echo($time) ?>" disabled="">
                                        <label class="form-label">DATE </label>
                                    </div>
                                </div>                                
                                <button class="btn btn-primary waves-effect" type="submit" name="indicate">SAVE</button>
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
<?php ; ?>
</html>