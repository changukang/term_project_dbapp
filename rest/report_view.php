<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";   
$conn = dbconnect($host, $dbid, $dbpass, $dbname);


if (array_key_exists('report_id', $_GET)) {
	$report_id=$_GET['report_id'];
	$query= "select * from (Reports natural join ReportTypes natural join Restaurant)  where report_id=$report_id ";
	$res = mysqli_query($conn, $query);
	$report = mysqli_fetch_assoc($res);
	if (!$report) {
        msg("신고 내역이 없어요!! (이럴리가 없는데..)");
    }
}

?>

<div class="container fullwidth">
   <h3>신고 내역</h3>
	<p>
        <label for="report_id">신고 번호</label>
        <h4> <?= $report['report_id'] ?> </h4>
    </p>
     <p>
        <label for="report_title">신고 제목</label>
        <h4> <?= $report['report_title'] ?> </h4>
    </p>
    <p>
        <label for="restaurant_name">신고 대상 음식점</label>
        <h4> <?= $report['restaurant_name'] ?> </h4>
    </p>
    <p>
        <label for="report_type_name">신고 종류</label>
        <h4> <?= $report['report_type_name'] ?> </h4>
    </p>
    <p>
        <label for="report_content">신고 내용</label>
        <h4> <?= $report['report_content'] ?> </h4>
    </p>

</div>


