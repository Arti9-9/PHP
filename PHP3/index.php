<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="ajax.js"></script>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Форма обратной связи</title>
    <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <div id="container-xxl" class = "container-xxl mt-5">
        <div id ="block-form" class="block-form">
        <form  action = "" method="post" id="ajax_form">
            <div class = "row mb-3">
            <label for = "inputName3" class = "col-sm-2 col-form-label">ФИО</label>
                <div class = "col-sm-10">
                    <input  placeholder="Введите ФИО" type = "name" name = "name" class = "form-control" id = "inputName3">
                </div>
            </div>
            <div class = "row mb-3">
                <label for = "inputEmail3" class = "col-sm-2 col-form-label">Почта</label>
                <div class = "col-sm-10">
                    <input  placeholder="Введите Email" type = "email" name = "email" class = "form-control" id = "inputEmail3">
                </div>
            </div>
            <div class = "row mb-3">
                <label for = "inputPhone3" class = "col-sm-2 col-form-label">Телефон</label>
                <div class = "col-sm-10">
                    <input placeholder="Введите телефон в формате +7(955)321-11-21" type = "tel" name = "phone" class = "bfh-phone form-control " id = "inputPhone3">
                </div>
            </div>
            <div class = "row mb-3">
                <label for = "inputComment3" class = "col-sm-2 col-form-label">Комментарий</label>
                <div class = "col-sm-10">
                    <textarea  placeholder="Введите комментарий" type = "comment" name = "comment" class = "form-control" id = "inputComment3"></textarea>
                </div>
            </div>
            <p><input id="btn" name = "submit" type = "submit" value = "Отправить"></p>
        </form>
        </div>
        <div id = "result_form" class="display_none">
        </div>
    </div>
</body>
</html>