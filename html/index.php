<html lang="ja">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>メール送信フォーム</title>
  </head>
  <body>
    <h1>メール送信フォーム</h1>
    <form action="submit.php" method="post">
      <div>氏名： <input type="text" name="name" id="name"></div>
      <div>メールアドレス: <input type="text" name="to" id="to"></div>
      <div>件名: <input type="text" name="subject" id="subject"></div>
      <div>本文: <br />
        <textarea name="message" id="message" cols="50" rows="10"></textarea>
      </div>
      <div><input type="submit" value="送信" /></div>
    </form>
  </body>
</html>
