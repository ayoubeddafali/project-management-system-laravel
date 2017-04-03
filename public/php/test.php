<?php


$dsn = 'mysql:dbname=pms;host=ayoub.dev';
$user = 'ayoubensalem';
$password = '19641995';

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    var_dump($_POST['text']);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$sth = $dbh->prepare("SELECT projects.libelle , projects.id FROM projects WHERE projects.libelle LIKE '".$_POST['text']."%'");
 $sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
//print_r($result);
$projects = [];
foreach ($result as $res){
    array_push($projects , $res['libelle'] . "/".$res['id']  );
}
print((implode('$',$projects)));




