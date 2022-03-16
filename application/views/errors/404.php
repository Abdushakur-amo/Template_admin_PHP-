<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Страница <?=$code?></title>
    <link rel="shortcut icon" href="/favicon.ico">
</head>
<body>
    <style>
      *{transition: all 0.6s;}
      html {height: 100%;}
      body{font-family: 'Lato', sans-serif;color: #888;margin: 0;}
      #main{display: table;width: 100%;height: 100vh;text-align: center;}
      .fof{display: table-cell;vertical-align: middle;}
      .fof h1{font-size: 50px;margin-bottom: 5px;display: inline-block;padding-right: 12px;animation: type .5s alternate infinite;}
      .fof p{margin: 0;color: #66666694;}
      @keyframes type{from{box-shadow: inset -3px 0px 0px #888;}to{box-shadow: inset -3px 0px 0px transparent;}}
    </style>
    <div id="main">
          <div class="fof">
                <h1>Error <?=$code?></h1>
                <p><?=$text?></p>
          </div>
    </div>
</body>
</html>
