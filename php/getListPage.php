<?php
function getList(){
  $hostName = "localhost:3306";
  $username = "root";
  $password = "root";
  $dbname = "young_future";
  $type=$_GET['type'];
  $conn = mysqli_connect($hostName,$username, $password, $dbname);
  mysqli_set_charset($conn, 'utf-8');
  if(!$conn){
      die("Connection failed: ".mysqli_connect_error());
  }
  if($conn){
        $sqlstr =" SELECT pID , pTitle, pUpdateTime From passage Where pCategory='$type' order by pUpdateTime ASC";
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