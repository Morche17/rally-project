<?php
include 'connect.php'; // Archivo de configuración de la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rol = $_POST['role']; // Captura el rol del formulario

    // Validar que los campos no estén vacíos
    if (!empty($username) && !empty($password) && !empty($rol)) {
        // No encriptar la contraseña, simplemente usarla como texto plano
        $plain_password = $password; // Guardar la contraseña como texto plano

        // Preparar la consulta para insertar el usuario en la base de datos
        $sql = "INSERT INTO usuarios (username, password, rol) VALUES (?, ?, ?)"; // Asegúrate de que la tabla tenga el campo 'rol'

        if ($stmt = $conn->prepare($sql)) {
            // Vincular los parámetros
            $stmt->bind_param("sss", $username, $plain_password, $rol); // Agregar $rol

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Redirigir al index.html después del registro exitoso
                header("Location: ../index.html");
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
