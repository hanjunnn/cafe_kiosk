<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>컴포즈커피</title>
    <style>
        @font-face {
    font-family: 'JalnanGothic';
    src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_231029@1.1/JalnanGothic.woff') format('woff');
    font-weight: normal;
    font-style: normal;
}
        body {
            font-family: 'JalnanGothic';
            text-align: center;
        }

        .container {
            position: relative;
            display: inline-block;
        }

        .overlay-text {
            position: absolute;
            top: 10px;
            right: 200px;
            color: rgb(251, 255, 0);
            font-size: 30px;
            font-weight: bold;
        }

        .button {
            width: 200px;
            height: 50px;
            background-color: white;
            border: 2px solid white;
            border-radius: 30px;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
            transition: border-color 0.3s, color 0.3s, background-color 0.3s;
            font-size: 18px;
            font-weight: bold;
        }

        .activebtn {
            background-color: rgb(251, 255, 0);
        }

        .categorybar {
            text-align: center;
            margin: 0 auto;
            display: inline-block;
        }

        .table {
            text-align: center;
            margin: 0 auto;
            display: inline-block;
        }

        .bottomtable {
            display: inline-block;
        }

        .menu_image {
            width: 200px;
            height: 300px;
            border: 1px solid lightgray;
        }

        .menu_image:hover {
            cursor: pointer;
            transform: scale(1.03);
        }

        #resultorder {
            width: 400px;
            height: 150px;
        }

        #resultcnt {
            width: 100px;
            height: 150px;
        }

        #totalprice {
            width: 150px;
            height: 100px;
        }

        .reset {
            font-size: 18px;
            color: white;
            background: lightgrey;
            width: 150px;
            height: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .reset:hover{
            background: red;
        }

        .payment {
            background:rgb(251, 255, 0);;
            font-size: 25px;
            width: 160px;
            height: 160px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .payment:hover {
            cursor: pointer;
            transform: scale(1.03);
        }
        .paybutton{
            width: 100px;
            height: 50px;
            background-color: rgb(33, 124, 222);
            border: 1px solid white;
            border-radius: 8px;
            text-align: center;
            color: white;
            line-height: 50px;
            font-size: 18px;
        }
        .canclebutton{
            width: 100px;
            height: 50px;
            background-color: rgb(255, 20, 20);
            border: 1px solid white;
            border-radius: 8px;
            text-align: center;
            color: white;
            line-height: 50px;
            font-size: 18px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<?php
    $dbcon = mysqli_connect('localhost', 'root', "");
    mysqli_select_db($dbcon, 'kt_cafe');
    $query = "select * from kt_menu";
    $result = mysqli_query($dbcon, $query);
    $menuInfo = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $menuInfo[$row['num']] = array(
            'cname' => $row['cname'],
            'ccost' => $row['ccost']
        );
    }

    mysqli_close($dbcon);
?>
<script>

    var total_price = 0;
    var menuItems = {
        '1': { text: "HOT 아메리카노", count: 0 },
        '2': { text: "ICE 아메리카노", count: 0 },
        '3': { text: "HOT 카페라떼", count: 0 },
        '4': { text: "ICE 카페라떼", count: 0 },
        '5': { text: "HOT 바닐라라떼", count: 0 },
        '6': { text: "ICE 바닐라라떼", count: 0 },
        '7': { text: "HOT 헤이즐넛라떼", count: 0 },
        '8': { text: "ICE 헤이즐넛라떼", count: 0 },
        '9': { text: "HOT 카라멜마끼아또", count: 0 },
        '10': { text: "ICE 카라멜마끼아또", count: 0 },
        '11': { text: "HOT 카페모카", count: 0 },
        '12': { text: "ICE 카페모카", count: 0 },
        '13': { text: "딸기스무디", count: 0 },
        '14': { text: "망고스무디", count: 0 },
        '15': { text: "블루베리스무디", count: 0 },
        '16': { text: "유자스무디", count: 0 },
        '17': { text: "딸기요거트스무디", count: 0 },
        '18': { text: "망고요거트스무디", count: 0 },
        '19': { text: "블루베리요거트스무디", count: 0 },
        '20': { text: "플레인요거트스무디", count: 0 },
        '21': { text: "리얼초코자바칩프라페", count: 0 },
        '22': { text: "쿠키초코프라페", count: 0 },
        '23': { text: "민트초코오레오프라페", count: 0 },
        '24': { text: "그린티프라페", count: 0 },
        '25': { text: "블루레몬 스페셜에이드", count: 0 },
        '26': { text: "청포도 스페셜에이드", count: 0 },
        '27': { text: "패션후르츠 스페셜에이드", count: 0 },
        '28': { text: "자몽에이드", count: 0 },
        '29': { text: "레몬에이드", count: 0 },
        '30': { text: "망고에이드", count: 0 },
        '31': { text: "유자에이드", count: 0 },
        '32': { text: "복숭아주스", count: 0 },
        '33': { text: "키위주스", count: 0 },
        '34': { text: "오렌지당근주스", count: 0 },
        '35': { text: "샤인파인케일주스", count: 0 },
        '36': { text: "HOT 자몽허니블랙티", count: 0 },
        '37': { text: "ICE 자몽허니블랙티", count: 0 },
        '38': { text: "HOT 페퍼민트", count: 0 },
        '39': { text: "ICE 페퍼민트", count: 0 },
        '40': { text: "HOT 캐모마일", count: 0 },
        '41': { text: "ICE 캐모마일", count: 0 },
        '42': { text: "HOT 로즈마리", count: 0 },
        '43': { text: "ICE 로즈마리", count: 0 },
        '44': { text: "HOT 얼그레이", count: 0 },
        '45': { text: "ICE 얼그레이", count: 0 },
        '46': { text: "HOT 레몬티", count: 0 },
        '47': { text: "ICE 레몬티", count: 0 },
    };

    var totalcnt = 0;
    window.onload = function () {
        changeMenu(1);
    };
    function changeMenu(category) {
        var btn = document.getElementsByName('btn');
 
        document.querySelectorAll('.table').forEach(function (table) {
            table.style.display = 'none';
        });

        for(i = 0; i < btn.length; i++){
            if(btn[i].classList.contains('activebtn')){
                btn[i].classList.remove('activebtn');
            }
        }
        btn[category-1].classList.add('activebtn');
        
        document.getElementById('table' + category).style.display = 'table';
    }
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    function add_item(menu_num) {
        menuItems[menu_num].count += 1;

        var resultorder = document.getElementById('resultorder');
        resultorder.innerHTML = '주문내역<br>';
        var resultcnt = document.getElementById('resultcnt');
        resultcnt.innerHTML = '수량<br>';

        for (var name in menuItems) {
            var item = menuItems[name];
            if (item.count > 0) {
                resultorder.innerHTML += item.text + '<br>';
                resultcnt.innerHTML += item.count + '<br>';
            }
        }
        switch (menu_num) {
            case 1:
                total_price += <?= $menuInfo[1]['ccost'] ?>;
                break;
            case 2:
                total_price += <?= $menuInfo[2]['ccost'] ?>;
                break;
            case 3:
                total_price += <?= $menuInfo[3]['ccost'] ?>;
                break;
            case 4:
                total_price += <?= $menuInfo[4]['ccost'] ?>;
                break;
            case 5:
                total_price += <?= $menuInfo[5]['ccost'] ?>;
                break;
            case 6:
                total_price += <?= $menuInfo[6]['ccost'] ?>;
                break;
            case 7:
                total_price += <?= $menuInfo[7]['ccost'] ?>;
                break;
            case 8:
                total_price += <?= $menuInfo[8]['ccost'] ?>;
                break;
            case 9:
                total_price += <?= $menuInfo[9]['ccost'] ?>;
                break;
            case 10:
                total_price += <?= $menuInfo[10]['ccost'] ?>;
                break;
            case 11:
                total_price += <?= $menuInfo[11]['ccost'] ?>;
                break;
            case 12:
                total_price += <?= $menuInfo[12]['ccost'] ?>;
                break;
            case 13:
                total_price += <?= $menuInfo[13]['ccost'] ?>;
                break;
            case 14:
                total_price += <?= $menuInfo[14]['ccost'] ?>;
                break;
            case 15:
                total_price += <?= $menuInfo[15]['ccost'] ?>;
                break;
            case 16:
                total_price += <?= $menuInfo[16]['ccost'] ?>;
                break;
            case 17:
                total_price += <?= $menuInfo[17]['ccost'] ?>;
                break;
            case 18:
                total_price += <?= $menuInfo[18]['ccost'] ?>;
                break;
            case 19:
                total_price += <?= $menuInfo[19]['ccost'] ?>;
                break;
            case 20:
                total_price += <?= $menuInfo[20]['ccost'] ?>;
                break;
            case 21:
                total_price += <?= $menuInfo[21]['ccost'] ?>;
                break;
            case 22:
                total_price += <?= $menuInfo[22]['ccost'] ?>;
                break;
            case 23:
                total_price += <?= $menuInfo[23]['ccost'] ?>;
                break;
            case 24:
                total_price += <?= $menuInfo[24]['ccost'] ?>;
                break;
            case 25:
                total_price += <?= $menuInfo[25]['ccost'] ?>;
                break;
            case 26:
                total_price += <?= $menuInfo[26]['ccost'] ?>;
                break;
            case 27:
                total_price += <?= $menuInfo[27]['ccost'] ?>;
                break;
            case 28:
                total_price += <?= $menuInfo[28]['ccost'] ?>;
                break;
            case 29:
                total_price += <?= $menuInfo[29]['ccost'] ?>;
                break;
            case 30:
                total_price += <?= $menuInfo[30]['ccost'] ?>;
                break;
            case 31:
                total_price += <?= $menuInfo[31]['ccost'] ?>;
                break;
            case 32:
                total_price += <?= $menuInfo[32]['ccost'] ?>;
                break;
            case 33:
                total_price += <?= $menuInfo[33]['ccost'] ?>;
                break;
            case 34:
                total_price += <?= $menuInfo[34]['ccost'] ?>;
                break;
            case 35:
                total_price += <?= $menuInfo[35]['ccost'] ?>;
                break;
            case 36:
                total_price += <?= $menuInfo[36]['ccost'] ?>;
                break;
            case 37:
                total_price += <?= $menuInfo[37]['ccost'] ?>;
                break;
            case 38:
                total_price += <?= $menuInfo[38]['ccost'] ?>;
                break;
            case 39:
                total_price += <?= $menuInfo[39]['ccost'] ?>;
                break;
            case 40:
                total_price += <?= $menuInfo[40]['ccost'] ?>;
                break;
            case 41:
                total_price += <?= $menuInfo[41]['ccost'] ?>;
                break;
            case 42:
                total_price += <?= $menuInfo[42]['ccost'] ?>;
                break;
            case 43:
                total_price += <?= $menuInfo[43]['ccost'] ?>;
                break;
            case 44:
                total_price += <?= $menuInfo[44]['ccost'] ?>;
                break;
            case 45:
                total_price += <?= $menuInfo[45]['ccost'] ?>;
                break;
            case 46:
                total_price += <?= $menuInfo[46]['ccost'] ?>;
                break;
            case 47:
                total_price += <?= $menuInfo[47]['ccost'] ?>;
                break;


        }

        totalprice.innerHTML = "총 결제 금액 <h2 style='color: red;'>￦" + numberWithCommas(total_price) + "</h2>";
    }
    function reset() {
        total_price = 0;
        menu_num = 0;
        var resultorder = document.getElementById('resultorder');
        resultorder.innerHTML = '주문내역<br>';
        var resultcnt = document.getElementById('resultcnt');
        resultcnt.innerHTML = '수량<br>';
        totalprice.innerHTML = "총 결제 금액<br><br><br><br><br>";
        for (var name in menuItems) {
            menuItems[name].count = 0;
        };
    }
    function payment(){
        var orderData = '';
        for (var name in menuItems) {
    var item = menuItems[name];
    if (item.count > 0) {
        orderData += item.text + ': ' + item.count+'<br>';
    }
}
if (orderData.trim() === '') {
        // 메뉴가 선택되지 않은 경우, 진행하지 않음
        return false;
    }
Swal.fire({
   title: '결제 하시겠습니까?',
   html: orderData+"<br>총 가격: "+ numberWithCommas(total_price)+"원<br><br><table style='margin-left:auto;margin-right:auto;'><tr><td><div class='paybutton' onclick='sendorder()'> 승인</div></td><td><div class='canclebutton' onclick='cancleorder()'> 취소</div></td></tr></table>",
   icon: 'warning',
   
   showConfirmButton: false,
   showCancelButton: false, // cancel버튼 보이기. 기본은 원래 없음
});
reset();
    }
    function sendorder(){
        
        Swal.fire('주문이 완료되었습니다.', '잠시만 기다려주세요!', 'success',);
    }
    function cancleorder() {
    Swal.close();
}
</script>

<body>
    <div class="container">
        <img src="coffee2.png" alt="" width="70%">
        <div class="overlay-text" onclick="">COMPOSE COFFEE</div>
    </div>
    <br>
    <div class="categorybar">
        <table>
            <tr>
                <td>
                    <div class="button" name="btn" onclick='changeMenu(1)'>
                        커피
                    </div>
                </td>
                <td>
                    <div class="button" name="btn" onclick='changeMenu(2)'>
                        스무디/프라페
                    </div>
                </td>
                <td>
                    <div class="button" name="btn" onclick='changeMenu(3)'>
                        에이드/주스
                    </div>
                </td>
                <td>
                    <div class="button" name="btn" onclick='changeMenu(4)'>
                        티
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <div class="table" id=table1>
        <table>
            <tr>
                <td>
                    <div class="menu_image" onclick="add_item(1)">
                        <img src='./menuimg/menu1.jpg' width="200px" height="250px">
                        HOT 아메리카노
                        <br>
                        <?=number_format($menuInfo[1]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(2)">
                        <img src='./menuimg/menu2.jpg' width="200px" height="250px">
                        ICE 아메리카노
                        <br>
                        <?=number_format($menuInfo[2]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(3)">
                        <img src='./menuimg/menu3.jpg' width="200px" height="250px">
                        HOT 카페라떼
                        <br>
                        <?=number_format($menuInfo[3]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(4)">
                        <img src='./menuimg/menu4.jpg' width="200px" height="250px">
                        ICE 카페라떼
                        <br>
                        <?=number_format($menuInfo[4]['ccost'])?>원
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="menu_image" onclick="add_item(5)">
                        <img src='./menuimg/menu5.jpg' width="200px" height="250px">
                        HOT 바닐라라떼
                        <br>
                        <?=number_format($menuInfo[5]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(6)">
                        <img src='./menuimg/menu6.jpg' width="200px" height="250px">
                        ICE 바닐라라떼
                        <br>
                        <?=number_format($menuInfo[6]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(7)">
                        <img src='./menuimg/menu7.jpg' width="200px" height="250px">
                        HOT 헤이즐넛라떼
                        <br>
                        <?=number_format($menuInfo[7]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(8)">
                        <img src='./menuimg/menu8.jpg' width="200px" height="250px">
                        ICE 헤이즐넛라떼
                        <br>
                        <?=number_format($menuInfo[8]['ccost'])?>원
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="menu_image" onclick="add_item(9)">
                        <img src='./menuimg/menu9.jpg' width="200px" height="250px">
                        HOT 카라멜마끼아또
                        <br>
                        <?=number_format($menuInfo[9]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(10)">
                        <img src='./menuimg/menu10.jpg' width="200px" height="250px">
                        ICE 카라멜마끼아또
                        <br>
                        <?=number_format($menuInfo[10]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(11)">
                        <img src='./menuimg/menu11.jpg' width="200px" height="250px">
                        HOT 카페모카
                        <br>
                        <?=number_format($menuInfo[11]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(12)">
                        <img src='./menuimg/menu12.jpg' width="200px" height="250px">
                        ICE 카페모카
                        <br>
                        <?=number_format($menuInfo[12]['ccost'])?>원
                    </div>
                </td>
            </tr>
        </table>
    </div>
    </div>
    <div class='table' id="table2">
        <table>
            <tr>
                <td>
                    <div class="menu_image" onclick="add_item(13)">
                        <img src='./menuimg/menu13.jpg' width="200px" height="250px">
                        딸기스무디
                        <br>
                        <?=number_format($menuInfo[13]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(14)">
                        <img src='./menuimg/menu14.jpg' width="200px" height="250px">
                        망고스무디
                        <br>
                        <?=number_format($menuInfo[14]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(15)">
                        <img src='./menuimg/menu15.jpg' width="200px" height="250px">
                        블루베리스무디
                        <br>
                        <?=number_format($menuInfo[15]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(16)">
                        <img src='./menuimg/menu16.jpg' width="200px" height="250px">
                        유자스무디
                        <br>
                        <?=number_format($menuInfo[16]['ccost'])?>원
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="menu_image" onclick="add_item(17)">
                        <img src='./menuimg/menu17.jpg' width="200px" height="250px">
                        딸기요거트스무디
                        <br>
                        <?=number_format($menuInfo[17]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(18)">
                        <img src='./menuimg/menu18.jpg' width="200px" height="250px">
                        망고요거트스무디
                        <br>
                        <?=number_format($menuInfo[18]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(19)">
                        <img src='./menuimg/menu19.jpg' width="200px" height="250px">
                        블루베리요거트스무디
                        <br>
                        <?=number_format($menuInfo[19]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(20)">
                        <img src='./menuimg/menu20.jpg' width="200px" height="250px">
                        플레인요거트스무디
                        <br>
                        <?=number_format($menuInfo[20]['ccost'])?>원
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="menu_image" onclick="add_item(21)">
                        <img src='./menuimg/menu21.jpg' width="200px" height="250px">
                        리얼초코자바칩프라페
                        <br>
                        <?=number_format($menuInfo[21]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(22)">
                        <img src='./menuimg/menu22.jpg' width="200px" height="250px">
                        쿠키초코프라페
                        <br>
                        <?=number_format($menuInfo[22]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(23)">
                        <img src='./menuimg/menu23.jpg' width="200px" height="250px">
                        민트초코오레오프라페
                        <br>
                        <?=number_format($menuInfo[23]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(24)">
                        <img src='./menuimg/menu24.jpg' width="200px" height="250px">
                        그린티프라페
                        <br>
                        <?=number_format($menuInfo[24]['ccost'])?>원
                    </div>
                </td>
            </tr>
        </table>
    </div>
    </div>
    <div class='table' id="table3">
        <table>
            <tr>
                <td>
                    <div class="menu_image" onclick="add_item(25)">
                        <img src='./menuimg/menu25.jpg' width="200px" height="250px">
                        블루레몬 스페셜에이드
                        <br>
                        <?=number_format($menuInfo[25]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(26)">
                        <img src='./menuimg/menu26.jpg' width="200px" height="250px">
                        청포도 스페셜에이드
                        <br>
                        <?=number_format($menuInfo[26]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(27)">
                        <img src='./menuimg/menu27.jpg' width="200px" height="250px">
                        패션후르츠 스페셜에이드
                        <br>
                        <?=number_format($menuInfo[27]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(28)">
                        <img src='./menuimg/menu28.jpg' width="200px" height="250px">
                        자몽에이드
                        <br>
                        <?=number_format($menuInfo[28]['ccost'])?>원
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="menu_image" onclick="add_item(29)">
                        <img src='./menuimg/menu29.jpg' width="200px" height="250px">
                        레몬에이드
                        <br>
                        <?=number_format($menuInfo[29]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(30)">
                        <img src='./menuimg/menu30.jpg' width="200px" height="250px">
                        망고에이드
                        <br>
                        <?=number_format($menuInfo[30]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(31)">
                        <img src='./menuimg/menu31.jpg' width="200px" height="250px">
                        유자에이드
                        <br>
                        <?=number_format($menuInfo[31]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(32)">
                        <img src='./menuimg/menu32.jpg' width="200px" height="250px">
                        복숭아주스
                        <br>
                        <?=number_format($menuInfo[32]['ccost'])?>원
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="menu_image" onclick="add_item(33)">
                        <img src='./menuimg/menu33.jpg' width="200px" height="250px">
                        키위주스
                        <br>
                        <?=number_format($menuInfo[33]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(34)">
                        <img src='./menuimg/menu34.jpg' width="200px" height="250px">
                        오렌지당근주스
                        <br>
                        <?=number_format($menuInfo[34]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(35)">
                        <img src='./menuimg/menu35.jpg' width="200px" height="250px">
                        샤인파인케일주스
                        <br>
                        <?=number_format($menuInfo[35]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image">
                    </div>
                </td>
            </tr>
        </table>
    </div>
    </div>
    <div class="table" id=table4>
        <table>
            <tr>
                <td>
                    <div class="menu_image" onclick="add_item(36)">
                        <img src='./menuimg/menu36.jpg' width="200px" height="250px">
                        HOT 자몽허니블랙티
                        <br>
                        <?=number_format($menuInfo[36]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(37)">
                        <img src='./menuimg/menu37.jpg' width="200px" height="250px">
                        ICE 자몽허니블랙티
                        <br>
                        <?=number_format($menuInfo[37]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(38)">
                        <img src='./menuimg/menu38.jpg' width="200px" height="250px">
                        HOT 페퍼민트
                        <br>
                        <?=number_format($menuInfo[38]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(39)">
                        <img src='./menuimg/menu39.jpg' width="200px" height="250px">
                        ICE 페퍼민트
                        <br>
                        <?=number_format($menuInfo[39]['ccost'])?>원
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="menu_image" onclick="add_item(40)">
                        <img src='./menuimg/menu40.jpg' width="200px" height="250px">
                        HOT 캐모마일
                        <br>
                        <?=number_format($menuInfo[40]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(41)">
                        <img src='./menuimg/menu41.jpg' width="200px" height="250px">
                        ICE 캐모마일
                        <br>
                        <?=number_format($menuInfo[41]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(42)">
                        <img src='./menuimg/menu42.jpg' width="200px" height="250px">
                        HOT 로즈마리
                        <br>
                        <?=number_format($menuInfo[42]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(43)">
                        <img src='./menuimg/menu43.jpg' width="200px" height="250px">
                        ICE 로즈마리
                        <br>
                        <?=number_format($menuInfo[43]['ccost'])?>원
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="menu_image" onclick="add_item(44)">
                        <img src='./menuimg/menu44.jpg' width="200px" height="250px">
                        HOT 얼그레이
                        <br>
                        <?=number_format($menuInfo[44]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(45)">
                        <img src='./menuimg/menu45.jpg' width="200px" height="250px">
                        ICE 얼그레이
                        <br>
                        <?=number_format($menuInfo[45]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(46)">
                        <img src='./menuimg/menu46.jpg' width="200px" height="250px">
                        HOT 레몬티
                        <br>
                        <?=number_format($menuInfo[46]['ccost'])?>원
                    </div>
                </td>
                <td>
                    <div class="menu_image" onclick="add_item(47)">
                        <img src='./menuimg/menu47.jpg' width="200px" height="250px">
                        ICE 레몬티
                        <br>
                        <?=number_format($menuInfo[47]['ccost'])?>원
                    </div>
                </td>
            </tr>
        </table>
    </div>
    </div>

    <div class="bottomtable">
        <table>
            <tr>
                <td>
                    <div id="resultorder">
                        주문내역
                    </div>
                </td>
                <td>
                    <div id="resultcnt">
                        수량
                    </div>
                </td>
                <td>
                    <div id="totalprice">
                        총 결제 금액    
                    </div>
                    <div class="reset" onclick="reset()">
                        전체 취소
                    </div>
                </td>
                <td>
                    <div class="payment" onclick="payment()">
                        결제하기
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>