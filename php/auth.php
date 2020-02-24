<?php 
include 'sqlInfo.php';
header('Content-Type:application/json; charset=utf-8');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:GET, POST,OPTIONS');
header("Access-Control-Allow-Headers:X-Requested-With");
//输入token然后解码
function Decode($input) {
  return strrev(base64_decode(strrev(base64_decode($input))));
}

 function Encode($input) {
        return base64_encode(strrev(base64_encode(strrev($input))));
    }


//先解析token,获取UID和data
$token=$_POST['token'];
$token_rev=Decode($token);
//str1 uid 日期
$strList=explode(' ',$token_rev);

if ($strList[0]&&$strList[1]){
	$UID=$strList[0];
	$date=$strList[1];
}else{
	$arr = array('status'=>"fail",'message'=>"伪造token信息");
	exit(json_encode($arr));
}

if ($date>date("Y-m-d",strtotime("+1 week"))){
	$arr = array('status'=>"fail",'message'=>"身份信息过期，请重新登录");
	exit(json_encode($arr));
}

//连接mysql
$hostName = $sqlHost;
$username = $sqlUser;
$password = $sqlPassword;
$dbname = $sqlDB;
$content = mysqli_connect($hostName ,$username, $password, $dbname);
mysqli_set_charset($content, 'utf-8');


if ($content) {    } else {
  die("Connect Fail! " . mysqli_connect_error());
}
$sql = "USE young_future ;";
mysqli_query($content, $sql);
$sqlStr = "SELECT * FROM users where uID='".$UID."';";
$result = mysqli_query($content, $sqlStr);
$UID_judge=false;
if(mysqli_num_rows($result)>0){
  $UID_judge=true;
  while($row = mysqli_fetch_assoc($result)) {
	$token_new = Encode($UID . " " . date("Y-m-d"));
	$arr = array('status'=>"success", 'uname'=>$row["uName"],'token'=>$token_new);
  }
}else{
  $arr = array('status'=>"fail",'message'=>"用户权限被更改");
}
mysqli_close($content);
exit(json_encode($arr))

// for ($i=0; $i<count($strList); $i++){
//   echo $strList[$i];
// }

?> 
