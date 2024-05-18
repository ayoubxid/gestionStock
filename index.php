<?php
session_start();
 if(!isset($_SESSION["id"])){
    header("location:login.php");
 }
 require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo"><img src="img/TransLogoTxt.jpg" height="200"   alt=""></div>
        </div>
    </header>

    <main class="row justify-content-center mt-4">
      <?php require "add_palette.php"; ?>
        <section class="col col-md-10">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">numero palette </th>
                    <th scope="col">date controle</th>
                    <th scope="col">date palette</th>
                    <th scope="col">variete</th>
                    <th scope="col">producteur</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    $conn = DbConnection::getConnection();
                    $stmt = $conn->query("SELECT * FROM shelf_life");
                    while($row = $stmt->fetch()):
                    
                    ?>
                  <tr>
                    <td><?php echo $row["numero_palette"] ?> </td>
                    <td><?php echo $row["date_controle"] ?> </td>
                    <td><?php echo $row["date_palette"] ?></td>
                    <td><?php echo $row["variete"] ?></td>
                    <td><?php echo $row["producteur"] ?></td>
                    <td><a href="?numeroPalette=<?php echo $row["numero_palette"]; ?>" class="btn btn-primary">modifier</a></td>
                    <td><form action="action.php" method="post"> <input type="hidden" name="numero_palette" value="<?php echo $row["numero_palette"] ?>"> <input type="submit" class="btn btn-danger" name="delete" value="Supprimer"></form></td>
                    <td><form action="action.php" method="post"> <input type="hidden" name="numero_palette" value="<?php echo $row["numero_palette"] ?>"> <input type="submit" class="btn btn-secondary" name="imprimer" value="Imprimer"></form></td>
                  </tr>
                  <?php endwhile ?>
                </tbody>
              </table>
        </section>
    </main>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>