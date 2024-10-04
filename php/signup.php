<?php
include 'config.php'; // Archivo de configuración de la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar que los campos no estén vacíos
    if (!empty($username) && !empty($password)) {
        // Encriptar la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta para insertar el usuario en la base de datos
        $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Vincular los parámetros
            $stmt->bind_param("ss", $username, $hashed_password);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Redirigir al index.html después del registro exitoso
                header("Location: index.html");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            // Cerrar la sentencia
            $stmt->close();
        }
    } else {
        echo "Por favor, complete todos los campos.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
