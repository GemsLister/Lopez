<!-- 

$serverName = 'localhost';
$userName = 'root';
$password = '';
$databaseName = 'crud';

$conn = new mysqli($serverName, $userName, $password, $databaseName);

try{
    $pdo = new PDO("mysql:host=$serverName; dbname=$databaseName", $userName, $password);
}
catch(PDOException $e){
    die('Database Connection Failed:' . $e->getMessage());
}

echo('Database Connection Successful');
?> -->

<?php
$serverName = 'localhost';
$userName = 'root';
$password = '';
$databaseName = 'crud';

try {
    $pdo = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
    // Set error mode to exception for better debugging
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'Database Connection Successful';
} 
catch (PDOException $e) {
    die('Database Connection Failed: ' . $e->getMessage());
}
?>
