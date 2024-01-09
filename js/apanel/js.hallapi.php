<script language="javascript">

    function getLocation() {
        return '<?php echo BASE_URL;?>includes/controllers/ajax.hallapi.php';
    }

    function getTableId() {
        return 'table_dnd';
    }
    
    $(document).ready(function () {
        oTable = $('#example').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        }).rowReordering({
            sURL: "<?php echo BASE_URL;?>includes/controllers/ajax.hallapi.php?action=sort",
            fnSuccess: function (message) {
                var msg = jQuery.parseJSON(message);
                showMessage(msg.action, msg.message);
            }
        });
    });


    $(document).ready(function () {
        $('.btn-submit').on('click', function () {
            var actVal = $(this).attr('btn-action');
            $('#idValue').attr('myaction', actVal);
        })
        // form submisstion actions
        jQuery('#hallapi_frm').validationEngine({
            autoHidePrompt: true,
            promptPosition: "bottomLeft",
            scroll: true,
            onValidationComplete: function (form, status) {
                if (status == true) {
                    $('.btn-submit').attr('disabled', 'true');
                    var action = ($('#idValue').val() == 0) ? "action=add&" : "action=edit&";
                    for (instance in CKEDITOR.instances)
                        CKEDITOR.instances[instance].updateElement();
                    var data = $('#hallapi_frm').serialize();
                    queryString = action + data;
                    $.ajax({
                        type: "POST",
                        dataType: "JSON",
                        url: getLocation(),
                        data: queryString,
                        success: function (data) {
                            var msg = eval(data);
                            if (msg.action == 'warning') {
                                showMessage(msg.action, msg.message);
                                setTimeout(function () {
                                    $('.my-msg').html('');
                                }, 3000);
                                $('.btn-submit').removeAttr('disabled');
                                $('.formButtons').show();
                                return false
                            }
                            if (msg.action == 'success') {
                                showMessage(msg.action, msg.message);
                                var actionId = $('#idValue').attr('myaction');
                                setTimeout(function () {
                                    window.location.href = "<?php echo ADMIN_URL?>hallapi/list";
                                }, 3000);
                            }
                            if (msg.action == 'notice') {
                                showMessage(msg.action, msg.message);
                                setTimeout(function () {
                                    window.location.href = window.location.href;
                                }, 3000);
                            }
                            if (msg.action == 'error') {
                                showMessage(msg.action, msg.message);
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
    function editRecord(Re) {
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: getLocation(),
            data: 'action=editExistsRecord&id=' + Re,
            success: function (data) {
                var msg = eval(data);
                $("#title").val(msg.title);
                $("#idValue").val(msg.editId);
            }
        });
    }

    // Deleting Record
    function recordDelete(Re) {
        $('.MsgTitle').html('<?php echo sprintf($GLOBALS['basic']['deleteRecord_'], "hall")?>');
        $('.pText').html('Click on yes button to delete this package permanently.!!');
        $('.divMessageBox').fadeIn();
        $('.MessageBoxContainer').fadeIn(1000);

        $(".botTempo").on("click", function () {
            var popAct = $(this).attr("id");
            if (popAct == 'yes') {
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: getLocation(),
                    data: 'action=delete&id=' + Re,
                    success: function (data) {
                        var msg = eval(data);
                        showMessage(msg.action, msg.message);
                        $('#' + Re).remove();
                        reStructureList(getTableId());
                    }
                });
            } else {
                Re = null;
            }
            $('.divMessageBox').fadeOut();
            $('.MessageBoxContainer').fadeOut(1000);
        });
    }


    /*************************************** Toggle Meta tags********************************************/	
    function toggleMetadata(){
	$( ".metadata" ).slideToggle("slow",function(){});
    }
    /***************************************** View hall Lists *******************************************/
    function viewPackagelist() {
        window.location.href = "<?php echo ADMIN_URL?>hallapi/list";
    }

    /***************************************** Add New hall *******************************************/
    function AddNewhall() {
        window.location.href = "<?php echo ADMIN_URL?>hallapi/form";
    }

    /***************************************** Edit records *****************************************/
    function editRecord(Re) {
        window.location.href = "<?php echo ADMIN_URL?>hallapi/form/" + Re;
    }


    /******************************** Remove temp upload image ********************************/
    function deleteTempimage(Re) {
        $('#previewhallsimage' + Re).fadeOut(1000, function () {
            $('#previewhallsimage' + Re).remove();
        });
    }

    function viewsubimagelist(Re) {
        window.location.href = "<?php echo ADMIN_URL?>hallapi/hallImageList/" + Re;
    }

    /******************************** Remove User saved Sub Package images ********************************/
    
    function deleteSavedimage(Re) {
        $('.MsgTitle').html('<?php echo sprintf($GLOBALS['basic']['deleteRecord_'], "image")?>');
        $('.pText').html('Click on yes button to delete this image permanently.!!');
        $('.divMessageBox').fadeIn();
        $('.MessageBoxContainer').fadeIn(1000);

        $(".botTempo").on("click", function () {
            var popAct = $(this).attr("id");
            if (popAct == 'yes') {
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: getLocation(),
                    data: 'action=deleteSubimage&id=' + Re,
                    success: function (data) {
                        var msg = eval(data);
                        if (msg.action == 'success') {
                            $('.removeSavedimg' + Re).fadeOut(1000, function () {
                                $('.removeSavedimg' + Re).remove();
                            });
                        }
                    }
                });
            } else {
                Re = '';
            }
            $('.divMessageBox').fadeOut();
            $('.MessageBoxContainer').fadeOut(1000);
        });
    }

    /******************************** Remove User saved Package images ********************************/
    function deleteSavedPackageimage(Re) {
        $('.MsgTitle').html('<?php echo sprintf($GLOBALS['basic']['deleteRecord_'], "image")?>');
        $('.pText').html('Click on yes button to delete this image permanently.!!');
        $('.divMessageBox').fadeIn();
        $('.MessageBoxContainer').fadeIn(1000);

        $(".botTempo").on("click", function () {
            var popAct = $(this).attr("id");
            if (popAct == 'yes') {
                $('#removeSavedimg' + Re).fadeOut(1000, function () {
                    $('#removeSavedimg' + Re).remove();
                    $('.uploader').fadeIn(500);
                });
            } else {
                Re = '';
            }
            $('.divMessageBox').fadeOut();
            $('.MessageBoxContainer').fadeOut(1000);
        });
    }

    /***************************************** Add New Row *******************************************/
    function addnewRow() {
        var rowNum = Math.floor((Math.random() * 999) + 1);
        var newRow = '<div class="form-row my-style" id="NewRow' + rowNum + '">';
        newRow += '<div class="form-label col-md-2"></div>';
        newRow += '<div class="form-input col-md-12">';
        newRow += '<div class="col-md-4">';
        newRow += '<input placeholder="Facility Name" type="text" name="facility[]" id="facility" class="validate[length[0,50]]">';
        newRow += '</div>';
        newRow += '<div>';
        newRow += '<a href="javascript:void(0);" class="btn medium bg-blue tooltip-button" data-placement="right" title="Add" onclick="addnewRow(this);">';
        newRow += '<i class="glyph-icon icon-plus-square"></i>';
        newRow += '</a>';
        newRow += '<a href="javascript:void(0);" class="btn medium bg-red tooltip-button" data-placement="right" title="Delete" onclick="deletenewRow(' + rowNum + ');">';
        newRow += '<i class="glyph-icon icon-minus-square"></i>';
        newRow += '</a>';
        newRow += '</div>';
        newRow += '</div>';
        newRow += '</div>';

        $('#option-field').append(newRow);
    }

    /********* On change max no of guest ***********/
    $(document).ready(function () {

        $(document).on('blur', "#max_people", function () {
            var selVal = $(this).val();
            if (selVal == 1) {
                $('.rmovprice1').removeClass('hide');
                $('.rmovprice2').addClass('hide');
                $('.rmovprice3').addClass('hide');
                $('.rmovprice4').removeClass('hide');
            }
            if (selVal == 2) {
                $('.rmovprice1').removeClass('hide');
                $('.rmovprice2').removeClass('hide');
                $('.rmovprice3').addClass('hide');
                $('.rmovprice4').removeClass('hide');
            }
            if (selVal == 3) {
                $('.rmovprice1').removeClass('hide');
                $('.rmovprice2').removeClass('hide');
                $('.rmovprice3').removeClass('hide');
                $('.rmovprice4').removeClass('hide');
            }
        });
        $('#max_people').trigger('blur');
        $(".character-details").keyup(function () {
            var a = 125, b = $(this).val().length;
            if (b >= a) $(".description-remaining").text(" you have reached the limit");
            else {
                var c = a - b;
                $(".description-remaining").text(c + " characters left")
            }
        });
    })

    //naresh coding start here
    $(function () {
        $(document).on('click', '.remove_feature_row', function () {
            $(this).parent().remove();
        });
    });

    function addFeaturesRows(feature_id) {
        var rowNum = Math.floor((Math.random() * 999) + 1);
        var newRow = '<div><input type="checkbox" class="custom-radio checkbox-hall" name="feature[' + feature_id + '][' + rowNum + '][id]" value="' + rowNum + '" checked="checked" >';
        newRow += '<input type="text" placeholder="Icon Class" class="col-md-2 validate[length[0,30]]" name="feature[' + feature_id + '][' + rowNum + '][icon_class]">';
        newRow += ' <input type="text" placeholder="Title" class="col-md-6 validate[length[0,100]]" name="feature[' + feature_id + '][' + rowNum + '][title]"><span class="cp remove_feature_row"><i class="glyph-icon icon-minus-square"></i></span><br></div>';

        $('#add_option_div' + feature_id).append(newRow);
    }

    function addFacilityRows() {
        var feature_id = '_' + Math.floor((Math.random() * 999) + 1);
        var featureNewRow = '<div class="form-row">';
        featureNewRow += '<div class="form-label col-md-2">';
        featureNewRow += '<label for="">New Feature</label>';
        featureNewRow += '</div>';
        featureNewRow += '<div class="form-checkbox-radio col-md-10 form-input">';
        featureNewRow += '<input type="text" placeholder="Feature Title" class="col-md-4 validate[length[0,250]]" name="fparent[' + feature_id + '][name]">';
        featureNewRow += '<div class="clear"></div>';

        var rowNum = Math.floor((Math.random() * 999) + 1);
        featureNewRow += '<div><input type="checkbox" class="custom-radio" name="feature[' + feature_id + '][' + rowNum + '][id]" value="' + rowNum + '" checked="checked" >';
        featureNewRow += '<input type="text" placeholder="Icon Class" class="col-md-2 validate[length[0,30]]" name="feature[' + feature_id + '][' + rowNum + '][icon_class]">';
        featureNewRow += '&nbsp;<input type="text" placeholder="Title" class="col-md-6 validate[length[0,100]]" name="feature[' + feature_id + '][' + rowNum + '][title]"><br><span class="cp remove_feature_row"><i class="glyph-icon icon-minus-square"></i></span><br></div>';

        featureNewRow += '<div id="add_option_div' + feature_id + '"></div>';
        featureNewRow += '<a href="javascript:void(0);" class="btn medium bg-blue tooltip-button" title="Add" onclick="addFeaturesRows(\'' + feature_id + '\');"><i class="glyph-icon icon-plus-square"></i></a>';
        featureNewRow += '</div></div>';
        $('#add_facility_div').append(featureNewRow);
    }


</script>