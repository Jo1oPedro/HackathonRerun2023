<?php
$lines = file('./arquivosDeEntrada/arquivoDeEntrada1.txt', FILE_IGNORE_NEW_LINES);

$classes = array();
$structs = array();
$insideClassOrStruct = false;

foreach ($lines as $line) {
    $objeto = new stdClass();
    $extendsAux = false;
    $words = str_word_count($line, 1);
    foreach ($words as $key => $word) {
        if($word === "extends") {
            $extendsAux = $words[$key + 1];
            break;
        }
    }
    if (preg_match('/^(struct|class|Class) (\w+)/', $line, $matches)) {
        $type = $matches[1];
        $name = $matches[2];
        if($name) {
            $objeto->name = $name;
        }
        if ($type === 'struct') {
            $objeto->type = 'struct';
            $insideClassOrStruct = true;
        } elseif ($type === 'class' || $type === 'Class') {
            $objeto->type = 'class';
            $insideClassOrStruct = true;
        }
    } elseif ($insideClassOrStruct) {
        if (strpos($line, '{') !== false) {
            $attributes = array();
        } elseif (strpos($line, '}') !== false) {
            $insideClassOrStruct = false;
            $atributosObj = [];
            foreach($attributes as $attr) {
                $words = str_word_count($attr, 1);
                $atributo = new stdClass();
                $atributo->type = $words[0];
                $atributo->value = $words[1];
                $atributosObj[] = $atributo;
            }
            $objeto->atributos = $atributosObj;
            $attributes = array();
        } else {
            $attributeLine = trim($line, " \t;");
            if (!empty($attributeLine)) {
                $attributes[] = $attributeLine;
            }
        }
    }

    if(isset($objeto->type)) {
        if($objeto->type === 'struct') {
            $structs[] = $objeto;
        }else if($objeto->type === 'class') {
            $classes[] = $objeto;
        }
    }
}

var_dump($classes);exit;


// $lines = file('./arquivosDeEntrada/arquivoDeEntrada2.txt', FILE_IGNORE_NEW_LINES);

// $structs = array();
// $classesLowercase = array();
// $classesUppercase = array();

// $classExtends = array();
// $classUpExtends = array();
// $classData = array();
// $structData = array();
// $currentClass = null;
// $currentStruct = null;
// $insideClassOrStruct = false;
// $attributes = array();

// foreach ($lines as $line) {
//     $extendsAux = false;
//     $words = str_word_count($line, 1);
//     foreach ($words as $key => $word) {
//         if($word === "extends") {
//             $extendsAux = $words[$key + 1];
//             break;
//         }
//     }
//     if (preg_match('/^(struct|class|Class) (\w+)/', $line, $matches)) {
//         $type = $matches[1];
//         $name = $matches[2];

//         if ($type === 'struct') {
//             $structs[] = $name;
//             $currentStruct = $name;
//             $insideClassOrStruct = true;
//         } elseif ($type === 'class') {
//             $classesLowercase[] = $name;
//             $currentClass = $name;
//             $insideClassOrStruct = true;
//             if($extendsAux) {
//                 $classExtends[$currentClass] = $extendsAux;
//             }
//         } elseif ($type === 'Class') {
//             $classesUppercase[] = $name;
//             $currentClass = $name;
//             $insideClassOrStruct = true;
//             if($extendsAux) {
//                 $classUpExtends[$currentClass] = $extendsAux;
//             }
//         }
//     } elseif ($insideClassOrStruct) {
//         if (strpos($line, '{') !== false) {
//             $attributes = array();
//         } elseif (strpos($line, '}') !== false) {
//             $insideClassOrStruct = false;
//             if ($currentClass) {
//                 $classData[$currentClass] = array('attributes' => $attributes);
//             } elseif ($currentStruct) {
//                 $structData[$currentStruct] = array('attributes' => $attributes);
//             }
//             $attributes = array();
//         } else {
//             $attributeLine = trim($line, " \t;");
//             if (!empty($attributeLine)) {
//                 $attributes[] = $attributeLine;
//             }
//         }
//     }
// }

// echo "Structs: " . implode(', ', $structs) . PHP_EOL;
// echo "Classes (Iniciando com letra minúscula): " . implode(', ', $classesLowercase) . PHP_EOL;
// echo "Classes (Iniciando com letra maiúscula): " . implode(', ', $classesUppercase) . PHP_EOL;

// foreach ($classData as $className => $data) {
//     echo "Atributos da classe $className: " . implode(', ', $data['attributes']) . PHP_EOL;
// }

// foreach ($structData as $structName => $data) {
//     echo "Atributos da struct $structName: " . implode(', ', $data['attributes']) . PHP_EOL;
// }

// foreach ($classExtends as $className => $value) {
//     echo "Extends da $className: " . $value . PHP_EOL;
// }

// foreach ($classUpExtends as $className => $value) {
//     echo "Extends da $className: " . $value . PHP_EOL;
// }


