$( document ).ready(function() {
    $('#btn').click(//слушатель событий кнопки
		function() 
        {
            if (validation()) { 
			    sendAjaxForm('result_form', 'ajax_form', 'action_ajax_form.php');//слушатель сработал и вызвал метод
			    return false; 
		    }
            event.preventDefault();
        }
	);
});
function sendAjaxForm(result_form, ajax_form, url) 
{// result_form - это div в который будут рендерится данные, ajax_form - это id формы отправки сообщения и url - это местоположение файла action_ajax_form.php который отвечает за серверную часть (обработка формы).
    $('#block-form').addClass('d-none');
       $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
        	result = $.parseJSON(response);
            if(result.error==false) {
               $('#result_form').html('Ваши данные обработаны!'+'<br>Имя: '+ result.name[1] + '<br>Фамилия: '+ result.name[0] + '<br>Отчество: ' + result.name[2] + '<br>Адрес электронной почты: ' + result.email + '<br>Телефон: '+ result.phone + '<br>Комментарий: ' + result.comment + '<br>' + result.message); 
            } else {
                $('#result_form').html('Данные обрабатываются. Повторную заявку можно отправить в ' + result.time);
            }
        	
    	},
    	error: function(response) { // Данные не отправлены
            $('#result_form').html('Ошибка. Данные не отправлены.');
    	}
 	});
}
function validation() 
{
    var flag = true;
    if ($('#inputName3').val().length == 0) {
        $('#inputName3').addClass('border-danger');
        flag=false;
    } else {
        $('#inputName3').removeClass('border-danger');
    }
    if ($('#inputComment3').val().length == 0) {
        $('#inputComment3').addClass('border-danger');
        flag=false;
    } else {
        $('#inputComment3').removeClass('border-danger');
    }
    //проверка почты
    var reg = /^\w+([\.-]?\w+)*@(((([a-z0-9]{2,})|([a-z0-9][-][a-z0-9]+))[\.][a-z0-9])|([a-z0-9]+[-]?))+[a-z0-9]+\.([a-z]{2}|(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum))$/i;
    if ($('#inputEmail3').val().length == 0 || !reg.test( $('#inputEmail3').val())){
        flag=false;
        $('#inputEmail3').addClass('border-danger');
    } else {
        $('#inputEmail3').removeClass('border-danger');
    }
    //проверка телефона
    var reg = /\+7\(\d{3}\)\d{3}-\d{2}-\d{2}/;
    if ($('#inputPhone3').val().length == 0 || !reg.test( $('#inputPhone3').val())){
        flag=false;
        $('#inputPhone3').addClass('border-danger');
    } else {
        $('#inputPhone3').removeClass('border-danger');
    }
    return flag;
}
