<?php
//$mysqli = new mysqli("localhost", "c0490274_casad", "RA80fazope", "c0490274_casad");
$mysqli = new mysqli("localhost", "root", "", "requeriments");

if($_POST['method']=='getAllUsers'){
    getAllUsers();
}

if($_POST['method']=='findByUser'){
    findByUser();
}

if($_POST['method']=='getAllProducts'){
    getAllProducts();
}

if($_POST['method']=='findByProduct'){
    findByProduct();
}

if($_POST['method']=='getAllRoles'){
    getAllRoles();
}

if($_POST['method']=='getAllMaquinarias'){
    getAllMaquinarias();
}

if($_POST['method']=='getAllMarcas'){
    getAllMarcas();
}

if($_POST['method']=='getAllTipos'){
    getAllTipos();
}

if($_POST['method']=='deleteUser'){
    deleteUser();
}

if($_POST['method']=='findUserById'){
    findUserById();
}

if($_POST['method']=='createUser'){
    createUser();
}

if($_POST['method']=='updateUser'){
    updateUser();
}

if($_POST['method']=='deleteProduct'){
    deleteProduct();
}

if($_POST['method']=='findProductById'){
    findProductById();
}

if($_POST['method']=='createProduct'){
    createProduct();
}

if($_POST['method']=='updateProduct'){
    updateProduct();
}

if($_POST['method']=='getMaquinariasFromProduct'){
    getMaquinariasFromProduct();
}

if($_POST['method']=='getMarcasFromProduct'){
    getMarcasFromProduct();
}

if($_POST['method']=='findUserByUsernameAndPassword'){
    findUserByUsernameAndPassword();
}

if($_POST['method']=='saveImage'){
    saveImage();
}

if($_POST['method']=='findImagesByIdProduct'){
    findImagesByIdProduct();
}

if($_POST['method']=='deleteImage'){
    deleteImage();
}

if($_POST['method']=='deletePhotosByProduct'){
    deletePhotosByProduct();
}

if($_POST['method']=='deleteMachineFromProduct'){
    deleteMachineFromProduct();
}

if($_POST['method']=='deleteMarcaFromProduct'){
    deleteMarcaFromProduct();
}

if($_POST['method']=='addMachineFromProduct'){
    addMachineFromProduct();
}

if($_POST['method']=='addMarcaFromProduct'){
    addMarcaFromProduct();
}

if($_POST['method']=='findMaquinariaNamesByProduct'){
    findMaquinariaNamesByProduct();
}

if($_POST['method']=='findMarcaNamesByProduct'){
    findMarcaNamesByProduct();
}

if($_POST['method']=='getFirstImageProduct'){
    getFirstImageProduct();
}

if($_POST['method']=='getRequeriments'){
    getRequeriments();
}

if($_POST['method']=='createRequeriment'){
    createRequeriment();
}

if($_POST['method']=='deleteRequeriment'){
    deleteRequeriment();
}

if($_POST['method']=='editRequeriment'){
    editRequeriment();
}

function getAllUsers(){
    $query = 'SELECT id, nombre, cedula FROM usuario';
    executeQuery($query);
}

function findByUser(){
    $data = "'%".$_POST['search']."%'";
    $query = 'SELECT id, nombre, cedula FROM usuario WHERE nombre LIKE '.$data.' UNION
        SELECT id, nombre, cedula FROM usuario WHERE cedula LIKE '.$data;
    executeQuery($query);
}

function getAllProducts(){
    $query = 'SELECT id, nombre, codigo, referencia FROM producto';
    executeQuery($query);
}

function findByProduct(){
    $data = "'%".$_POST['search']."%'";
    $query = 'SELECT id, nombre, codigo, referencia FROM producto WHERE nombre LIKE '.$data.' UNION
        SELECT id, nombre, codigo, referencia FROM producto WHERE codigo LIKE '.$data.' UNION
        SELECT id, nombre, codigo, referencia FROM producto WHERE referencia LIKE '.$data.' UNION
        SELECT producto.id, producto.nombre, codigo, referencia FROM producto INNER JOIN producto_has_maquinaria ON producto.id = producto_has_maquinaria.idProducto
          INNER JOIN maquinaria ON producto_has_maquinaria.idMaquinaria = maquinaria.id WHERE maquinaria.nombre LIKE '.$data.' UNION
        SELECT producto.id, producto.nombre, codigo, referencia FROM producto INNER JOIN producto_has_marca ON producto.id = producto_has_marca.idProducto
          INNER JOIN marca ON producto_has_marca.idMarca = marca.id WHERE marca.nombre LIKE '.$data;
    executeQuery($query);
}

