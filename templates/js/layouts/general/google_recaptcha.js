grecaptcha.ready(useRecaptcha);

let isRecapthaLoadBlock = false;

function useRecaptcha() {
	//Выполнить запрос, если доступ не заблокирован
	if (!isRecapthaLoadBlock) {
		isRecapthaLoadBlock = true; //Блокируем дальнейшие попытки запросов
		
		//Получаем input для рекапчи
		let $inputList = $(".g-recaptcha-input");

		if ($inputList.length === 0) {
			//Снимаем блокировку, если нет необходимых input
			isRecapthaLoadBlock = false;
		} else {
			//Вставляем в каждый input код
			for (let index = 0; index < $inputList.length; index++) {
				grecaptcha.execute('6Lc_wLQUAAAAAOQKngSe9uBkX3ic6TkFxjJgHKLF', {action: 'homepage'}).then(function(token) {
					$inputList[index].value = token;

					//Снимаем блокировку, если это последний input
					if (index === ($inputList.length - 1)) {
						isRecapthaLoadBlock = false;
					}    
				});
			}
		}
	}
}