<script language="javascript">

function getLocation(){
	return '<?php echo BASE_URL;?>includes/controllers/ajax.calenderbooking.php';
}
function getTableId(){
	return 'table_dnd';
}

$(document).ready(function() {
	oTable = $('#example').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
	}).rowReordering({ 
		  sURL:"<?php echo BASE_URL;?>includes/controllers/ajax.calenderbooking.php?action=sort",
		  fnSuccess: function(message) { 
					var msg = jQuery.parseJSON(message);
					showMessage(msg.action,msg.message);
			   }
		   });
});

$(document).ready(function(){
	$('#reserve_date').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd'
	});

	$('#date_from').datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd',
				minDate: '0',
				maxDate: '+2M',
				onSelect: function(dateStr) {
		            var d1 = $(this).datepicker("getDate");
		            d1.setDate(d1.getDate() + 0); // change to + 1 if necessary
		            var d2 = $(this).datepicker("getDate");
		            d2.setDate(d2.getDate() + 60); // change to + 180 if necessary
		            $("#date_to").datepicker("option", "minDate", d1);
		            $("#date_to").datepicker("option", "maxDate", d2); 
		            var start = $("#date_from").datepicker("getDate");
		            var end   = $("#date_to").datepicker("getDate");
		            var days   = (end - start)/1000/60/60/24;
		        }
			});

			$('#date_to').datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd',		
				minDate: $("#date_from").datepicker("getDate"),
		        maxDate: '+2M',
		        onSelect: function(){
		        	var start = $("#date_from").datepicker("getDate");
		          	var end   = $("#date_to").datepicker("getDate");
		          	var days   = (end - start)/1000/60/60/24;
		        }
			});
});

$(document).ready(function(){		
	// form submisstion actions		
	jQuery('#offers_frm').validationEngine({		
		prettySelect : true,
		autoHidePrompt:true,
		useSuffix: "_chosen",
		scroll: true,
		onValidationComplete: function(form, status){
			if(status==true){	
				$('#btn-submit').attr('disabled', 'true');
				var action = ($('#idValue').val() == 0) ? "action=add&" : "action=edit&" ;	
				/* By Me */
				for ( instance in CKEDITOR.instances ) 
				CKEDITOR.instances[instance].updateElement();	
				/* End By Me */				
				var data = $('#offers_frm').serialize();
				queryString = action+data;
				$.ajax({
				   type: "POST",
				   dataType:"JSON",
				   url:  getLocation(),
				   data: queryString,
				   success: function(data){
					   var msg = eval(data);
					   if(msg.action=='warning'){
						   showMessage(msg.action,msg.message);
						   $('#btn-submit').removeAttr('disabled');						   			   
		 				   $('.formButtons').show();
						   return false
					   }
					   if(msg.action=='success'){
						   showMessage(msg.action,msg.message);							   
						   setTimeout( function(){window.location.href="<?php echo ADMIN_URL?>roomoffers/list";},3000);
					   }
					   if(msg.action=='notice'){
						   showMessage(msg.action,msg.message);		   					   
						   setTimeout( function(){window.location.href=window.location.href;},3000);
					   }			   					   
					   if(msg.action=='error'){
						   showMessage(msg.action,msg.message);
						   $('#buttonsP img').remove();
		 				   $('.formButtons').show();
						   return false;
					   }
				   }
				});
			return false;
			}
		}
	})
});

// Edit records
function editRecord(Re)
{
	$.ajax({
	   type: "POST",
	   dataType:"JSON",
	   url:  getLocation(),
	   data: 'action=editExistsRecord&id='+Re,
	   success: function(data){
		   var msg = eval(data);
		   $("#title").val(msg.title);
		   $("#idValue").val(msg.editId);		   
	   }
	});
}
		
// Deleting Record
function recordDelete(Re){
	$('.MsgTitle').html('<?php echo sprintf($GLOBALS['basic']['deleteRecord_'],"Calender Booking")?>');															
	$('.pText').html('Click on yes button to delete this image permanently.!!');
	$('.divMessageBox').fadeIn();
	$('.MessageBoxContainer').fadeIn(1000);
	
	$(".botTempo").on("click",function(){						
		var popAct=$(this).attr("id");						
		if(popAct=='yes'){
			$.ajax({
			   type: "POST",
			   dataType:"JSON",
			   url:  getLocation(),
			   data: 'action=delete&id='+Re,
			   success: function(data){
				 var msg = eval(data);  
				 showMessage(msg.action,msg.message);
				 $('#'+Re).remove();
				 Re='';
				 reStructureList(getTableId());
			   }
			});
		}
		$('.divMessageBox').fadeOut();
		$('.MessageBoxContainer').fadeOut(1000);
	});	
}



