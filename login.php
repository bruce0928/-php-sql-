<?php
session_start();
unset($_SESSION['useraccount']);
require_once 'config.php';

$response = array();

$messageErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

      $account = $_REQUEST['account'];
      $password = $_REQUEST['password'];
      
        if( preg_match('/^[\w\x80-\xff]{3,15}$/', $account) && strlen($password) >= 6){

              $sqlcheck="SELECT * FROM newuser WHERE account = '$account' AND password ='$password'";
            $result = $mysqli->query($sqlcheck);
                
            
            if(!empty(mysqli_fetch_array($result, MYSQLI_ASSOC))){

        
                  //-------------------------------------------------------------------取得帳號
                  $_SESSION['useraccount'] = $account;
            
              echo "<script>alert('登入成功'); location.href = 'index.php';</script>";
            }else{
                  $messageErr = "帳號不存在或密碼錯誤";
            } 
        }else{            
                $messageErr = "帳號不存在或密碼錯誤";      
        }   

}
?>
<!DOCTYPE html>
<html lang="en" style="height:100%">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>登入-線上書籍訂購系統</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/one-page-wonder.css" rel="stylesheet">
    <style type="text/css">        
      body {
        background-image: url("https://1.bp.blogspot.com/-i-8hWC1tkBg/XQJp8M79itI/AAAAAAAAAvE/xINni-Dgo5YRQX-TWSI4vGhTf1yK_VcGACLcBGAs/s1600/Many_Book_Library_468620_1400x1050_2.jpg");
      }
      #head{
        font:28px helvetica;
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
    </style>
  </head>
  <body style="min-height: 100%;display: flex; flex-direction: column; ">
  	<div style="flex: 1">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
      <div class="container">
        <a class="navbar-brand" href="#"><p id="head">線上書籍訂購系統</p></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
          </ul>
        </div>
      </div>
    </nav>

    <!--<header class="masthead">
    </header>-->

    <section>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 order-lg-2">
            <div class="p-5">
              
            </div>
          </div>

          <div class="col-lg-6 order-lg-1">
            <div class="p-5 text-center">
              <br><br><br>
              <h2>登入系統</h2>
            <br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="form1" method="post">

              <table  style="margin-bottom:15px;" width="100%" >
              <tr>
              <td style="width: 20%">帳號</td>
             <td style="width: 40%" ><Input  Type="text" id="account" Name="account" required></td>
             <td style="width: 40%" rowspan="2"><input class="btn rounded"  value="登入" name="submit" style="padding:20px 40px 20px 40px"  type="submit" /></td>
              </tr>
              <tr>
             <td style="width: 20%" >密碼</td>
             <td style="width: 40%" ><Input  Type="text" id="password" Name="password" required></td>             
            </tr>
            <tr>
              <td colspan="2" style="height: 40px;" ><input  type ="button" onclick="javascript:location.href='create_Account.php'" value="註冊帳號"></td>
            </tr>
            </table>
             <span style="color:red"><?php echo $messageErr;?></span>  

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

</html>
