
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
            width: 750px; height: 390px;
            font:normal 24px helvetica; color:#444444;
        }
    #og_price{
      font:normal 24px helvetica; color:#444444;
      text-decoration: line-through;
    }
    #discount{
        color: red;
        font-weight:bold;
        font-size: 28px;
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
$bookname = $bookauthor = $bookisbn = $bookprice =$bookpic = $discount="";
if(isset($_POST['bookname']))
  $_SESSION['bookname'] = $_POST['bookname'];
if(isset($_POST['bookauthor']))
  $_SESSION['bookauthor'] = $_POST['bookauthor'];
if(isset($_POST['bookisbn']))
  $_SESSION['bookisbn'] = $_POST['bookisbn'];
if(isset($_POST['bookprice']))
  $_SESSION['bookprice'] = $_POST['bookprice'];
if(isset($_POST['bookpic']))
  $_SESSION['bookpic'] = $_POST['bookpic'];
if(isset($_POST['discount']))
  $_SESSION['discount'] = $_POST['discount'];
if(isset($_POST['bookname']))
  echo "<script>location.href = 'orderbook.php';</script>";
?>

    <section>
      <div id="book">
      <div class="container">
        <div id="book_info">
          <br>
          <img src="https://images-na.ssl-images-amazon.com/images/I/91uReMRrz6L.jpg" width="220px" height="330px">
        </div>

        <div id="book_info">&nbsp&nbsp&nbsp&nbsp</div>

        <div id="book_info">
          <br>
        <form action="booklist.php" method="post">
          書名:And Then There Were None<br><br>
          作者:Agatha Christie<br><br>
          isbn:0007136838<br><br>
          <p style="float: left">定價:&nbsp&nbsp</p><p id="og_price" style="float: left">NT$384<p>&nbsp&nbsp<p id="discount" style="float: left;">NT$338</p><br>
          <input type="hidden" name="bookname" value="And Then There Were None">
          <input type="hidden" name="bookauthor" value="Agatha Christie">
          <input type="hidden" name="bookisbn" value="0007136838">
          <input type="hidden" name="bookprice" value="338">
          <input type="hidden" name="bookpic" value="https://images-na.ssl-images-amazon.com/images/I/91uReMRrz6L.jpg">
          <br>
          <input type="hidden" name="discount" value="周年慶全館88折">
          <br>
          <input type="submit" value="去訂購"><br>
        </form>
        </div>
        </div>

        <br><br>

      <div id="book">
      <div class="container">
        <div id="book_info">
          <br>
          <img src="https://images-na.ssl-images-amazon.com/images/I/513Ru9zRjRL._SX330_BO1,204,203,200_.jpg" width="220px" height="330px">
        </div>

        <div id="book_info">&nbsp&nbsp&nbsp&nbsp</div>

        <div id="book_info">
        <br>
        <form  action="booklist.php" method="post">
          書名:The ABC Murders<br><br>
          作者:Agatha Christie<br><br>
          isbn:978-0062073587<br><br>
          <p style="float: left">定價:&nbsp&nbsp</p><p id="og_price" style="float: left">NT$385<p>&nbsp&nbsp<p id="discount" style="float: left;">NT$339</p><br>
          <input type="hidden" name="bookname" value="The ABC Murders">
          <input type="hidden" name="bookauthor" value="Agatha Christie">
          <input type="hidden" name="bookisbn" value="978-0062073587">
          <input type="hidden" name="bookprice" value="339">
          <input type="hidden" name="bookpic" value="https://images-na.ssl-images-amazon.com/images/I/513Ru9zRjRL._SX330_BO1,204,203,200_.jpg">
          <input type="hidden" name="discount" value="周年慶全館88折">
          <br><br>
          <input type="submit" value="去訂購"><br>
        </form>
        </div>
      </div>
    </div>


      <br>

      <div id="book">
      <div class="container">
        <div id="book_info">
          <br><img src="https://images-na.ssl-images-amazon.com/images/I/91Q5dCjc2KL.jpg" width="220px" height="330px">
        </div>

        <div id="book_info">&nbsp&nbsp&nbsp&nbsp</div>

        <div id="book_info">
          <br>
        <form  action="booklist.php" method="post">
          書名:The Da Vinci Code<br><br>
          作者:Dan Brown<br><br>
          isbn:978-0307474278<br><br>
          <p style="float: left">定價:&nbsp&nbsp</p><p id="og_price" style="float: left">NT$300<p>&nbsp&nbsp<p id="discount" style="float: left;">NT$264</p><br>
          <input type="hidden" name="bookname" value="The Da Vinci Code">
          <input type="hidden" name="bookauthor" value="Dan Brown">
          <input type="hidden" name="bookisbn" value="978-0307474278">
          <input type="hidden" name="bookprice" value="264">
          <input type="hidden" name="bookpic" value="https://images-na.ssl-images-amazon.com/images/I/91Q5dCjc2KL.jpg">
          <input type="hidden" name="discount" value="周年慶全館88折">
          <br><br>
          <input type="submit" value="去訂購"><br>
        </form>
        </div>
    </div>
  </div>
   <br><br>
  </section>
     
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
