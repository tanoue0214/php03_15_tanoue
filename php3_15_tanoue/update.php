<?php
require_once('funcs.php');
//1. POSTデータ取得
$b_name   = $_POST['b_name'];
$b_url  = $_POST['b_url'];
$b_comment = $_POST['b_comment'];
$id = $_POST['id'];
$pdo = db_conn();
//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE
                        gs_bm_table
                    SET
                       b_name = :b_name,
                        b_url = :b_url,
                       b_comment = :b_comment,
                        datetime = sysdate()
                    where
                        id = :id;
                    ');
// 最後のものには,をつけない
// sql文の最後は;をつける :id;
// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':b_name', $name, PDO::PARAM_STR);
$stmt->bindValue(':b_url', $email, PDO::PARAM_STR);
$stmt->bindValue(':b_comment', $content, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行
// PARAM_INT整数
//４．データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}
?>