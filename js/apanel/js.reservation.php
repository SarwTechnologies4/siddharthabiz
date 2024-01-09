<script language="javascript">

function getLocation(){
	return '<?php echo BASE_URL;?>includes/controllers/ajax.reservation.php';
}
function getTableId(){
	return 'table_dnd';
}


$(document).ready(function() {
	oTable = $('#example').dataTable({
		"bJQueryUI": true,
		"iDisplayLength": 25,
		"sPaginationType": "full_numbers"
	});
	$(".datepicker_search").datepicker({
		dateFormat:'yy-mm-dd',
		changeMonth: true,
        changeYear: true,
        showButtonPanel: true
    });
});


$(document).ready(function(){
	$(document).on('click', '.make_approve', function(){
		var row_id  =  $(this).data('id');
		$.ajax({
		   	type: "POST",
		   	dataType:"JSON",
		   	url:  getLocation(),
		   	data: "action=make_approve&idValue="+row_id,
		   	success: function(response){
		   		var response  = eval(response);
		   		$('.alert').remove(); 
		   		if(response.success==true){
		   			$('#my-msg').append('<div class="alert alert-success">'+response.message+'</div>');
                    $('.alert').show().delay(3000).fadeOut('slow');
                    setTimeout(function()
                      {  window.location.href=window.location.href;                    
                      }, 2000);
		   		} 
		   		
		   	}
		});
	});

	$(document).on('click', '.un_approve', function(){
		var row_id  =  $(this).data('id');
		$.ajax({
		   	type: "POST",
		   	dataType:"JSON",
		   	url:  getLocation(),
		   	data: "action=un_approve&idValue="+row_id,
		   	success: function(response){
		   		var response  = eval(response);
		   		$('.alert').remove(); 
		   		if(response.success==true){
		   			$('#my-msg').append('<div class="alert alert-success">'+response.message+'</div>');
                    $('.alert').show().delay(3000).fadeOut('slow');
                    setTimeout(function()
                      {  window.location.href=window.location.href;                    
                      }, 2000);
		   		} 
		   		
		   	}
		});
	});


});//ready
</script>