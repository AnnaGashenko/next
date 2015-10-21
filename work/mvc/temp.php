<?php 
session_start();
echo date('Y-m-d H:i:s');
echo '<pre>';
print_r($_COOKIE);
print_r($_SESSION);
echo '</pre>';