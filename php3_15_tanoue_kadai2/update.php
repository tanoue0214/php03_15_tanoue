<?php
require_once('funcs.php');
//1. POSTデータ取得
$name   = $_POST['name'];
$lid  = $_POST['lid'];
$lpw = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg'];
$life_flg= $_POST['life_flg'];
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE
                        gs_user_table
                    SET
                       name = :name,
                       lid= :lid,
                        lpw = :lpw,
                        kanri_flg = :kanri_flg,
                        life_flg = :life_flg
                        
                    where
                        id = :id;
                    ');
// 最後のものには,をつけない
// sql文の最後は;をつける :id;
// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR

$stmt->bindValue(':name', $b_name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $b_url, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $b_comment, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $b_comment, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $b_comment, PDO::PARAM_INT);
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

