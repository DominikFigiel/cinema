<!doctype html>
<html lang="pl">
<head>
  <meta charset="utf-8">
  <title>Installation</title>
  <link rel="stylesheet">
</head>
<body>
<?php
    require 'vendor/autoload.php';

    use Config\Database\DBConfig as DB;
    use Config\Database\DBConnection as DBConnection;
    
    DBConnection::setDBConnection(DB::$user,DB::$password, 
            DB::$hostname, DB::$databaseType, DB::$port);	
    try {
        $pdo =  DBConnection::getHandle();
    }catch(\PDOException $e){
        echo \Config\Database\DBErrorName::$connection;
        exit(1);
    }

    // Table Genre
    $query = 'DROP TABLE IF EXISTS `'.DB::$tableGenre.'`';
	try
	{
		$pdo->exec($query);
	}
	catch(PDOException $e)
	{
		echo \Config\Database\DBErrorName::$delete_table.DB::$tableGenre;
    }
    
    // Create table Genre
    $query = 'CREATE TABLE IF NOT EXISTS `'.DB::$tableGenre.'` (
        `'.DB\Genre::$IdGenre.'` INT NOT NULL AUTO_INCREMENT,
        `'.DB\Genre::$GenreName.'` VARCHAR(30) NOT NULL,
        PRIMARY KEY ('.DB\Genre::$IdGenre.')) ENGINE=InnoDB;';
    try
    {
        $pdo->exec($query);
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$create_table.DB::$tableGenre;
    }

    // Table Genre
    $genres = array();
    $genres[] = 'akcja';
    $genres[] = 'biograficzny';
    $genres[] = 'dramat';
    $genres[] = 'fantastyczny';
    $genres[] = 'horror';
    $genres[] = 'komedia';
    $genres[] = 'musical';
	$genres[] = 'romantyczny';
    $genres[] = 'sci-fiction';

    try
	{
		$stmt = $pdo -> prepare('INSERT INTO `'.DB::$tableGenre.'` (`'.DB\Genre::$GenreName.'`) VALUES(:genre)');
		foreach($genres as $genre)
		{
			$stmt -> bindValue(':genre', $genre, PDO::PARAM_STR);
			$stmt -> execute(); 
		}
	}
	catch(PDOException $e)
	{
		echo \Config\Database\DBErrorName::$noadd;
    }

    echo "<b>Instalacja aplikacji zakończona!</b>"
?>
</body>
</html>