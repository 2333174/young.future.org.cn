<?php
    error_reporting(0);

    function _get($str) {
        $val = !empty($_POST[$str]) ? $_POST[$str] : "null";
        return $val;
    }

    $id = $_POST['uid'];
    $name = $_POST['uname'];
    $gender = $_POST['gender'];
    $tel = $_POST['utel'];
    $qq = $_POST['uQQ'];
    $email = $_POST['uemail'];
    $dept = $_POST['udep'];
    $choice_1 = $_POST['com1'];
    $choice_1_detail = $_POST['sec1'];
    $chocie_1_detail2 = $_POST['sec1_1'];
    $choice_1_isobey = $_POST['isobey1'];
    if ($choice_1_isobey == -1) {
        $choice_1_isobey = "不服从调剂";
    } else if ($choice_1_isobey == 1) {
        $choice_1_isobey = "服从调剂";
    }

    $choice_2 = _get('com2');
    $choice_2_detail = _get('sec2');
    $chocie_2_detail2 =_get('sec2_1');
    $choice_2_isobey = _get('isobey2');

    if ($choice_2_isobey == -1) {
        $choice_2_isobey = "不服从调剂";
    } else if ($choice_2_isobey == 1) {
        $choice_2_isobey = "服从调剂";
    } else {
        $choice_2_isobey = "无";
    }

    $hostname = "localhost";
    $username = "stzx";
    $password = "stzx0902";
    $dbName = "stzx";
    
    $content = mysqli_connect($hostname, $username, $password, $dbName);
    mysqli_set_charset($content, 'utf-8');
    if ($content) {}else {
        echo "<script>alert('连接数据库失败！')</script>";
    }
    echo "$choice_2";
    if ($choice_2 != "null") {
        echo "<script>console.log('$id,'+'$name,'+'$gender,'+'$tel,'+'$qq,'+'$email,'+ '$dept,'+ '$choice_1,'+ '$choice_1_detail,'+ '$chocie_1_detail2,'+ '$choice_1_isobey,'+ '$choice_2,'+'$choice_2_detail,'+'$chocie_2_detail2,'+ '$choice_2_isobey');</script>";
        $sqlStr = "INSERT INTO stuinfo (id, name, gender, tel, qq, email, dept, choice1, choice1_dept1, choice1_dept2, isobey1, choice2, choice2_dept1, choice2_dept2, isobey2)
        VALUES ('$id', '$name', '$gender', '$tel', '$qq', '$email', '$dept', '$choice_1', '$choice_1_detail', '$chocie_1_detail2', '$choice_1_isobey', '$choice_2', '$choice_2_detail', '$chocie_2_detail2', '$choice_2_isobey')";
    } else {
        $choice_2 = "无";
        $choice_2_detail = "无";
        $chocie_2_detail2 ="无";
        echo "<script>console.log('$id,'+'$name,'+'$gender,'+'$tel,'+'$qq,'+'$email,'+ '$dept,'+ '$choice_1,'+ '$choice_1_detail,'+ '$chocie_1_detail2,'+ '$choice_1_isobey,'+ '$choice_2,'+'$choice_2_detail,'+'$chocie_2_detail2,'+ '$choice_2_isobey');</script>";
        $sqlStr = "INSERT INTO stuinfo (id, name, gender, tel, qq, email, dept, choice1, choice1_dept1, choice1_dept2, isobey1, choice2, choice2_dept1, choice2_dept2, isobey2)
        VALUES ('$id', '$name', '$gender', '$tel', '$qq', '$email', '$dept', '$choice_1', '$choice_1_detail', '$chocie_1_detail2', '$choice_1_isobey', '$choice_2', '$choice_2_detail', '$chocie_2_detail2', '$choice_2_isobey')";
    }
    if (mysqli_query($content, $sqlStr)) {
        echo "<script>window.location.href='./success.html';</script>";
    } else {
        echo "<script>alert(\"你已经报名过了！\");window.location.href='./index.html';</script>";
    }
    mysqli_close($content);
?>