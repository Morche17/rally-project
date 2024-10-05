<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Buscar al usuario en la base de datos
    $sql = "SELECT id, password FROM usuarios WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $plain_password); // Cambiar a $plain_password
            $stmt->fetch();

            // Verificar la contraseña directamente, sin hash
            if ($password === $plain_password) { // Comparar texto plano
                $_SESSION['user_id'] = $id;
                echo 'success';  // Respuesta que indica éxito
            } else {
                echo 'Contraseña incorrecta.';  // Respuesta de error
            }
        } else {
            echo 'El usuario no existe.';  // Respuesta de error
        }
        $stmt->close();
    }
    $conn->close();
}
?>
