<?php
// подключение к БД
require('config.php');

// подгружаем данные из бд
$database=new PDO($connection,$user,$password);
$sql = 'SELECT * FROM links';
$request = $database->prepare($sql);
$request->execute();
$data = $request->fetchAll();

// регулярное выражени по которому будем искать нашу ссылку
$pattern = '/(http:\/\/asozd\.duma\.gov\.ru\/main\.nsf\/\(Spravka\)\?OpenAgent&RN=)((\d+)-(\d+))&(\d+)/';
for ($i=0;$i<count($data);$i++) {
    // проверяем, действительно ли в этой записи есть значние, удовлетворяющее нашему регулярному выражению
    if (preg_match($pattern, $data[$i]['src'])) {
        $data[$i]['src'] = preg_replace_callback($pattern, function ($texts) {
            preg_match('/((\d+)-(\d+))/', $texts[0], $text);
            return 'http://sozd.parlament.gov.ru/bill/' . $text[0];
        }, $data[$i]['src']);
                echo $data[$i]['src'];
        
         $database=new PDO($connection,$user,$password);
         $sql = 'UPDATE links SET src=:Src WHERE "ID"=:id';
         $request = $database->prepare($sql);
         $params = [
         ':id' => $data[$i]['ID'],
         ':Src' => $data[$i]['src']
         ];
        $request->execute($params);
    }
}