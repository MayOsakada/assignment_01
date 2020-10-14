<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>シート評価</title>
</head>
<body>

    <form action="index.php" method="post">
        ブロック<select name = "block"><option value="blocka">A</option><option value="blockc">C</option><option value=blocke>E</option>
                    <option value="blockg">G</option></select>
        タイトル: <input type="text" name="title">
        お名前: <input type="text" name="name">
        ★いくつ？：<select name = "star"><option value="1">1</option><option value="2">2</option><option value="3">3</option>
                    <option value="4">4</option><option value="5">5</option></select>
        コメント: <textarea  name="comment"></textarea>
        <input type="submit" value="送信">
    </form>
</body>
</html>