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
	//删除新闻图片文件：
	function deldir($dir) {
		//删除当前文件夹：
		if(unlink($dir)) {
		   return true;
		} else {
		   return false;
		}
	}
    //删除文章
    function deletePassage($pID){
        $dir="../passage/".$pID.".jpg";
		if (file_exists($dir)){
			if(!deldir($dir)){
				die(array('status'=>"failed",'message'=>'删除失败'));
			}
		}
		$content = mysqli_connect($GLOBALS['hostName'],$GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
        mysqli_set_charset($content, 'utf-8');   
        if ($content) { 
          $sqlStr = "DELETE FROM passage WHERE pID='$pID';";
          $result = mysqli_query($content, $sqlStr);
        } else {
          die("Connect Fail! " . mysqli_connect_error());
        }
        mysqli_close($content);
        return array('status'=>"success",'message'=>'删除成功');
    }

    //获取文章信息
    function getList(){
        $content = mysqli_connect($GLOBALS['hostName'],$GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
        $list = array();
        mysqli_set_charset($content, 'utf-8');   
        if ($content) { 
          $sqlStr = "SELECT * FROM passage;";  //找文章表
          $result = mysqli_query($content, $sqlStr);
          if(mysqli_num_rows($result)>0){//如果passage表里列的数量大于0
            while($row = mysqli_fetch_assoc($result)) {//每一行赋值给$list
                unset($row['pContent']);
                $list[]=$row;

            }
            return $list;
          }else{//否则返回空值
            return [];
          }
        } else {//如果连接不成功，返回错误原因
          die("Connect Fail! " . mysqli_connect_error());
        }
        mysqli_close($content);
      }
    
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
		//打开链接，现在$content相当于钥匙
        $content = mysqli_connect($GLOBALS['hostName'],$GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']); 
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


    $token = $_GET['token'];
    if (valid($token)==false){//将网页的cookie获得的信息进行验证
        $arr = array('status'=>"fail", 'message'=>"用户无权限");
        exit(json_encode($arr));
    }

    $type = $_GET['type'];
    if ($type=="get"){//如果网页要求get信息
      $arr = array('status'=>"success",'list'=>getList());
      exit(json_encode($arr));
    }else if($type=="delete"){//如果网页要求delete信息
      $pID=$_GET['pID'];
      exit(json_encode(deletePassage($pID)));
    }
?>