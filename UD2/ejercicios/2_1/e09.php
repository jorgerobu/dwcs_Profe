<?php
function esAnagrama(string $p1, string $p2):bool
{
    //Si las palabras no tienen las mismas letras no pueden ser un anagrama.
    if(strlen($p1)!=strlen($p2)){
        return false;
    }

    //Ponemos ambos textos en mayusculas para que no sea case sensitive.
    $p1 = strtoupper($p1);
    $p2 = strtoupper($p2);

    //Si son la misma palabra tampoco son anagramas.
    if($p1==$p2){
        return false;
    }

    //Convertimos p1 en un array
    $arrayP1 = str_split($p1);
    
    foreach($arrayP1 as $letra){
        
        if(($i=strpos($p2,$letra))===false){
            //Si no contiene la letra es que no es un anagrama
            return false;
        }else{
            //Si detectamos la letra en la cadena la eliminamos de la misma y seguimos comprobando.
            substr_replace($p2,'',$i,1);
        }
    }

    return true;
}

$p1 = 'hola';
$p2 = 'hAlo';
echo "Es anagrama $p1 de $p2?: ";
if(esAnagrama($p1,$p2)){
    echo "Si";
}else{
    echo "No";
}

?>
