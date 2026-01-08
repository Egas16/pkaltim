<?php
/**
 * Database Configuration
 * Contoh Mini Project - Wisata Kaltim
 */

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pkaltim_contoh";

try {
    // Create PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set error mode to exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set charset to UTF-8
    $conn->exec("set names utf8mb4");
    
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Session start for authentication
session_start();
?>
