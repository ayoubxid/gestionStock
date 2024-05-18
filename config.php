
<?php class DbConnection{
    static function getConnection(){
            $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = null;
    try{
            $pdo = new PDO("mysql:host=localhost;dbname=shelflife;charset=utf8mb4", "root", "",$options);
    }catch(Exception $ex){
        echo $ex->getMessage() ;
        
    }
    return $pdo;
    }
}
?>