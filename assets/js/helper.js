$(function () {

	var pathparts = location.pathname.split('/');
    var base_url = location.origin+'/'+pathparts[1].trim('/')+'/';

    $('#id_purpose').change(function(){

    	var id_purpose = $(this).val();

    	$('#email_helper').html('');

		$.post(base_url+"Helper/get_helper",
		{
			id_purpose: id_purpose,
			//city: "Duckburg"
		},
		function(response){
			//console.log(response);
			$.each(response, function(i, helper){
				//alert(helper.email);
                $('#email_helper').append('<option value="'+helper.email+'">'+helper.first_name+' '+helper.last_name+'</option>');
            });
		});

    })
    
});