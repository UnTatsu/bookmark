<?php
//1.  DB接続します
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=babybeat22_book_fav;charset=utf8;host=mysql57.babybeat22.sakura.ne.jp','babybeat22','');
} catch (PDOException $e) {
    exit('DBConnection Error:'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<tr>';
    $view .= '<td>'.$res['id'].'</td>';
    $view .= '<td><img src="'.$res['bookimg'].'" alt="画像なし"></td>';
    $view .= '<td><a href="'.$res['bookurl'].'">'.$res['bookname'].'</a></td>';
    $view .= '<td>'.$res['bookauthors'].'</td>';
    $view .= '<td>'.$res['bookdescription'].'</td>';
    $view .= '<td>'.$res['bookcomment'].'</td>';
    $view .= '</tr>';
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>お気に入りの本</title>

<link rel="stylesheet" href="./css/style.css">
</head>
<body id="main">
<!-- Head[Start] -->
<header>
      <div id="in2back">登録画面はこちら</div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <table id="favorite">
        <tr>
            <th>No.</th>
            <th>画像</th>
            <th>タイトル</th>
            <th>著者</th>
            <th>あらすじ</th>
            <th>コメント</th>
            </tr>  
        <?=$view?>
    </table>
</div>
<!-- Main[End] -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
  $("#in2back").on('click', function(){
    window.open('index2.php')
    open('about:blank', '_self').close();    //一度再表示してからClose
  })
</script>

</body>
</html>
