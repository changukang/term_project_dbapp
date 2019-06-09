<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$action = "report_insert.php";


$reporttypes = array();
$restaurants = array();

$query_reporttypes = "select * from ReportTypes";
$query_restaurants = "select * from Restaurant";

$res_reporttypes = mysqli_query($conn, $query_reporttypes);
while($row_reporttypes = mysqli_fetch_array($res_reporttypes)) {
    $reporttypes[$row_reporttypes['report_type_id']] = $row_reporttypes['report_type_name'];

}

$res_restaurants = mysqli_query($conn, $query_restaurants);
while($row_restaurants = mysqli_fetch_array($res_restaurants)) {
    $restaurants[$row_restaurants['restaurant_id']] = $row_restaurants['restaurant_name'];
}





?>

  <div class="container">
    	<h2>
    		나쁜 음식점을 신고해주세요
    	</h2>
    	
    	<h4>
    		**<고음>은 사용자의 음식점 신고에 대한 그 어떤 법적 책임도 지지 않을 것입니다**
    	</h4>
    	
     <form name="report_form" action="<?=$action?>" method="post" class="fullwidth">
     	
    	<p>
            <label for="report_title">신고 제목</label>
            <input type="text" placeholder="신고 제목 입력" id="report_title" name="report_title" />
        </p>

             <p>
                <label for="restaurant_id">신고 대상 음식점</label>
                <select name="restaurant_id" id="restaurant_id">
                    <option value=-1>선택해 주십시오.</option>
                    <?
                        foreach($restaurants as $id => $name) {
                                echo "<option value='{$id}'>{$name}</option>";
                        }
                    ?>
                </select>
            </p>


          <p>
                <label for="report_type_id">신고 종류</label>
                <select name="report_type_id" id="report_type_id">
                    <option value=-1>선택해 주십시오.</option>
                    <?
                        foreach($reporttypes as $id => $name) {
                                echo "<option value='{$id}'>{$name}</option>";
                        }
                    ?>
                </select>
            </p>

			 <p>
                <label for="report_content">신고 내용</label>
                <textarea placeholder="신고 내용 입력" id="report_content" name="report_content" rows="10"></textarea>
            </p>

    
   <p align="center"><button class="button primary large" onclick="javascript:return validate();">신고하기</button></p>


     </form>
     	
   </div>