<?php
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='';
$DATABASE='wms-2.o';

$con=mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,$DATABASE,3309);

if($con===false){
    die("connection error");
}

?>