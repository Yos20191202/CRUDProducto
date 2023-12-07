<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos con usuario, contraseña y nombre de la BD
$servidor = "localhost";
$usuario = "root";
$contrasenia = "";
$nombreBaseDatos = "tienda01";

$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);

// Función para ejecutar consultas y manejar la respuesta en formato JSON
function ejecutarConsulta($sqlQuery, $successMessage = "success") {
    global $conexionBD;

    $result = mysqli_query($conexionBD, $sqlQuery);

    if ($result) {
        echo json_encode([$successMessage => 1]);
    } else {
        echo json_encode([$successMessage => 0]);
    }

    exit();
}

// Operaciones CRUD para la tabla Producto

if (isset($_GET["consultar_producto"])) {
    $sqlProducto = mysqli_query($conexionBD, "SELECT * FROM producto WHERE id=" . $_GET["consultar_producto"]);
    if (mysqli_num_rows($sqlProducto) > 0) {
        $productos = mysqli_fetch_all($sqlProducto, MYSQLI_ASSOC);
        echo json_encode($productos);
        exit();
    } else {
        echo json_encode(["success" => 0]);
    }
}

if (isset($_GET["borrar_producto"])) {
    ejecutarConsulta("DELETE FROM producto WHERE id=" . $_GET["borrar_producto"], "success_producto");
}

if (isset($_GET["insertar_producto"])) {
    $data = json_decode(file_get_contents("php://input"));
    $nombre = $data->nombre;
    $descripcion = $data->descripcion;
    $talla = $data->talla;
    $estilo = $data->estilo;
    $f_img = $data->f_img;
    $f_cat = $data->f_cat;

    if (($nombre != "") && ($descripcion != "") && ($talla != "") && ($estilo != "") && ($f_img != "") && ($f_cat != "")) {
        ejecutarConsulta("INSERT INTO producto(nombre, descripcion, talla, estilo, f_img, f_cat) VALUES('$nombre','$descripcion','$talla','$estilo','$f_img','$f_cat')", "success_producto");
    }
}

if (isset($_GET["actualizar_producto"])) {
    $data = json_decode(file_get_contents("php://input"));
    $id = (isset($data->id)) ? $data->id : $_GET["actualizar_producto"];
    $nombre = $data->nombre;
    $descripcion = $data->descripcion;
    $talla = $data->talla;
    $estilo = $data->estilo;
    $f_img = $data->f_img;
    $f_cat = $data->f_cat;

    ejecutarConsulta("UPDATE producto SET nombre='$nombre', descripcion='$descripcion', talla='$talla', estilo='$estilo', f_img='$f_img', f_cat='$f_cat' WHERE id='$id'", "success_producto");
}

// Operaciones CRUD para la tabla Categoria

if (isset($_GET["consultar_categoria"])) {
    $sqlCategoria = mysqli_query($conexionBD, "SELECT * FROM categoria WHERE id_cat=" . $_GET["consultar_categoria"]);
    if (mysqli_num_rows($sqlCategoria) > 0) {
        $categorias = mysqli_fetch_all($sqlCategoria, MYSQLI_ASSOC);
        echo json_encode($categorias);
        exit();
    } else {
        echo json_encode(["success" => 0]);
    }
}

if (isset($_GET["borrar_categoria"])) {
    ejecutarConsulta("DELETE FROM categoria WHERE id_cat=" . $_GET["borrar_categoria"], "success_categoria");
}

if (isset($_GET["insertar_categoria"])) {
    $data = json_decode(file_get_contents("php://input"));
    $descripcion = $data->descripcion;
    $img_cat = $data->img_cat;

    if (($descripcion != "") && ($img_cat != "")) {
        ejecutarConsulta("INSERT INTO categoria(descripcion, img_cat) VALUES('$descripcion','$img_cat')", "success_categoria");
    }
}

if (isset($_GET["actualizar_categoria"])) {
    $data = json_decode(file_get_contents("php://input"));
    $id = (isset($data->id)) ? $data->id : $_GET["actualizar_categoria"];
    $descripcion = $data->descripcion;
    $img_cat = $data->img_cat;

    ejecutarConsulta("UPDATE categoria SET descripcion='$descripcion', img_cat='$img_cat' WHERE id_cat='$id'", "success_categoria");
}

// Operaciones CRUD para la tabla Imagen

if (isset($_GET["consultar_imagen"])) {
    $sqlImagen = mysqli_query($conexionBD, "SELECT * FROM imagen WHERE id_img=" . $_GET["consultar_imagen"]);
    if (mysqli_num_rows($sqlImagen) > 0) {
        $imagenes = mysqli_fetch_all($sqlImagen, MYSQLI_ASSOC);
        echo json_encode($imagenes);
        exit();
    } else {
        echo json_encode(["success" => 0]);
    }
}

if (isset($_GET["borrar_imagen"])) {
    ejecutarConsulta("DELETE FROM imagen WHERE id_img=" . $_GET["borrar_imagen"], "success_imagen");
}

if (isset($_GET["insertar_imagen"])) {
    $data = json_decode(file_get_contents("php://input"));
    $img = $data->img;
    $descripcion = $data->descripcion;

    if (($img != "") && ($descripcion != "")) {
        ejecutarConsulta("INSERT INTO imagen(img, descripcion) VALUES('$img','$descripcion')", "success_imagen");
    }
}

if (isset($_GET["actualizar_imagen"])) {
    $data = json_decode(file_get_contents("php://input"));
    $id = (isset($data->id)) ? $data->id : $_GET["actualizar_imagen"];
    $img = $data->img;
    $descripcion = $data->descripcion;

    ejecutarConsulta("UPDATE imagen SET img='$img', descripcion='$descripcion' WHERE id_img='$id'", "success_imagen");
}

// Si no se ha realizado ninguna operación, se consulta la tabla Producto

$sqlProductos = mysqli_query($conexionBD, "SELECT * FROM producto ");
if (mysqli_num_rows($sqlProductos) > 0) {
    $productos = mysqli_fetch_all($sqlProductos, MYSQLI_ASSOC);
    echo json_encode($productos);
} else {
    echo json_encode([["success" => 0]]);
}
?>