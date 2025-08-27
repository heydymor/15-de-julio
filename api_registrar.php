<?php
// Incluir la conexión a la base de datos
include("con_db.php");

// Indicar que la respuesta será en formato JSON
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *"); // Permite peticiones desde cualquier origen (ajustar en producción)
header("Access-Control-Allow-Methods: POST"); // Métodos permitidos

// Obtener los datos enviados en el cuerpo de la petición (en formato JSON)
$data = json_decode(file_get_contents("php://input"));

// Validar que los datos no estén vacíos
if (!empty($data->name) && !empty($data->email)) {
    
    // Asignar los datos a variables
    $name = trim($data->name);
    $email = trim($data->email);
    $fechareg = date("d/m/y");

    // Preparar la consulta para evitar inyección SQL (más seguro)
    $consulta = "INSERT INTO datos(nombre, email, fecha_reg) VALUES ('$name', '$email', '$fechareg')";
    $resultado = mysqli_query($conex, $consulta);

    if ($resultado) {
        // Si la inserción fue exitosa, enviar respuesta JSON de éxito
        http_response_code(201); // 201 Creado
        echo json_encode(["status" => "success", "message" => "¡Te has inscripto correctamente!"]);
    } else {
        // Si hubo un error en la base de datos
        http_response_code(500); // 500 Error Interno del Servidor
        echo json_encode(["status" => "error", "message" => "¡Ups ha ocurrido un error al guardar!"]);
    }

} else {
    // Si los datos están incompletos
    http_response_code(400); // 400 Petición incorrecta
    echo json_encode(["status" => "error", "message" => "¡Por favor complete los campos!"]);
}
?>