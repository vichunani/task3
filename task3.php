<?php
//Функция работает с простыми предложениями, где нет , ; : ' " ( ) и т.д.

function revertCharacters($string){
   
    $arrString =  preg_split("/(?<=[.?!])\s+/", $string ); //Разбиваем на предложения по .!?
  
    foreach ($arrString as $elem) {
        $lastLetter = mb_substr($elem, -1, 1);// Отрезаем .!? в конце предложения
        $elem = mb_substr($elem, 0, mb_strlen($elem)-1);
        $elem = mb_strtolower($elem);
        $words = explode(' ',$elem);
        
        foreach ($words as $word) {
            
            $word = strrev_arr($word);//Эта функция внизу
            $newWords[] = $word;
        }
       
        $newElem = implode(' ',$newWords);
        $newWords = [];//Обнуляем массив для следующей итерации
        $newElem = mb_strtoupper(mb_substr($newElem, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($newElem, 1, null,'UTF-8');//Первый символ кириллицей
        $newElem = $newElem . $lastLetter;//Вставляем .!?
        $newArr[] = $newElem;
    }
    return $newString = implode(' ', $newArr);
}
function strrev_arr($str)
{
	preg_match_all('/./us', $str, $array);
	$str = join('',array_reverse($array[0]));
	return $str;
}


$result = revertCharacters("Привет! Как дела? Давненько не виделись.");
echo $result; 