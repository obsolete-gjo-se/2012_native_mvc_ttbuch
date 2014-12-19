<?php
require_once '../../application/bootstrap.php';

$dbh = new entities\person\Person();
try {
    $dbh->deletePerson();
}
catch (error\myException $e) {
    echo $e->myMessage();
}