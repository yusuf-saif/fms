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
                            <h2>REPORT: VENDOR REGISTRATION</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>VENDOR  Name</th>
                                            <!-- <th>VENDOR TYPE</th> -->
                                            <th>VENDOR CONTACT PERSON FULL NAME</th>
                                            <th>VENDOR CONTACT PERSON PHONE NUMBER</th>
                                            <th>VENDOR OFFICIAL EMAIL</th>
                                            <th>VENDOR OFFICIAL ADDRESS</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>S/N</th>
                                            <th>VENDOR  Name</th>
                                            <!-- <th>VENDOR TYPE</th> -->
                                            <th>VENDOR CONTACT PERSON FULL NAME</th>
                                            <th>VENDOR CONTACT PERSON PHONE NUMBER</th>
                                            <th>VENDOR OFFICIAL EMAIL</th>
                                            <th>VENDOR OFFICIAL ADDRESS</th>
                                            <th>Date</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>



                            <?php
                                $result = "SELECT * FROM vendor";

                                $query = mysqli_query($db, $result);
                                    $sn = 0;
                                while($row = mysqli_fetch_array($query))
                                    {
                                        $sn++;
                                        $vendor_name=$row['vendor_name'];
                                        $contact_personname=$row['contact_perosnname'];
                                        $contact_personnumber=$row['contact_personnumber'];
                                        $email=$row['email'];
                                        $address =$row['address'];
                                        $date=$row['date'];

                                        echo "<tr>";
                                        echo "<td> $sn </td>";
                                        echo"<td> $vendor_name </td>";
                                        echo "<td> $contacft_perosnname </td>";
                                       echo "<td> $contact_perosnnumber </td>";
                                        echo "<td> $email </td>";
                                        echo"<td> $address</td>";
                                        echo "<td> $date </td>";
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
    <?php mysqli_close($db);  // close connection ?>

    <!-- Jquery Core Js -->
<script src="../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../plugins/node-waves/waves.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- Custom Js -->
<script src="../js/admin.js"></script>
<script src="../js/pages/tables/jquery-datatable.js"></script>

<!-- Demo Js -->
<script src="../js/demo.js"></script>


    </body>

</html> -->
