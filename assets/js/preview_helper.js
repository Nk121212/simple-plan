$(function () {

	var pathparts = location.pathname.split('/');
    var base_url = location.origin+'/'+pathparts[1].trim('/')+'/';

    $('#id_purpose').change(function(){
    	//alert('aaa');
    	var id_purpose = $(this).val();

    	$('#table_helper').DataTable().destroy();

    	var dataTable = $('#table_helper').DataTable( {
		    ajax: {
		        url: base_url+"json_print/list_helper/"+id_purpose+"",
		        data: function(data){

		        },
		        dataSrc: 'data',
		    },
		    searching: false,
		    fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
		        return "Menampilkan "+iStart+" Sampai "+iEnd+" Dari "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" Data";
		    },
		    pagingType: 'full_numbers',
		    language: {paginate: {
		        first: '<i class="fa fa-step-backward"></i>',
		        last: '<i class="fa fa-step-forward"></i>',
		        previous: '<i class="fa fa-backward"></i>',
		        next: '<i class="fa fa-forward"></i>',
		    }},
		    paging: true,
		    order: [[ 2, "asc" ]],
		    dom: 'tip',
		    pageLength: 25,
		    serverSide: true,
		    serverMethod: 'post',
		    columns: [
		        {data: "email"},
                {data: "name"},
                {data: "progress"},
		        {data: "action", orderable:false, className: "dt-body-center"}
		    ]
		});

    })

	$('#table_helper tbody').on('click', 'tr td a.delete', function () {
        //var data = table.row( this ).data();
        var id_purpose = $(this).attr('id-purpose');
        var email_helper = $(this).attr('email-helper');

        var dataTable = $('#table_helper').DataTable();
        //alert( 'You clicked on '+data.id+'\'s row' );
        swal("Anda yakin Menghapus Helper ini ?", {
            buttons: {
                yes: {
                    text: "Ya",
                    value: "yes",
                },
                no: {
                    text: "Tidak",
                    value: "no",
                },
            },
            })
            .then((value) => {

            switch (value) {
            
                case "yes":

                    $.post(base_url+"Helper/delete_helper",
                    {
                        id_purpose: id_purpose,
                        email_helper: email_helper
                    },
                    function(resp){
                        //alert("Data: " + data + "\nStatus: " + status);
                        console.log(resp);

                        swal({
                            icon: resp.bs_color,
                            title: resp.message,
                            text: resp.full_message,
                        }).then(function() {
                            dataTable.draw();
                        });
                    });

                break;
            
                case "no":
                    //swal("And Memilih no data id : "+id_group);
                break;
            
                default:
                    //swal("And Memilih hold data id : "+id_group);
            }

        });

    });

    $('#table_helper tbody').on('click', 'tr td a.view-task', function () {
        //var data = table.row( this ).data();
        var param = $(this).attr('param');

        var enc_mail = atob(param);

        //alert(enc_mail);

        var exp = enc_mail.split("_");

        var mail_helper = exp[1];

        //alert(mail_helper);

        $('.div-task').removeClass('hidden');

        $('#helper_mail').text('Helper : '+mail_helper);

        $('#table_task').DataTable().destroy();

    	var dataTable = $('#table_task').DataTable( {
		    ajax: {
		        url: base_url+"json_print/list_task_by_helper/"+param+"",
		        data: function(data){

		        },
		        dataSrc: 'data',
		    },
		    searching: false,
		    fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
		        return "Menampilkan "+iStart+" Sampai "+iEnd+" Dari "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" Data";
		    },
		    pagingType: 'full_numbers',
		    language: {paginate: {
		        first: '<i class="fa fa-step-backward"></i>',
		        last: '<i class="fa fa-step-forward"></i>',
		        previous: '<i class="fa fa-backward"></i>',
		        next: '<i class="fa fa-forward"></i>',
		    }},
		    paging: true,
		    order: [[ 2, "asc" ]],
		    dom: 'tip',
		    pageLength: 25,
		    serverSide: true,
		    serverMethod: 'post',
		    columns: [
		        //{data: "id"},
                {data: "task"},
                {data: "start"},
                {data: "end"},
                {data: "interval"},
                {data: "progress"},
		        //{data: "action", orderable:false, className: "dt-body-center"}
		    ]
		});
        

    });
    
});