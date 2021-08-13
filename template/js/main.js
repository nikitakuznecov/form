$().ready(function() {

	let form = $("#contactform");

	let filesExt = ['jpg', 'jpeg', 'png'];

	form.validate({
		rules: {
			name: "required",
			phone: "required",
			email: {
				required: true,
				email: true
			},
			photo: {
				required: true,
				extension: "png|jpeg|jpg",
				filesize: 1048576
			}
		},
		messages: {
			name: "Пожалуйста, заполните поле - Ваше имя",
			phone: "Пожалуйста, заполните поле - Ваш телефон",
			email: "Пожалуйста, заполните поле - Ваше e-mail",
			photo: {
				required:"Входные данные проверяются",
				extension:"Файлы должны быть в формате JPG или PNG"
			}
		}
	});

	form.submit (function(event) {
		if (form.valid())
		{
			let bodyFormData = new FormData(document.getElementById("contactform"));

			axios({
				method: 'post',
				url: '/addUser',
				data: bodyFormData,
				headers: {
					'Content-Type': 'multipart/form-data'
				}
			})
				.then(function(response) {
					$.jGrowl(response.data['Message']);
                    $(".table-row").append(response.data['arrResponse']);
                    form[0].reset();
				})
				.catch(function(error) {
					console.log(error);
				});
		}
		event.preventDefault(); // stop form from redirecting to java servlet page
	});

	$('input[type=file]').change(function(){
		var parts = $(this).val().split('.');
		if(filesExt.join().search(parts[parts.length - 1]) == -1){
			$.jGrowl("Файлы должны быть в формате jpg/jpeg или png",{ theme: 'red_theme'});
			$(this).val('');
		}
	});

});



