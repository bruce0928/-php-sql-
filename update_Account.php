<?php
session_start(); 
/*
 * Following code will update a product information
 * A product is identified by product id (pid)
 */
require_once 'config.php';

// array for JSON response
$response = array();

$account = $_SESSION['useraccount'];

$message="";
$sqlcheck="SELECT * FROM newuser WHERE account = '$account'";
if (!empty($result = $mysqli->query($sqlcheck))) {

    if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {   //新版寫法

        $name = $row['name'];
        $password = $row['password'];
        $email = $row['email'];
        $phone = $row['phone'];
        //echo json_encode($row['id'] ,JSON_UNESCAPED_UNICODE);
        
    }
}
// check for required fields

//先將錯誤訊息設定為空
$nameErr = $passwordErr = $emailErr = $phoneErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	if ($_POST["action"]=="修改"){
	 
		  $name = $_REQUEST['name'];
		  $password = $_REQUEST['password'];
		  $email = $_REQUEST['email'];
		  $phone = $_REQUEST['phone'];

		$updated_at =date("Y/m/d H:i:s");
		$checkwrong=100;
		// date("Y/m/d H:i:s")可以取得時間 要設定時區
			if(!preg_match('/^(?!_|\s\')[A-Za-z0-9_\x80-\xff\s\']+$/',$name)){
			  $checkwrong=1;        
			  $nameErr = " 名稱不符規定 ";
			  $name = "";
			   //--------------------------------------------名稱不符
			}

			if(strlen($password) < 6){
			  $checkwrong=3;            
			  $passwordErr = "密碼不符規定 ";
			  $password = "";
			   //--------------------------------------------密碼不符
			}
			if(!preg_match('/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/', $email)){
			  $checkwrong=4;            
			  $emailErr = "電子郵件不符規定 ";
			  $email = "";
			   //--------------------------------------------郵件不符
			}
			if(!preg_match("/09[0-9]{2}[0-9]{6}/", $phone)){
			  $checkwrong=5;            
			  $phoneErr = "手機不符規定 ";
			  $phone = "";
			   //--------------------------------------------手機不符
			}



		if($checkwrong==100){
		// mysql update row with matched pid  //, updated_at = '$updated_at' email = '$email',
			$sql = "UPDATE newuser SET name ='$name', password = '$password', email = '$email', phone = '$phone'  WHERE account = '$account'";
			// check if row inserted or not
			if ($result = $mysqli->query($sql)) {
				// successfully updated
				echo "<script>alert('資料修改成功'); location.href = 'update_Account.php';</script>";
			}
		}
			
	}
	else{



		$sql = "DELETE FROM newuser WHERE account = '$account'";
		
		if ($result = $mysqli->query($sql)) {
			unset($_SESSION['useraccount']);
			echo "<script>alert('帳號刪除成功'); location.href = 'login.php';</script>";
		}else{
			$message="帳號刪除失敗";
		}			

	}

}
?>
<!DOCTYPE html>
<html lang="en" style="height: 100%">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>帳戶資訊-線上書籍訂購系統</title>
    <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <style>
        body {
                background-image: url("https://2.bp.blogspot.com/-8viAI96YCNs/W8jF1nTQJJI/AAAAAAAAHic/IE_t7JF-thEBwIT29zGx7ipI3KEyhc55QCLcBGAs/s1600/7fe03fe7997c4f406596325ceb4bdb3b.jpg");
            }
        .active{
          background-color: #607d8b;
        }
        #info {
            margin: auto;
            border: 5px solid #555555;
            padding: 10px;
            background: #FFFFFF;
            width: 500px; height: 380px;
            font:normal 28px helvetica; color:#444444;
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
      <li  class="active" style="float:right"><a href="update_Account.php">帳戶資料</a></li>
      <li  style="float:right"><a href="orderlist.php">訂單查詢</a></li>
      <li style="float:right"><a href="booklist.php">訂購書籍</a></li>
      <li style="float:right"><a href="index.php">首頁</a></li>
    </ul>
  </div>
</nav><br><br><br><br>

  <body style="min-height: 100%;display: flex; flex-direction: column; ">
    <div style="flex: 1">
<style>
.error {color: #FF0000;}
</style>
    <section>
      <br><br>
      <div class="container">
        <div class=" w3-round-xlarge" id="info">
          <div >
            <div >
              <h2 align="center">個人資料修改</h2>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="form1" method="post">                
            <table  name="course" width="100%" >
              <tr>
                <td>帳號</td>
                <td align="left"><?php echo $account;?></td>
              </tr>
              <tr>
                <td>姓名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><Input  Type="text" id="name" Name="name" value="<?php echo $name;?>" required></td>
                <td><span class="error"><?php echo $nameErr;?></span></td>
              </tr>
              <tr>
                <td>密碼</td>
                <td><Input  Type="text" id="password" Name="password" value="<?php echo $password;?>" required></td>
                <td><span class="error"><?php echo $passwordErr;?></span></td>
              </tr>   
              <tr>
                <td>信箱</td>
                <td><Input  Type="text" id="email" Name="email" value="<?php echo $email;?>" required></td>
                <td><span class="error"><?php echo $emailErr;?></span></td>
              </tr> 
              <tr>
                <td>電話</td>
                <td><Input  Type="text" id="phone" Name="phone" value="<?php echo $phone;?>" required></td>
                <td><span class="error"><?php echo $phoneErr;?></span></td>
              </tr> 
              <tr>
                <td><span style="color: red"><?php echo $message;?></span></td>
              </tr>          
              </table>
              <br>
              <div align="center">
              <input class="btn col-5 rounded-pill"  value="修改" name="action"  type="submit" />
              &nbsp&nbsp&nbsp&nbsp
              <input class="btn col-5 rounded-pill"  value="刪除" name="action"  type="submit" />
          </div>
              </form>
               
            </div>
          </div>
        </div>
      </div>
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

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>

</html>




