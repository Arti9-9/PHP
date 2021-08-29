<?php
require_once('connect.php');
global $db;
$query = 'SELECT * FROM "user" WHERE "login" = :_login AND "password" = :_password';
$q = $db->prepare($query);
$q->bindParam(':_login', $_POST['login1']);
$q->bindParam(':_password', $_POST['password1']);
$q->execute();
$result = $q->fetchAll();
if ($result) {
echo '<li>' . "Авторизация прошла успешно" . '</li>' . "\n";
}
$query = 'SELECT "password" FROM "user" WHERE "password"='.$_POST['password2'];
$q = $db->prepare($query);
$res=$q->execute();
$res = $q->fetchAll();
if ($res) {
    echo '<li>' . "Авторизация прошла успешно" . '</li>' . "\n"; 
}