<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation


$restaurant_id = $_GET['restaurant_id'];
$delete_columns = mysqli_query($conn, "select column_id from ObjectTo where restaurant_id = $restaurant_id"); 
$ret_reports = mysqli_query($conn, "delete from Reports where restaurant_id = $restaurant_id");
$ret_objectto = mysqli_query($conn, "delete from ObjectTo where restaurant_id = $restaurant_id");



while($del_column = mysqli_fetch_array($delete_columns)){
	$del_column_id = $del_column['column_id'];
	$ret_column = mysqli_query($conn, "delete from FoodColumn where column_id = $del_column_id");
	if(!$ret_column){
	  mysqli_query($conn, "rollback"); 
	  //삭제할 리포트의 대상 음식점의 칼럼이 삭제되지 않음. Rollback!.
	}
	else
	{
	//삭제할 리포트의 대상 음식점의 칼럼이 삭제 성공!
	}
}
$ret = mysqli_query($conn, "delete from Restaurant where restaurant_id = $restaurant_id");


if(!$ret)
{
    //삭제할 리포트의 대상 음식점이 삭제되지 않음. Rollback!.
    msg('Query Error : 삭제할 음식점이 없어요 '.mysqli_error($conn));
     mysqli_query($conn, "rollback"); 

}
else
{

    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=restaurant_list.php'>";
    //삭제할 신고 내역의 음식점, 칼럼 data item 모두 삭제 성공!
	//transaction commit.
	mysqli_query($conn, "commit"); //transaction 성공
}

?>

