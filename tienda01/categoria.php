<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "tienda01";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);


// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sqlCategoria = mysqli_query($conexionBD,"SELECT * FROM categoria WHERE id=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlCategoria) > 0){
        $categoria = mysqli_fetch_all($sqlCategoria,MYSQLI_ASSOC);
        echo json_encode($categoria);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])){
    $sqlCategoria = mysqli_query($conexionBD,"DELETE FROM categoria WHERE id=".$_GET["borrar"]);
    if($sqlCategoria){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Inserta un nuevo registro y recepciona en método post los datos de tipo y descripcion
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $tipo=$data->tipo;
    $descripcion=$data->descripcion;
        if(($descripcion!="")&&($tipo!="")){
            
    $sqlCategoria = mysqli_query($conexionBD,"INSERT INTO categoria(tipo,descripcion) VALUES('$tipo','$descripcion') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
    $tipo=$data->tipo;
    $descripcion=$data->descripcion;
    
    $sqlCategoria = mysqli_query($conexionBD,"UPDATE categoria SET tipo='$tipo',descripcion='$descripcion' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Consulta todos los registros de la tabla empleados
$sqlCategoria = mysqli_query($conexionBD,"SELECT * FROM categoria ");
if(mysqli_num_rows($sqlCategoria) > 0){
    $categoria = mysqli_fetch_all($sqlCategoria,MYSQLI_ASSOC);
    echo json_encode($categoria);
}
else{ echo json_encode([["success"=>0]]); }

if (isset($_GET["actualizar_categoria"])) {
    $data = json_decode(file_get_contents("php://input"));
    $id = (isset($data->id)) ? $data->id : $_GET["actualizar_categoria"];
    $descripcion = $data->descripcion;
    $tipo = $data->tipo;

    ejecutarConsulta("UPDATE categoria SET descripcion='$descripcion', tipo='$tipo' WHERE id='$id'", "success_categoria");
}

?>
