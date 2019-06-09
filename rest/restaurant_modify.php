<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$restaurant_id = $_POST['restaurant_id'];
$restaurant_name = $_POST['restaurant_name'];
$food_type_id = $_POST['food_type_id'];
$restaurant_feat = $_POST['restaurant_feat'];
$restaurant_intro = $_POST['restaurant_intro'];
$area_id = $_POST['area_id'];


$update = "update Restaurant set restaurant_name = '$restaurant_name', food_type_id = $food_type_id, restaurant_intro = '$restaurant_feat', restaurant_intro = '$restaurant_intro', area_id = $area_id where restaurant_id=$restaurant_id ";
$ret = mysqli_query($conn, $update);

// echo "$update";
if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=restaurant_list.php'>";
}

?>
