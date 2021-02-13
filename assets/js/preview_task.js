$(function () {

	var pathparts = location.pathname.split('/');
    var base_url = location.origin+'/'+pathparts[1].trim('/')+'/';

	var dataTable = $('#table_task').DataTable( {
	    ajax: {
	        url: base_url+"json_print/list_task",
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
	    	{data: "purpose"},
	        {data: "task"},
			{data: "comment"},
			{data: "interval"},
			{data: "progress"},
			{data: "attachment"},
	        //{data: "action", orderable:false, className: "dt-body-center"}
	    ]
	});

	$('.form-filter').submit(function(e){

	    window.swal({
	        title: "Searching ...",
	        text: "Please wait",
	        icon: '<?=base_url()?>assets/img/searching.gif',
	        button: false,
	        allowOutsideClick: false
	    })
	    e.preventDefault();    
	    var formData = new FormData(this);

	    //var status = $('#status').val();
	    var search = $('#search').val();

	    $('.table-activity').dataTable().fnDestroy();

	    $('.table-activity').DataTable( {
	        ajax: {
	            url: base_url+'ajax/document/type.json?search='+search+'',
	            data: function(data){
	                console.log(data);
	                //data.search.role = $("#role").val();
	                //data.search.q = $("#search").val();
	            },
	            dataSrc: 'data',
	        },
	        "initComplete": function( oSettings, json ) {
	            swal({
	                icon: 'success',
	                title: 'Finish',
	                //message: resp.message,
	                button: 'Close'
	            });
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
	            {data: "no", orderable:false, width: "30px", className: "dt-body-center"},
	            {data: "title"},
	            {data: "desc"},
	            {data: "image"},
	            {data: "action", orderable:false, className: "dt-body-center"}
	        ]
	    });

	});
    
});