<?php
require_once "db.php"; // Importa la conexión

try {
// Crear la tabla si no existe
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    );";
    $pdo->exec($sql);

    // Insertar un usuario de prueba si no existe
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute(['galanor@example.com']);
    $exists = $stmt->fetchColumn();

    if ($exists == 0) {
        $hashedPassword = password_hash("12345", PASSWORD_DEFAULT); // Cifrar la contraseña
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["galanor@example.com", $hashedPassword]);
        echo "Usuario de prueba agregado.";
    } else {
        echo "El usuario ya existe.";
    }
} catch (PDOException $e) {
    die("Error en la base de datos: " . $e->getMessage());
}
?>