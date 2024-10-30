<?php
include_once('../../../../wp-load.php');
$ilmp_lat = $_POST['ilmpLat'];
$ilmp_lng = $_POST['ilmpLng'];
update_option('ilmp_lat', $ilmp_lat);
update_option('ilmp_lng', $ilmp_lng);
?>