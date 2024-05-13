<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
    $item = $_GET['item'];

    echo "주문내역 <br>.$item";
    ?>
    <br><br><br><br><br>
    <input type="button" value="창닫기" onclick="window.close()">
</body>
</html>
