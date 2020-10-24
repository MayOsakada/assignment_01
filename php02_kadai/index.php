
<?php //テーブル読み込み
            //1.  DB接続します//お約束　ＤＢ名だけつくる
            try {
            //Password:MAMP='root',XAMPP=''
            $pdo = new PDO('mysql:dbname=gs_bm_table;charset=utf8;host=localhost', 'root', 'root');
            } catch (PDOException $e) {
            exit('DBConnectError:' . $e->getMessage());
            }
            //２．データ取得SQL作成
            $stmt = $pdo->prepare("SELECT hour, minutes, flag FROM alarm_table ORDER BY hour");//テーブルにあるデータを持って来るだけなので文字列でいれるとかは気にしなくていいよ
            $status = $stmt->execute();//成功失敗
            //３．データ表示
            $view="";
            $houra[]="";
            $minutesa[]="";
            $count="";
            $flag[]="";
            if ($status==false) {//取得失敗
                //execute（SQL実行時にエラーがある場合）
            $error = $stmt->errorInfo();
            exit("ErrorQuery:".$error[2]);
            }else{//取得成功
            //Selectデータの数だけ自動でループしてくれる
            //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                $view.="<p>";
                $view .= $result['hour']. ':' . $result['minutes'];
                //.= はテーブル行をどんどん追加していく上書きを防ぐ。’.’がないと一行だけしか表示されない
                $view.="</p>";
                $houra[] = $result['hour'];
                $minutesa[] = $result['minutes'];
                $flag[] = $result['flag'];
                $count = $count + 1;

            }
            }

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Alarm</title>
<script src="js/jquery-2.1.3.min.js"></script>
<link rel="stylesheet" href="css/sample.css">

<script>
    //初期表示

   
    //一秒ごとに読み込み（1分毎に読み込んでアラームを鳴らす）
    setInterval("timer()",60000);//アラーム用
    setInterval("timer1()",1000);//表示用

    function timer1(){//1秒毎
        let now = new Date(); //nowのためのインスタンス作成
        let p_hours = now.getHours();
        let p_minutes = now.getMinutes();
        //let p_seconds = now.getSeconds();

        //現在時間の表示
        if(p_hours<10 || p_minutes<10){
            //01とかって表示したい//保留
        }
        $("#viewTime").html(p_hours + ":" + p_minutes);
    }

    function timer(){//1分毎
        //時間取得
        let now = new Date(); //nowのためのインスタンス作成
        let p_hours = now.getHours();
        let p_minutes = now.getMinutes();

        //phpの情報を取得
        var count = "<?php echo $count; ?>";
        const hour_array = <?= json_encode($houra) ?>;
        const minutes_array = <?= json_encode($minutesa) ?>;
        const flag_array = <?= json_encode($flag) ?>;

        for(let i =0; i<count; i++){
           if(hour_array[i] = p_hours & minutes_array[i] = p_minutes & flag[i] = null){
                   alert("時間です");
           };

        };

    }

</script>
</head>

<body>
<header class="head">

<h1>今日はもういいよ! アラーム</h1>
<img src="tokei.png">
<div id="viewTime"></div>
<?= $alert?>
</header>


<div id="check">
<a href="todayok.php">今日はもういいですボタン</a>
</div> 
<div id="outputarea">
    <!-- 入力データが入る -->
    <?= $view ?>
</div>
<div id="setbutton">
        <a href="insert.php">時間をセットする</a>
</div> 

</body>
</html>