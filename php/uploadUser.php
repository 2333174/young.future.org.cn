<?php
include 'sqlInfo.php';
global $hostName;
global $username;
global $password;
global $dbname;
$hostName = $sqlHost;
$username = $sqlUser;
$password = $sqlPassword;
$dbname = $sqlDB;
$token = $_POST['token'];
$uAccount = $_POST['uAccount'];
$uPassword = $_POST['uPassword'];
$uName = $_POST['uName'];
$uGrade = $_POST['uGrade'];

//解码
function Decode($input) {
	return strrev(base64_decode(strrev(base64_decode($input))));
}

//验证用户身份
function valid($token){
	$token_rev=Decode($token);
	//str1 uid 日期
	$strList=explode(' ',$token_rev);//字符串打散为数组
	
	if ($strList[0]&&$strList[1]){//如果获得数组不成功，返回错误
	  $UID=$strList[0];
	  $date=$strList[1];
	}else{
	  return false;
	}
	
	if ($date>date("Y-m-d",strtotime("+1 week"))){//如果登录时间超过一周，返回错误
	  return false;
	}
	
	//连接mysql
			$content = mysqli_connect($GLOBALS['hostName'],$GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']); //打开链接，现在$content相当于钥匙
	mysqli_set_charset($content, 'utf-8');//规定默认字符集
	
	
	if ($content) { 
	  $sqlStr = "SELECT * FROM users where uID='".$UID."';";//寻找uid指定的那一行
	  $result = mysqli_query($content, $sqlStr);
	  $UID_judge=false;
	  if(mysqli_num_rows($result)>0){
		$UID_judge=true;
		while($row = mysqli_fetch_assoc($result)) {
		  return true;
		}
	  }else{//如果没找到，返回错误
		return false;
	  }
	} else {//如果链接不成功，程序结束，返回错误原因
	  die("Connect Fail! " . mysqli_connect_error());
	}
	mysqli_close($content);//关闭链接
}

if (valid($token)==false){//将网页的cookie获得的信息进行验证
	$arr = array('status'=>"fail", 'message'=>"用户无权限");
	exit(json_encode($arr));
}

//增加用户
$content = mysqli_connect($GLOBALS['hostName'],$GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
$list = array();
$uID;
mysqli_set_charset($content, 'utf-8');   
if ($content) { 
  $sqlStr = "SELECT * FROM users;";  //找users表
  $result = mysqli_query($content, $sqlStr);
  if($result){//如果找到user表
	while($row=mysqli_fetch_assoc($result)) {
		$uID = $row['uID'] ;
		$uID++;
	}
  }else{
	  $arr = array('status'=>'fail','message'=>"维护中");
	  exix(json_encode($arr));
  }
}else{
	die("Connect Fail! " . mysqli_connect_error());
}
$sqlStr = "INSERT INTO users (uID,uAccount,uPassword,uName,uGrade)
VALUES ('$uID','$uAccount','$uPassword','$uName','$uGrade');";
$result = mysqli_query($content, $sqlStr);
mysqli_close($content);
if($result){
	$arr = array('status'=>"success");
	exit(json_encode($arr));
}else{
	$arr = array('status'=>'fail','message'=>"用户添加失败");
	exix(json_encode($arr));
}
?>