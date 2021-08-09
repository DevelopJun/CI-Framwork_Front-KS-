
<script>
	console.log("testing");
</script>
<h2>테스팅 페이지</h2>
<div class="dombox_tt">
<h2>
	<?php
	// 여기만 테스트 페이지로 남겨 놓겠습니다.
	$arr = array(
	        "kshosting" => array("june" => "intern1", "Hyewon" => "intern2"),
	        "number" => array("one" => 1, "two" => 2, "three" => 3),
	        "animal" => array("zibra", "bear")
	        );
	        foreach( $arr as $key => $value) {
	            echo "첫번째 배열 key=".$key.", 이중배열 : ";
	            foreach($value as $key2 => $value2) {
	                echo "key=".$key2.", ";
	                echo "value=".$value2.", ";
	            }
	            echo "<br>";
	        }
	 ?>
</h2>
</div>
