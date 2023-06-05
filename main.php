<?php

//Для всех заданий с массивами задан многомерный массив, элементы которого могут содержать одинаковые id:
$array = [
    [
        "id" => 1,
        "date" => "12.01.2020",
        "name" => "test1"
    ],
    [
        "id" => 2,
        "date" => "02.05.2020",
        "name" => "test2"
    ],
    [
        "id" => 4,
        "date" => "08.03.2020",
        "name" => "test4"
    ],
    [
        "id" => 1,
        "date" => "22.01.2020",
        "name" => "test1"
    ],
    [
        "id" => 2,
        "date" => "11.11.2020",
        "name" => "test4"
    ],
    [
        "id" => 3,
        "date" => "06.06.2020",
        "name" => "test3",
    ]
];

//1
//выделить уникальные записи (убрать дубли) в отдельный массив.
// в конечном массиве не должно быть элементов с одинаковым id.
//  $array = [
//      [id => 1, ...],
//      [id => 2, ...],
//      [id => 4, ...],
//      [id => 3, ...],
//  ]
$res = array_values(array_column($array,null,'id'));

//2
//отсортировать многомерный массив по ключу (любому)
usort($array, fn($a, $b) => $a['id'] <=> $b['id']);
$res = $array;

//3
//вернуть из массива только элементы, удовлетворяющие внешним условиям (например элементы с определенным id)
$res = array_filter($array, fn($elem) => $elem['name'] === 'test1');

//4
//изменить в массиве значения и ключи (использовать name => id в качестве пары ключ => значение)
//$array = [
//    "test1" => 1,
//    "test2" => 2,
//    "test4" => 4,
//    "test3" => 3
//]
$res = array_column($array,'id','name');

//5
//В базе данных имеется таблица с товарами goods (id INTEGER, name TEXT), таблица с тегами tags (id INTEGER, name TEXT)
// и таблица связи товаров и тегов goods_tags (tag_id INTEGER, goods_id INTEGER, UNIQUE(tag_id, goods_id)). Выведите id
// и названия всех товаров, которые имеют все возможные теги в этой базе.
$res = "
    SELECT good_id, (SELECT good_name FROM goods WHERE id = good_id)
    FROM goods_tags as gt
    WHERE (SELECT COUNT(id) FROM tags) = (SELECT COUNT(tag_id) FROM goods_tags WHERE good_id = gt.good_id)
    GROUP BY good_id
";

//6
//Выбрать без join-ов и подзапросов все департаменты, в которых есть мужчины,
// и все они (каждый) поставили высокую оценку (строго выше 5).

$res = "
    SELECT department_id
    FROM evaluations
    WHERE gender = true
    GROUP BY department_id
    HAVING MIN(value > 5)
";

