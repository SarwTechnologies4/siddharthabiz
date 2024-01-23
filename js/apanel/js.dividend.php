<script language="javascript">

    function getLocation() {
        return '<?php echo BASE_URL;?>includes/controllers/ajax.dividend.php';
    }

    function getTableId() {
        return 'table_dnd';
    }

    $(document).ready(function () {
        oTable = $('#example').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        })
    });

    $(document).ready(function () {
        $('.btn-submit').on('click', function () {
            var actVal = $(this).attr('btn-action');
            $('#idValue').attr('myaction', actVal);
        });

        // form submisstion actions
        jQuery('#dividend_frm').validationEngine({
            prettySelect: true,
            autoHidePrompt: true,
            useSuffix: "_chosen",
            scroll: true,
            onValidationComplete: function (form, status) {
                if (status == true) {
                    $('.btn-submit').attr('disabled', 'true');
                    var action = ($('#idValue').val() == 0) ? "add" : "edit";
                    var data = $('#dividend_frm').serialize();
                    queryString = "action=" + action + "&" + data;
                    $.ajax({
                        type: "POST",
                        dataType: "JSON",
                        url: getLocation(),
                        data: queryString,
                        success: function (data) {
                            let msg = eval(data);
                            if (msg.action == 'warning') {
                                showMessage(msg.action, msg.message);
                                $('.btn-submit').removeAttr('disabled');
                                $('.formButtons').show();
                                return false
                            } else if (msg.action == 'success') {
                                showMessage(msg.action, msg.message);
                                let actionId = parseInt($('#idValue').attr('myaction'));
                                switch (actionId) {
                                    case 1:
                                        setTimeout(function () {
                                            window.location.href = "<?php echo ADMIN_URL?>dividend/addEdit";
                                        }, 3000);
                                        break;
                                    case 2:
                                        setTimeout(function () {
                                            window.location.href = "<?php echo ADMIN_URL?>dividend/list";
                                        }, 3000);
                                        break;
                                    default:
                                        if (action === 'edit') {
                                            setTimeout(function () {
                                                window.location.href = "";
                                            }, 3000);
                                        } else {
                                            setTimeout(function () {
                                                window.location.href = "<?php echo ADMIN_URL?>dividend/list";
                                                // window.location.href = "<?php echo ADMIN_URL?>dividend/addEdit/" + msg.data.id;
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
    function recordDeleteByCompany(Re) {
        $('.MsgTitle').html('<?php echo sprintf($GLOBALS['basic']['deleteRecord_'], "Dividend")?>');
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
                    data: 'action=deleteByCompany&id=' + Re,
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

    // Deleting Record
    function recordDelete(Re) {
        $('.MsgTitle').html('<?php echo sprintf($GLOBALS['basic']['deleteRecord_'], "Dividend")?>');
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

    /***************************************** View dividend Lists *******************************************/
    function viewDividendlist() {
        window.location.href = "<?php echo ADMIN_URL?>dividend/list";
    }

    /***************************************** Add New dividend *******************************************/
    function AddNewDividend() {
        window.location.href = "<?php echo ADMIN_URL?>dividend/addEdit";
    }

    /***************************************** Edit records *****************************************/
    function editRecord(Re) {
        window.location.href = "<?php echo ADMIN_URL?>dividend/addEdit/" + Re;
    }

    /***************************************** Edit records *****************************************/
    function viewRecord(Re) {
        window.location.href = "<?php echo ADMIN_URL?>dividend/viewDividend/" + Re;
    }

    /***************************************** Edit records *****************************************/
    function downloadExcel(Re) {
        
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: getLocation(),
            data: 'action=downloadExcel&id=' + Re,
            success: function (data) {
            }
        });
        // window.location.href = "<?php echo ADMIN_URL?>dividend/downloadExcel/" + Re;
    }
</script>