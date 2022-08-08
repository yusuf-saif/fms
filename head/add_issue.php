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
 $vehicle_name  = mysqli_real_escape_string($db, trim($_POST['vehicle_name']));
 $driver_name  = mysqli_real_escape_string($db, trim($_POST['driver_name']));
 $issue_title = mysqli_real_escape_string($db, trim($_POST['issue_tilte']));
 $issue_description = mysqli_real_escape_string($db, trim($_POST['issue_description']));

 
 //check for empty field
 if(!empty($vehicle_name) && !empty($driver_name) && !empty($issue_title) && !empty($issue_description)){

     
     //check for duplicate
     $check= "SELECT COUNT(*) FROM indicate WHERE issue_vehicle = '".$vehicle_name."' && vehicle_name = '".$driver_name."' && driver_name= '".$issue_title."' && issue_title = '".$issue_description."'&& issue_description ='";


     $sql = mysqli_query($db,$check);
         
     $row = mysqli_fetch_assoc($sql);  

     if($row['COUNT(*)'] == 0) {

         //insert values 
         $query="INSERT INTO issue_vehicle (vehicle_name, driver_name, issue_title, issue_description, date) VALUES('$vehicle_name', '$driver_name', '$issue_title', '$issue_description', '$time')";
         
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
                                
                                <div class="form-group form-float form-line">
                                    <select class="form-control show-tick" name="state" required>
                                        <option >Please select a vehicle</option>
                                        <?php
                                            // $vehicle = mysqli_query($db, "SELECT name From vehicle");  // Use select query here 

                                            // while($data = mysqli_fetch_array($vehicle))
                                            // {
                                            //     echo "<option value='". $data['name'] ."'>" .$data['name'] ."</option>";  // displaying data in option menu
                                            // }   
                                            ?>

                                    </select>
                                </div>
                                <div class="form-group form-float form-line">
                                    <select class="form-control show-tick" name="state" required>
                                        <option >Please select a Driver</option>
                                        <?php
                                            // $driver = mysqli_query($db, "SELECT name From driver");  // Use select query here 

                                            // while($data = mysqli_fetch_array($driver))
                                            // {
                                            //     echo "<option value='". $data['name'] ."'>" .$data['name'] ."</option>";  // displaying data in option menu
                                            // }   
                                            ?>

                                    </select>
                                </div>


                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="issuename" required>
                                        <label class="form-label">Issue tittle  </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="textarea" class="form-control" name="issuedescription" >
                                        <label class="form-label"> Desciption </label>
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