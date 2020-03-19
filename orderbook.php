
<!DOCTYPE html>
<html lang="en" style="height: 100%">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>訂購書籍-線上書籍訂購系統</title>

    <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style>
        body {
                background-image: url("https://i.pinimg.com/originals/37/0e/4d/370e4dd454581f7756dd6de562acc7c1.jpg");
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

    }
    /* Change the link color to #111 (black) on hover */
    li a:hover {
      background-color: #111;
    }
    #book_info{
      float: left;
    }
    #book {
            margin: auto;
            border: 5px solid #555555;
            background: #FFFFFF;
            width: 900px; height: 500px;
            font:normal 24px helvetica; color:#444444;
        }
    </style>
  </head>
  <body style="min-height: 100%;display: flex; flex-direction: column; ">
    <div style="flex: 1">
    <!-- Navigation -->
    <nav class="nav">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><p>線上書籍訂購系統</p></li>
      <li  style="float:right"><a href="login.php">登出</a></li>
      <li  style="float:right"><a href="update_Account.php">帳戶資料</a></li>
      <li  style="float:right"><a href="orderlist.php">訂單查詢</a></li>
      <li  class="active" style="float:right"><a href="booklist.php">訂購書籍</a></li>
      <li style="float:right"><a href="index.php">首頁</a></li>
    </ul>
  </div>
</nav><br><br><br><br>

<?php
session_start();
require_once 'config.php';
$data = $mysqli->query("SELECT * FROM class");
if($_SESSION['useraccount'] == null)
{
  echo "<script>alert('請重新登入'); location.href = 'login.php';</script>";
}
$useraccount = $_SESSION['useraccount'];
$bookname = $bookauthor = $bookisbn = $bookprice =$bookpic = $discount="";
$ordernum = 0;
$total = 0;
$address = "";

if(isset($_SESSION['bookname']))
  $bookname = $_SESSION['bookname'];
if(isset($_SESSION['bookauthor']))
  $bookauthor = $_SESSION['bookauthor'];
if(isset($_SESSION['bookisbn']))
  $bookisbn = $_SESSION['bookisbn'];
if(isset($_SESSION['bookprice']))
  $bookprice = $_SESSION['bookprice'];
if(isset($_SESSION['bookpic']))
  $bookpic = $_SESSION['bookpic'];
if(isset($_SESSION['discount']))
  $discount = $_SESSION['discount'];
if(isset($_POST['num'])&&isset($_POST['address'])){
  $ordernum = $_POST['num'];
  $address = $_POST['address'];
  $total=$bookprice*$ordernum;
  $query = "INSERT INTO book_order(buyer,kind,num,discount,total,address) values ('".$useraccount."','".$bookisbn."',".$ordernum.",'".$discount."',".$total.",'".$address."')";
  $result = $mysqli->query($query);
  if(!$result){
    echo "<script>alert('出現錯誤，請重試一次');</script>";
  }
  else{
     
      echo "<script>alert('成功下訂');location.href = 'orderlist.php';</script>";
  }
}


echo 
'      <section>
      <div id="book">
      <div class="container">
        <div id="book_info">
          <br>
          <img src="'.$bookpic.'" width="260px" height="380px">
        </div>

        <div id="book_info">&nbsp&nbsp&nbsp&nbsp</div>

        <div id="book_info">
          <br>
        <form action="orderbook.php" method="post">
          書名:'.$bookname.'<br><br>
          作者:'.$bookauthor.'<br><br>
          isbn:'.$bookisbn.'<br><br>
          定價:NT$'.$bookprice.'<br><br>
          使用優惠(一次只能使用一項):'.$discount.'<br><br>
          <div>
          訂購&nbsp&nbsp<input type="number" name="num" value="1" min="1" style="width: 70px;">&nbsp&nbsp本
          <br><br>
          <div>
          <div>
          寄送地址:&nbsp&nbsp<input type="text" name="address" required = "required" style="width: 450px;">&nbsp&nbsp
          <br><br>
          <div>
          <input type="submit" value="訂購"><br>
        </form>
        </div>
        </div>

        <br><br>
  </section>';

?>

     
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