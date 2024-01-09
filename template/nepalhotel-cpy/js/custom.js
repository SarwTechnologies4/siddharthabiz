


var base_url = jQuery('base').attr('url');
// Home page Hotel search 
if(jQuery('#hotelsearch-form')[0]) {

    jQuery( "#autocompleteid2" ).autocomplete({
        source: base_url+"hotelcomplete.php",
        minLength: 2,
        showHintOnFocus: true,
        select: function( event, ui ) {
              /*log( ui.item ?
            "Selected: " + ui.item.value + " aka " + ui.item.id :
            "Nothing selected, input was " + this.value );*/
            jQuery('input[name="hotelid"]').val(ui.item.id);
        }
      });

      /*jQuery('#checkin').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        minDate: '0',
        maxDate: '+2Y',
        onSelect: function(dateStr) {
            var d1 = jQuery(this).datepicker("getDate");
            d1.setDate(d1.getDate() + 1); // change to + 1 if necessary
            var d2 = jQuery(this).datepicker("getDate");
            d2.setDate(d2.getDate() + 180); // change to + 180 if necessary   
            jQuery("#checkout").datepicker("option", "minDate", d1);
            jQuery("#checkout").datepicker("option", "maxDate", d2);
            var start = jQuery("#checkin").datepicker("getDate");                
            var end   = jQuery("#checkout").datepicker("getDate");
            var days   = (end - start)/1000/60/60/24;
            if(end!=null)
                var dd = jQuery(this).datepicker("getDate");
                jQuery('#checkout').datepicker('setDate', d1);
        }
    });*/

    /*jQuery('#checkout').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        minDate: jQuery("#checkin").datepicker("getDate"),
        maxDate: '+2Y'
    });*/

    jQuery("#hotelsearch-form").validate({
        errorElement: 'span',
        errorClass: 'validate-has-error',
        rules: {
            searchkey: { required: true, },
            hotelid: { required: true }
        },
        messages:{              
            searchkey: { required: "Please enter a destination to start searching.", },
            hotelid: { required: '' }
        },      
        submitHandler:function(form){	        	
            var Frmval = jQuery("#hotelsearch-form").serialize();  
            jQuery("#btn-search").attr("disabled", "true").html('Loading...');
            jQuery.ajax({
                type: "POST",
                dataType:"JSON",
                url: base_url+"hotelcomplete.php",
                data:"action=getlink&"+Frmval,
                success:function(data){
                    var msg=eval(data); 
                    window.location.href = base_url+"search/"+data.url;
                }               
            });	            
            return false;
        }
    });

}