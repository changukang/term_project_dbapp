<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>

<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select column_id, column_writer, column_title  from FoodColumn";
    $res = mysqli_query($conn, $query);

    ?>
    <h2>
    <고음>이 선별에서 제공하는 미식 칼럼!
    </h2>
    <h4>무단 배포 및 불법 복제가 가능합니다!</h4>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>작성자</th>
            <th>제목</th>
            <th>기능</th>

        </tr>
        </thead>
        <tbody>
        <?
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['column_id']}</td>";
		    echo "<td>{$row['column_writer']}</td>";
		    echo "<td>{$row['column_title']}</td>";


            // echo "<td>{$row['manufacturer_name']}</td>";
            // echo "<td><a href='product_view.php?product_id={$row['product_id']}'>{$row['product_name']}</a></td>";
            // echo "<td>{$row['price']}</td>";
            // echo "<td>{$row['added_datetime']}</td>";
            echo "<td width='15%'>
            	<center>
            	
                 <a href='column_view.php?column_id={$row['column_id']}'><button class='button view small'>상세 조회</button></a>

                </td>
                </center>"
                ;
            echo "</tr>";
        }
        ?>
        
        </tbody>
    </table>
    
 </div>
    