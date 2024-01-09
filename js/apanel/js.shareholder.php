<script language="javascript">

    function getLocation() {
        return '<?php echo BASE_URL;?>includes/controllers/ajax.shareholder.php';
    }

    function getTableId() {
        return 'table_dnd';
    }

    $(document).ready(function () {
        oTable = $('#example').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        }).rowReordering({
            sURL: "<?php echo BASE_URL;?>includes/controllers/ajax.shareholder.php?action=sort",
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
        });

        // form submisstion actions
        jQuery('#shareholder_frm').validationEngine({
            prettySelect: true,
            autoHidePrompt: true,
            useSuffix: "_chosen",
            scroll: true,
            onValidationComplete: function (form, status) {
                console.log(form);
                if (status == true) {
                    $('.btn-submit').attr('disabled', 'true');
                    var action = ($('#idValue').val() == 0) ? "add" : "edit";
                    var data = $('#shareholder_frm').serialize();
                    queryString = "action=" + action + "&" + data;
                    $.ajax({
                        type: "POST",
                        dataType: "JSON",
                        url: getLocation(),
                        data: queryString,
                        success: function (data) {
                            let msg = eval(data);
                            console.log(msg);
                            if (msg.action == 'warning') {
                                showMessage(msg.action, msg.message);
                                $('.btn-submit').removeAttr('disabled');
                                $('.formButtons').show();
                                return false
                            } else if (msg.action == 'success') {
                                showMessage(msg.action, msg.message);
                                let actionId = parseInt($('#idValue').attr('myaction'));
                                console.log(actionId);
                                switch (actionId) {
                                    case 1:
                                        console.log('add more');
                                        setTimeout(function () {
                                            window.location.href = "<?php echo ADMIN_URL?>shareholder/addEdit";
                                        }, 3000);
                                        break;
                                    case 2:
                                        console.log('add quit');
                                        setTimeout(function () {
                                            window.location.href = "<?php echo ADMIN_URL?>shareholder/list";
                                        }, 3000);
                                        break;
                                    default:
                                        console.log('sav3e');
                                        if (action === 'edit') {
                                            setTimeout(function () {
                                                window.location.href = "";
                                            }, 3000);
                                        } else {
                                            setTimeout(function () {
                                                window.location.href = "<?php echo ADMIN_URL?>shareholder/addEdit/" + msg.data.id;
                                            }, 3000);
                                        }
                                        break;
                                }
                            } else if (msg.action == 'notice') {
                                showMessage(msg.action, msg.message);
                                setTimeout(function () {
                                    window.location.href = window.location.href;
                                }, 3000);
                            } else if (msg.action == 'error') {
                                showMessage(msg.action, msg.message);
                                $('#buttonsP img').remove();
                                $('.formButtons').show();
                                return false;
                            }
                            $('.btn-submit').attr('disabled', 'false');
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
        $('.MsgTitle').html('<?php echo sprintf($GLOBALS['basic']['deleteRecord_'], "Shareholder")?>');
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

    /*************************************** Toggle Meta tags********************************************/
    function toggleMetadata() {
        $(".metadata").slideToggle("slow", function () {
        });
    }

    function toggleTypeForm() {
        $(".type_form").slideToggle("slow", function () {
        });
    }

    function saveType() {
        let title = $("#type_title").val();
        if (title === '') return;
        let formData = {
            title: title,
        };
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: getLocation(),
            data: 'action=addType&data=' + JSON.stringify(formData),
            success: function (data) {
                let type = JSON.parse(data.data);
                var message = '<div class="myinfobox infobox clearfix infobox-close-wrapper success-bg">' +
                    '<div class="info-icon"><i class="glyph-icon icon-check-square-o"></i></div>' +
                    '<p>Shareholder type added successfully. You can choose added type from above select box.</p>' +
                    '</div>';
                $(message).prependTo('.type-alert').fadeIn(500, function () {
                    $('.myinfobox').fadeOut(6000)
                });
                setTimeout(function () {
                    $('.type_form').hide();
                    $('.type-alert').html('');
                }, 5000);
                $('#type_id').append($('<option>', {
                    value: type.id,
                    text: type.title
                }))
            }
        });

    }

    /***************************************** View shareholder Lists *******************************************/
    function viewShareholderlist() {
        window.location.href = "<?php echo ADMIN_URL?>shareholder/list";
    }

    /***************************************** Add New shareholder *******************************************/
    function AddNewShareholder() {
        window.location.href = "<?php echo ADMIN_URL?>shareholder/addEdit";
    }

    /***************************************** Edit records *****************************************/
    function editRecord(Re) {
        window.location.href = "<?php echo ADMIN_URL?>shareholder/addEdit/" + Re;
    }

    /******************************** Remove temp upload image ********************************/
    function deleteTempimage(Re) {
        $('#previewUserimage' + Re).fadeOut(1000, function () {
            $('#previewUserimage' + Re).remove();
            $('#preview_Image').html('<input type="hidden" name="imageArrayname" value="" class="">');
        });
    }

    /******************************** Remove saved shareholder image ********************************/
    function deleteSavedShareholderimage(Re) {
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
                    $('#preview_Image' + Re).html('<input type="hidden" name="imageArrayname' + Re + '" value="" class=""/>');
                });
            } else {
                Re = '';
            }
            $('.divMessageBox').fadeOut();
            $('.MessageBoxContainer').fadeOut(1000);
        });
    }
</script>