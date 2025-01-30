<?php
$servername = "localhost";
$username = "root";  // Nombre de usuario
$password = "";  // Contraseña (vacía por defecto)
$dbname = "encuesta";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sexo = $_POST["sexo"];
    $edad = $_POST["edad"];
    $direccion = $_POST["direccion"];
    $campo1 = $_POST["campo1"];
    $campo2 = $_POST["campo2"];
    $campo3 = $_POST["campo3"];
    $campo4 = $_POST["campo4"];
    $campo5 = $_POST["campo5"];
    $campo6 = $_POST["campo6"];
    $campo7 = $_POST["campo7"];
    $campo8 = $_POST["campo8"];
    $campo9 = $_POST["campo9"];
    $campo10 = $_POST["campo10"];

    $sql = "INSERT INTO respuestas (sexo, edad, direccion, campo1, campo2, campo3, campo4, campo5, campo6, campo7, campo8, campo9, campo10)
    VALUES ('$sexo', '$edad', '$direccion', '$campo1', '$campo2', '$campo3', '$campo4', '$campo5', '$campo6', '$campo7', '$campo8', '$campo9', '$campo10')";

    if ($conn->query($sql) === TRUE) {
        header("Location: confirmacion.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
