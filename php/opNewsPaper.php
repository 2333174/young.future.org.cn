<?php
  /*
   *@author: ShawCai
   *@time:2020-1-16
   *@description:管理珞青报
  */
  //获取珞青报信息列表
  include 'sqlInfo.php';
  global $hostName;
  global $username;
  global $password;
  global $dbname;
  $hostName = $sqlHost;
  $username = $sqlUser;
  $password = $sqlPassword;
  $dbname = $sqlDB;
  function getList(){
    $content = mysqli_connect($GLOBALS['hostName'],$GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    $list = array();
    mysqli_set_charset($content, 'utf-8');   
    if ($content) { 
      //mysql查找语句
      $sqlStr = "SELECT * FROM newspaper;";
      $result = mysqli_query($content, $sqlStr);
      if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)) {
          $list[]=$row;
        }
        return $list;
      }else{
        return [];
      }
    } else {
      die("Connect Fail! " . mysqli_connect_error());
    }
    mysqli_close($content);
  }
  //删除珞青报目录下的文件：
  function deldir($dir) {
    $dh=opendir($dir);
    while ($file=readdir($dh)) {
       if($file!="." && $file!="..") {
          $fullpath=$dir."/".$file;
          if(!is_dir($fullpath)) {
             unlink($fullpath);
          } else {
             deldir($fullpath);
          }
       }
    }
    closedir($dh);
    //删除当前文件夹：
    if(rmdir($dir)) {
       return true;
    } else {
       return false;
    }
  }
   //删除珞青报
  function deleteNews($title){
    if  (!deldir("../newspaper/".$title)){
      return array('status'=>"fail",'message'=>'文件删除失败');
    }
    $content = mysqli_connect($GLOBALS['hostName'],$GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    mysqli_set_charset($content, 'utf-8');   
    if ($content) { 
      $sqlStr = "DELETE FROM newspaper WHERE title='$title';";
      $result = mysqli_query($content, $sqlStr);
    } else {
      die("Connect Fail! " . mysqli_connect_error());
    }
    mysqli_close($content);
    return array('status'=>"success",'message'=>'删除成功');
  }
  //验证用户身份
  function Decode($input) {
    return strrev(base64_decode(strrev(base64_decode($input))));
  }
  function valid($token){
    $token_rev=Decode($token);
    //str1 uid 日期
    $strList=explode(' ',$token_rev);
    
    if ($strList[0]&&$strList[1]){
      $UID=$strList[0];
      $date=$strList[1];
    }else{
      return false;
    }
    
    if ($date>date("Y-m-d",strtotime("+1 week"))){
      return false;
    }
    
    //连接mysql
    $content = mysqli_connect($GLOBALS['hostName'],$GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    mysqli_set_charset($content, 'utf-8');
    
    
    if ($content) { 
      //mysql查找语句
      $sqlStr = "SELECT * FROM users where uID='".$UID."';";
      $result = mysqli_query($content, $sqlStr);
      $UID_judge=false;
      if(mysqli_num_rows($result)>0){
        $UID_judge=true;
        while($row = mysqli_fetch_assoc($result)) {
          return true;
        }
      }else{
        return false;
      }
    } else {
      die("Connect Fail! " . mysqli_connect_error());
    }
    mysqli_close($content);
  }

  $token = $_GET['token'];
  if (valid($token)==false){
    $arr = array('status'=>"fail", 'message'=>"用户无权限");
    exit(json_encode($arr));
  }

  $type = $_GET['type'];
  if ($type=="get"){
    $arr = array('status'=>"success",'list'=>getList());
    exit(json_encode($arr));
  }else if($type=="delete"){
    $title=$_GET['title'];
    exit(json_encode(deleteNews($title)));
  }
?>