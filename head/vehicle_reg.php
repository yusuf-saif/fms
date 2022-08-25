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

    if(isset($_POST['vehicle'])){
// collecting form inputs using the specified method
//  $state  = mysqli_real_escape_string($db, trim($_POST['state']));
 $vehicle_name  = mysqli_real_escape_string($db, trim($_POST['vehicle_name']));
 $vehicle_type = mysqli_real_escape_string($db, trim($_POST['vehicle_type']));
 $model = mysqli_real_escape_string($db, trim($_POST['model']));
 $plate_number = mysqli_real_escape_string($db, trim($_POST['plate_number']));
 $chasis_number = mysqli_real_escape_string($db, trim($_POST['chasis_number']));
 $manufacture_by = mysqli_real_escape_string($db, trim($_POST['manufacture_by']));
 $security_number = mysqli_real_escape_string($db, trim($_POST['security_number']));
  $asset_number = mysqli_real_escape_string($db, trim($_POST['asset_number']));

//check for empty field
 if(!empty($vehicle_name) && !empty($vehicle_type) && !empty($model) && !empty($plate_number) 
 && !empty($chasis_number) && !empty($manufacture_by) && !empty($security_number) && !empty($asset_number)){

     
     //check for duplicate
     $check= "SELECT COUNT(*) FROM vehicle WHERE vehicle_name = '".$vehicle_name."' && vehicle_type = '".$vehicle_type.
     "' && model = '".$model."' && plate_number = '".$plate_number."'&& chasis_number = '".$chasis_number."'&& manufacture_by = '".$manufacture_by. "' && security_number = '".$security_number."' && asset_number = '".$asset_number."'";


     $sql = mysqli_query($db,$check);
         
     $row = mysqli_fetch_assoc($sql);  

     if($row['COUNT(*)'] == 0) {

         //insert values 
         $query="INSERT INTO vehicle (vehicle_name, vehicle_type, model, plate_number, chasis_number, manufacture_by, security_number, asset_number, date) 
         VALUES( '$vehicle_name', '$vehicle_type', '$model', '$plate_number', '$chasis_number',  '$manufacture_by', '$security_number', '$asset_number',  '$time')";
            
            $action= mysqli_query($db, $query);
            if($action){
                $error="<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>
                        INDICATOR SAVED SUCCESSFULLY <br> 
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
//  print_r($_POST);

?>
    <section class="content">
        <div class="container-fluid">            

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>VEHICLE REGISTRATION</h2>
                        </div>

                            <?php
                                if(isset($error)){
                                    echo $error;
                                }
                            ?>

                        <div class="body">
                            <form id="form_validation" method="POST" action="vehicle_reg.php" name="vehicle">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="vehicle_name" required>
                                        <label class="form-label"> Vehicle Name </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="vehicle_type" >
                                        <label class="form-label"> Vehicle Type </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="model">
                                        <label class="form-label">Vehicle model</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="plate_number" required>
                                        <label class="form-label">PlateNumber</label>
                                    </div>                                    
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="chasis_number" required>
                                        <label class="form-label">Chasis Number</label>
                                    </div>                                    
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="manufacture_by">
                                        <label class="form-label">Manufacturer</label>
                                    </div>                                    
                            </div>
                            <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="security_number" required>
                                        <label class="form-label">Vehicle Security Number</label>
                                    </div>                                    
                                </div>   
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="asset_number">
                                        <label class="form-label">Asset Number</label>
                                    </div>                                    
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line col-lg-6">
                                        <input type="datetime" class="form-control"  name="date" value="<?php echo($time) ?>" disabled="">
                                        <label class="form-label">DATE </label>
                                    </div>
                                </div>                                
                                <button class="btn btn-primary waves-effect" type="submit" name="vehicle">SAVE</button>
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
<?php
 include '../head/foot.php';
?>