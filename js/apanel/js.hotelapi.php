<script language="javascript">

    function getLocation() {
        return '<?php echo BASE_URL;?>includes/controllers/ajax.hotelapi.php';
    }
    function getOfferLocation() {
        return '<?= BASE_URL ?>includes/controllers/ajax.roomoffers.php';
    }
    function getTableId() {
        return 'table_dnd';
    }
    function gethallLocation() {
        return '<?= BASE_URL ?>includes/controllers/ajax.hallapi.php';
    }

    $(document).ready(function () {
        /*************************************** USer Package Featured Toggler ******************************************/
        $('.featureToggler').on('click', function () {
            var Re = $(this).attr('moduleId');
            var status = $(this).attr('status');
            newStatus = (status == 1) ? 0 : 1;
            $.ajax({
                type: "POST",
                url: getLocation(),
                data: "action=toggleFeatured&id=" + Re,
                success: function (msg) {
                }
            });
            $(this).attr({'status': newStatus});
            if (status == 1) {
                $('#futimgHolder_' + Re).removeClass("bg-green");
                $('#futimgHolder_' + Re).addClass("bg-red");
                $(this).attr("data-original-title", "Click to Publish");
            } else {
                $('#futimgHolder_' + Re).removeClass("bg-red");
                $('#futimgHolder_' + Re).addClass("bg-green");
                $(this).attr("data-original-title", "Click to Un-publish");
            }
        });

        /*************************************** USer Package Home Toggler ******************************************/
        $('.homeToggler').on('click', function () {
            var Re = $(this).attr('moduleId');
            var status = $(this).attr('status');
            newStatus = (status == 1) ? 0 : 1;
            $.ajax({
                type: "POST",
                url: getLocation(),
                data: "action=togglehome&id=" + Re,
                success: function (msg) {
                }
            });
            $(this).attr({'status': newStatus});
            if (status == 1) {
                $('#hmimgHolder_' + Re).removeClass("bg-green");
                $('#hmimgHolder_' + Re).addClass("bg-red");
                $(this).attr("data-original-title", "Click to Publish");
            } else {
                $('#hmimgHolder_' + Re).removeClass("bg-red");
                $('#hmimgHolder_' + Re).addClass("bg-green");
                $(this).attr("data-original-title", "Click to Un-publish");
            }
        });


        //Filter Destinatino wise activity option
        $('.destinationId').on('change', function () {
            var destId = $(this).val();
            console.log(destId);
            $('.nearby_att').html('<label>Loading...</label>');
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: getLocation(),
                data: "action=filterNearbyAttractions&destid=" + destId,
                success: function (data) {
                    var msg = eval(data);
                    if (msg.action == 'success') {
                        $('.nearby_att').html(msg.result);
                    }
                }
            });
            return false;
        });
    });

    $(document).ready(function () {
        oTable = $('#example').dataTable({
            "bJQueryUI": true,
            "iDisplayLength": 25,
            "sPaginationType": "full_numbers"
        }).rowReordering({
            sURL: "<?= BASE_URL ?>includes/controllers/ajax.hotelapi.php?action=sort",
            fnSuccess: function (message) {
                var msg = jQuery.parseJSON(message);
                showMessage(msg.action, msg.message);
            }
        });
    });

    $(document).ready(function () {
        // form submisstion actions
        jQuery('#hotelapi_frm').validationEngine({
            prettySelect: true,
            autoHidePrompt: true,
            useSuffix: "_chosen",
            scroll: true,
            onValidationComplete: function (form, status) {
                if (status == true) {
                    $('#btn-submit').attr('disabled', 'true');
                    var action = ($('#idValue').val() == 0) ? "action=add&" : "action=edit&";
                    /* By Me */
                    for (instance in CKEDITOR.instances)
                        CKEDITOR.instances[instance].updateElement();
                    /* End By Me */
                    var data = $('#hotelapi_frm').serialize();
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
                                $('#btn-submit').removeAttr('disabled');
                                $('.formButtons').show();
                                return false
                            }
                            if (msg.action == 'success') {
                                showMessage(msg.action, msg.message);
                                setTimeout(function () {
                                    window.location.href = "<?php echo ADMIN_URL?>hotelapi/list";
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

        $("select[name='inquiry_type']").change(function () {
            var v = $(this).val();
            if (v == 1) {
                $('input#inquiry_email').removeClass("validate[required,custom[email]]");
            }
            if (v == 2) {
                $('input#inquiry_email').addClass("validate[required,custom[email]]");
            }
        });
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
                    data: 'action=delete&id=' + Re,
                    success: function (data) {
                        var msg = eval(data);
                        showMessage(msg.action, msg.message);
                        $('#' + Re).remove();
                        Re = '';
                        reStructureList(getTableId());
                    }
                });
            }
            $('.divMessageBox').fadeOut();
            $('.MessageBoxContainer').fadeOut(1000);
        });
    }

    /***************************************** View offers Lists *******************************************/
    function viewHotellist() {
        window.location.href = "<?php echo ADMIN_URL?>hotelapi/list";
    }

    /***************************************** Add New offers *******************************************/
    function AddNewHotelTo(Re) {
        window.location.href = "<?php echo ADMIN_URL?>hotelapi/addEdit/" + Re;
    }

    function AddNewHotel() {
        window.location.href = "<?php echo ADMIN_URL?>hotelapi/addEdit";
    }

    /***************************************** Edit records *****************************************/
    function editRecord(Re) {
        window.location.href = "<?php echo ADMIN_URL?>hotelapi/addEdit/" + Re;
    }
    function addNewhall(Re){
        window.location.href = "<?php echo ADMIN_URL?>hotelapi/hallAddEdit/" + Re;
    }

    function viewhallList(Re){
        window.location.href = "<?php echo ADMIN_URL?>hotelapi/halllist/" + Re;
    }

    function edithall(Pid, Re) {
        window.location.href = "<?php echo ADMIN_URL?>hotelapi/hallAddEdit/" + Pid + "/" + Re;
    }
    
    function deletehall(Re) {
        $('.MsgTitle').html('<?php echo sprintf($GLOBALS['basic']['deleteRecord_'], "Record")?>');
        $('.pText').html('Click on yes button to delete this record permanently.!!');
        $('.divMessageBox').fadeIn();
        $('.MessageBoxContainer').fadeIn(1000);

        $(".botTempo").on("click", function () {
            var popAct = $(this).attr("id");
            if (popAct == 'yes') {
                $.ajax({
                    type:       "POST",
                    dataType:   "JSON",
                    url:        gethallLocation(),
                    data:       'action=delete&id=' + Re,
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

    function statusTogglehall(Re, R){
        var id      = Re;
        var status  = R;
        newStatus   = (status == 1) ? 0 : 1;
        $.ajax({
            type:   "POST",
            url:    gethallLocation(),
            data:   "action=toggleStatus&id=" + id,
            success: function (msg) {
            }
        });
        $(this).attr({'status': newStatus});
        if (status == 1) {
            $('#imgHolder_' + id).removeClass("bg-green");
            $('#imgHolder_' + id).addClass("bg-red");
            $(this).attr("data-original-title", "Click to Publish");
        } else {
            $('#imgHolder_' + id).removeClass("bg-red");
            $('#imgHolder_' + id).addClass("bg-green");
            $(this).attr("data-original-title", "Click to Un-publish");
        }
    }

    function deleteSelectedhalls(idArray){
        $.ajax({
            type:       "POST",
            dataType:   "JSON",
            url:        gethallLocation(),
            data:       "action=bulkDelete&idArray="+idArray,
            success: function(data){
                var msg = eval(data);
                if(msg.action=='success'){
                    showMessage(msg.action,msg.message);
                    var myMessage = idArray.split("|");
                    var counter   = myMessage.length;
                    for (i = 1; i < counter; i++) {
                        $('#'+myMessage[i]).remove();
                        reStructureList(getTableId());
                    }
                }
                if (msg.action == 'error') { showMessage(msg.action, msg.message); }
            }
        });
    }
    /**
     *                  Offers Section
     */
    function addNewOffer(Re) {
        window.location.href = "<?php echo ADMIN_URL?>hotelapi/offerAddEdit/" + Re;
    }

    function viewOfferList(Re) {
        window.location.href = "<?php echo ADMIN_URL?>hotelapi/offerList/" + Re;
    }

    function editOffer(Pid, Re) {
        window.location.href = "<?php echo ADMIN_URL?>hotelapi/offerAddEdit/" + Pid + "/" + Re;
    }
    function deleteOffer(Re) {
        $('.MsgTitle').html('<?php echo sprintf($GLOBALS['basic']['deleteRecord_'], "Record")?>');
        $('.pText').html('Click on yes button to delete this record permanently.!!');
        $('.divMessageBox').fadeIn();
        $('.MessageBoxContainer').fadeIn(1000);

        $(".botTempo").on("click", function () {
            var popAct = $(this).attr("id");
            if (popAct == 'yes') {
                $.ajax({
                    type:       "POST",
                    dataType:   "JSON",
                    url:        getOfferLocation(),
                    data:       'action=delete&id=' + Re,
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

    function statusToggleOffer(Re, R){
        var id      = Re;
        var status  = R;
        newStatus   = (status == 1) ? 0 : 1;
        $.ajax({
            type:   "POST",
            url:    getOfferLocation(),
            data:   "action=toggleStatus&id=" + id,
            success: function (msg) {
            }
        });
        $(this).attr({'status': newStatus});
        if (status == 1) {
            $('#imgHolder_' + id).removeClass("bg-green");
            $('#imgHolder_' + id).addClass("bg-red");
            $(this).attr("data-original-title", "Click to Publish");
        } else {
            $('#imgHolder_' + id).removeClass("bg-red");
            $('#imgHolder_' + id).addClass("bg-green");
            $(this).attr("data-original-title", "Click to Un-publish");
        }
    }

    function deleteSelectedOffers(idArray){
        $.ajax({
            type:       "POST",
            dataType:   "JSON",
            url:        getOfferLocation(),
            data:       "action=bulkDelete&idArray="+idArray,
            success: function(data){
                var msg = eval(data);
                if(msg.action=='success'){
                    showMessage(msg.action,msg.message);
                    var myMessage = idArray.split("|");
                    var counter   = myMessage.length;
                    for (i = 1; i < counter; i++) {
                        $('#'+myMessage[i]).remove();
                        reStructureList(getTableId());
                    }
                }
                if (msg.action == 'error') { showMessage(msg.action, msg.message); }
            }
        });
    }

    $(document).ready(function () {
        oTable = $('#offerListTable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        }).rowReordering({
            sURL: "<?= BASE_URL ?>includes/controllers/ajax.roomoffers.php?action=sort",
            fnSuccess: function (message) {
                var msg = jQuery.parseJSON(message);
                showMessage(msg.action, msg.message);
            }
        });

        $('#date_from , #date_to').datepicker({ changeMonth: true, changeYear: true, showButtonPanel: true, dateFormat: 'yy-mm-dd' })

        jQuery('#offers_frm').validationEngine({
            prettySelect:   true,
            autoHidePrompt: true,
            useSuffix:      "_chosen",
            scroll:         true,
            onValidationComplete: function (form, status) {
                if (status == true) {
                    $('#btn-submit').attr('disabled', 'true');
                    var action = ($('#idValue').val() == 0) ? "action=add&" : "action=edit&";
                    /* By Me */
                    for (instance in CKEDITOR.instances)
                        CKEDITOR.instances[instance].updateElement();
                    /* End By Me */
                    var data    = $('#offers_frm').serialize();
                    var Re      = $('#hotel_id').val();
                    queryString = action + data;
                    $.ajax({
                        type:       "POST",
                        dataType:   "JSON",
                        url:        getOfferLocation(),
                        data:       queryString,
                        success: function (data) {
                            var msg = eval(data);
                            if (msg.action == 'warning') {
                                showMessage(msg.action, msg.message);
                                $('#btn-submit').removeAttr('disabled');
                                $('.formButtons').show();
                                return false
                            }
                            if (msg.action == 'success') {
                                showMessage(msg.action, msg.message);
                                setTimeout(function () { window.location.href = "<?php echo ADMIN_URL?>hotelapi/offerList/" + Re; }, 3000);
                            }
                            if (msg.action == 'notice') {
                                showMessage(msg.action, msg.message);
                                setTimeout(function () { window.location.href = window.location.href; }, 3000);
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

        $('#applySelected_btn_offer').on("click", function () {
            var action = $('#groupTaskField').val();
            if (action == '0') { showMessage('warning', 'Please select an action!!.'); }
            var idArray = '0';
            $('.bulkCheckbox').each(function () {
                if ($(this).is(":checked")) {
                    idArray += "|" + $(this).attr('bulkId');
                }
            });
            checkIfAnyCheckBoxChecked();
            if (idArray != '0') {
                switch (action) {
                    case "toggleStatus":
                        $.ajax({
                            type:   "POST",
                            url:    getOfferLocation(),
                            data:   "action=bulkToggleStatus&idArray=" + idArray,
                            success: function (msg) {
                                var myMessage   = idArray.split("|");
                                var counter     = myMessage.length;
                                for (i = 1; i < counter; i++) {
                                    var status = $('#imgHolder_' + myMessage[i]).attr('status');
                                    newStatus = (status == 1) ? 0 : 1;
                                    $('#imgHolder_' + myMessage[i]).attr({'status': newStatus});
                                    if (status == 1) {
                                        $('#imgHolder_' + myMessage[i]).removeClass("bg-green");
                                        $('#imgHolder_' + myMessage[i]).addClass("bg-red");
                                        $('#imgHolder_' + myMessage[i]).attr("data-original-title", "Click to Publish");
                                    } else {
                                        $('#imgHolder_' + myMessage[i]).removeClass("bg-red");
                                        $('#imgHolder_' + myMessage[i]).addClass("bg-green");
                                        $('#imgHolder_' + myMessage[i]).attr("data-original-title", "Click to Un-publish");
                                    }
                                }
                                showMessage('success', 'Status has been toggled.');
                            }
                        });
                        break;

                    case "delete":
                        $('.MsgTitle').html('Do you want to delete the selected rows?');
                        $('.pText').html('Click on yes button to delete this rows permanently.!!');
                        $('.divMessageBox').fadeIn();
                        $('.MessageBoxContainer').fadeIn(1000);

                        $(".botTempo").on("click", function () {
                            var popAct = $(this).attr("id");
                            if (popAct == 'yes') {
                                deleteSelectedOffers(idArray);
                            }
                            $('.divMessageBox').fadeOut();
                            $('.MessageBoxContainer').fadeOut(1000);
                        });
                        break;
                } // end switch section
                reStructureList(getTableId());
            } // end if section
        });
    });

    /******************************** Remove temp upload image ********************************/
    function deleteTempimage(Re) {
        $('#previewUserimage' + Re).fadeOut(1000, function () {
            $('#previewUserimage' + Re).remove();
            $('#preview_Image').html('<input type="hidden" name="imageArrayname" value="" class="">');
        });
    }

    /******************************** Remove saved image ********************************/
    function deleteSavedPackageImage(Re) {
        $('.MsgTitle').html('Do you want to delete the record ?');
        $('.pText').html('Clicking yes will be delete this record permanently. !!!');
        $('.divMessageBox').fadeIn();
        $('.MessageBoxContainer').fadeIn(1000);

        $(".botTempo").on("click", function () {
            var popAct = $(this).attr("id");
            if (popAct == 'yes') {
                $('#removeSavedPackageImg' + Re).fadeOut(1000, function () {
                    $('#removeSavedPackageImg' + Re).remove();
                    $('.uploader' + Re).fadeIn(500);
                });
            } else {
                Re = '';
            }
            $('.divMessageBox').fadeOut();
            $('.MessageBoxContainer').fadeOut(1000);
        });
    }
    
    function deleteSavedimage(Re) {
        $('.MsgTitle').html('Do you want to delete the record ?');
        $('.pText').html('Clicking yes will be delete this record permanently. !!!');
        $('.divMessageBox').fadeIn();
        $('.MessageBoxContainer').fadeIn(1000);

        $(".botTempo").on("click", function () {
            var popAct = $(this).attr("id");
            if (popAct == 'yes') {
                $('#removeSavedimg' + Re).fadeOut(1000, function () {
                    $('#removeSavedimg' + Re).remove();
                    $('.uploader' + Re).fadeIn(500);
                });
            } else {
                Re = '';
            }
            $('.divMessageBox').fadeOut();
            $('.MessageBoxContainer').fadeOut(1000);
        });
    }

    $(document).on('change', 'select#payment_type', function (e) {
        e.preventDefault();
        var selVal = $(this).val();
        if (selVal == 3) {
            $('div.hblinfo').removeClass('hide');
            $('div.nabilinfo').addClass('hide');
        }
        else if (selVal == 4) {
            $('div.nabilinfo').removeClass('hide');
            $('div.hblinfo').addClass('hide');
        }
        else {
            $('div.hblinfo').addClass('hide');
            $('div.nabilinfo').addClass('hide');
        }
    })
    $(document).ready(function(){
        oTable = $('#hallListTable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        }).rowReordering({
            sURL: "<?php echo BASE_URL;?>includes/controllers/ajax.hallapi.php?action=sort",
            fnSuccess: function (message) {
                var msg = jQuery.parseJSON(message);
                showMessage(msg.action, msg.message);
            }
        });

        $('.btn-submit').on('click', function () {
            var actVal  = $(this).attr('btn-action');
            $('#idValue').attr('myaction', actVal);
        })

        jQuery('#hallapi_frm').validationEngine({
            autoHidePrompt: true,
            promptPosition: "bottomLeft",
            scroll:         true,
            onValidationComplete: function (form, status) {
                if (status == true) {
                    $('.btn-submit').attr('disabled', 'true');
                    var action      = ($('#idValue').val() == 0) ? "action=add&" : "action=edit&";
                    for (instance in CKEDITOR.instances)
                        CKEDITOR.instances[instance].updateElement();
                    var data        = $('#hallapi_frm').serialize();
                    var Re          = $('#hotel_id').val();
                    queryString     = action + data;
                    $.ajax({
                        type:       "POST",
                        dataType:   "JSON",
                        url:        gethallLocation(),
                        data:       queryString,
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
                                if(actionId==2)
                                    setTimeout( function(){window.location.href="<?php echo ADMIN_URL?>hotelapi/halllist/"+Re;},3000);
                                if(actionId==1)
                                    setTimeout( function(){window.location.href="<?php echo ADMIN_URL?>hotelapi/hallAddEdit/"+Re;},3000);
                                if(actionId==0)
                                    setTimeout( function(){window.location.href="";},3000);
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
    })

    $(document).ready(function () {
        $(document).on('change', '#zone-list', function () {
            var selVal = $('#zone-list option:selected').attr('parentOf');
            var disVal = $('#zone-list option:selected').attr('seldest');
            $('#district-list').html('<option>Loading...</option>');
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: getLocation(),
                data: "action=getdistrict&parentOf=" + selVal + "&disId=" + disVal,
                success: function (data) {
                    var msg = eval(data);
                    $('#district-list').html(msg.result);
                }
            });
        })

        $('#zone-list').trigger('change');


    })

    $(function () {
        $(document).on('click', '.remove_feature_row', function () {
            $(this).parent().remove();
        });
    });

    function addFaqRows(u_id) {
        var id = u_id;
        var newRow = '<div><input type="text" placeholder="Question" class="col-md-3 validate[]" name="faq[' + id + '][question]">';
        newRow += ' <input type="text" placeholder="Answer" class="col-md-8 validate[]" name="faq[' + id + '][answer]">' +
            '<span class="cp remove_feature_row"><i class="glyph-icon icon-minus-square"></i></span><br></div>';
        var rowNum = ++id;
        $('#add_faq_div').append(newRow);
        var newOnClick = 'addFaqRows(' + rowNum + ')';
        document.getElementById("faq_add").setAttribute("onClick", newOnClick);
    }

    function addNearbyRows(u_id) {
        var id = u_id;
        var newRow = '<div><input type="text" placeholder="Title" class="col-md-3 validate[]" name="nearby_attractions[' + id + '][title]">';
        newRow += ' <input type="text" placeholder="Location" class="col-md-8 validate[]" name="nearby_attractions[' + id + '][location]">' +
            '<span class="cp remove_feature_row"><i class="glyph-icon icon-minus-square"></i></span><br></div>';
        var rowNum = ++id;
        $('#add_nearby_div').append(newRow);
        var newOnClick = 'addNearbyRows(' + rowNum + ')';
        document.getElementById("nearby_add").setAttribute("onClick", newOnClick);
    }
</script>