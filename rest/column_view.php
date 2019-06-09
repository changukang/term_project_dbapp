<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";   
$conn = dbconnect($host, $dbid, $dbpass, $dbname);


$object_rest = array();
if (array_key_exists('column_id', $_GET)) {
	$column_id=$_GET['column_id'];
	$query= "select * from (FoodColumn natural join ObjectTo, Restaurant) where (ObjectTo.restaurant_id=Restaurant.restaurant_id AND column_id=$column_id) ";
	$res = mysqli_query($conn, $query);
	$res_temp = mysqli_query($conn, $query);
	while($res_temps = mysqli_fetch_assoc($res_temp)){
		$object_rest[$res_temps['restaurant_id']]=$res_temps['restaurant_name'];
	}
	$column = mysqli_fetch_assoc($res);
	if (!$column) {
        msg("칼럼이 없어요!! (이럴리가 없는데..)");
    }
   
   $query_food_id = "select * from FoodColumn NATURAL JOIN FoodType where column_id=$column_id";
   $type_res = mysqli_query($conn, $query_food_id);
   $food_type = mysqli_fetch_assoc($type_res);

    	
}

?>

<div class="container fullwidth">
   <h3>칼럼</h3>
	<p>
        <label for="column_id">칼럼 번호</label>
        <h4> <?= $column['column_id'] ?> </h4>
    </p>
     <p>
        <label for="column_title">칼럼 제목</label>
        <h4> <?= $column['column_title'] ?> </h4>
    </p>
    <p>
        <label for="column_writer">작성자</label>
        <h4> <?= $column['column_writer'] ?> </h4>
    </p>
    <p>
        <label for="food_type_name">음식 종류</label>
        <h4> <?= $food_type['food_type_name'] ?> </h4>
    </p>
    
    <p>
    	
    <label for="restaurant_name">다루는 음식점</label>
		<h4>
        <?
        	foreach($object_rest as $id => $name){
        		echo "'{$name}'";

        	}
        ?>
        </h4>
    </p>
    
    
        <p>
        <label for="column_content">내용</label>
        <h4> <?= $column['column_content'] ?> </h4>
    </p>

</div>