/***************************************** View calenderbooking Lists *******************************************/
function viewCalenderlist()
{
	window.location.href="<?php echo ADMIN_URL?>calenderbooking/list";
}

/***************************************** Add New calenderbooking *******************************************/
function AddNew()
{
	window.location.href="<?php echo ADMIN_URL?>calenderbooking/addEdit";
}

/***************************************** Edit records *****************************************/
function editRecord(Re)
{
	window.location.href="<?php echo ADMIN_URL?>calenderbooking/addEdit/"+Re;
}

/******************************** Remove temp upload image ********************************/
function deleteTempimage(Re)
{
	$('#previewUserimage'+Re).fadeOut(1000,function(){
		$('#previewUserimage'+Re).remove(); 
		$('#preview_Image').html('<input type="hidden" name="imageArrayname" value="" class="">');
	});
}

$(document).ready(function() {
    jQuery('.cal_anchor').fancybox({
					closeBtn  : true,
					autoSize  : true,
					width     : '350',
					height : '300',
					autoSize : false,
					afterLoad : function() {	
					var id  = this.title;
						jQuery.ajax({
							type: "POST",
							url:  getLocation(),
			                data: 'action=date_detail&date='+id,
							success: function(data){
								jQuery('#datePopup').html(data);
							}
						})
					},
					helpers : {
							title   : false
						}
				});

    $(document).on("click","#BtnSubmit",function(){
    	  var params  =  $('#calender_date_booking_form').serialize();
    	  params +="&action=save_date_detail";
    	  jQuery.ajax({
					type: "POST",
					url:  getLocation(),
	                data: params,
	                dataType:"JSON",
					success: function(response){
				        var response = eval(response);
				        alert(response.message);
					}
				})
    });

    $(document).on("keyup","input.room_field",function(){
          var id    =  $(this).data("self_id");
          var tot   =  $(this).data("total");
          var val   =  $(this).val();
          var booked_room  =  parseInt(tot)-parseInt(val);
          $("#booked_"+id).val(booked_room);
    });

    $(document).on("keyup","input.booked_field",function(){	
          var id    =  $(this).data("self_id");
          var tot   =  $(this).data("total");
          var val   =  $(this).val();
          var remain_room  =  parseInt(tot)-parseInt(val);
          $("#room_"+id).val(remain_room);
    });
});	

jQuery(document).on('keydown', 'input.room-block, input.room-rate, input.bulk-rate', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
jQuery(document).on('blur', 'input.room-block', function(e) {
	e.preventDefault();
	var _input = jQuery(this);
	var max_room = _input.attr('data-max');
	var tot_room = _input.val();
	var man_info = _input.attr('data-main');

	var blok_room = (max_room <= tot_room)?max_room : tot_room;

	jQuery.ajax({
		type: "POST",
		url:  getLocation(),
        data: { 'action': 'newCalendar', 'info_main':man_info , 'room_blok': blok_room },
        dataType:"JSON",
		success: function(data) {
	        var msg = eval(data);
	        _input.val(msg.room_qty);
	        if(msg.room_qty > 0) { jQuery('button.'+msg.room_date).removeClass('bg-red').addClass('bg-green'); jQuery('button.'+msg.room_date).attr('data-rum', '0'); } 
	        else { jQuery('button.'+msg.room_date).removeClass('bg-green').addClass('bg-red'); jQuery('button.'+msg.room_date).attr('data-rum', max_room); }
		},
		beforeSend: function(){
			_input.attr('disabled', 'disabled');
        },
        complete: function(){
        	_input.removeAttr('disabled');
        }
	});
	return false;
});

jQuery(document).on('click', 'button.btn-act', function(e) {
	e.preventDefault();
	var room = jQuery(this).attr('data-rum');
	var clas = jQuery(this).attr('data-inrow');
	jQuery('input.'+clas).val(room);
	jQuery('input.'+clas).trigger('blur');
});

$(document).on('click', 'button.dbulk', function(e) {
	e.preventDefault();
    var pdata = jQuery(this).attr('data-bulk');
    $.fancybox({
        width: 'auto',
        height: 200,
        autoSize: false,
        href: getLocation(),
        type: 'ajax',
        ajax: {
            type: "POST",
            data: { 'action':'bulkroom', 'bulkpost':pdata }
        },
        helpers : { 
            overlay : {
                closeClick: false
            } // prevents closing when clicking OUTSIDE fancybox
        }
    });
});

jQuery(document).on('focusin', 'input.date_from', function(e) {
	e.preventDefault();
	$(this).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		minDate: '0',
		maxDate: '+2M',
		onSelect: function(dateStr) {
	        var d1 = $(this).datepicker("getDate");
	        d1.setDate(d1.getDate() + 0); // change to + 1 if necessary
	        var d2 = $(this).datepicker("getDate");
	        d2.setDate(d2.getDate() + 60); // change to + 180 if necessary
	        $('div.frm-bulk, div.frm-qbulk').find("input.date_to").datepicker("option", "minDate", d1);
	        $('div.frm-bulk, div.frm-qbulk').find("input.date_to").datepicker("option", "maxDate", d2); 
	        var start = $(this).datepicker("getDate");
	        var end   = $('div.frm-bulk, div.frm-qbulk').find("input.date_to").datepicker("getDate");
	        var days   = (end - start)/1000/60/60/24;
	    }
	});
});


