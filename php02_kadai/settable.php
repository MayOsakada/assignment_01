<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$hour = $_POST['hour'];
$minutes = $_POST['minutes'];


//2. DB接続します
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_bm_table;charset=utf8;host=localhost', 'root', 'root');
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}
//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO alarm_table(hour, minutes, flag)VALUES(:hour, :minutes, NULL)");//ここに直接値や変数を居れるのはセキュリティ上よくない
$stmt->bindValue(':hour', $hour, PDO::PARAM_STR); //文字列にする処理 //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':minutes', $minutes, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMessage:" . $error[2]);
} else {
    //  書き込みが成功した場合、ぺージが下記ＵＲＬに飛ぶ
    header("Location: index.php");
}
