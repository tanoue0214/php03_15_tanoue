<?php
$id = $_GET['id'];
// DBに接続
// 変数を使えるようにする！
require_once('funcs.php');
$pdo = db_conn();
// 2.データ登録sql作成　バインド変数(:id')を仮置きしてセキュリティ上の問題を回避
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table where id = :id');
$stmt ->bindValue(':id',$id, PDO::PARAM_INT);
$status = $stmt->execute();
// ３、データ表示
$view = '';
if ($status === false) {
    sql_error($stmt);
} else {
    // データが取得できたら fetchでデータを取ってくる
    $view = $stmt->fetch();
}
// var_dump($view);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ブックマーク登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>
    <!-- method, action, 各inputのnameを確認してください。  -->
    <!-- 飛ばす場所はupdate -->
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>詳細画面</legend>
                <label>書籍名：<input type="text" name="b_name" value=<?= $view['b_name']?>></label><br>
                <label>URL：<input type="text" name="b_url" value=<?= $view['b_url']?>></label><br>
                <label><textarea name="b_comment" rows="4" cols="40" ><?= $view['b_comment']?></textarea></label><br>
                <input type="hidden" name="id" value=<?= $view['id']?>><br>
                <!-- idを変えられる可能性があるため、hidden -->
                <input type="submit" value="送信">
            </fieldset>
            <!-- textareaはvalueに値をいれるのではなく直接記述する -->
        </div>
    </form>
</body>
</html>



