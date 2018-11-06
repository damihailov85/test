<?php

function replacePos($str) {
    
    echo "Полученная строка: $str .</br>";

    $matches = [];
    preg_match_all("/[^A-Za-z0-9а-яёА-ЯЁ]{1}/ui", $str, $matches, PREG_OFFSET_CAPTURE);

    $count = count($matches[0]);
    $pos = 0;

    for ($i = 0; $i < $count; $i++ ){
        $pos = strpos($str, $matches[0][$i][0], $pos);
        $str = substr_replace($str, $matches[0][$count - 1 - $i][0], $pos, 1);
    }

    echo "Преобразованная строка: $str .</br>Ещё?";

}

if ($_POST['str']) {
    replacePos($_POST['str']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="test.php" method="POST" >
        <input type="text" name="str">
        <input type="submit">
    </form>
</body>
</html>