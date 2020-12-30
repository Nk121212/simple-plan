$(function () {

    $('input, select').on('focus', function () {
        $(this).parent().find('.input-group-text').css('border-color', '#80bdff');
    });

    $('input, select').on('blur', function () {
        $(this).parent().find('.input-group-text').css('border-color', '#ced4da');
    });

    $(document).ready(function() {
	    $('form#form_reg').submit(function() {
	        var password = $('#password').val();
		    var password_confirmation = $('#password_confirmation').val();

		    if(password != password_confirmation){
				$('#password').focus();
				$('p#notif_password').text('Password dan Password konfirmasi tidak sama !');
				return false;
		    }else{
		    	return true;
		    }
	    });
	});

    /*$("form#form_reg").submit(function(e){
	    e.preventDefault();   
	    var password = $('#password').val();
	    var password_confirmation = $('#password_confirmation').val();

	    if(password != password_confirmation){
			$('#password').parent().find('.input-group-text').css('border-color', '#ced4da');
			return false;
	    }else{
	    	return true;
	    }

	});*/
});