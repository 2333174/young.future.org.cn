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
  $coverNum = $_POST['coverNum'];
  $pdf= $_FILES['pdfFile']; 
  $cover= $_FILES['cover'];
  $uploadPerson = $_POST['uploadPerson'];
  $content = mysqli_connect($hostName ,$username, $password, $dbname);
  mysqli_set_charset($content, 'utf-8');
  if ($content) {
  }else {
      die("Connect Fail! " . mysqli_connect_error());
  }
  $sqlStr = "SELECT * FROM newspaper WHERE title='$title';";
  $result = mysqli_query($content, $sqlStr);
  if (mysqli_num_rows($result) == 1) {
    $arr = array('status'=>"fail", 'message'=>'本期珞青报已添加');
    exit(json_encode($arr));
  }

  //创建对应文件夹
  $dir = iconv("UTF-8", "GBK", "../newspaper/".$title);
  if (!file_exists($dir)){
    mkdir ($dir,0777,true);
  } else{
    $arr = array('status'=>"fail", 'message'=>"请勿重复上传");
    exit(json_encode($arr));
  }
  //存储版面
  for ($i=0;$i<$coverNum;$i++){
    if ($_FILES["cover".$i]["error"] > 0)
    {
      $arr = array('status'=>"fail", 'message'=>"版面上传失败，错误码:" . $_FILES["cover".$i]["error"]);
      exit(json_encode($arr));
    }
    else
    {
      if (file_exists("../newspaper/". $title . "/cover"  . $i . ".jpg"))
      {
        $arr = array('status'=>"fail", 'message'=>"请勿重复上传");
        exit(json_encode($arr));
      }
      else
      {
        move_uploaded_file($_FILES["cover".$i]["tmp_name"],
        "../newspaper/". $title . "/cover"  . $i . ".jpg");
      }
    }
  }
  //存储封面
  if ($_FILES["cover"]["error"] > 0)
  {
    $arr = array('status'=>"fail", 'message'=>"封面上传失败，错误码:" . $_FILES["cover"]["error"]);
    exit(json_encode($arr));
  }
  else
  {
    if (file_exists("../newspaper/". $title . "/cover.jpg"))
    {
      $arr = array('status'=>"fail", 'message'=>"请勿重复上传");
      exit(json_encode($arr));
    }
    else
    {
      move_uploaded_file($_FILES["cover"]["tmp_name"],
      "../newspaper/". $title . "/cover.jpg");
    }
  }
  //存储报刊原件
  if ($_FILES["pdfFile"]["error"] > 0)
  {
    $arr = array('status'=>"fail", 'message'=>"报纸原件上传失败，错误码:" . $_FILES["cover"]["error"]);
    exit(json_encode($arr));
  }
  else
  {
    if (file_exists("../newspaper/". $title . "/". $title .".pdf"))
    {
      $arr = array('status'=>"fail", 'message'=>"请勿重复上传");
      exit(json_encode($arr));
    }
    else
    {
      move_uploaded_file($_FILES["pdfFile"]["tmp_name"],
      "../newspaper/". $title .  "/". $title .".pdf");
    }
  }
  date_default_timezone_set("PRC");
  $uploadTime = date("Y-m-d H:i:s");
  $sqlStr = "INSERT INTO newspaper (title,uploadTime,uploadPerson,viewTimes,coverNum)
  VALUES ('$title','$uploadTime','$uploadPerson','0','$coverNum');";
  $result = mysqli_query($content, $sqlStr);
  mysqli_close($content);
  $arr = array('status'=>"success");
  exit(json_encode($arr));
?>