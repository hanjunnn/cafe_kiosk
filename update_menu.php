<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>수정</title>
</head>
<body>
<?php

// 데이터베이스 연결
$dbcon = mysqli_connect('localhost', 'root', '');
// 데이터베이스 선택
mysqli_select_db($dbcon, 'kt_cafe');

    $num = $_POST["num"];
    $newPrice = $_POST["price"];

    // 메뉴 항목을 데이터베이스에서 업데이트
    $sql = "UPDATE kt_menu SET ccost = '$newPrice' WHERE num = '$num'";

    if (mysqli_query($dbcon, $sql)) {
        echo "메뉴 항목이 성공적으로 업데이트되었습니다.";
    } else {
        echo "메뉴 항목 업데이트 오류: " . mysqli_error($dbcon);
    }


mysqli_close($dbcon);
?>
<a href="kt_admin.php">돌아가기</a>
</body>
</html>