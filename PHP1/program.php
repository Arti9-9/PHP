<?php 

function getValue($filePath)
{
    $file = fopen($filePath, 'r');
    $result =0;
    $countBet= fgets($file);//считывание кол-во ставок из файла с входными данными
    $arrayBets = [];//массив ставок
    for($i =0; $i<$countBet; $i++)
    {
        list($idGame, $betAmount, $possibleOutcome)=explode(" " ,fgets($file));//считывание ставок(айди ставки, сумма, исход)
        $arrayBets[$idGame]['betAmount'] = (int)$betAmount;
        $arrayBets[$idGame]['possibleOutcome'] = $possibleOutcome;
    }
    $countGames =fgets($file);//считывание кол-во игр
    $arrayGames = [];//массив игр
    for($i=0;$i<$countGames;$i++)
    {
        list($idGame, $coefficientL, $coefficientR, $coefficientD,$outcome)=explode(" ",fgets($file));//считывание атрибутов игры(айди, коэфиценты, исход)
        $arrayGames[$idGame]['coefL'] = (float)$coefficientL;
        $arrayGames[$idGame]['coefR'] = (float)$coefficientR;
        $arrayGames[$idGame]['coefD'] = (float)$coefficientD;
        $arrayGames[$idGame]['outcome'] =   $outcome;
    }
    foreach ($arrayBets as $idGame => $bet) //проверям все ставки пользователя
    {
        if ($bet['possibleOutcome'] == $arrayGames[$idGame]['outcome']) //проверка на верный исход
        {
            switch($arrayGames[$idGame]['outcome'])
            {   
                case "L\n":
                    $result += $arrayGames[$idGame]['coefL'] * $bet['betAmount'] -$bet['betAmount'];
                    break;
                case "R\n":
                    $result += $arrayGames[$idGame]['coefR'] * $bet['betAmount'] -$bet['betAmount'];
                    break;
                case "D\n":
                    $result += $arrayGames[$idGame]['coefD'] * $bet['betAmount'] -$bet['betAmount'];
                    break;
            }
        }
        else {
            $result -= $bet['betAmount'];
        }
    }
    return $result;
}