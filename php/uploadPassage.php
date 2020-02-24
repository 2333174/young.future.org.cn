<?php
include 'sqlInfo.php';
$hostName = $sqlHost;
$username = $sqlUser;
$password = $sqlPassword;
$dbname = $sqlDB;
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:GET, POST,OPTIONS');
header("Access-Control-Allow-Headers:*");
$title = $_POST['title'];
$author = $_POST['author'];
$category = $_POST['category'];
$publisher = $_POST['publisher'];
$content = $_POST['content'];
date_default_timezone_set("PRC");
$updateTime = date("Y-m-d H:i:s");

$connect = mysqli_connect($hostName ,$username, $password, $dbname);
mysqli_set_charset($connect, 'utf-8');
if (!$connect) {
	die("Connect Fail! " . mysqli_connect_error());
}
$sqlStr = "INSERT INTO `passage` (`pTitle`, `pAuthor`, `pPublisher`, `pCategory`, `pUpdateTime`, `pContent`, `pViews`)"
	."VALUES ('$title', '$author', '$publisher', '$category', '$updateTime', '$content', 0);";
$result = $connect->query($sqlStr);
if ($result) {
	// 如果为新闻，需要上传封面图片
	$sqlStr = "SELECT * FROM `passage` WHERE  `pUpdateTime`='$updateTime'";
	$result = $connect->query($sqlStr);
	if (mysqli_num_rows($result) > 1) {
		$arr = array('status'=>"fail", 'message'=>"有重复项");
		$sqlStr = "DELETE FROM `passage` WHERE `pUpdateTime`='$updateTime' AND `pTitle`='$title'";
		$connect->query($sqlStr);
		mysqli_close($connect);
		exit(json_encode($arr));
	}
	if (mysqli_num_rows($result) < 1) {
		$arr = array('status'=>"fail", 'message'=>"没有查到对应数据");
		exit(json_encode($arr));
	}
	$row = $result->fetch_assoc();
	$fileName = $row["pID"];
	if ($category == '新闻') {
		$cover = $_FILES['cover'];
		// 判断是否有对应passage的文件夹
		$dir = iconv("UTF-8", "GBK", "../passage");
		if (!file_exists($dir)) {
			mkdir($dir, 0777, true);
		}
		if ($_FILES['cover']['error'] > 0) {
			$arr = array('status'=>"fail", 'message'=>"封面上传失败，错误码:" . $_FILES["cover"]["error"]);
			$sqlStr = "DELETE FROM `passage` WHERE `pUpdateTime`='$updateTime' AND `pTitle`='$title'";
			$connect->query($sqlStr);
			mysqli_close($connect);
			exit(json_encode($arr));
		} else {
			if (file_exists("../passage/" . $fileName . ".jpg")) {
				$arr = array('status'=>"fail", 'message'=>"请勿重复上传");
				$sqlStr = "DELETE FROM `passage` WHERE `pUpdateTime`='$updateTime' AND `pTitle`='$title'";
				$connect->query($sqlStr);
				mysqli_close($connect);
				exit(json_encode($arr));
			} else {
				move_uploaded_file($_FILES["cover"]["tmp_name"],
					"../passage/" . $fileName . ".jpg");
				mysqli_close($connect);
			}
		}
	}
	$arr = array('status'=>"success");
	exit(json_encode($arr));
} else {
	$arr = array('status'=>'fail','message'=>"文章添加失败");
	exit(json_encode($arr));
}
?>