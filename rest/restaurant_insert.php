<?php

include "config.php";    //데이터베이스 연결 설정파일
include "util.php";  

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$restaurant_name = $_POST['restaurant_name'];
$food_type_id = $_POST['food_type_id'];
$restaurant_feat = $_POST['restaurant_feat'];
$restaurant_intro = $_POST['restaurant_intro'];
$area_id = $_POST['area_id'];


mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation



$ret = mysqli_query($conn, "insert into Restaurant(restaurant_name, restaurant_feat, restaurant_intro, food_type_id, area_id) values('$restaurant_name', '$restaurant_feat', '$restaurant_intro', '$food_type_id','$area_id')");
if(!$ret)
{
	
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
     mysqli_query($conn, "rollback");  //음식점 데이터 아이템 추가가 안됨. Rollback!

}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=restaurant_list.php'>"; 
    mysqli_query($conn, "commit"); //음식점 데이터 아이템 추가 성공! transaction commit.


}
?>
