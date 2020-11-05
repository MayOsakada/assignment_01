<?php
//セッションチェック
session_start();
include("funcs.php");
sessionCheck();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

// 前月・次月リンクが押された場合は、GETパラメーターから年月を取得
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // 今月の年月を表示
    $ym = date('Y-m');
}

// タイムスタンプを作成し、フォーマットをチェックする
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// 今日の日付 フォーマット　例）2018-07-3
$today = date('Y-m-j');

// カレンダーのタイトルを作成　例）2017年7月
$html_title = date('Y年n月', $timestamp);

// 前月・次月の年月を取得
// 方法１：mktimeを使う mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));


// 該当月の日数を取得
$day_count = date('t', $timestamp);

// １日が何曜日か　0:日 1:月 2:火 ... 6:土
// 方法１：mktimeを使う
$youbi = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
// 方法２
// $youbi = date('w', $timestamp);


// カレンダー作成の準備
$weeks = [];
$week = '';

// 第１週目：空のセルを追加
// 例）１日が水曜日だった場合、日曜日から火曜日の３つ分の空セルを追加する
$week .= str_repeat('<td></td>', $youbi);


$view="";    
$view2=""; 
$view3=""; 

//1.  DB接続します//お約束　ＤＢ名だけつくる
    try {
        //Password:MAMP='root',XAMPP=''
        $pdo = new PDO('mysql:dbname=gs_db_kadai03;charset=utf8;host=localhost', 'root', 'root');
    } catch (PDOException $e) {
        exit('DBConnectError:' . $e->getMessage());
    }


    for ( $day = 1; $day <= $day_count; $day++, $youbi++) {

            //２．データ取得SQL作成
    $stmt = $pdo->prepare("SELECT * FROM calendar_202010 where date = $day;");
    $status = $stmt->execute();

    if ($status == false) {//取得失敗
        sql_error($status);
    } else {//取得成功
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $view .= $result['yotei1'];
            $view1 .=$result['yotei2'];
            $view2 .=$result['yotei3'];
        }
    }

        // 2017-07-3
        $date = $ym . '-' . $day;

        if ($today == $date) {//<td><a href=add.php> 1~31</br>yotei1~3</a></td>
            // 今日の日付の場合は、class="today"をつける
            $week .= '<td class="today"><a href=add.php?day='.$day.'>' . $day.'</a>';
        } else {
            $week .= '<td><a href=add.php?day='.$day.'>' . $day.'</a>';
        }
        $week .= '</br>'.$view.'</br>'.$view1.'</br>'.$view2 .'</td>';

        // 週終わり、または、月終わりの場合
        if ($youbi % 7 == 6 || $day == $day_count) {

            if ($day == $day_count) {
                // 月の最終日の場合、空セルを追加
                // 例）最終日が木曜日の場合、金・土曜日の空セルを追加
                $week .= str_repeat('<td></td>', 6 - ($youbi % 7));
            }

            // weeks配列にtrと$weekを追加する
            $weeks[] = '<tr>' . $week . '</tr>';

            // weekをリセット
            $week = '';
        }
        $view="";    
        $view2=""; 
        $view3=""; 

    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>スケジュールカレンダー</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <p class="title_jp">スケジュールカレンダー</p>
    <h2>管理者画面</h2>
    <div class="container">
        <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
        <table class="table table-bordered">
        <?=$view?>
            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
            ?>
        </table>
        <h3 class="logout"><a href="logout.php">LOGOUT</a>
    </div>
</body>
</html>