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
function getList(){
  $type=$_GET['type'];
  $conn = mysqli_connect($GLOBALS['hostName'],$GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
  mysqli_set_charset($conn, 'utf-8');
  if(!$conn){
	  $List=array('status'=>'success','message'=>"Connection failed: ".mysqli_connect_error());
	  exit(json_encode($List));
  }
  if($conn){
	  if ($type=='珞青报'){
		$sqlstr =" SELECT title, uploadTime From newspaper order by uploadTime DESC"; 
	  }elseif ($type=='search')  {
		$key=$_GET['keyword'];
		$sqlstr = "SELECT pID , pTitle, pUpdateTime From passage Where pTitle LIKE '%$key%' order by pUpdateTime DESC";
	  }elseif ($type!='珞青报'){
        $sqlstr =" SELECT pID , pTitle, pUpdateTime From passage Where pCategory='$type' order by pUpdateTime DESC";
	  }
		$results = mysqli_query($conn, $sqlstr);
		$data1 = array();
		while($row = mysqli_fetch_assoc($results)) {
		  $data1[]=$row;
		}
    }
    mysqli_close($conn);  
    return($data1);
 }


$List=array();
$List=array('status'=>'success','list'=>getlist());
exit(json_encode($List));

?>