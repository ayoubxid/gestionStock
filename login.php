<?php
 require "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
    <div class="container">
            <div class="logo"><img src="img/TransLogoTxt.jpg" height="200"  alt=""></div>
            
        </div>
    </header>
    <main class="mt-6">
        <section class="row justify-content-center " >
            <h2 > Welcome </h2>
            <form class="col col-md-6 p-4" action="login.php" method="post">
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Email address</label>
                  <input type="text" name="username" id="form2Example1" class="form-control" />
                  
                </div>
              
                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <label class="form-label" for="form2Example2">Password</label>
                  <input type="password" name="password" id="form2Example2" class="form-control" />
                  
                </div>
              
                
              
                  
                </div>
              
                <!-- Submit button -->
                <button  type="submit" name="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Sign in</button>
                <?php
                    if(isset($_POST["submit"])){
                      $username = $_POST["username"];
                      $password = $_POST["password"];

                      $conn = DbConnection::getConnection();
                      $sql = "SELECT * FROM tbl_user";
                      $stmt = $conn->query($sql);
                      while($row = $stmt->fetch()){
                      if($username == $row["username"] && $password==$row["password"]){
                        session_start();
                        $_SESSION["id"] = $row["id"];
                        $_SESSION["username"] = $username;

                        header("location:index.php");
                      }else{
                        $message = "incorrect username or password";
                      }

                    }
                    }
                 ?>
                
              </form>
        </section>
    </main>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>