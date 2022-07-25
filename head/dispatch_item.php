<?php
    session_start();
    $role = $_SESSION['role'];
    $user = $_SESSION['username'];
    if(!isset($_SESSION['username']) || $role!="Chairman"){
      header('Location: /fms');
    }

    include ('../conn.php');

    include 'head.php';
    include 'nav.php';

        $time=date("Y-m-d h:i") ;

        if(isset($_POST['receive'])){
    //collecting form inputs using the specified method
    $depart  = mysqli_real_escape_string($db, trim($_POST['depart']));
    $name = mysqli_real_escape_string($db, trim($_POST['name']));
    $desc = mysqli_real_escape_string($db, trim($_POST['desc']));
    $qty = mysqli_real_escape_string($db, trim($_POST['qty']));
    $unit = mysqli_real_escape_string($db, trim($_POST['unit']));
    $folio = mysqli_real_escape_string($db, trim($_POST['folio']));

    //check for empty field
    if(!empty($depart) && !empty($name) && !empty($desc) && !empty($qty) && !empty($unit) && !empty($folio)){

        
        //check for duplicate
        $check= "SELECT COUNT(*) FROM item WHERE depart = '".$depart."' && item_name = '".$name."' && quantity = '".$qty."' && unit = '".$unit."' && description = '".$desc."' && folio = '".$folio."'";


        $sql = mysqli_query($db,$check);
            
        $row = mysqli_fetch_assoc($sql);  

        if($row['COUNT(*)'] == 0) {

            //insert values 
            $query="INSERT INTO item (depart, item_name, description, quantity, unit, folio, receive_date, status, user) VALUES('$depart', '$name', '$desc', '$qty', '$unit', '$folio', '$time', 'despatch', '$user')";
            
            $action= mysqli_query($db, $query);

            if($action){
                $error="<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>
                       DISPATCHED ITEM IS SUCCESSFULLY RECORDED <br> 
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
    <section class="content">
        <div class="container-fluid">
            
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>DESPATCH ITEM FORM</h2>
                        </div>


                            <?php
                                if(isset($error)){
                                    echo $error;
                                }
                            ?>


                        <div class="body">
                            <form id="form_validation" method="POST" action="#">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="depart" required>
                                        <label class="form-label">DEPARTMENT</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" required>
                                        <label class="form-label"> NAME OF ITEM </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="desc" >
                                        <label class="form-label"> DESCRIPTION OF ARTICLE </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="unit" required>
                                        <label class="form-label"> UNIT OF MEASUREMENT </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="qty" required>
                                        <label class="form-label">QUANTITY</label>
                                    </div>                                    
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="folio" >
                                        <label class="form-label">FOLIO</label>
                                    </div>                                    
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line col-lg-6">
                                        <input type="datetime" class="form-control" name="date" value="<?php echo($time) ?>" disabled="">
                                        <label class="form-label">DATE </label>
                                    </div>
                                </div>
                                
                                <button class="btn btn-primary waves-effect" type="submit" name="receive">SAVE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
            
        </div>
    </section>
<?php
    include 'foot.php';
?>