<?php
/*$host_name = 'innovabitalent.com';
$database = 'innovabi_requeriments';
$user_name = 'innovabi_reqs';
$password = 'greensize2018';
$connect = mysqli_connect($host_name, $user_name, $password, $database);*/

//$mysqli = new mysqli("innovabitalent.com", "innovabi_reqs", "greensize2018", "innovabi_requeriments");
//$mysqli = new mysqli("db754482285.db.1and1.com", "dbo754482285", "@Green.123!", "db754482285");
$mysqli = new mysqli("db756342560.db.1and1.com", "dbo756342560", "@Green.12345!", "db756342560");

/*if (mysqli_connect_errno()) {
    die('<p>Failed to connect to MySQL: '.mysqli_connect_error().'</p>');
} else {
    echo '<p>Connection to MySQL server successfully established.</p >';
    // $query = 'INSERT INTO users (username, psw, role ) VALUES (\'ehurtado\', \'123456\',\'ADMIN\')';
}*/

 //$query = 'INSERT INTO users (username, psw, role ) VALUES (\'ehurtado\', \'greensize2018\',\'ADMIN\')';
  $query = 'SELECT * FROM requeriments';
 // $query = 'ALTER TABLE requeriments ADD pointRequeriment varchar(100) NULL;';
 // $query = 'ALTER TABLE requeriments MODIFY priority varchar(50);';
//  $query = 'ALTER TABLE requeriments ADD swapped varchar(10) DEFAULT \'false\' NULL';
// $query = 'DELETE FROM users WHERE id= 1';
    echo $query;
    executeQuery($query);

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
?>