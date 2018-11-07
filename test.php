<?php

function test($str_in, $str_out, $count, $mirror) {
    $error_list = [];
    
    if(gettype($str_in)!="string"){
        $error_list[count($error_list)] = "Ошибка ввода: Тип полученных данных $type. Данная функция предназначена для работы со строками.";
    }
    
    if (strcmp($str_in, $str_out)==0&&$mirror!=1) {
        $error_list[count($error_list)] = "Ошибка выполнения: Функция не произвела перестановку символов!";
    }
    
    if ($count==0||$count==1){
        $error_list[count($error_list)] = "Ошибка ввода: Строка не содержит необходимое для перестановки количество символов(найдено: $count).";
    }
    
    if ($mirror==1&&$count>1){
        $error_list[count($error_list)] = "Ошибка ввода: Знаки препинания в исходной строке расположены зеркально, перестановка не даст видимого результата.";        
    }
    
    return $error_list;
    
}

function replacePos($str_in) {

    $matches = [];
    preg_match_all("/[^A-Za-z0-9а-яёА-ЯЁ]{1}/ui", $str_in, $matches);

    $count = count($matches[0]);
    $pos = 0;
    $str_out = $str_in;
    $mirror = 1;

    for ($i = 0; $i < $count; $i++ ){
        $pos = strpos($str_in, $matches[0][$i][0], $pos);
        $str_out = substr_replace($str_out, $matches[0][$count - 1 - $i][0], $pos, 1);
        if ($matches[0][$i][0]!=$matches[0][$count - 1 - $i][0]){
            $mirror = 0;
        }
    }

    $error_list = test($str_in, $str_out, $count, $mirror);

    if (count($error_list)>0){
        for ($i=0; $i<count($error_list); $i++){
            echo $error_list[$i]."</br>";
        }
    }
    
    echo "Полученная строка: $str_in</br>";    
    echo "Преобразованная строка: $str_out</br>Ещё?";

}

if ($_POST['str']) {
    replacePos($_POST['str']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Перестановка знаков перепинанния</title>
</head>
<body>
    <form action="test.php" method="POST" >
        <input type="text" name="str">
        <input type="submit">
    </form>
</body>
</html>