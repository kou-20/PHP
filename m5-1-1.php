<?php

//実行処理の確認
echo "DBへの接続を実行しました。";

//DB接続設定

$dsn = 'mysql:dbname=tb250573db;host=localhost';
$user = 'tb-250573';
$password = 'GZuFhxhz2u';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// テーブルの内容を表示する
$sql_select = "SELECT * FROM tb5_11";
$stmt_select = $pdo->query($sql_select);
$results_select = $stmt_select->fetchAll();

// 結果を出力
foreach ($results_select as $row_select) {
    echo "ID: " . $row_select['id'] . "<br>";
    echo "Name: " . $row_select['name'] . "<br>";
    echo "Comment: " . $row_select['comment'] . "<br>";
    echo "Password: " . $row_select['password'] . "<br>";
    echo "<hr>";
}
?>