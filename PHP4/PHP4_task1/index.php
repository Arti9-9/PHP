<?php
//считываем входные данные
$data = file_get_contents('input.txt');
//регулярное вырожение
$pattern = '/\'[0-9]+\'/' ;
$data= preg_replace_callback($pattern,function($items)
{
  
    preg_match('/[0-9]+/', $items[0], $item);
    return '\'' . $item[0] * 2 . '\'';
},$data);
echo $data;
//запишем данные в файл
$fp = fopen("output.txt", "w");
fwrite($fp, $data);
fclose($fp);