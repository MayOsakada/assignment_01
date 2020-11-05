<?php
//ログイン認証処理用のPHPファイル

session_start();

//ログインID,パスワードの値の取得
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

//DB接続
include("funcs.php");
$pdo = db_conn();

//データ登録SQL作成　存在チェック
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid = :lid AND lpw = :lpw;");
$stmt->bindValue(':lid',$lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw',$lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入
//if(password_verify($lpw, $val["lpw"])){ //* PasswordがHash化の場合はこっちのIFを使う
if( $val["id"] != "" ){//IDが取れてきた場合（存在チェック成功
    //Login成功時
    $_SESSION["chk_ssid"]  = session_id();//成功した人のみセッションを付与
    $_SESSION["kanri_flg"] = $val['kanri_flg'];
    $_SESSION["name"]      = $val['name'];

    if($_SESSION["kanri_flg"] == '1'){
        header('Location: index.php');//管理者ページに飛ぶ
    }else{
        header('Location: index02.php');//一般＿閲覧ONLYページに飛ぶ
    }

}else{
    //Login失敗時(Logout経由)
    header('Location: login.php');
}

exit();

?>
