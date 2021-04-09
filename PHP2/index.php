<?php
require_once('config.php');
//подключение к бд
try {
    $database=new PDO($connection,$user,$password);
    echo '<p>База данных подключена.</p>';
    $queryInsert='INSERT INTO "worker"("Name","Passport","Post") VALUES (:N , :Pas, :post)';//запроос на добавлениие данных в БД
    $request=$database->prepare($queryInsert);
    $xml = simplexml_load_file('xmlFile.xml');
    foreach ($xml as $worker) {
        $request->bindParam(':N', $worker->name);
        $request->bindParam(':Pas', $worker->passport);
        $request->bindParam(':post', $worker->post);
        try {
            $request->execute();//добавление
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    $queryOutput = 'SELECT "Name","Passport","Post" FROM "worker"';//запрос на считывание данных из БД
    $request=$database->prepare($queryOutput);
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_ASSOC);//получаем массив данных
    $json = json_encode($result);//json представление
    file_put_contents('jsonFile.json', $json);//запись в файл
} catch (PDOException $e) {
    echo '<p>Ошибка подключения</p>';
}
?>