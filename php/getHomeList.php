<?php
function getList(){
  $hostName = "localhost:3306";
  $username = "root";
  $password = "root";
  $dbname = "young_future";
  $content = mysqli_connect($hostName,$username, $password, $dbname);
  
  mysqli_set_charset($content, 'utf-8');
  if ($content) { 

    
    $sqlstr = " SELECT pID , pTitle, pUpdateTime From passage WHERE pCategory ='新闻' order by pUpdateTime ASC ";
    $results = mysqli_query($content, $sqlstr);
    $data1 =array(); 
    $i=0;
    while ($row= mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
      $i++;
      if ($i>5) break;
      $data1[]=$row;
    }
  

    $sqlstr = " SELECT pID , pTitle, pUpdateTime From passage WHERE pCategory ='文韵' order by pUpdateTime ASC ";
    $results = mysqli_query($content, $sqlstr);
    $data2 =array(); 
    $i=0;
    while ($row= mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
      $i++;
      if ($i>5) break;
      $data2[]=$row;
    }
  

  $sqlstr = " SELECT title, uploadTime,uploadPerson From newspaper order by uploadTime ASC ";
    $results = mysqli_query($content, $sqlstr);
    $data3 =array(); 
    $i=0;
    while ($row= mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
      $i++;
      if ($i>4) break;
      $data3[]=$row;
    }
  

  $sqlstr = " SELECT pID , pTitle, pUpdateTime From passage WHERE pCategory ='最新速递' order by pUpdateTime ASC ";
    $results = mysqli_query($content, $sqlstr);
    $data4 =array(); 
    $i=0;
    while ($row= mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
      $i++;
      if ($i>4) break;
      $data4[]=$row;
    }
  

    $sqlstr = " SELECT pID , pTitle, pUpdateTime From passage WHERE pCategory ='往期精选' order by pUpdateTime ASC ";
    $results = mysqli_query($content, $sqlstr);
    $data5 =array(); 
    $i=0;
    while ($row= mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
      $i++;
      if ($i>4) break;
      $data5[]=$row;
    }
  

    $sqlstr = " SELECT pID , pTitle, pUpdateTime From passage WHERE pCategory ='专题' order by pUpdateTime ASC ";
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




    
        
       

