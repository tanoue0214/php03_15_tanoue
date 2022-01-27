<?php
$id = $_GET['id'];
// DBに接続
// 変数を使えるようにする！
require_once('funcs.php');
$pdo = db_conn();
// 2.データ登録sql作成　バインド変数(:id')を仮置きしてセキュリティ上の問題を回避
$stmt = $pdo->prepare('SELECT * FROM gs_user_table where id = :id');
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
    <title>会員詳細画面</title>
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
                <legend>会員詳細画面</legend>
                <label>名前：<input type="text" name="name" value=<?= $view['name']?>></label><br>
                <label>id：<input type="text" name="lid" value=<?= $view['lid']?>></label><br>
                <label>pw：<input type="text" name="lpw" value=<?= $view['lpw']?>></label><br>
                <label>管理者：<input type="checkbox" name="kanri_flg"　checked value=<?= $view['kanri_flg']?>></label><br>
                <label>退職者：<input type="checkbox" name="life_flg" checked value=<?= $view['life_flg']?>></label><br>
                <input type="submit" value="送信">
            </fieldset>
            <!-- textareaはvalueに値をいれるのではなく直接記述する -->
        </div>
    </form>
</body>
</html>

