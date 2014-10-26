$(document).ready(function(){

    $(".validate_form").validate({

       rules:{

            login:{
                required: true,
                minlength: 4,
                maxlength: 16,
            },

            password:{
                required: true,
                minlength: 6,
                maxlength: 16,
            },
			
			password2:{
                required: true,
                minlength: 6,
                maxlength: 16,
            },
			
			email:{
                email: true,
            },
       },

       messages:{

            login:{
                required: "<br />Это поле обязательно для заполнения",
                minlength: "<br />Логин должен быть минимум 4 символа",
                maxlength: "Максимальное число символо - 16",
            },

            password:{
                required: "<br />Это поле обязательно для заполнения",
                minlength: "<br />Пароль должен быть минимум 6 символов",
                maxlength: "<br />Пароль должен быть максимум 16 символов",
            },
			password2:{
                required: "<br />Это поле обязательно для заполнения",
                minlength: "<br />Пароль должен быть минимум 6 символа",
                maxlength: "<br />Пароль должен быть максимум 16 символов",
            },

            email:{
                email: "<br />Вы указали не корректный email",
            },

       },

    });

});