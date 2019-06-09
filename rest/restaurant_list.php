<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>

<div class="container">
	
	 <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select restaurant_id, restaurant_name  from Restaurant";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where restaurant_name like '%$search_keyword%' ";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    
    <h2>
    고려대학교 음식점들을 가보세요!
    </h2>
    <h4>천하일미랍니다</h4>
    <h4>음식점 삭제 시 그 음식점의 칼럼, 신고도 삭제되니 조심해주세요</h4>

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
            echo "<td>{$row['restaurant_id']}</td>";
		    echo "<td>{$row['restaurant_name']}</td>";

            // echo "<td>{$row['manufacturer_name']}</td>";
            // echo "<td><a href='product_view.php?product_id={$row['product_id']}'>{$row['product_name']}</a></td>";
            // echo "<td>{$row['price']}</td>";
            // echo "<td>{$row['added_datetime']}</td>";
            echo "<td width='25%'>
            	<center>
            	
                 <a href='restaurant_view.php?restaurant_id={$row['restaurant_id']}'><button class='button view small'>상세</button></a>
                 <a href='restaurant_form.php?restaurant_id={$row['restaurant_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['restaurant_id']})' class='button danger small'>삭제</button>

                </td>
                </center>"
                ;
            echo "</tr>";
        }
        ?>
        
        </tbody>
    </table>
    <script>
        function deleteConfirm(restaurant_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "restaurant_delete.php?restaurant_id=" + restaurant_id;
            }else{   //취소
                return;
            }
        }
    </script>
    
    
    <div>
    	       <?echo 
    	       "
            	<center>
            	
                 <a href='restaurant_form.php'><button class='button large-red'>등록</button></a>

                </center>"
                ;
                ?>
    </div>
    <div>
    	 <form action="restaurant_list.php" method="post">
    	 	  <center>
                    <input size="100"  type="text" name="search_keyword" placeholder="고음 음식점검색">
    	 	  </center>
		</form>

    </div>
 </div>



