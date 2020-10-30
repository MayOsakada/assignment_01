<?php
///日付をクリックするとその日付の予定を表示します
///追加したい予定を入力できます

$day = $_GET['day'];
//1.  DB接続します//お約束　ＤＢ名だけつくる
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db_kadai03;charset=utf8;host=localhost', 'root', 'root');
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}
//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM calendar_202010 WHERE date = $day;");
$status = $stmt->execute();

$view = "";
if ($status == false) {//取得失敗
    sql_error($status);
} else {//取得成功
    $result = $stmt->fetch();
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>予定を編集</legend>
    <input type="hidden" name="day"  value=<?= $day ?>>
     <label>予定<input type="text" name="yotei1"  value=<?= $result['yotei1'] ?>></label><br>
     <label>予定<input type="text" name="yotei2" value=<?= $result['yotei2'] ?>></label><br>
     <label>予定<input type="text" name="yotei3" value=<?= $result['yotei3'] ?>></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
    
</body>
</html>