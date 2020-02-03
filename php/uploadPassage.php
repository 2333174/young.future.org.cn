<?php
    header('Access-Control-Allow-Origin:*');
    header('Access-Control-Allow-Methods:GET, POST,OPTIONS');
    header("Access-Control-Allow-Headers:*");
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $publisher = $_POST['publisher'];
    $content = $_POST['content'];

    $hostName = "localhost:3306";
    $username = "root";
    $password = "root";
    $dbname = "young_future";
    $connect = mysqli_connect($hostName ,$username, $password, $dbname);
    mysqli_set_charset($connect, 'utf-8');
    if (!$connect) {
        die("Connect Fail! " . mysqli_connect_error());
    }
    $sqlStr = "INSERT INTO `passage` (`pTitle`, `pAuthor`, `pPublisher`, `pCategory`, `pUpdateTime`, `pContent`)"
        ."VALUES ('$title', '$author', '$publisher', '$category', now(), '$content')";
    $result = mysqli_query($connect, $sqlStr);
    mysqli_close($connect);
    if ($result) {
        $arr = array('status'=>"success");
        exit(json_encode($arr));
    } else {
        $arr = array('status'=>'fail','message'=>"添加文章失败");
        exit(json_encode($arr));
    }
