<?php

require_once '../application/bootstrap.php';
require_once '../application/includes/header.php';

require_once '../application/includes/navigation.php';


echo "<h1>Inhalte aus der Bootstrap:</h1> ";
echo "<h3>APP_PATH</h3>" . APPLICATION_PATH;
echo "<h3>APP_ENV</h3>" . APPLICATION_ENV;

echo "<h3>Includepath</h3>" . get_include_path();

echo "<h3>PDO Driver</h3><pre>";
print_r(PDO::getAvailableDrivers());
echo "</pre>";

echo "<h3>PHP Info</h3>" . phpinfo();
require_once '../application/includes/footer.php';