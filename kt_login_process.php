<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>로그인</title>
</head>
<body>
    <?php
    $uid=$_POST['uid'];
    $upw=$_POST['upw'];
    //데이터베이스 연결
    $dbcon=mysqli_connect('localhost','qwedfr79','qazwsx!2');
    //데이터베이스 선택
    mysqli_select_db($dbcon, 'qwedfr79');
    #처리
    $query = "SELECT * FROM member WHERE uid='$uid'";
    $result = mysqli_query($dbcon, $query);
    $row = mysqli_fetch_array($result);
    if($row){
        if($row['upw'] == $upw){
            session_start();
            $_SESSION['userid'] = $uid;
            $_SESSION['time'] = time();
            echo "$uid 님 로그인이 완료되었습니다";
            echo "<meta http-equiv='refresh' content='2;url=./kt_admin2.php'>" ;
        }
        else{
            echo "아이디 또는 패스워드가 일치하지 않습니다.";
            echo "<meta http-equiv='refresh' content='2;url=./kt_login.php'>" ;
        }
    }else{
        echo"아이디 또는 패스워드가 일치하지 않습니다.";
        echo "<meta http-equiv='refresh' content='2;url=./kt_login.php'>"  ;
    }
    
    //데이터베이스 연결 종료
    mysqli_close($dbcon);
    ?>
    

</body>
</html>