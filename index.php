<?php
session_start();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Тестовое задание</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-5">Тестовое задание для Junior Web Developer</h1>
        <form class="mb-5" action="config.php" method="post">
            <input
                    class="form-control mb-3"
                    type="text" name="option"
                    value="<?php
					    if(array_key_exists('option', $_SESSION) != false)
                            echo $_SESSION['option'];
                    ?>"
                    placeholder="Введите название опции"
                    required
            >
            <input
                    class="form-control mb-3"
                    type="text" name="default"
                    value="<?php
					    if(array_key_exists('default', $_SESSION) != false)
                            echo $_SESSION['default'];
                    ?>"
                    placeholder="Введите значение по умолчанию"
            >
            <input class="btn btn-success" type="submit" value="Получить значение">
        </form>
        <h2 class="text-center text-success">
            <?php
                if(array_key_exists('result', $_SESSION) != false)
                    echo $_SESSION['result'];
            ?>
        </h2>
        <h2 class="text-center text-danger">
            <?php
			if(array_key_exists('error', $_SESSION) != false)
                    echo $_SESSION['error'];
            ?>
        </h2>
    </div>
</body>
</html>
<?php
session_destroy();
?>