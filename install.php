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

// Table MovieProduction
$query = 'DROP TABLE IF EXISTS `'.DB::$tableMovieProduction.'`';
try
{
    $pdo->exec($query);
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$delete_table.DB::$tableMovieProduction;
}

// Table MovieGenre
$query = 'DROP TABLE IF EXISTS `'.DB::$tableMovieGenre.'`';
try
{
    $pdo->exec($query);
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$delete_table.DB::$tableMovieGenre;
}

// Table Cast
$query = 'DROP TABLE IF EXISTS `'.DB::$tableCast.'`';
try
{
    $pdo->exec($query);
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$delete_table.DB::$tableCast;
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

// Table Movie
$query = 'DROP TABLE IF EXISTS `'.DB::$tableMovie.'`';
try
{
    $pdo->exec($query);
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$delete_table.DB::$tableMovie;
}

// Table Actor
$query = 'DROP TABLE IF EXISTS `'.DB::$tableActor.'`';
try
{
    $pdo->exec($query);
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$delete_table.DB::$tableActor;
}

// Table Production
$query = 'DROP TABLE IF EXISTS `'.DB::$tableProduction.'`';
try
{
    $pdo->exec($query);
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$delete_table.DB::$tableProduction;
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

// Create table Production
$query = 'CREATE TABLE IF NOT EXISTS `'.DB::$tableProduction.'` (
            `'.DB\Production::$IdProduction.'` INT NOT NULL AUTO_INCREMENT,
            `'.DB\Production::$Country.'` VARCHAR(60) NOT NULL,
            PRIMARY KEY ('.DB\Production::$IdProduction.')) ENGINE=InnoDB;';
try
{
    $pdo->exec($query);
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$create_table.DB::$tableProduction;
}

// Create table Movie
$query = 'CREATE TABLE IF NOT EXISTS `'.DB::$tableMovie.'` (
                `'.DB\Movie::$IdMovie.'` INT NOT NULL AUTO_INCREMENT,
                `'.DB\Movie::$Title.'` VARCHAR(200) NOT NULL,
                `'.DB\Movie::$ReleaseDate.'` DATE NOT NULL,
                `'.DB\Movie::$Age.'` INT NOT NULL,
                `'.DB\Movie::$DurationTime.'` INT NOT NULL,
                `'.DB\Movie::$Cover.'` VARCHAR(200) NULL,
                `'.DB\Movie::$Description.'` VARCHAR(1000) NULL,
                PRIMARY KEY ('.DB\Movie::$IdMovie.')) ENGINE=InnoDB;';
try
{
    $pdo->exec($query);
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$create_table.DB::$tableMovie;
}

// Create table MovieGenre
$query = 'CREATE TABLE IF NOT EXISTS `'.DB::$tableMovieGenre.'` (
                    `'.DB\MovieGenre::$IdMovieGenre.'` INT NOT NULL AUTO_INCREMENT,
                    `'.DB\MovieGenre::$IdMovie.'` INT NOT NULL,
                    `'.DB\MovieGenre::$IdGenre.'` INT NOT NULL,
                    PRIMARY KEY ('.DB\MovieGenre::$IdMovieGenre.'),
                    FOREIGN KEY ('.DB\MovieGenre::$IdMovie.') REFERENCES '.DB::$tableMovie.'('.DB\Movie::$IdMovie.') ON DELETE CASCADE,
                    FOREIGN KEY ('.DB\MovieGenre::$IdGenre.') REFERENCES '.DB::$tableGenre.'('.DB\Genre::$IdGenre.') ON DELETE CASCADE
                    ) ENGINE=InnoDB;';
try
{
    $pdo->exec($query);
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$create_table.DB::$tableMovieGenre;
}

