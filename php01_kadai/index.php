<?php

// POSTを受け取る
$block = $_POST['block'];
$title = $_POST['title'];
$name = $_POST['name'];
$star = $_POST['star'];
$comment = $_POST['comment'];

//formで入力されたjsを起動させない
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}
//☆の編集
if ($star = 1){
    $star = '★☆☆☆☆';
}elseif($star = 2){
    $star = '★★☆☆☆';
}elseif($star = 3){
    $star = '★★★☆☆';
}elseif($star = 4){
    $star = '★★★★☆';
}else{
    $star = '★★★★★';
};
//ファイルに書き込む
//書き込み対象ファイル：
$file = fopen('./'. $block. '.txt','a');//パス先にファイルがなければ追加
fwrite($file,'<h3>●座席レビュー</h3><div id= \"review\"><h4>'.h($title).'</h4><p>'.h($name).'</p><p>見やすさ：'.h($star).'</p><p>'.h($comment).'</p></div>'."\n");
//fwrite($file,'<h3>●座席レビュー</h3><div id= \"review\"><img src=\"buke.png\"><h4>'.h($title).'</h4><p>'.h($name).'</p><p>見やすさ：'.h($star).'</p><p>'.h($comment).'</p></div>'."\n");
//fclose($file);

//ファイルを読み込む
// ファイルを開く
$openfile = fopen('./'. $block. '.txt','r');
// ファイル内容を1行ずつ読み込んで出力
while ( $str = fgets($openfile)){//$strに読み込んだ1行分のデータを入れる
    $count = $count +1;//何行あるかを確認
    $ary[] = $str;
}
// ファイルを閉じる
fclose($openfile);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>国立競技場|座席評価</title>
    <script src="js/jquery-2.1.3.min.js"></script>  
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="body">
    <h2>
        <p class="title_jp">国立競技場 座席評価</p>
        <p class="title_en">SEAT REVIEW</p>
    </h2>
    <div id="seatbox">
        <img src="seatmap.jpg" width="710" height="545" usemap="#seatmap">
        <map name="seatmap">
            <area shape="rect" coords="102,253,205,291" href="javascript:void(0)" onclick= "mclick('blocka')">
            <area shape="rect" coords="309,111,409,149" href="javascript:void(0)" onclick= "mclick('blockg')">
            <area shape="rect" coords="523,252,612,288" href="javascript:void(0)" onclick= "mclick('blocke')">
            <area shape="rect" coords="308,391,410,429" href="javascript:void(0)" onclick= "mclick('blockc')">
        </map>
    </div>
    <div id="rbox">
    <!--レビュー一覧-->
    </div>
    <div id="button">
        <a class="button" href="review.php">座席の評価をする</a>
    </div>
<script> 
    //PHPから評価情報取得
    var name = "<?php echo $name; ?>";
    console.log(name);
    var count = "<?php echo $count; ?>";
    const js_ary = <?= json_encode($ary) ?>;

    //ブロック押下時にポイントビューと座席ビューを表示する
    function mclick(blockname) {
        //ポイントビューと画像を表示
        $("#rbox").append("<h3>●ポイントビュー</h3><img src=\""+blockname+".jpg\">");

        //評価を表示
        for(let i =0; i<count; i++){
           $("#rbox").append(js_ary[i]);
           console.log(js_ary[i]);
        }

    }
</script>

</body>
</html>

