<?php

include "config.php";    //데이터베이스 연결 설정파일
include "util.php";  

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$report_title = $_POST['report_title'];
$restaurant_id = $_POST['restaurant_id'];
$report_type_id = $_POST['report_type_id'];
$report_content = $_POST['report_content'];



$ret = mysqli_query($conn, "insert into Reports(report_title, report_content, restaurant_id, report_type_id) values('$report_title', '$report_content', '$restaurant_id', '$report_type_id')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=report_list.php'>"; 

}
?>
