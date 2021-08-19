<?php
function throwNewException()
{
	throw new Exception('Такого параметра нет.');
}
/**
 * Функция получает путь к файлу settings.php с настройками проекта.
 * вызывается с 1 или 2 параметрами.
 * @param string $optionName - строка, необходима для указания ключа опции.
 * @param mixed $defaultValue - строка, необходима для указания значения опции по умолчанию, если опции в файле нет.
 * *Если опции нет, и значение по-умолчанию не задано, будет выброшено исключение.
 * @return mixed
 */

function config(string $optionName = null, $defaultValue = null)
{
	error_reporting(E_ALL & ~E_WARNING);
	$setting = include "data/settings.php";
	try {
		if (strpos($optionName, ".")) {
			$optionNameArr = explode(".", $optionName);
			$arr = $setting;
			foreach ($optionNameArr as $el) {
				if (array_key_exists($el, $arr)) {
					$arr = $arr["$el"];
				}
				else if (isset($defaultValue)) {
					return $defaultValue;
				}
				else throwNewException();
			}
			return $arr;
		} elseif (array_key_exists($optionName, $setting)) {
			return $setting[$optionName];
		} elseif (isset($defaultValue)) {
			return $defaultValue;
		} else
			throwNewException();
	}
	catch (Exception $e) {
		echo 'Выброшено исключение: '.  $e->getMessage();
	}
}