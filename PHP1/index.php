<?php
require './program.php';
$InputData = glob("A/*.dat");
$OutputData= glob("A/*.ans");
$index = 0;
foreach($InputData as $input)//проходимся по всем файламм с входными данными
{
    $ProgramRes=getValue($input);//вызов функции
    $File= fopen($OutputData[$index], r );
    $FileRes=fgets($File);
    $index++;
    echo "Test № $index: ";
    if($FileRes==$ProgramRes)//сравнение ответа из файла и ответа который вернула функция
    {
        echo "верно</p>";
    }
    else 
    {
        echo "неверно</p>";
    }
}

