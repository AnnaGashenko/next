﻿<?php

/*
is_array — Определяет, является ли переменная массивом
is_bool  — Проверяет, является ли переменная булевой (true or false)
is_double - Эта функция является псевдонимом: is_float()
is_float — Проверяет, является ли переменная числом с плавающей точкой
is_int — Проверяет, является ли переменная переменной целочисленного типа 
is_integer — Псевдоним is_int()
is_null — Проверяет, является ли значение переменной равным NULL
is_numeric — Проверяет, является ли переменная числом или строкой, содержащей число
is_real — Псевдоним is_float()
is_string — Проверяет, является ли переменная строкой
*/

if (is_int("235jjjjj")) {
    echo "целое число\n";
} else {
    echo "не число\n";
}

?>