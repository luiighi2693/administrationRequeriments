<?php
$mysqli = new mysqli("localhost", "root", "", "requeriments");
//$mysqli = new mysqli("db754482285.db.1and1.com", "dbo754482285", "@Green.123!", "db754482285");

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

if($_POST['method']=='getComments'){
    getComments();
}

if($_POST['method']=='createComment'){
    createComment();
}

if($_POST['method']=='deleteComment'){
    deleteComment();
}

if($_POST['method']=='editComment'){
    editComment();
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

function getComments(){
    $query = 'SELECT * FROM comments';
    executeQuery($query);
}

function createComment(){
    $query = 'INSERT INTO comments (usernameComment, dateComment, contentComment, 
                                    emailToNotifyComment, flagComment, usernameAnswer, 
                                    dateAnswer, contentAnswer, emailToNotifyAnswer, 
                                    flagAnswer, idRequeriment) VALUES ( \''.
        $_POST['usernameComment'].'\', \''.
        $_POST['dateComment'].'\', \''.
        $_POST['contentComment'].'\', \''.
        $_POST['emailToNotifyComment'].'\', \''.
        $_POST['flagComment'].'\', \''.
        $_POST['usernameAnswer'].'\', \''.
        $_POST['dateAnswer'].'\', \''.
        $_POST['contentAnswer'].'\', \''.
        $_POST['emailToNotifyAnswer'].'\', \''.
        $_POST['flagAnswer'].'\', '.
        $_POST['idRequeriment'].')';

    executeQuery($query);
}

function deleteComment(){
    $query = 'DELETE FROM comments WHERE id= '.$_POST['id'];
    executeQuery($query);
}

function editComment(){
    $query = 'UPDATE comments SET 
                usernameComment=\''.$_POST['usernameComment'].'\', 
                dateComment=\''.$_POST['dateComment'].'\', 
                contentComment=\''.$_POST['contentComment'].'\', 
                emailToNotifyComment=\''.$_POST['emailToNotifyComment'].'\', 
                flagComment=\''.$_POST['flagComment'].'\', 
                usernameAnswer=\''.$_POST['usernameAnswer'].'\', 
                dateAnswer=\''.$_POST['dateAnswer'].'\', 
                contentAnswer=\''.$_POST['contentAnswer'].'\', 
                emailToNotifyAnswer=\''.$_POST['emailToNotifyAnswer'].'\' 
                flagAnswer=\''.$_POST['flagAnswer'].'\' 
                WHERE id='.$_POST['id'];

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