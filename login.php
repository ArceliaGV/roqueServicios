<?php
require_once "db.php"; // Importa la conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email =:email");
        $stmt->execute(['email' =>$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            echo "Login exitoso. Bienvenido, " . htmlspecialchars($email);
        } else {
            echo "Credenciales incorrectas.";
        }
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
}
}
?>