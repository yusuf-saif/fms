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

    if(isset($_POST['tyre'])){
// collecting form inputs using the specified method
 $state  = mysqli_real_escape_string($db, trim($_POST['state']));
 $vehicle  = mysqli_real_escape_string($db, trim($_POST['vehicle']));
 $vendor = mysqli_real_escape_string($db, trim($_POST['vendor']));
 $quantity = mysqli_real_escape_string($db, trim($_POST['quantity']));
 $rate = mysqli_real_escape_string($db, trim($_POST['rate']));
 $odemeter = mysqli_real_escape_string($db, trim($_POST['odemeter']));
 $purchase_date = mysqli_real_escape_string($db, trim($_POST['purchase_date']));
//check for empty field
//  if(!empty($vehicle) && !empty($vendor) && !empty($quantity) && !empty($rate) 
//  && !empty($odemeter) && !empty($purchase_date)){

     
    //  check for duplicate
    //  $check= "SELECT COUNT(*) FROM tyre WHERE vehicle = '".$vehicle_name."' && vendor = '".$vendor.
    //  "' && quantity = '".$quantity."' && rate = '".$rate."'&& odemeter = '".$odemeter."'&& purchase_date = '".$purchase_date."'";


     $sql = mysqli_query($db,$check);
         
     $row = mysqli_fetch_assoc($sql);  

     if($row['COUNT(*)'] == 0) {

         //insert values 
         $query="INSERT INTO tyre (vehicle, vendor, quantity, tyre_number, rate, odemeter, purchase_date, date) 
         VALUES( '$vehicle', '$vendor', '$quantity', '$tyre_number', '$rate', '$odemeter',  '$purchase_date', '$file_upload',  '$time')";
            
            $action= mysqli_query($db, $query);
    //         if($action){
    //             $error="<div class='alert alert-success alert-dismissable'>
    //             <button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>
    //                     INDICATOR SAVED SUCCESSFULLY <br> 
    //                 </div> "; 
    //         }
    //         else{
    //             $error="<div class='alert alert-danger alert-dismissable'>
    //             <button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>
    //                    Error in Data Entry <br>
    //                    Please Contact The Web Admin
    //                 </div>";
    //             }
    //     }
    //     else{
    //         $error="<div class='alert alert-danger alert-dismissable'>
    //         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    //             SORRY DUPLICATION IS NOT ALLOWED <br>
    //             </div>";
    //     }
    // }
    // else{
    
    //     $error="<div class='alert alert-danger alert-dismissable'>
    //         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    //         PLEASE KINDLY FILL ALL REQUIRED FIELDS
    //     </div>";

    //     }
 }
 }
//}
//  print_r($_POST);

?>
    <section class="content">
        <div class="container-fluid">            

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>TYRE REGISTRATION</h2>
                        </div>

                            <?php
                                if(isset($error)){
                                    echo $error;
                                }
                            ?>

                            <div class="form-group form-float form-line">
                                    <select class="form-control show-tick" name="vehicle" required>
                                        <option >Please select a vehicle</option>
                                        //<?php
                                            //$state = mysqli_query($db, "SELECT name From state");  // Use select query here 

                                           // while($data = mysqli_fetch_array($state))
                                           // {
                                               // echo "<option value='". $data['name'] ."'>" .$data['name'] ."</option>";  // displaying data in option menu
                                           // }   
                                            //?>

                                    </select>
                                </div>
                                <div class="form-group form-float form-line">
                                    <select class="form-control show-tick" name="vendor" required>
                                        <option >Please select a vendor</option>
                                        //<?php
                                            //$state = mysqli_query($db, "SELECT name From state");  // Use select query here 

                                           // while($data = mysqli_fetch_array($state))
                                            //{
                                               // echo "<option value='". $data['name'] ."'>" .$data['name'] ."</option>";  // displaying data in option menu
                                           // }   
                                            ?>
                                    </select>
                                </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="quantity" required>
                                        <label class="form-label">quantity</label>
                                    </div>
                                </div>

                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="rate" required>
                                        <label class="form-label">rate</label>
                                    </div>                                    
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="odemeter" required>
                                        <label class="form-label">odemeter</label>
                                    </div>                                    
                            </div>
                            <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="date" class="form-control" required>
                                        <label class="form-label">purchase date</label>
                                    </div>                                    
                                </div>                          
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line col-lg-6">
                                        <input type="datetime" class="form-control" name="date" value="<?php echo($time) ?>" disabled="">
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

    <table>
<?php 


    // foreach ($_POST as $key => $value) {
    //     echo "<tr>";
    //     echo "<td>";
    //     echo $key;
    //     echo "</td>";
    //     echo "<td>";
    //     echo $value;
    //     echo "</td>";
    //     echo "<td>";
    //     echo $key;
    //     echo "</td>";
    //     echo "<td>";
    //     echo $value;
    //     echo "</td>";
    //      echo "</tr>";
    // }


?>
</table>
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