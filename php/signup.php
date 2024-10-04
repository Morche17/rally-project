<?php
// Incluir el archivo de configuración de la base de datos
include 'connect.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar que los campos no estén vacíos
    if (!empty($username) && !empty($password)) {
        // Encriptar la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta para insertar el usuario en la base de datos
        $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
        
        // Preparar la sentencia
        if ($stmt = $conn->prepare($sql)) {
            // Vincular los parámetros
            $stmt->bind_param("ss", $username, $hashed_password);
            
            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Usuario registrado exitosamente.";
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
