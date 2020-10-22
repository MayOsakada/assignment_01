<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="css/sample.css">
</head>
<body>
<div id="setarea">
        <p>時間をセットしてください</p>
        <form action="settable.php" method="post">
            <select id="hour" name="hour"></select>
            <select id="minutes" name="minutes"></select>     
            <input type="submit" value="セット">
        </form>
    </div> 
</body>
<script>
    //初期表示
    //セレクトボックス内に0～23をセット
    let h ='<option hidden>選択してください（時）</option>';
    for (let i=0; i<24; i++){
        h += '<option value="'+i+'">'+i+'</option>';
    }
    $("#hour").html(h);
    //セレクトボックス内に0~59をセット
    let m ='<option hidden>選択してください（分）</option>';
    for(let i=0; i<60; i++){
        m += '<option value="'+i+'">'+i+'</option>';
    }
    $("#minutes").html(m);
</script>
</html>