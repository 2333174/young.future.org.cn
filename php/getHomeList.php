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
  $content = mysqli_connect($GLOBALS['hostName'],$GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
  
  mysqli_set_charset($content, 'utf-8');
  if ($content) { 

    
    $sqlstr = " SELECT pID , pTitle, pUpdateTime From passage WHERE pCategory ='新闻' order by pUpdateTime DESC ";
    $results = mysqli_query($content, $sqlstr);
    $data1 =array(); 
    $i=0;
    while ($row= mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
      $i++;
      if ($i>5) break;
      $data1[]=$row;
    }
	foreach($data1 as $k => &$v){
		//注意，由于上面遍历的时候写了地址传值符&,
		//所以下面可以直接给$v 赋值;如果不写&符号，下面这样写是没有任何意义的
		$v['isScroll'] = false;
	}

    $sqlstr = " SELECT pID , pTitle, pUpdateTime From passage WHERE pCategory ='文韵' order by pUpdateTime DESC ";
    $results = mysqli_query($content, $sqlstr);
    $data2 =array(); 
    $i=0;
    while ($row= mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
      $i++;
      if ($i>5) break;
      $data2[]=$row;
    }
  

  $sqlstr = " SELECT title, uploadTime,uploadPerson From newspaper order by uploadTime DESC ";
    $results = mysqli_query($content, $sqlstr);
    $data3 =array(); 
    $i=0;
    while ($row= mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
      $i++;
      if ($i>4) break;
      $data3[]=$row;
    }
  

  $sqlstr = " SELECT pID , pTitle, pUpdateTime From passage WHERE pCategory ='最新速递' order by pUpdateTime DESC ";
    $results = mysqli_query($content, $sqlstr);
    $data4 =array(); 
    $i=0;
    while ($row= mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
      $i++;
      if ($i>4) break;
      $data4[]=$row;
    }
  

    $sqlstr = " SELECT pID , pTitle, pUpdateTime From passage WHERE pCategory ='往期精选' order by pUpdateTime DESC ";
    $results = mysqli_query($content, $sqlstr);
    $data5 =array(); 
    $i=0;
    while ($row= mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
      $i++;
      if ($i>4) break;
      $data5[]=$row;
    }
  

    $sqlstr = " SELECT pID , pTitle, pUpdateTime From passage WHERE pCategory ='专题' order by pUpdateTime DESC ";
    $results = mysqli_query($content, $sqlstr);
    $data6 =array(); 
    $i=0;
    while ($row= mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
      $i++;
      if ($i>4) break;
      $data6[]=$row;
    }
  }
    
  mysqli_close($content);
  $all=array();
  $all=array('newsList'=>$data1,'artList'=>$data2,'LQBList'=>$data3,'newsqList'=>$data4,'handPickedList'=>$data5,'topicList'=>$data6);
 
  return($all);

}

  $List=array();
  $List=array('status'=>'success','list'=>getlist());
  exit(json_encode($List));

  $array= array();
  $array = getList();
  exit(json_encode($array));
?>




    
        
       

