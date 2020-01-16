<?php
    // error_reporting(0);

    header('Content-Type:application/json; charset=utf-8');
    header('Access-Control-Allow-Origin:*');
    header('Access-Control-Allow-Methods:GET, POST,OPTIONS');
    header("Access-Control-Allow-Headers:X-Requested-With");

    function Encode($input) {
        return base64_encode(strrev(base64_encode(strrev($input))));
    }


    $account = $_POST['username'];
    $pwd = $_POST['password'];
    $hostName = "localhost:3306";
    $username = "root";
    $password = "root";
    $dbname = "young_future";
    $content = mysqli_connect($hostName ,$username, $password, $dbname);
    mysqli_set_charset($content, 'utf-8');
    if ($content) {
    }else {
        die("Connect Fail! " . mysqli_connect_error());
    }
    

    $sqlStr = "SELECT * FROM users WHERE uAccount='$account' AND uPassword='$pwd';";
    $result = mysqli_query($content, $sqlStr);
    if (mysqli_num_rows($result) == 1) {
        while($row = mysqli_fetch_assoc($result)) {
            $token = Encode($row["uID"] . " " . date("Y-m-d"));
            $arr = array('status'=>"success", 'token'=>$token);
        }
    } else {
        $arr = array('status'=>"fail");
    }
    
    mysqli_close($content);
    exit(json_encode($arr));
?>