<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";   
$conn = dbconnect($host, $dbid, $dbpass, $dbname);


if (array_key_exists('area_id', $_GET)) {
	$area_id=$_GET['area_id'];
	$query= "select * from Area  where area_id=$area_id ";
	$res = mysqli_query($conn, $query);
	$column = mysqli_fetch_assoc($res);
	if (!$column) {
        msg("상권 정보가 없어요!! (이럴리가 없는데..)");
    }
}

?>

<div class="container fullwidth">
   <h3>상권</h3>
	<p>
        <label for="area_id">상권 번호</label>
        <h4> <?= $column['area_id'] ?> </h4>
    </p>
     <p>
        <label for="area_name">상권 이름</label>
        <h4> <?= $column['area_name'] ?> </h4>
    </p>
     <p>
        <label for="area_content">상권 소개</label>
        <h4> <?= $column['area_content'] ?> </h4>
    </p>


</div>

