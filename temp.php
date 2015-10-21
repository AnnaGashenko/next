<?php
error_reporting(-1);
ini_set('display_errors',1);
header('Content-Type: text/html; charset=utf-8');
session_start();

echo '<pre>';
print_r($_COOKIE);
print_r($_SESSION);
echo '</pre>';