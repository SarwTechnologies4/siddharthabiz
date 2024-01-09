<script language="javascript">

    function getLocation() {
        return '<?php echo BASE_URL;?>includes/controllers/ajax.registereduser.php';
    }

    function getTableId() {
        return 'table_dnd';
    }

    /***************************************** Re ordering Users *******************************************/

    $(document).ready(function () {
        oTable = $('#example').dataTable({
            "bJQueryUI": true,
            "iDisplayLength": 25,
            "bSort": false,
            "sPaginationType": "full_numbers"
        });
        $('#column1_filter').keyup(function () {oTable.fnFilter(this.value, 1);});
        $('#column2_filter').keyup(function () {oTable.fnFilter(this.value, 2);});
        $('#column3_filter').keyup(function () {oTable.fnFilter(this.value, 3);});
        $('#column4_filter').keyup(function () {oTable.fnFilter(this.value, 4);});
        $('#column5_filter').keyup(function () {oTable.fnFilter(this.value, 5);});
        $('#column6_filter').keyup(function () {oTable.fnFilter(this.value, 6);});
        

        $('.lstatusToggler').on('click', function () {
            var Re = $(this).attr('moduleId');
            var status = $(this).attr('status');
            newStatus = (status == 1) ? 0 : 1;
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: getLocation(),
                data: "action=toggleApproved&id=" + Re,
                success: function (data) {
                    // var msg = eval(data);
                    // showMessage(msg.action, msg.message);
                    // setTimeout(function () {
                    //     window.location.href = window.location.href;
                    // }, 3000);
                }
            });
            (newStatus == 1)? message = "User has been verified and sent verified mail.": message = "User has been deactivated and sent mail.";


            // message = "User has been verified and sent verified mail.";
            showMessage("success", message);
            setTimeout(function () {
                        window.location.href = window.location.href;
                    }, 3000);
            return false;
            
        });
        // $('#example_filter').hide();
        $('#example_1').dataTable({
            "bJQueryUI": true,
            "iDisplayLength": 25,
            "sPaginationType": "full_numbers"
        });
        

//         new DataTable('#example', {
//         initComplete: function () {
//         this.api()
//             .columns()
//             .every(function () {
//                 let column = this;
//                 let title = column.footer().textContent;
 
               
//                 let input = document.createElement('input');
//                 input.placeholder = title;
//                 column.footer().replaceChildren(input);
//                 console.log(column.footer());
//                 // Event listener for user input
//                 input.addEventListener('keyup', () => {
//                     if (column.search() !== this.value) {
//                         column.search(input.value).draw();
//                     }
//                 });
//             });
//     }
// });
    });
    
//     new DataTable('#example', {
//     initComplete: function () {
//         this.api()
//             .columns()
//             .every(function () {
//                 let column = this;
//                 let title = column.footer().textContent;
 
//                 // Create input element
//                 let input = document.createElement('input');
//                 input.placeholder = title;
//                 column.footer().replaceChildren(input);
 
//                 // Event listener for user input
//                 input.addEventListener('keyup', () => {
//                     if (column.search() !== this.value) {
//                         column.search(input.value).draw();
//                     }
//                 });
//             });
//     }
// });
    

    /***************************************** USer Record delete *******************************************/
    function recordDelete(Re) {
        $('.MsgTitle').html('<?php echo sprintf($GLOBALS['basic']['deleteRecord_'], "Approved User")?>');
        $('.pText').html('Click on yes button to delete this user permanently.!!');
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

    /***************************************** Add new Users *******************************************/
    function AddNewUsers() {
        window.location.href = "<?php echo ADMIN_URL?>registereduser/addEdit";
    }

    /***************************************** View Users Lists *******************************************/
    function viewuserslist() {
        window.location.href = "<?php echo ADMIN_URL?>registereduser/list";
    }

    /***************************************** Edit User login Info *******************************************/
    function editRecord(Re) {
        window.location.href = "<?php echo ADMIN_URL?>registereduser/addEdit/" + Re;
    }
    function updateRecord(Re) {
        window.location.href = "<?php echo ADMIN_URL?>registereduser/update/" + Re;
    }
    function editRecordSub(Re,De) {
        window.location.href = "<?php echo ADMIN_URL?>registereduser/update/" + Re + "/" +De;
    }
    /***************************************** AddEdit login Info *******************************************/
    $(document).ready(function () {
        // form submisstion actions
        jQuery('#adminusersetting_frm').validationEngine({
            prettySelect: true,
            useSuffix: "_chosen",
            autoHidePrompt: true,
            scroll: false,
            onValidationComplete: function (form, status) {
                if (status == true) {
                    $('#btn-submit').attr('disabled', 'true');
                    var action = ($('#idValue').val() == 0) ? "action=addNewUser&" : "action=editNewUser&";
                    var data = $('#adminusersetting_frm').serialize();
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
                                    window.location.href = "<?php echo ADMIN_URL?>registereduser/list";
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

    $(document).ready(function () {
        // form submisstion actions
        jQuery('#adminusersetting_frm_reward').validationEngine({
            prettySelect: true,
            useSuffix: "_chosen",
            autoHidePrompt: true,
            scroll: false,
            onValidationComplete: function (form, status) {
                if (status == true) {
                    $('#btn-submit').attr('disabled', 'true');
                    var action = ($('#idValue').val() == 0) ? "action=addReward&" : "action=addReward&";
                    var data = $('#adminusersetting_frm_reward').serialize();
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
                                    window.location.href = "<?php echo ADMIN_URL?>registereduser/list";
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

    $(document).on('change', 'select#payment_type', function(e) {
	e.preventDefault();
	var selVal = $(this).val();
	if(selVal==2) { $('div.points').removeClass('hide'); $('div.prize').addClass('hide');}
	else if(selVal==3) { $('div.prize').removeClass('hide'); $('div.points').addClass('hide');}
	else{ $('div.points').removeClass('hide'); $('div.prize').addClass('hide'); }
})
</script>