<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);


if (array_key_exists('restaurant_id', $_GET)) {
	$restaurant_id=$_GET['restaurant_id'];
	$query= "select * from  (Restaurant NATURAL JOIN FoodType NATURAL JOIN Area) where restaurant_id=$restaurant_id ";
	$res = mysqli_query($conn, $query);
	$column = mysqli_fetch_assoc($res);
	if (!$column) {
        msg("음식점이 없어요!! (이럴리가 없는데..)");
    }
}
?>

<div class="container fullwidth">
   <h3>음식점</h3>
	<p>
        <label for="restaurant_id">음식점 번호</label>
        <h4> <?= $column['restaurant_id'] ?> </h4>
    </p>
     <p>
        <label for="restaurant_name">음식점 이름</label>
        <h4> <?= $column['restaurant_name'] ?> </h4>
    </p>
    <p>
        <label for="food_type_name">음식점 전문 분야</label>
        <h4> <?= $column['food_type_name'] ?> </h4>
    </p>
        <p>
        <label for="restaurant_feat">음식점 특징</label>
        <h4> <?= $column['restaurant_feat'] ?> </h4>
    </p>
    <p>
        <label for="restaurant_intro">음식점 소개</label>
        <h4> <?= $column['restaurant_intro'] ?> </h4>
    </p>
        <p>
        <label for="area_nam">음식점 위치 구역</label>
        <h4> <?= $column['area_name'] ?> </h4>
    </p>
    

</div>
