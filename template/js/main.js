$().ready(function() {
	// validate signup form on keyup and submit
	$("#contactform").validate({
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
			photo: "Файлы должны быть в формате JPG или PNG",
			photo: {
				required:"Входные данные проверяются",                  
				extension:"Файлы должны быть в формате JPG или PNG"
			}
		},
		submitHandler: function() {
             
			let bodyFormData = new FormData(document.getElementById("contactform"));

			axios({
				method: 'post',
				url: '/',
				data: bodyFormData,
				headers: {
				 'Content-Type': 'multipart/form-data'
				}
			  })
			  .then(function(response) {
				$.jGrowl(response.data);
				setInterval(function() {
					window.location.reload(true);
				  }, 3000);
			  })
			  .catch(function(error) {
				console.log(error);
			  });
        },
	});
});

let filesExt = ['jpg', 'jpeg', 'png']; 

$('input[type=file]').change(function(){
    var parts = $(this).val().split('.');
    if(filesExt.join().search(parts[parts.length - 1]) == -1){
       $.jGrowl("Файлы должны быть в формате jpg/jpeg или png",{ theme: 'red_theme'});
       $(this).val('');
    } 
});