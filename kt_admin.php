<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KT Cafe 메뉴</title>
</head>
<body>

<?php


//데이터베이스 연결
$dbcon=mysqli_connect('localhost','root',"");
//데이터베이스 선택
mysqli_select_db($dbcon, 'kt_cafe');
$sql = "SELECT * FROM kt_menu";
$result = $dbcon->query($sql);

if ($result->num_rows > 0) {
    // 각 메뉴 항목 출력
    while ($row = $result->fetch_assoc()) {
        echo '<div>';
        echo '<span>' . $row['cname'] . '</span>';
        echo '<span>가격: $' . $row['ccost'] . '</span>';
        echo '<form action="update_menu.php" method="post">';
        echo '<input type="hidden" name="num" value="' . $row['num'] . '">';
        echo '<label for="price">새로운 가격:</label>';
        echo '<input type="text" name="price" placeholder="새로운 가격 입력">';
        echo '<input type="submit" value="업데이트">';
        echo '</form>';
        echo '</div>';
    }
} else {
    echo "메뉴 항목이 없습니다";
}

$dbcon->close();
?>

</body>
</html>
