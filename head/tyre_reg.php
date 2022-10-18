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

     if(isset($_POST['tyre'])){

 //collecting form inputs using the specified method

 $vehicle_name  = mysqli_real_escape_string($db, trim($_POST['vehicle_name']));
 $vendor  = mysqli_real_escape_string($db, trim($_POST['vendor']));
 $qty = mysqli_real_escape_string($db, trim($_POST['qty']));
 $rate = mysqli_real_escape_string($db, trim($_POST['rate']));
 $odometer =mysqli_real_escape_string($db, trim($_POST['odometer']));

 //check for empty field

 if(!empty($vehicle_name) && !empty($vendor) && !empty($qty) && !empty($rate) && !empty($odometer)){

     //check for duplicate

     $check= "SELECT COUNT(*) FROM tyre WHERE vehicle_name = '".$vehicle_name."' && vendor = '".$vendor.
     "' && qty = '".$qty."' && rate = '".$rate."'&& odometer = '".$odometer."'";

     $sql = mysqli_query($db,$check);
         
     $row = mysqli_fetch_assoc($sql);  

     if($row['COUNT(*)'] == 0) {

         //insert values 
         $query="INSERT INTO tyre (vehicle_name, vendor, qty, rate, odometer, user, date) 
         VALUES('$vehicle_name', '$vendor', '$qty', '$rate', '$odometer', '$user', '$time')";
         
         $action= mysqli_query($db, $query);
            if($action){
                $error="<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>
                     TYRE REGISTRATION SAVED SUCCESSFULLY <br> 
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
                            <h2>TYRE PURCHASE</h2> 
                       </div>

                            <?php
                                if(isset($error)){
                                    echo $error;
                                }
                            ?>

                        <div class="body">
                            <form id="form_validation" method="POST" action="tyre_reg.php" name="tyre">
                                
                                <div class="form-group form-float form-line">
                                    <select class="form-control show-tick" name="vehicle_name" required>
                                        <option >Please select a vehicle</option>
                                        <?php
                                            // $vehicle = mysqli_query($db, "SELECT name FROM vehicle");  // Use select query here 

                                            // while($data = mysqli_fetch_array($vehicle))
                                            // {
                                            //     echo "<option value='". $data['name'] ."'>" .$data['name'] ."</option>";  // displaying data in option menu
                                            // }   
                                            $vehicle = mysqli_query($db, "SELECT vehicle_name FROM vehicle") ;
                                                
                                            while ($data = mysqli_fetch_array($vehicle)) {
                                                    echo "<option value='".$data['vehicle_name']. "'>" .$data['vehicle_name']."</option>";
                                            }
                                            ?>

                                    </select>
                                </div>
                                <div class="form-group form-float form-line">
                                    <select class="form-control show-tick" name="vendor" required>
                                        <option >Please select a Vendor</option>
                                        <?php
                                            // $driver = mysqli_query($db, "SELECT name From driver");  // Use select query here 

                                            // while($data = mysqli_fetch_array($driver))
                                            // {
                                            //     echo "<option value='". $data['name'] ."'>" .$data['name'] ."</option>";  // displaying data in option menu
                                            // }
                                            $vendor = mysqli_query($db, "SELECT vendor_name FROM vendor");  // Use select query here 

                                            while($data = mysqli_fetch_array($vendor))
                                            {
                                                echo "<option value='". $data['vendor_name'] ."'>" .$data['vendor_name'] ."</option>";  // displaying data in option menu
                                            }   
                                            ?>

                                    </select>
                                </div>


                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="qty" required>
                                        <label class="form-label">Tyre Quantity  </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="rate" >
                                        <label class="form-label"> Rate  </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="odometer" >
                                        <label class="form-label"> Vehicle odometer  </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line col-lg-6">
                                        <input type="datetime" class="form-control" name="date" value="<?php echo($time) ?>" disabled="">
                                        <label class="form-label">DATE </label>
                                    </div>
                                </div>
                                
                                <button class="btn btn-success waves-effect" type="submit" name="tyre">SAVE</button>
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