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
function getContent(){
  $type=$_GET['type'];
  $key=$_GET['key'];
  $conn = mysqli_connect($GLOBALS['hostName'],$GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
  if ($type=='article'){
	$sqlstr="UPDATE passage SET pViews=Pviews+1 where pID='$key'";
	$sqlstr1 =" SELECT * from passage where pID='$key'";
  }elseif ($type=='newspaper'){
	$sqlstr ="UPDATE newspaper SET viewTimes=viewTimes+1 where title='$key'";
	$sqlstr1=" SELECT * From newspaper where title='$key'";
  }
  mysqli_set_charset($conn, 'utf-8');
  if(!$conn){
	  $List=array('status'=>'success','message'=>"Connection failed: ".mysqli_connect_error());
	  exit(json_encode($List));
  }
  if($conn){
		mysqli_query($conn, $sqlstr);
		$data=array();
		$sqlresults = mysqli_query($conn, $sqlstr1);
		while($row = mysqli_fetch_assoc($sqlresults)) {
		  $data[]=$row;
		}
    }
    mysqli_close($conn);  
    return($data);
}
$result=array('status'=>'success','content'=>getContent());
exit(json_encode($result));
?>