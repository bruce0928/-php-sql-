<?php
require_once 'config.php';

$response = array();

//先將錯誤訊息設定為空
$nameErr = $accountErr = $passwordErr = $emailErr = $phoneErr = "";

$name = $account = $password = $email = $phone = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

      //接收 form 表單 input 值
      $name = $_REQUEST['name'];
      $account = $_REQUEST['account'];
      $password = $_REQUEST['password'];
      $email = $_REQUEST['email'];
      $phone = $_REQUEST['phone'];
      $gender = $_REQUEST['gender'];

      $checkinput=100; $message=""; 
        if(!preg_match('/^(?!_|\s\')[A-Za-z0-9_\x80-\xff\s\']+$/',$name)){
          $checkinput=1;        
          $nameErr = " 名稱不符規定 ";
          $name = "";
           //--------------------------------------------名稱不符
        }
        if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $account)){
          $checkinput=2;            
          $accountErr = "帳號不符規定 ";
          $account = "";
          //--------------------------------------------帳號不符
        }
        if(strlen($password) < 6){
          $checkinput=3;            
          $passwordErr = "密碼不符規定 ";
          $password = "";
           //--------------------------------------------密碼不符
        }
        if(!preg_match('/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/', $email)){
          $checkinput=4;            
          $emailErr = "電子郵件不符規定 ";
          $email = "";
           //--------------------------------------------郵件不符
        }
        if(!preg_match("/09[0-9]{2}[0-9]{6}/", $phone)){
          $checkinput=5;            
          $phoneErr = "手機不符規定 ";
          $phone = "";
           //--------------------------------------------手機不符
        }

          if($checkinput==100)
          {
               $sqlcheck="SELECT * FROM newuser WHERE account = '$account'";
               $result = $mysqli->query($sqlcheck);
                 if(!empty(mysqli_fetch_array($result, MYSQLI_ASSOC))){
                      $accountErr = "帳號已被使用";
                }else{
                
                  $sql = "INSERT INTO newuser(name, account, password, email, phone, gender) VALUES('$name', '$account', '$password', '$email','$phone','$gender')";


                  // check if row inserted or not
                  if ($result = $mysqli->query($sql)) {
                    // successfully inserted into database
                    //$_SESSION['User']=$_REQUEST['account'];
                    //$response["account"]=$_SESSION['User'];
                 echo "<script>alert('帳號創建成功'); location.href = 'login.php';</script>";
                    //當註冊帳號時 順便在通知資料表也新增帳號資料  
                    $sqltonotification = "INSERT INTO usernotification(account) VALUES('$account')";
                    $resultnotification = $mysqli->query($sqltonotification);
                  } else {
                    // failed to insert row
                 echo "<script>alert('發生未知錯誤'); location.href = 'create_Account.php';</script>";
                  }
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
    <title>註冊-線上書籍訂購系統</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/one-page-wonder.css" rel="stylesheet">
    <style type="text/css">
        .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #32CD32;
        color: white;
        text-align: center;
        } 
        #head{
          font:28px helvetica;
        }
        body {
          background-image: url("http://file01.16sucai.com/d/file/2014-01-14/13897104329249.jpg");
        }

    </style>
  </head>
  <body style="min-height: 100%;display: flex; flex-direction: column; ">
    <div style="flex: 1">
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

<style>
.error {color: #FF0000;}
</style>
    <section>
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 order-lg-1">
            <div class="p-5 text-center">
              <h2 class="display-8 ">帳號註冊</h2>
              <p>請填入相關資料</p>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="form1" method="post">                
            <table class="d-flex justify-content-center" name="course" width="100%" >
              <tr>
                <td>姓名&nbsp;&nbsp;</td>
                <td><Input  Type="text" id="name" Name="name" value="<?php echo $name;?>" required></td>
                <td><span class="error"><?php echo $nameErr;?></span></td>
              </tr>
              <tr>
                <td>帳號&nbsp;&nbsp;</td>
                <td><Input  Type="text" id="account" Name="account" value="<?php echo $account;?>" required></td>
                <td><span class="error"><?php echo $accountErr;?></span></td>
              </tr>
              <tr>
                <td>密碼&nbsp;&nbsp;</td>
                <td><Input  Type="text" id="password" Name="password" value="<?php echo $password;?>" required></td>
                <td><span class="error"><?php echo $passwordErr;?></span></td>
              </tr>   
              <tr>
                <td>信箱&nbsp;&nbsp;</td>
                <td><Input  Type="text" id="email" Name="email" value="<?php echo $email;?>" required></td>
                <td><span class="error"><?php echo $emailErr;?></span></td>
              </tr> 
              <tr>
                <td>電話&nbsp;&nbsp;</td>
                <td><Input  Type="text" id="phone" Name="phone" value="<?php echo $phone;?>" required></td>
                <td><span class="error"><?php echo $phoneErr;?></span></td>
              </tr> 
              <tr>
                <td>性別</td>
                <td><select id="gender" Name="gender">
                  　<option value="男">男</option>
                  　<option value="女">女</option>
                  </select>
                </td>
              </tr>             
              </table>
              <br>
              <input class="btn col-6 rounded-pill"  value="註冊" name="submit"  type="submit" />
              </form>
              <br>
              <input class="btn col-6 rounded-pill" type ="button" onclick="javascript:location.href='login.php'" value="返回登入畫面"></input>
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




