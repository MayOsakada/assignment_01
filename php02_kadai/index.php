
<?php //テーブル読み込み
            //1.  DB接続します//お約束　ＤＢ名だけつくる
            try {
            //Password:MAMP='root',XAMPP=''
            $pdo = new PDO('mysql:dbname=gs_bm_table;charset=utf8;host=localhost', 'root', 'root');
            } catch (PDOException $e) {
            exit('DBConnectError:' . $e->getMessage());
            }
            //２．データ取得SQL作成
            $stmt = $pdo->prepare("SELECT hour, minutes FROM alarm_table");//テーブルにあるデータを持って来るだけなので文字列でいれるとかは気にしなくていいよ
            $status = $stmt->execute();//成功失敗
            //３．データ表示
            $view="";
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
</head>

<body>
<header class="head">

<h1>今日はもういいよ! アラーム</h1>
<img src="tokei.png">
<div id="viewTime"></div>
</header>


<div id="check">
    <input  type="submit" value="今日はもういいですボタン" onClick="todayok()" >
</div> 
<div id="outputarea">
    <!-- 入力データが入る -->
    <?= $view ?>
</div>
<div id="setbutton">
        <a href="insert.php">時間をセットする</a>
</div> 

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

        <?php //テーブル読み込み
            //1.  DB接続します//お約束　ＤＢ名だけつくる
            $hour = date("G");
            $minutes = date("i");

            try {
            //Password:MAMP='root',XAMPP=''
            $pdo = new PDO('mysql:dbname=gs_bm_table;charset=utf8;host=localhost', 'root', 'root');
            } catch (PDOException $e) {
            exit('DBConnectError:' . $e->getMessage());
            }
            //２．データ取得SQL作成(フラグに値がないものを取得する)
            $stmt = $pdo->prepare("SELECT hour, minutes FROM alarm_table WHERE hour = $hour and minutes = $minutes and flag = 'x'");//テーブルにあるデータを持って来るだけなので文字列でいれるとかは気にしなくていいよ
            $status = $stmt->execute();//成功失敗を格納
            //３．データ表示
            if ($status==false) {//取得失敗
                //execute（SQL実行時にエラーがある場合）
            $error = $stmt->errorInfo();
            exit("ErrorQuery:".$error[2]);
            }else{//取得成功
            //Selectデータの数だけ自動でループしてくれる
            //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){


                    if($result['hour'] = $hour){
                        if($result['minutes'] = $minutes){
                            $alert = "alert('時間です') ";
                        }
                    }
                }
            }
        ?>

        <?= $alert ?>;

    }

    function todayok(){


        //テーブルにフラグを立てる

    }


        // //セット クリックイベント
        // $("#savebutton").on("click",function(){
        //     console.log(h);
        //     const hour = $("#hour").val();//keyに入力された値を持ってくる
        //     const minutes = $("#minutes").val();
        //     let idcount = $("#outputtable tr").length;
        //     let settime = hour+':'+minutes;
        //     localStorage.setItem(idcount,settime);
            
        //     const html = '<tr><th id="time'+idcount+'">'+hour+':'+minutes+'</th><td><button id="trash'+idcount+'" onClick="del('+idcount+')">削除</td></tr>';
        //     $("#outputtable").append(html);

        // });

        
        // //削除 クリックイベント関数
        // function del(idcount) {

        //     $('#trash'+idcount).parent().parent().remove();
            
        //     //ローカルストレージからも削除
        //     localStorage.removeItem(idcount);
        // }



    // //2.clear クリックイベント
    // $("#clear").on("click",function(){
    //     localStorage.clear();
    //     $("#list").empty();
    //     alert("ok");

    // });



    // //3.ページ読み込み：保存データ取得表示 //リロードしても動くよ
    // for(let i=0; i<localStorage.length; i++){
    //     const key = localStorage.key(i);
    //     const memo = localStorage.getItem(key);
    //     const html = '<tr><td>'+key+'</td><td>'+memo+'</td></tr>';
    //     $("#list").append(html);
    // }




</script>
</body>
</html>