jQuery(document).on('focusin', 'input.date_to', function(e) {
	e.preventDefault();
	var min_date = $('div.frm-bulk, div.frm-qbulk').find("input.date_from").datepicker("getDate");
	$(this).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',		
		minDate: (min_date!=null)?min_date:0,
	    maxDate: '+2M',
	    onSelect: function(){
	    	var start = $('div.frm-bulk, div.frm-qbulk').find("input.date_from").datepicker("getDate");
	      	var end   = $(this).datepicker("getDate");
	      	var days   = (end - start)/1000/60/60/24;
	    }
	});
});

jQuery(document).on('click', 'button.btn-bulk', function(e) {
	e.preventDefault();
	var _input = jQuery(this);
	var d_from = jQuery('input[name="from_date"]').val();
	var d_to   = jQuery('input[name="to_date"]').val();
	var d_room = jQuery('input[name="block_room"]').val();
	var m_hotel= _input.attr('data-hotel');
	var m_room = _input.attr('data-room');
	var mx_room = _input.attr('data-max');

	jQuery.ajax({
		type: "POST",
		url:  getLocation(),
        data: { 'action': 'bulkCalendar', 'hotel_id':m_hotel , 'room_id':m_room, 'date_from':d_from, 'date_to':d_to, 'block_room':d_room, 'max_room':mx_room },
        dataType:"JSON",
		success: function(data) {
	        var msg = eval(data);
         	$.each(msg.res, function(i, item) {	         	
	         	jQuery('input.'+i).val(item);
	         	if(item > 0) { jQuery('button.'+i).removeClass('bg-red').addClass('bg-green'); jQuery('button.'+i).attr('data-rum', '0'); } 
	        	else { jQuery('button.'+i).removeClass('bg-green').addClass('bg-red'); jQuery('button.'+i).attr('data-rum', mx_room); }
        	});
        	jQuery.fancybox.close();
		},
		beforeSend: function(){
			_input.attr('disabled', 'disabled').html('Loading...');
        },
        complete: function(){
        	_input.removeAttr('disabled').html('Save');
        }
	});
	return false;
})

jQuery(document).on('click', 'a.get-indvres', function(e) {
	e.preventDefault();
	var _input = jQuery(this);
	var m_post = _input.attr('data-mrate');
	jQuery.ajax({
		type: "POST",
		url:  getLocation(),
        data: {'action': 'getIndividual', 'm_data':m_post },
        dataType:"JSON",
		success: function(data){
	        var res = eval(data);
	        jQuery('tr.one-'+res.room_id).html(res.guest_a);
	        jQuery('tr.two-'+res.room_id).html(res.guest_b);
	        jQuery('tr.three-'+res.room_id).html(res.guest_c);
	        jQuery('tr.extra-'+res.room_id).html(res.guest_ex);	

	        _input.removeClass('get-indvres').addClass('cls-indvres');
	        _input.attr('data-roomid', res.room_id);
		}
	});

	return false;
});	

