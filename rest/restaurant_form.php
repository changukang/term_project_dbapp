<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "등록";
$action = "restaurant_insert.php";


if (array_key_exists("restaurant_id", $_GET)) {
    $restaurant_id = $_GET["restaurant_id"];
    $query =  "select * from Restaurant where restaurant_id = $restaurant_id";
    $res = mysqli_query($conn, $query);
    $restaurant = mysqli_fetch_array($res);
    if(!$restaurant) {
        msg("음식점이 존재하 지않아요..안돼 ㅠㅠ");
    }
    $mode = "수정";
    $action = "restaurant_modify.php";
}

$foodtypes = array();
$areas = array();

$query_foodtype = "select * from FoodType";
$query_area = "select * from Area";

$res_foodtype = mysqli_query($conn, $query_foodtype);
while($row_foodtype = mysqli_fetch_array($res_foodtype)) {
    $foodtypes[$row_foodtype['food_type_id']] = $row_foodtype['food_type_name'];
}

$res_area = mysqli_query($conn, $query_area);
while($row_area = mysqli_fetch_array($res_area)) {
    $areas[$row_area['area_id']] = $row_area['area_name'];
}  
?>

    <div class="container">
    	<h2>
    		음식점 정보 <?=$mode?>
    	</h2>
    	<h4>
    		음식점 등록 ID는 자동으로 생성됩니다 ^.^
    	</h4>
    	
        <form name="restaurant_form" action="<?=$action?>" method="post" class="fullwidth">
        	    	<input type="hidden" name="restaurant_id" value="<?=$restaurant['restaurant_id']?>"/>

            <p>
                <label for="restaurant_name">음식점 이름</label>
                <input type="text" placeholder="음식점 이름 입력" id="restaurant_name" name="restaurant_name" value="<?=$restaurant['restaurant_name']?>"/>
            </p>
            
             <p>
                <label for="food_type_id">음식 전문 분야</label>
                <select name="food_type_id" id="food_type_id">
                    <option value=-1>선택해 주십시오.</option>
                    <?
                        foreach($foodtypes as $id => $name) {
                            if($id == $restaurant['food_type_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
            <p>
                <label for="restaurant_feat">음식점 특징</label>
                <input type="text" placeholder="음식점 특징 입력" id="restaurant_feat" name="restaurant_feat" value="<?=$restaurant['restaurant_feat']?>"/>
            </p>
            <p>
                <label for="restaurant_intro">음식점 소개</label>
                <textarea placeholder="음식점 소개 입력입력(선택)" id="restaurant_intro" name="restaurant_intro" rows="10"><?=$restaurant['restaurant_intro']?></textarea>
            </p>
            
			 <p>
                <label for="area_id">위치 구역</label>
                <select name="area_id" id="area_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($areas as $id => $name) {
                            if($id == $restaurant['area_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
            <script>
                function validate() {
                    if(document.getElementById("restaurant_name").value == "") {
                        alert ("음식점 이름을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("food_type_id").value == -1) {
                        alert ("음식점 전문 분야를 선택해  주십시오"); return false;
                    }
                    else if(document.getElementById("restaurant_feat").value == "") {
                        alert ("음식점 특징을 작성해  주십시오"); return false;
                    }
                    else if(document.getElementById("area_id").value == -1) {
                        alert ("음식점 위치 구역을 선택해 주십시오"); return false;
                    }
                    return true;
                }
            </script>
            
     
          
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>


            </form>

</div>