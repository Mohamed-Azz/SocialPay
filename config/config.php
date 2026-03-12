<?php
// Define the base URL and subfolder dynamically
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$scriptName = $_SERVER['SCRIPT_NAME'];
$baseDir = str_replace('/index.php', '', $scriptName);

define('APPROOT', dirname(dirname(__FILE__)));
define('URLROOT', $protocol . "://" . $host . $baseDir);
define('SITENAME', 'منصة الخدمات الاجتماعية');