jQuery(document).on('click', 'a.cls-indvres', function(e) {
	e.preventDefault();
	var _input = jQuery(this);
	var room_id = _input.attr('data-roomid');
	jQuery('tr.one-'+room_id).html('');
    jQuery('tr.two-'+room_id).html('');
    jQuery('tr.three-'+room_id).html('');
    jQuery('tr.extra-'+room_id).html('');	  
    _input.removeClass('cls-indvres').addClass('get-indvres');
});

jQuery(document).on('blur', 'input.room-rate', function(e) {
	e.preventDefault();
	var _input = jQuery(this);
	var new_rate = _input.val();
	var man_data = _input.attr('data-main');
	
	jQuery.ajax({
		type: "POST",
		url:  getLocation(),
        data: { 'action': 'newRate', 'data_main':man_data , 'rate_new': new_rate },
        dataType:"JSON",
		success: function(data) {
	        var msg = eval(data);
	        _input.val(msg.room_rate);	 
	        jQuery('button.mytooltip').attr('data-show', 1);       
	        jQuery('button.mytooltip > span.tooltiptext').html('Loading...');
		},
		beforeSend: function(){
			_input.attr('disabled', 'disabled');
        },
        complete: function(){
        	_input.removeAttr('disabled');
        }
	});
	return false;
});

// For Price calculation
jQuery(document).ready(function($) {
    var st;
    $(".mytooltip").mouseenter(function(e) { 
        var _this = jQuery(this);
        var dhow = _this.attr('data-show');
        var jdata = _this.attr('data-mrate');
        st = setTimeout(function() {
        	if(dhow==1) {
        		jQuery.ajax({
					type: "POST",
					url:  getLocation(),
			        data: { 'action': 'getmeRate', 'data_main':jdata },
			        dataType:"JSON",
					success: function(data) {
				        var msg = eval(data);
				        _this.attr('data-show', 2);
				        _this.find('span.tooltiptext').html(msg.res);
					}
				});
				return false;
        	}
        }, 1000);
    }).mouseleave(function() {
     	clearTimeout( st ); 
    });    
});

// Individual Room
$(document).on('click', 'button.qbulk', function(e) {
	e.preventDefault();
    var pdata = jQuery(this).attr('data-qbulk');
    $.fancybox({
        width: 'auto',
        height: 220,
        autoSize: false,
        href: getLocation(),
        type: 'ajax',
        ajax: {
            type: "POST",
            data: { 'action':'bulkRate', 'bulkpost':pdata }
        },
        helpers : { 
            overlay : {
                closeClick: false
            } // prevents closing when clicking OUTSIDE fancybox
        }
    });
});

jQuery(document).on('click', 'button.btn-qbulk', function(e) {
	e.preventDefault();
	var _input = jQuery(this);
	var d_from = jQuery('input[name="from_date"]').val();
	var d_to   = jQuery('input[name="to_date"]').val();
	var d_rate = jQuery('input[name="new_rate"]').val();
	var m_hotel= _input.attr('data-hotel');
	var m_room = _input.attr('data-room');
	var mx_room = _input.attr('data-pmax');

	if(d_rate < 5 && mx_room!=4) { jQuery('span.error').html('Min. room rate greater than 5'); return false; }

	jQuery.ajax({
		type: "POST",
		url:  getLocation(),
        data: { 'action': 'bulkRoomprice', 'hotel_id':m_hotel , 'room_id':m_room, 'date_from':d_from, 'date_to':d_to, 'room_rate':d_rate, 'room_type':mx_room },
        dataType:"JSON",
		success: function(data) {
	        var msg = eval(data);
         	$.each(msg.res, function(i, item) {	         	
	         	jQuery('input.'+i).val(item);
        	});
        	jQuery('button.mytooltip').attr('data-show', 1);       
	        jQuery('button.mytooltip > span.tooltiptext').html('Loading...');
        	jQuery.fancybox.close();
		},
		beforeSend: function(){
			_input.attr('disabled', 'disabled').html('Loading...');
        },
        complete: function(){
        	_input.removeAttr('disabled').html('Save');
        }
	});
	return false;
});

</script>