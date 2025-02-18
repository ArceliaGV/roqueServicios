<?php
// Configuración de la base de datos
$host = "10.0.0.2";
$dbname = "roquebd";
$user = "agv"; // Cambiar si es necesario
$password = "12345"; // Cambiar por la contraseña real

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>