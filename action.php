<?php 
   session_start();
    require "config.php";
    require 'vendor/autoload.php';


    use Dompdf\Dompdf;

    function uploadImage($file) {
        $target_dir = "image_controle/"; // Make sure this folder exists and is writable
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        // Check if image file is a actual image or fake image
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
    
        
    
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            return false;
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
                return false;
            }
        }
    }
   if(isset($_POST["ajouter"])){
    $numero_palette = $_POST["numero_palette"];
    $date_controle = $_POST["date_controle"];
    $date_palette = $_POST["date_palette"];
    $variete = $_POST["variete"];
    $producteur = $_POST["producteur"];
    $calibre = $_POST["calibre"];
    $nombre_fruit = $_POST["nombre_fruit"];
    $brunessnebent = $_POST["brunessnebent"];
    $brunessnebent_taux = ($brunessnebent/$nombre_fruit)*100;
    $pourriture = $_POST["pourriture"];
    $pourriture_taux = ($pourriture/$nombre_fruit)*100;
    $id_user = $_SESSION["id"];
    $image_controle = uploadImage($_FILES["image_controle"]);
    if ($image_controle) {
        try {
            $conn = DbConnection::getConnection();
            $query = "INSERT INTO shelf_life(date_controle,date_palette,variete,producteur,calibre,nombre_fruit,brunessnebent,brunessnebent_taux,pourriture,pourriture_taux,image_controle,id_user) 
                      VALUES(:date_controle,:date_palette,:variete,:producteur,:calibre,:nombre_fruit,:brunessnebent,:brunessnebent_taux,:pourriture,:pourriture_taux,:image_controle,:id_user)";
            $stmt = $conn->prepare($query);
            $stmt->execute([
                "date_controle" => $date_controle,
                "date_palette" => $date_palette,
                "variete" => $variete,
                "producteur" => $producteur,
                "calibre" => $calibre,
                "nombre_fruit" => $nombre_fruit,
                "brunessnebent" => $brunessnebent,
                "brunessnebent_taux" => $brunessnebent_taux,
                "pourriture" => $pourriture,
                "pourriture_taux" => $pourriture_taux,
                "image_controle" => $image_controle,
                "id_user" => $id_user
            ]);
            header("location:index.php");
        } catch (PDOException $ex) {
            echo "An error occurred " . $ex->getMessage();
        } finally {
            $conn = null;
        }
    }


   }
   if(isset($_POST["modifier"])){
    $numero_palette = $_POST["numero_palette"];
    $date_controle = $_POST["date_controle"];
    $date_palette = $_POST["date_palette"];
    $variete = $_POST["variete"];
    $producteur = $_POST["producteur"];
    $calibre = $_POST["calibre"];
    $nombre_fruit = $_POST["nombre_fruit"];
    $brunessnebent = $_POST["brunessnebent"];
    $brunessnebent_taux = ($brunessnebent/$nombre_fruit)*100;
    $pourriture = $_POST["pourriture"];
    $pourriture_taux = ($pourriture/$nombre_fruit)*100;
   
    $id_user = $_SESSION["id"];
    $image_controle = uploadImage($_FILES["image_controle"]);
    if ($image_controle) {
     try{
    $conn = DbConnection::getConnection();
    $query = "UPDATE shelf_life SET date_controle=:date_controle,date_palette=:date_palette,variete=:variete,producteur=:producteur,calibre=:calibre,nombre_fruit=:nombre_fruit,brunessnebent=:brunessnebent ,brunessnebent_taux=:brunessnebent_taux,pourriture=:pourriture,pourriture_taux=:pourriture_taux,image_controle=:image_controle WHERE 	id_user=:id_user AND numero_palette=:numero_palette";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        "date_controle"=>$date_controle,
        "date_palette"=>$date_palette,
        "variete"=>$variete,
        "producteur"=>$producteur,
        "calibre"=>$calibre,
        "nombre_fruit"=>$nombre_fruit,
        "brunessnebent"=>$brunessnebent,
        "brunessnebent_taux"=>$brunessnebent_taux,
        "pourriture"=>$pourriture,
        "pourriture_taux"=>$pourriture_taux,
        "image_controle"=>$image_controle,
        "numero_palette"=>$numero_palette,
        "id_user"=>$id_user
    ]);
    header("location:index.php");
}catch(PDOException $ex){
    echo "An error occurred " .$ex->getMessage(); 
}finally{
    
}
    }
   }

if(isset($_POST["delete"])){
    $numero_palette = $_POST["numero_palette"];
    try{
        $conn = DbConnection::getConnection();
        $query = "DELETE FROM shelf_life WHERE numero_palette=:numero_palette";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            "numero_palette"=>$numero_palette,

        ]);
        header("location:index.php");
    }catch(PDOException $ex){
        echo "An error occurred " .$ex->getMessage(); 
    }finally{
        
    }
   }

   if(isset($_POST["imprimer"])){

if (isset($_POST["numero_palette"])) {
    $numero_palette = $_POST["numero_palette"];
    try {
        $conn = DbConnection::getConnection();
        $stmt = $conn->prepare("SELECT * FROM shelf_life WHERE numero_palette = :numero_palette");
        $stmt->execute(['numero_palette' => $numero_palette]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            
            $html = file_get_contents("pdf.html");
            $dompdf = new Dompdf();
            
            $html = str_replace('{{numero_palette}}', $data['numero_palette'], $html);
            $html = str_replace('{{date_controle}}', $data['date_controle'], $html);
            $html = str_replace('{{date_palette}}', $data['date_palette'], $html);
            $html = str_replace('{{variete}}', $data['variete'], $html);
            $html = str_replace('{{producteur}}', $data['producteur'], $html);
            $html = str_replace('{{calibre}}', $data['calibre'], $html);
            $html = str_replace('{{nombre_fruit}}', $data['nombre_fruit'], $html);
            $html = str_replace('{{brunessnebent}}', $data['brunessnebent'], $html);
            $html = str_replace('{{brunessnebent_taux}}', $data['brunessnebent_taux'], $html);
            $html = str_replace('{{pourriture}}', $data['pourriture'], $html);
            $html = str_replace('{{pourriture_taux}}', $data['pourriture_taux'], $html);
            $html = str_replace('{{image_controle}}', $data['image_controle'], $html);

          
            $dompdf->loadHtml($html);
            $dompdf->setBasePath(__DIR__);
            $dompdf->set_option("isRemoteEnabled", true);
            $dompdf->setPaper('A4', 'portrait');

         
            $dompdf->render();

            // Output the generated PDF (1 = download and 0 = preview)
            $dompdf->stream("shelf_life_record_" . $data['numero_palette'], array("Attachment" => 0));
        } else {
            echo "No record found.";
        }
    } catch (PDOException $ex) {
        echo "An error occurred " . $ex->getMessage();
    }
} else {
    echo "No ID provided.";
}

   }

?>