<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// $db = mysqli_connect("localhost", "root", "", "fms_db");

// if (!$db) {
//     die("ERROR: " . mysqli_connect_error);
// } else {
//     return true;
// }


$db= new mysqli('localhost', 'root', '', 'fms_db')
or die("Could not connect to mysql".mysqli_error($con));
?>
