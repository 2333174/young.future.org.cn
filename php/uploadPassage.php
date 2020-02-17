<?php
    header('Access-Control-Allow-Origin:*');
    header('Access-Control-Allow-Methods:GET, POST,OPTIONS');
    header("Access-Control-Allow-Headers:*");
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $publisher = $_POST['publisher'];
    $content = $_POST['content'];

    // 如果为新闻，需要上传封面图片
    if ($category == '新闻') {
        $cover = $_FILES['cover'];
        // 判断是否有对应passage的文件夹
        $dir = iconv("UTF-8", "GBK", "../passage");
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        if ($_FILES['cover']['error'] > 0) {
            $arr = array('status'=>"fail", 'message'=>"封面上传失败，错误码:" . $_FILES["cover"]["error"]);
            exit(json_encode($arr));
        } else {
            $type = $_FILES['cover']['type'];
            $spiltType = preg_split("/[\/]+/", $type);
            $type = $spiltType[1];
            if (file_exists("../passage/" . $title . "." . $type)) {
                $arr = array('status'=>"fail", 'message'=>"请勿重复上传");
                exit(json_encode($arr));
            } else {
                move_uploaded_file($_FILES["cover"]["tmp_name"],
                    "../passage/" . $title . "." . $type);
            }
        }
    }

    $hostName = "localhost:3306";
    $username = "root";
    $password = "root";
    $dbname = "young_future";
    $connect = mysqli_connect($hostName ,$username, $password, $dbname);
    mysqli_set_charset($connect, 'utf-8');
    if (!$connect) {
        die("Connect Fail! " . mysqli_connect_error());
    }
    $sqlStr = "INSERT INTO `passage` (`pTitle`, `pAuthor`, `pPublisher`, `pCategory`, `pUpdateTime`, `pContent`, `pViews`)"
        ."VALUES ('$title', '$author', '$publisher', '$category', now(), '$content', 0);";
    $result = $connect->query($sqlStr);
    if ($result) {
        $arr = array('status'=>"success");
        exit(json_encode($arr));
    } else {
        $arr = array('status'=>'fail','message'=>mysqli_error_list($connect));
        exit(json_encode($arr));
    }
