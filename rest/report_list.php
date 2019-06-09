<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
	
	 <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select report_id, report_title from Reports";

    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
    
    <h2>
    	모든 음식점이 완벽할 순 없죠! 고려대 인근 음식점 신고!
    </h2>
    
        <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>신고 제목</th>
            <th>기능</th>


        </tr>
        </thead>
        <tbody>
        <?
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['report_id']}</td>";
		    echo "<td>{$row['report_title']}</td>";
            echo "<td width='15%'>
            	<center>
            	
                 <a href='report_view.php?report_id={$row['report_id']}'><button class='button view small'>상세 조회</button></a>


                </td>
                </center>"
                ;
            echo "</tr>";
        }
        ?>
        
        </tbody>
    </table>
    
    <div>

 
            	<center>
            	
                 <a href='report_form.php'><button class='button large-red'>음식점 신고하기!!</button></a>

                </center>
    </div>



</div>
