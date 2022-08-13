<?php
    session_start();
    $role = $_SESSION['role'];
    if(!isset($_SESSION['username']) || $role!="Chairman"){
      header('Location: /fms');
    }

    include '../conn.php';
    include 'head.php';
    include 'nav.php';
  //  include 'links.php';
?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>REPORT</h2>
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>REPORT: VEHICLE REGISTRATION</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>VEHICLE NAME</th>
                                            <th>VEHICLE TYPE</th>
                                            <th>VEHICLE MODEL</th>
                                            <th>PLATENUMBER</th>
                                            <th>ENGINE NUMBER</th>
                                            <th>MANUFACTURER</th>
                                            <th>MAKE</th>
                                            <th>SECURITY NUMBER</th>
                                            <th>DATE</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>S/N</th>
                                            <th>VEHICLE NAME</th>
                                            <th>VEHICLE TYPE</th>
                                            <th>VEHICLE MODEL</th>
                                            <th>PLATENUMBER</th>
                                            <th>ENGINE NUMBER</th>
                                            <th>MANUFACTURER</th>
                                            <th>MAKE</th>
                                            <th>SECURITY NUMBER</th>
                                            <th>DATE</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>



                            <?php
                                $result = "SELECT * FROM vehicle";

                                $query = mysqli_query($db, $result);
                                    $sn = 0;
                                while($row = mysqli_fetch_array($query))
                                    {
                                        $sn++;
                                        $vehicle_name=$row['vehicle_name'];
                                        $vehicle_type=$row['vehicle_type'];
                                        $model=$row['model'];
                                        $plate_number=$row['plate_number'];
                                        $eng_number=$row['eng_number'];
                                        $manufacture_by=$row['manufacture_by'];
                                        $make=$row['make'];
                                        $security_number=$row['security_number'];
                                        $date=$row['date'];

                                        echo "<tr>";
                                        echo "<td> $sn </td>";
                                        echo "<td> $vehicle_name </td>";
                                        echo "<td> $vehicle_type </td>";
                                        // echo "<td> $programme </td>";
                                        echo "<td> $model </td>";
                                        echo "<td> $plate_number </td>";
                                       echo "<td> $eng_number </td>";
                                        echo "<td> $manufacture_by </td>";
                                        echo "<td> $make </td>";
                                        echo "<td> $security_number </td>";
                                        echo "<td> $date </td>";

                                        echo "<td>  </td>";
                                        echo "</tr>";
                                    }
                            ?>                                        

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
    <?php
 include '../head/foot.php';
?>