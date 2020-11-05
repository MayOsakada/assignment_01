<?=
//セッションチェック
session_start();
include("funcs.php");
sessionCheck();

///予定を更新します
//1. POSTデータ取得
$day   = $_POST["day"];
$yotei1  = $_POST["yotei1"];
$yotei2  = $_POST["yotei2"];
$yotei3  = $_POST["yotei3"];

try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db_kadai03;charset=utf8;host=localhost', 'root', 'root');
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}
//２．データ取得SQL作成
$stmt = $pdo->prepare("UPDATE calendar_202010 SET yotei1 = '$yotei1', yotei2 = '$yotei2', yotei3 = '$yotei3' WHERE date = '$day';");
$status = $stmt->execute();
var_dump($status);
//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    // $error = $stmt->errorInfo();
    // exit("SQLError:".$error[2]);
    sql_error($stmt);
}else{
    //*** function化する！*****************
    header("Location: index.php");
    // exit();
    //redirect("index.php");
}
?>

?>