<?php
/**
 * Database Configuration
 * 
 * Edit credentials sesuai environment:
 * - LOCAL: localhost, root, ""
 * - 000webhost: server_name dari hosting panel
 */

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pkaltim";  // Ganti dengan nama database tim kalian

try {
    // Create PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set error mode to exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set charset to UTF-8
    $conn->exec("set names utf8mb4");
    
    // Connection successful (optional: comment out in production)
    // echo "Connected successfully";
    
} catch(PDOException $e) {
    // Connection failed
    die("Connection failed: " . $e->getMessage());
}

/**
 * Alternative: MySQLi Connection
 * Uncomment jika prefer MySQLi
 */
/*
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8mb4");
*/

?>