// Create table MovieProduction
$query = 'CREATE TABLE IF NOT EXISTS `'.DB::$tableMovieProduction.'` (
                        `'.DB\MovieProduction::$IdMovieProduction.'` INT NOT NULL AUTO_INCREMENT,
                        `'.DB\MovieProduction::$IdMovie.'` INT NOT NULL,
                        `'.DB\MovieProduction::$IdProduction.'` INT NOT NULL,
                        PRIMARY KEY ('.DB\MovieProduction::$IdMovieProduction.'),
                        FOREIGN KEY ('.DB\MovieProduction::$IdMovie.') REFERENCES '.DB::$tableMovie.'('.DB\Movie::$IdMovie.') ON DELETE CASCADE,
                        FOREIGN KEY ('.DB\MovieProduction::$IdProduction.') REFERENCES '.DB::$tableProduction.'('.DB\Production::$IdProduction.') ON DELETE CASCADE
                        ) ENGINE=InnoDB;';
try
{
    $pdo->exec($query);
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$create_table.DB::$tableMovieProduction;
}

// Create table Actor
$query = 'CREATE TABLE IF NOT EXISTS `'.DB::$tableActor.'` (
                            `'.DB\Actor::$IdActor.'` INT NOT NULL AUTO_INCREMENT,
                            `'.DB\Actor::$FirstName.'` VARCHAR(50) NOT NULL,
                            `'.DB\Actor::$LastName.'` VARCHAR(100) NOT NULL,
                            `'.DB\Actor::$BirthDate.'` DATE NULL,
                            PRIMARY KEY ('.DB\Actor::$IdActor.')
                            ) ENGINE=InnoDB;';
try
{
    $pdo->exec($query);
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$create_table.DB::$tableActor;
}

// Create table Cast
$query = 'CREATE TABLE IF NOT EXISTS `'.DB::$tableCast.'` (
                                `'.DB\Cast::$IdCast.'` INT NOT NULL AUTO_INCREMENT,
                                `'.DB\Cast::$IdActor.'` INT NOT NULL,
                                `'.DB\Cast::$IdMovie.'` INT NOT NULL,
                                `'.DB\Cast::$Role.'` VARCHAR(100) NOT NULL,
                                PRIMARY KEY ('.DB\Cast::$IdCast.'),
                                FOREIGN KEY ('.DB\Cast::$IdMovie.') REFERENCES '.DB::$tableMovie.'('.DB\Movie::$IdMovie.') ON DELETE CASCADE,
                                FOREIGN KEY ('.DB\Cast::$IdActor.') REFERENCES '.DB::$tableActor.'('.DB\Actor::$IdActor.') ON DELETE CASCADE
                                ) ENGINE=InnoDB;';
