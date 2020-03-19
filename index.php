<?php
session_start();
require_once 'config.php';

if($_SESSION['useraccount'] == null)
{
  echo "<script>alert('請重新登入'); location.href = 'login.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en" style="height: 100%">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>線上書籍訂購系統</title>

    <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style>
        body {
                background-image: url("http://millmarginalia.org/static/img/background1.png");
            }
        .active{
          background-color: #607d8b;
        }
        .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #32CD32;
        color: white;
        text-align: center;
        } 
        .nav {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        background-color: #212121 ;
        color: white;
        text-align: center;
        }
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
    }

    li {
      float: left;
    }

    li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }
    li p{
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 28px;
    }
    /* Change the link color to #111 (black) on hover */
    li a:hover {
      background-color: #111;
    }

    </style>
  </head>
  <body style="min-height: 100%;display: flex; flex-direction: column; ">
    <div style="flex: 1">
    <!-- Navigation -->
    <nav class="nav">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><p>歡迎使用線上書籍訂購系統</p></li>
      <li  style="float:right"><a href="login.php">登出</a></li>
      <li  style="float:right"><a href="update_Account.php">帳戶資料</a></li>
      <li  style="float:right"><a href="orderlist.php">訂單查詢</a></li>
      <li style="float:right"><a href="booklist.php">訂購書籍</a></li>
      <li class="active" style="float:right"><a href="index.php">首頁</a></li>
    </ul>
  </div>
</nav><br><br><br><br>



    <section>

    </section>

  </div>
    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <p>線上書籍訂購系統&nbsp&nbspCopyright &copy; 2019</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>

</html>
