<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conexion a BD
$servidor = "localhost";
$usuario = "root";
$contrasenia = "";
$nombreBaseDatos = "tienda01";
$nombreTabla = "tbimagen";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);

// Consulta datos
if (isset($_GET["consultar"])) {
    $sqlimagenes = mysqli_query($conexionBD, "SELECT * FROM " . $nombreTabla . " WHERE id=" . $_GET["consultar"]);
    if (mysqli_num_rows($sqlimagenes) > 0) {
        $imagenes = mysqli_fetch_all($sqlimagenes, MYSQLI_ASSOC);
        echo json_encode($imagenes);
        exit();
    } else {
        echo json_encode(["success" => 0]);
    }
}
// Borrar con el id
if (isset($_GET["borrar"])) {
    $sqlimagenes = mysqli_query($conexionBD, "DELETE FROM $nombreTabla WHERE id=" . $_GET["borrar"]);
    if ($sqlimagenes) {
        echo json_encode(["success" => 1]);
        exit();
    } else {
        echo json_encode(["success" => 0]);
    }
}

// Inserta un nuevo registro
if(isset($_GET["insertar"])){
    $imagen = $_FILES['imagen'];
    $descripcion = $_POST['descripcion'];
    $nombreArchivo = basename($imagen['name']);
    $rutaArchivo = "img/" . $nombreArchivo;
    move_uploaded_file($imagen['tmp_name'], $rutaArchivo);

    if (!empty($nombreArchivo) && !empty($descripcion)) {
        $sqlimagenes = mysqli_query($conexionBD, "INSERT INTO $nombreTabla(imagen, descripcion) VALUES('$nombreArchivo', '$descripcion')");
        echo json_encode(["success" => 1]);
        exit();
    }
}

// actualizar imagen
if(isset($_GET["actualizar"])){
    $data = json_decode(file_get_contents("php://input"));
    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
    $imagen = $_FILES['imagen'];
    $descripcion = $_POST['descripcion'];

    $nombreArchivo = basename($imagen['name']);
    $rutaArchivo = "img/" . $nombreArchivo;
    move_uploaded_file($imagen['tmp_name'], $rutaArchivo);
    
    $sqlimagenes = mysqli_query($conexionBD,"UPDATE $nombreTabla SET imagen='$nombreArchivo',descripcion='$descripcion' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}



// Consulta todos los registros de la tabla tbimagen
$sqlimagenes = mysqli_query($conexionBD, "SELECT * FROM $nombreTabla");
if (mysqli_num_rows($sqlimagenes) > 0) {
    $imagenes = mysqli_fetch_all($sqlimagenes, MYSQLI_ASSOC);

    foreach ($imagenes as &$imagen) {
        $imagen['imagen'] = 'http://localhost/tienda01/img/' . $imagen['imagen'];
    }

    echo json_encode($imagenes);
} else {
    echo json_encode(["success" => 0]);
}

if (isset($_GET["consultar"])){
    $sqlimagenes = mysqli_query($conexionBD,"SELECT * FROM tbimagen WHERE id=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlimagenes) > 0){
        $imagen = mysqli_fetch_all($sqlimagenes,MYSQLI_ASSOC);
        echo json_encode($imagen);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
?>