try
{
    $pdo->exec($query);
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$create_table.DB::$tableCast;
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

// Table Production
$countries = array();
$countries[] = 'USA';
$countries[] = 'Belgia';
$countries[] = 'Polska';
$countries[] = 'Francja';
$countries[] = 'Włochy';
$countries[] = 'Hiszpania';
$countries[] = 'Niemcy';
$countries[] = 'Wielka Brytania';
$countries[] = 'Rosja';

try
{
    $stmt = $pdo -> prepare('INSERT INTO `'.DB::$tableProduction.'` (`'.DB\Production::$Country.'`) VALUES(:country)');
    foreach($countries as $country)
    {
        $stmt -> bindValue(':country', $country, PDO::PARAM_STR);
        $stmt -> execute();
    }
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$noadd;
}

// Table Movie
$movies = array();
$movies[] = array(
    'IdGatunek' => '1',
    'Title' => 'Mad Max: Na drodze gniewu',
    'Produkcja' => 'USA',
    'ReleaseDate' => '2015-05-22',
    'DurationTime' => '120',
    'Age' => '15',
    'Cover' => '',
    'Description' => 'Max przyłącza się do grupy uciekinierek z Cytadeli - osady rządzonej przez Wiecznego Joe. Tyran wraz ze swoją bandą rusza za nimi w pościg.');
$movies[] = array(
    'IdGatunek' => '3',
    'Title' => 'Mr Nobody',
    'Produkcja' => 'Belgia',
    'ReleaseDate' => '2009-09-12',
    'DurationTime' => '141',
    'Age' => '15',
    'Cover' => '',
    'Description' => 'Stoosiemnastoletni Nemo Nobody to ostatni śmiertelny człowiek w czasach, gdy ludzkość osiągnęła nieśmiertelność. Na łożu śmierci bohater rozważa, jak mogło potoczyć się jego życie.');
$movies[] = array(
    'IdGatunek' => '9',
    'Title' => 'Efekt motyla',
    'Produkcja' => 'USA',
    'ReleaseDate' => '2004-01-22',
    'DurationTime' => '113',
    'Age' => '15',
    'Cover' => '',
    'Description' => 'Evan, który potrafi podróżować w czasie, przekona się, że nawet najdrobniejsza zmiana w przeszłości ma kolosalny wpływ na teraźniejszość.');
$movies[] = array(
    'IdGatunek' => '1',
    'Title' => 'Szybcy i wściekli 7',
    'Produkcja' => 'USA',
    'ReleaseDate' => '2015-04-10',
    'DurationTime' => '140',
    'Age' => '15',
    'Cover' => '',
    'Description' => 'Toretto i jego ekipa mierzą się z pałającym żądzą krwi najemnikiem Deckardem Shawem.');
$movies[] = array(
    'IdGatunek' => '2',
    'Title' => 'The social network',
    'Produkcja' => 'USA',
    'ReleaseDate' => '2010-10-15',
    'DurationTime' => '120',
    'Age' => '15',
    'Cover' => '',
    'Description' => 'Historia powstania Facebooka. Komputerowy geniusz z Harvardu zakłada stronę thefacebook.com, która nieoczekiwanie bije rekordy popularności.');
$movies[] = array(
    'IdGatunek' => '1',
    'Title' => 'Death Race: Wyścig śmierci',
    'Produkcja' => 'USA',
    'ReleaseDate' => '2008-08-21',
    'DurationTime' => '111',
    'Age' => '15',
    'Cover' => '',
    'Description' => 'Były kierowca rajdowy odsiaduje wyrok w więzieniu, którego naczelniczka organizuje krwawe wyścigi samochodowe. ');
$movies[] = array(
    'IdGatunek' => '1',
    'Title' => 'Adrenalina',
    'Produkcja' => 'USA',
    'ReleaseDate' => '2006-08-31',
    'DurationTime' => '87',
    'Age' => '15',
    'Cover' => '',
    'Description' => 'Pewnego ranka Chev Chelios dowiaduje się, że został otruty. Jedyną rzeczą, która może utrzymać go przy życiu jest produkowana przez organizm adrenalina. ');
$movies[] = array(
    'IdGatunek' => '9',
    'Title' => 'Ja , Robot',
    'Produkcja' => 'USA',
    'ReleaseDate' => '2004-07-15',
    'DurationTime' => '115',
    'Age' => '15',
    'Cover' => '',
    'Description' => 'W roku 2035 roboty pomagają ludziom w codziennym życiu. Gdy ginie twórca zaawansowanego modelu, detektyw podejrzewa, że zabiła go maszyna.');

// Wstawianie
try
{
    $stmt = $pdo -> prepare('INSERT INTO `'.DB::$tableMovie.'` (`'.DB\Movie::$Title.'`, `'.DB\Movie::$ReleaseDate.'`, `'.DB\Movie::$Age.'` , `'.DB\Movie::$DurationTime.'`, `'.DB\Movie::$Cover.'`, `'.DB\Movie::$Description.'`) VALUES(:Title, :ReleaseDate, :Age , :DurationTime , :Cover , :Description)');
    foreach($movies as $movie)
    {
        $stmt -> bindValue(':Title', $movie['Title'], PDO::PARAM_STR);
        $stmt -> bindValue(':ReleaseDate', $movie['ReleaseDate'], PDO::PARAM_STR);
        $stmt -> bindValue(':Age', $movie['Age'], PDO::PARAM_INT);
        $stmt -> bindValue(':DurationTime', $movie['DurationTime'], PDO::PARAM_INT);
        $stmt -> bindValue(':Cover', $movie['Cover'], PDO::PARAM_STR);
        $stmt -> bindValue(':Description', $movie['Description'], PDO::PARAM_STR);
        $stmt -> execute();
    }
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$noadd;
}

// Table MovieGenre
$MovieGenres = array();
$MovieGenres[] = array(
    'IdMovie' => 1,
    'IdGenre' => 1
);
$MovieGenres[] = array(
    'IdMovie' => 1,
    'IdGenre' => 4
);
$MovieGenres[] = array(
    'IdMovie' => 2,
    'IdGenre' => 3
);
$MovieGenres[] = array(
    'IdMovie' => 2,
    'IdGenre' => 9
);
$MovieGenres[] = array(
    'IdMovie' => 3,
    'IdGenre' => 9
);
$MovieGenres[] = array(
    'IdMovie' => 3,
    'IdGenre' => 3
);
$MovieGenres[] = array(
    'IdMovie' => 3,
    'IdGenre' => 1
);
$MovieGenres[] = array(
    'IdMovie' => 4,
    'IdGenre' => 1
);
$MovieGenres[] = array(
    'IdMovie' => 5,
    'IdGenre' => 2
);
$MovieGenres[] = array(
    'IdMovie' => 6,
    'IdGenre' => 1
);
$MovieGenres[] = array(
    'IdMovie' => 6,
    'IdGenre' => 4
);
$MovieGenres[] = array(
    'IdMovie' => 7,
    'IdGenre' => 1
);
$MovieGenres[] = array(
    'IdMovie' => 7,
    'IdGenre' => 3
);
$MovieGenres[] = array(
    'IdMovie' => 8,
    'IdGenre' => 9
);
$MovieGenres[] = array(
    'IdMovie' => 8,
    'IdGenre' => 1
);

try
{
    $stmt = $pdo -> prepare('INSERT INTO `'.DB::$tableMovieGenre.'` (`'.DB\MovieGenre::$IdMovie.'` , `'.DB\MovieGenre::$IdGenre.'`) VALUES(:IdMovie , :IdGenre)');
    foreach($MovieGenres as $movieGenre)
    {
        $stmt -> bindValue(':IdMovie', $movieGenre['IdMovie'], PDO::PARAM_INT);
        $stmt -> bindValue(':IdGenre', $movieGenre['IdGenre'], PDO::PARAM_INT);
        $stmt -> execute();
    }
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$noadd;
}


// Table MovieProduction
$MovieProductions = array();
$MovieProductions[] = array(
    'IdMovie' => 1,
    'IdProduction' => 1
);
$MovieProductions[] = array(
    'IdMovie' => 2,
    'IdProduction' => 2
);
$MovieProductions[] = array(
    'IdMovie' => 2,
    'IdProduction' => 4
);
$MovieProductions[] = array(
    'IdMovie' => 2,
    'IdProduction' => 7
);
$MovieProductions[] = array(
    'IdMovie' => 3,
    'IdProduction' => 1
);
$MovieProductions[] = array(
    'IdMovie' => 4,
    'IdProduction' => 1
);
$MovieProductions[] = array(
    'IdMovie' => 5,
    'IdProduction' => 1
);
$MovieProductions[] = array(
    'IdMovie' => 6,
    'IdProduction' => 1
);
$MovieProductions[] = array(
    'IdMovie' => 6,
    'IdProduction' => 7
);
$MovieProductions[] = array(
    'IdMovie' => 6,
    'IdProduction' => 8
);
$MovieProductions[] = array(
    'IdMovie' => 7,
    'IdProduction' => 1
);
$MovieProductions[] = array(
    'IdMovie' => 8,
    'IdProduction' => 1
);
$MovieProductions[] = array(
    'IdMovie' => 8,
    'IdProduction' => 7
);

try
{
    $stmt = $pdo -> prepare('INSERT INTO `'.DB::$tableMovieProduction.'` (`'.DB\MovieProduction::$IdMovie.'` , `'.DB\MovieProduction::$IdProduction.'`) VALUES(:IdMovie , :IdProduction)');
    foreach($MovieProductions as $movieProduction)
    {
        $stmt -> bindValue(':IdMovie', $movieProduction['IdMovie'], PDO::PARAM_INT);
        $stmt -> bindValue(':IdProduction', $movieProduction['IdProduction'], PDO::PARAM_INT);
        $stmt -> execute();
    }
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$noadd;
}


// Table Actor
$actors = array();
$actors[] = [
    'FirstName' => 'Tom',
    'LastName' => 'Hardy',
    'BirthDate' => '1977-09-15'];
$actors[] = array(
    'FirstName' => 'Charlize',
    'LastName' => 'Theron',
    'BirthDate' => '1975-08-07');
$actors[] = array(
    'FirstName' => 'Vin',
    'LastName' => 'Diesel',
    'BirthDate' => '1967-07-18');
$actors[] = array(
    'FirstName' => 'Jason',
    'LastName' => 'Statham',
    'BirthDate' => '1967-07-26');
$actors[] = array(
    'FirstName' => 'Michelle',
    'LastName' => 'Rodriguez',
    'BirthDate' => '1978-07-12');
$actors[] = array(
    'FirstName' => 'Jesse',
    'LastName' => 'Eisenberg',
    'BirthDate' => '1983-10-05');
$actors[] = array(
    'FirstName' => 'Andrew',
    'LastName' => 'Garfield',
    'BirthDate' => '1983-08-20');
$actors[] = array(
    'FirstName' => 'Ashton',
    'LastName' => 'Kutcher',
    'BirthDate' => '1978-02-07');

// Wstawianie
try
{
    $stmt = $pdo -> prepare('INSERT INTO `'.DB::$tableActor.'` (`'.DB\Actor::$FirstName.'`, `'.DB\Actor::$LastName.'`, `'.DB\Actor::$BirthDate.'`) VALUES(:FirstName, :LastName, :BirthDate)');
    foreach($actors as $actor)
    {
        $stmt -> bindValue(':FirstName', $actor['FirstName'], PDO::PARAM_STR);
        $stmt -> bindValue(':LastName', $actor['LastName'], PDO::PARAM_STR);
        $stmt -> bindValue(':BirthDate', $actor['BirthDate'], PDO::PARAM_STR);
        $stmt -> execute();
    }
}
catch(PDOException $e)
{
    echo \Config\Database\DBErrorName::$noadd;
}


// Table Cast
$casts = array();
$casts[] = array(
    'IdActor' => '1',
    'IdMovie' => '1',
    'Role' => 'Max Rockatansky');
$casts[] = array(
    'IdActor' => '2',
    'IdMovie' => '1',
    'Role' => 'Cesarzowa Furiosa');
$casts[] = array(
    'IdActor' => '3',
    'IdMovie' => '4',
    'Role' => 'Dominic Toretto');
$casts[] = array(
    'IdActor' => '4',
    'IdMovie' => '4',
    'Role' => 'Deckard Shaw');
$casts[] = array(
    'IdActor' => '5',
    'IdMovie' => '4',
    'Role' => '	Letty');
$casts[] = array(
    'IdActor' => '6',
    'IdMovie' => '5',
    'Role' => 'Mark Zuckerberg');
$casts[] = array(
    'IdActor' => '7',
    'IdMovie' => '5',
    'Role' => 'Eduardo Saverin');
$casts[] = array(
    'IdActor' => '8',
    'IdMovie' => '3',
    'Role' => 'Evan Treborn');

// Wstawianie
try
{
    $stmt = $pdo -> prepare('INSERT INTO `'.DB::$tableCast.'` (`'.DB\Cast::$IdActor.'`, `'.DB\Cast::$IdMovie.'`, `'.DB\Cast::$Role.'`) VALUES(:IdActor, :IdMovie, :Role)');
    foreach($casts as $cast)
    {
        $stmt -> bindValue(':IdActor', $cast['IdActor'], PDO::PARAM_INT);
        $stmt -> bindValue(':IdMovie', $cast['IdMovie'], PDO::PARAM_INT);
        $stmt -> bindValue(':Role', $cast['Role'], PDO::PARAM_STR);
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