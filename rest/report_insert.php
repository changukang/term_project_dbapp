<?php

include "config.php";    //데이터베이스 연결 설정파일
include "util.php";  

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$report_title = $_POST['report_title'];
$restaurant_id = $_POST['restaurant_id'];
$report_type_id = $_POST['report_type_id'];
$report_content = $_POST['report_content'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "insert into Reports(report_title, report_content, restaurant_id, report_type_id) values('$report_title', '$report_content', '$restaurant_id', '$report_type_id')");
if(!$ret){
    msg('Query Error : '.mysqli_error($conn));
   	mysqli_query($conn, "rollback"); //insert 문을 통한 신고 data item 추가가 성공하지 않을 시, Rollback.

}
else //inserted문을 통한 데이터 아이템 추가 성공!
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=report_list.php'>"; 
    mysqli_query($conn, "commit"); //transaction commit

}
?>