function getAllRoles(){
    $query = 'SELECT * FROM rol';
    executeQuery($query);
}

function getAllMaquinarias(){
    $query = 'SELECT * FROM maquinaria';
    executeQuery($query);
}

function getAllMarcas(){
    $query = 'SELECT * FROM marca';
    executeQuery($query);
}

function getAllTipos(){
    $query = 'SELECT * FROM tipo';
    executeQuery($query);
}

function deleteUser(){
    $query = 'DELETE FROM usuario WHERE id= '.$_POST['id'];
    executeQuery($query);
}

function findUserById(){
    $query = 'SELECT * FROM usuario WHERE id='.$_POST['id'];
    executeQuery($query);
}

function createUser(){
    $query = 'INSERT INTO usuario (nombre, cedula, clave, idRol) VALUES (\''.$_POST['nombre'].'\', '.$_POST['cedula'].', '.$_POST['clave'].', '.$_POST['idRol'].')';
    executeQuery($query);
}

function updateUser(){
    $query = 'UPDATE usuario SET nombre=\''.$_POST['nombre'].'\', cedula= '.$_POST['cedula'].', clave= '.$_POST['clave'].', idRol= '.$_POST['idRol'].' WHERE id='.$_POST['id'];
    executeQuery($query);
}

function deleteProduct(){
    $query = 'DELETE FROM producto WHERE id= '.$_POST['id'];
    executeQuery($query);
}

function findProductById(){
    $query = 'SELECT * FROM producto WHERE id='.$_POST['id'];
    executeQuery($query);
}

function createProduct(){
    $query = 'INSERT INTO producto (nombre, codigo, descripcion, marca, idTipo, caracteristicas, referencia)  VALUES (\''.$_POST['nombre'].'\', \''.$_POST['codigo'].'\', \''.$_POST['descripcion'].'\', \''.$_POST['marca'].'\', '.$_POST['idTipo'].', \''.$_POST['caracteristicas'].'\', \''.$_POST['referencia'].'\')';
    executeQuery($query);
}

function updateProduct(){
    $query = 'UPDATE producto SET nombre=\''.$_POST['nombre'].'\', codigo=\''.$_POST['codigo'].'\', descripcion=\''.$_POST['descripcion'].'\', caracteristicas=\''.$_POST['caracteristicas'].'\', marca=\''.$_POST['marca'].'\', referencia=\''.$_POST['referencia'].'\', idTipo= '.$_POST['idTipo'].' WHERE id='.$_POST['id'];
    executeQuery($query);
}

function getMaquinariasFromProduct(){
    $query = 'SELECT idMaquinaria FROM producto_has_maquinaria WHERE idProducto= '.$_POST['id'];
    executeQuery($query);
}
function getMarcasFromProduct(){
    $query = 'SELECT idMarca FROM producto_has_marca WHERE idProducto= '.$_POST['id'];
    executeQuery($query);
}

function findUserByUsernameAndPassword(){
    $query = 'SELECT * FROM usuario WHERE nombre= \''.$_POST['username'].'\' AND clave= \''.$_POST['clave'].'\'';
    executeQuery($query);
}

function saveImage(){
    $query = 'INSERT INTO fotos (idProducto, nombre, fecha, id) VALUES ('.$_POST['idProducto'].', \''.$_POST['nombre'].'\', \''.$_POST['fecha'].'\', '.$_POST['id'].')';
    executeQuery($query);
}

function findImagesByIdProduct(){
    $query = 'SELECT * FROM fotos WHERE idProducto='.$_POST['id'];
    executeQuery($query);
}

function deleteImage(){
    $query = 'DELETE FROM fotos WHERE id= '.$_POST['id'].' AND idProducto='.$_POST['productId'];
    executeQuery($query);
}

function deletePhotosByProduct(){
    $query = 'DELETE FROM fotos WHERE idProducto= '.$_POST['id'];
    executeQuery($query);
}

function deleteMachineFromProduct(){
    $query = 'DELETE FROM producto_has_maquinaria WHERE idProducto= '.$_POST['id'];
    executeQuery($query);
}

