<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
	
	 <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select area_id, area_name  from Area";

    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
    
    <h2>
    	고려대학교의 정겨운 상권
    </h2>
    
        <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>음식점 이름</th>
            <th>기능</th>


        </tr>
        </thead>
        <tbody>
        <?
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['area_id']}</td>";
		    echo "<td>{$row['area_name']}</td>";
            echo "<td width='15%'>
            	<center>

                 <a href='area_view.php?area_id={$row['area_id']}'><button class='button view small'>상세 조회</button></a>
                </td>
                </center>"
                ;
            echo "</tr>";
        }
        ?>
        
        </tbody>
    </table>



</div>
