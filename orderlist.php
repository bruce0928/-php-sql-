<!DOCTYPE html>
<html lang="en" style="height: 100%">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>訂單查詢-線上書籍訂購系統</title>

    <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style>
        body {
                background-image: url("https://images2.minutemediacdn.com/image/upload/c_crop,h_842,w_1500,x_0,y_0/v1554998553/shape/mentalfloss/istock-539673956.jpg?itok=icKQx-BB");
            }
        .active{
          background-color: #607d8b;
        }
        .footer {
        position: relative;
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
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      text-align: left;
      padding: 8px;
      font-size: 20px;
    }

    tr:nth-child(even){background-color: #f2f2f2;font-size: 20px;}

    tr:nth-child(odd){background-color: #ffd54f;font-size: 20px;}

    th {
      background-color: #2196f3;
      color: white;
      font-size: 20px;
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
      <li  class="active" style="float:right"><a href="orderlist.php">訂單查詢</a></li>
      <li style="float:right"><a href="booklist.php">訂購書籍</a></li>
      <li  style="float:right"><a href="index.php">首頁</a></li>
    </ul>
  </div>
</nav><br><br><br><br>

<?php
session_start();
require_once 'config.php';

if($_SESSION['useraccount'] == null)
{
  echo "<script>alert('請重新登入'); location.href = 'login.php';</script>";
}
if(isset($_POST['id'])&&isset($_POST['delete'])){
  $query = 'DELETE FROM book_order WHERE id = "'.$_POST['id'].'"';
  $data = $mysqli->query($query);
  if (!$data) 
    echo "<script>alert('取消失敗，請重試一次');</script>";
  else
    echo "<script>alert('取消成功');</script>";
}
if(isset($_POST['id'])&&isset($_POST['update'])){
  session_start();
  $_SESSION['isbn'] = $_POST['isbn'];
  $_SESSION['id'] = $_POST['id'];
  echo "<script>location.href = 'mod_order.php';</script>";
}
$useraccount = $_SESSION['useraccount'];
$inside_table = "";
$query = 'SELECT * FROM book_order WHERE buyer = "'.$useraccount.'"';
/*$query = 'SELECT * FROM book_order
WHERE id =
(SELECT order_id FROM order_list WHERE user_id = 
   (SELECT user_id FROM newuser WHERE account = "'.$useraccount.'"))';*/
$data = $mysqli->query($query);
if (!$data) die ("Database access failed");
$rows = $data->num_rows;  
if($rows == 0){
      echo <<<_END
      <table>
      <tr>
      <tr>
        <th>訂單編號</th>
        <th>isbn</th>
        <th>數量</th>
        <th>折扣</th>
        <th>總價</th>
        <th>寄送地址</th>
        <th>&nbsp</th>
      </tr>
      <tr><td>尚未訂購書籍</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td></tr></table>
_END;
}
else{
echo <<<_END
      <table>
      <tr>
        <th>訂單編號</th>
        <th>isbn</th>
        <th>數量</th>
        <th>折扣</th>
        <th>總價</th>
        <th>寄送地址</th>
        <th>&nbsp</th>
        <th>&nbsp</th>
      </tr>
_END;

for($i=0;$i<$rows;++$i)
{
    $row = $data->fetch_array(MYSQLI_NUM);
    $r0 = $row[0];
    $r2 = $row[2];
    $r3 = $row[3];
    $r4 = $row[4];
    $r5 = $row[5];
    $r6 = $row[6];

    echo <<<_END
      <tr>
        <td>$r0</td>
        <td>$r2</td>
        <td>$r3</td>
        <td>$r4</td>
        <td>$r5</td>
        <td>$r6</td>
        <td>
        <form method="post" action="orderlist.php">
        <input type="hidden" name = "id" value="$r0">
        <input type="hidden" name = "isbn" value="$r2">
        <input type="hidden" name = "update" value="1">
        <input type="submit" value="修改訂單">
        </form></td>
        <td>
        <form method="post" action="orderlist.php">
        <input type="hidden" name = "id" value="$r0">
        <input type="hidden" name = "isbn" value="$r2">
        <input type="hidden" name = "delete" value="2">
        <input type="submit" value="取消訂單">
        </form></td>
      </tr>
_END;      
  }
  echo "</table>";
}

?>
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
