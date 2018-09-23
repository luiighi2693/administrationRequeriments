<?php
//$mysqli = new mysqli("localhost", "c0490274_casad", "RA80fazope", "c0490274_casad");
$mysqli = new mysqli("localhost", "root", "", "requeriments");

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

if($_POST['method']=='login'){
    login();
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

function login(){
    $query = 'SELECT * FROM users WHERE username = \''.$_POST['username'].'\'';
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