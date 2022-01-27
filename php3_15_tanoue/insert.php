<?php
require_once('funcs.php');
//1. POSTデータ取得
$b_name   = $_POST['b_name'];
$b_url  = $_POST['b_url'];
$b_comment = $_POST['b_comment'];
$pdo = db_conn();
//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(b_name,b_url,b_comment,datetime)VALUES(:b_name,:b_url,:b_comment,sysdate())");
// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':b_name', $b_name, PDO::PARAM_STR);
$stmt->bindValue(':b_url', $b_url, PDO::PARAM_STR);
$stmt->bindValue(':b_comment', $b_comment, PDO::PARAM_STR);
$status = $stmt->execute(); //実行
//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    sql_error($stmt);
    // $error = $stmt->errorInfo();
    // exit('SQLError:' . print_r($error, true));
} else {
    //*** function化する！*****************
    // header('Location: index.php');
    // exit();
    redirect('index.php');
}
?>
