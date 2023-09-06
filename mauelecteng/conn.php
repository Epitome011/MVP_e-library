
;l<?php
session_start();
$hostname = 'localhost';
$hostuname = 'annong';
$hostpass = '07067579920';
$dbname = 'docsy';

$mysqli = new mysqli($hostname, $hostuname, $hostpass, $dbname) or die(mysqli_error($mysqli));

?>