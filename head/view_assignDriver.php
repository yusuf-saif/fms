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
                <h2> REPORT</h2>
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>REPORT: DRIVER-VEHICLE ASSIGNMENT REGISTRATION</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>DRIVER  NAME</th>
                                            <th> ASSIGNED VEHICLE</th>
                                            <th>STARTING ODOMETER</th>
                                            <th>COMMENTS</th>
                                            <th>Date</th>
                                            <th>User</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>S/N</th>
                                            <th>DRIVER  NAME</th>
                                            <th>ASSIGNED VEHICLE</th>
                                            <th>STARTING ODOMETER</th>
                                            <th>COMMENTS</th>
                                            <th>Date</th>
                                            <th>User</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>



                            <?php
                                $result = "SELECT * FROM assigndriver";

                                $query = mysqli_query($db, $result);
                                    $sn = 0;
                                while($row = mysqli_fetch_array($query))
                                    {
                                        $sn++; 
                                        $driver_name=$row['driver_name'];
                                        $plate_number=$row['plate_number'];
                                        $odometer=$row['odometer'];
                                        $comment=$row['comment'];
                                        $date=$row['date'];
                                        $user=$row['user'];

                                        echo "<tr>";
                                        echo "<td> $sn </td>";
                                         echo "<td> $driver_name </td>";
                                        echo"<td> $plate_number </td>";
                                        echo "<td> $odometer </td>";
                                        echo "<td> $comment </td>";
                                        echo "<td> $date </td>";
                                        echo"<td> $user</td>";
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