function deleteMarcaFromProduct(){
    $query = 'DELETE FROM producto_has_marca WHERE idProducto= '.$_POST['id'];
    executeQuery($query);
}

function addMachineFromProduct(){
    $query = 'INSERT INTO producto_has_maquinaria (idProducto, idMaquinaria) VALUES ('.$_POST['idProducto'].', '.$_POST['idMaquinaria'].')';
    executeQuery($query);
}

function addMarcaFromProduct(){
    $query = 'INSERT INTO producto_has_marca (idProducto, idMarca) VALUES ('.$_POST['idProducto'].', '.$_POST['idMarca'].')';
    executeQuery($query);
}

function findMaquinariaNamesByProduct(){
    $query = 'SELECT nombre FROM maquinaria
      INNER JOIN producto_has_maquinaria ON maquinaria.id = producto_has_maquinaria.idMaquinaria
      WHERE producto_has_maquinaria.idProducto ='.$_POST['id'];
    executeQuery($query);
}

function findMarcaNamesByProduct(){
    $query = 'SELECT nombre FROM marca
      INNER JOIN producto_has_marca ON marca.id = producto_has_marca.idMarca
      WHERE producto_has_marca.idProducto ='.$_POST['id'];
    executeQuery($query);
}

function getFirstImageProduct(){
    $query = 'SELECT * FROM fotos WHERE idProducto='.$_POST['id'].' ORDER BY id LIMIT 1';
    executeQuery($query);
}

function getRequeriments(){
    $query = 'SELECT * FROM requeriments';
    executeQuery($query);
}

function createRequeriment(){
    $query = 'INSERT INTO requeriments (priority, idRow, team, deadline, feature, description, link, statusRequeriment, approved, orderRequeriment) VALUES ('.
        $_POST['priority'].', \''.
        $_POST['idRow'].'\', \''.
        $_POST['team'].'\', \''.
        $_POST['deadLine'].'\', \''.
        $_POST['feature'].'\', \''.
        $_POST['description'].'\', \''.
        $_POST['link'].'\', \''.
        $_POST['statusRequeriment'].'\', \''.
        $_POST['approved'].'\', '.
        $_POST['orderRequeriment'].')';

    executeQuery($query);
}

function editRequeriment(){
    $query = 'UPDATE requeriments (priority, idRow, team, deadline, feature, description, link, statusRequeriment, approved, orderRequeriment) VALUES ('.
        $_POST['priority'].', \''.
        $_POST['idRow'].'\', \''.
        $_POST['team'].'\', \''.
        $_POST['deadLine'].'\', \''.
        $_POST['feature'].'\', \''.
        $_POST['description'].'\', \''.
        $_POST['link'].'\', \''.
        $_POST['statusRequeriment'].'\', \''.
        $_POST['approved'].'\', '.
        $_POST['orderRequeriment'].')';

    $query = 'UPDATE requeriments SET 
                priority='.$_POST['priority'].', 
                idRow=\''.$_POST['idRow'].'\', 
                team=\''.$_POST['team'].'\', 
                deadLine=\''.$_POST['deadLine'].'\', 
                feature=\''.$_POST['feature'].'\', 
                description=\''.$_POST['description'].'\', 
                link=\''.$_POST['link'].'\', 
                statusRequeriment=\''.$_POST['statusRequeriment'].'\', 
                approved=\''.$_POST['approved'].'\', 
                orderRequeriment=\''.$_POST['orderRequeriment'].'\' 
                WHERE id='.$_POST['id'];

    executeQuery($query);
}

function deleteRequeriment(){
    $query = 'DELETE FROM requeriments WHERE id= '.$_POST['id'];
    executeQuery($query);
}

function executeQuery($query){
//    echo $query;
    global $mysqli;
    $result = $mysqli->query($query);

    $array = array();
    error_reporting(E_ERROR | E_PARSE);

    if($result->num_rows ==null){
        $arr = array('id' => $mysqli->insert_id);
        $response = json_encode($arr);
    }else{
        for ($i = 0; $i < $result->num_rows; $i++) {
            array_push($array,$result->fetch_array(MYSQLI_ASSOC));
        }
        $response = json_encode($array);
    }

    mysqli_free_result($result);
    $mysqli->close();


    echo $response;
}