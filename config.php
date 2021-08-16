<?php
session_start();
$option = trim($_POST['option']);
$default = trim($_POST['default']);

unset($_SESSION['option']);
unset($_SESSION['default']);
unset($_SESSION['result']);
unset($_SESSION['error']);

$_SESSION['option'] = $option;
$_SESSION['default'] = $default;

function config($optionName = null, $defaultValue = null) {
	try {
		$setting = include "data/settings.php";
		$optionNameConfig = $optionName;

		if(strpos($optionName, ".")) {
			$optionNameArr = explode(".", $optionName);
			$arr = $setting;

			foreach ($optionNameArr as $el) {
				if(array_key_exists($el, $arr)) {
					$arr = $arr["$el"];
				} else if($defaultValue != false) {
					$arr = $defaultValue;
					break;
				} else {
					throw new Exception('Такого параметра нет.');
				}
			}
			if(is_array($arr)) {
				ob_start();
				var_dump($arr);
				$optionNameConfig = ob_get_contents();
				ob_end_clean();
			}else {
				$optionNameConfig = $arr;
			}
		}
		else {
			if(array_key_exists($optionNameConfig, $setting)) {
				if(is_array($setting[$optionName])) {
					ob_start();
					var_dump($setting[$optionName]);
					$optionNameConfig = ob_get_contents();
					ob_end_clean();
				}else {
					$optionNameConfig = $setting[$optionName];
				}
			}else if($defaultValue != false) {
				$optionNameConfig = $defaultValue;
			}else  {
				throw new Exception('Такого параметра нет.');
			}
		}

		$_SESSION['result'] =  "Значение: ". $optionNameConfig . "<br>";
		return $optionNameConfig;

	}catch(Exception $e) {
		$_SESSION['error'] = 'Выброшено исключение: '.  $e->getMessage();
	}
}

config($option, $default);

header('Location: index.php');
