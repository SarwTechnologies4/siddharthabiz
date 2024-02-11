<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<?php
$moduleTablename = "tbl_payment"; // Database table name
$moduleId = 405;                // module id >>>>> tbl_modules
$moduleFoldername = "payment";        // Image folder name

if (isset($_GET['page']) && $_GET['page'] == "payment" && isset($_GET['mode']) && $_GET['mode'] == "list"):
    ?>
<h3>
    List payment
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="AddNewPayment();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-plus-square"></i>
        </span>
        <span class="button-content"> Add New </span>
    </a>
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" style="margin-right: 10px;" href="#"
        id="export_payment">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-download"></i>
        </span>
        <span class="button-content"> Download </span>
    </a>
    <form method="POST"></form>
</h3>
<div class="my-msg"></div>
<div class="example-box">
    <div class="example-code">
        <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
            <thead>
                <tr>
                    <th style="display:none;"></th>
                    <th class="text-center"><input class="check-all" type="checkbox" /></th>
                    <th class="text-left">Company Name</th>
                    <th class="text-left">Total Payment Received</th>
                    <th class="text-center" width="20%"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
            </thead>

            <tbody>
                <?php $records = Payment::agg_data();   
                foreach ($records as $key => $record): ?>
                <tr id="<?php echo $record->id; ?>">
                    <td style="display:none;"><?php echo $key + 1; ?></td>
                    <td><input type="checkbox" class="bulkCheckbox" bulkId="<?php echo $record->id; ?>" /></td>
                    <td>
                        <div class="col-md-7">
                            <a href="javascript:void(0);" onClick="viewRecord(<?php echo $record->id; ?>);"
                                class="loadingbar-demo"
                                title="<?php echo $record->long_name; ?>"><?php echo $record->long_name; ?></a>
                        </div>
                    </td>
                    <td>
                        <?php echo $record->payment_amount;?>
                    </td>
                    <?php if($loginUser->type == 'admin') { ?>
                    <td class="text-center">
                        <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button"
                            data-placement="top" title="View" onclick="viewRecord(<?php echo $record->id; ?>);">
                            <i class="glyph-icon icon-eye"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top"
                            title="Remove" onclick="recordDeleteByCompany(<?php echo $record->id; ?>);">
                            <i class="glyph-icon icon-remove"></i>
                        </a>
                        <input name="sortId" type="hidden" value="<?php echo $record->id; ?>">
                    </td>
                    <?php } else { ?> <td>-</td> <?php } ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?php elseif (isset($_GET['mode']) && ($_GET['mode'] == "addEdit" || $_GET['mode'] == "addNew")):
    $shareHolders = Shareholder::find_all();
    $companies = Hotelapi::find_all_active();

    if ($_GET['mode'] == "addEdit" && isset($_GET['id']) && !empty($_GET['id'])):
        $paymentId = addslashes($_REQUEST['id']);
        $paymentInfo = Payment::find_by_id($paymentId);

        $company = array_reduce($companies, function ($carry, $item) use ($paymentInfo) {
            return $item->id == $paymentInfo->company_id ? $item : $carry;
        }, null);

        $shareHolder = array_reduce($shareHolders, function ($carry, $item) use ($paymentInfo) {
            return $item->id == $paymentInfo->shareholder_id ? $item : $carry;
        }, null);
    elseif ($_GET['mode'] == "addNew" && isset($_GET['id']) && !empty($_GET['id'])):
        $shareHolder = array_reduce($shareHolders, function ($carry, $item) {
            return $item->id == $_GET['id'] ? $item : $carry;
        }, null);
    endif;
    ?>
<?php include_once('form.php')?>
<?php  elseif (isset($_GET['mode']) && $_GET['mode'] == "viewPayment"): ?>
<?php $company = Hotelapi::find_by_id($_GET["id"]);?>
<h3>
    Payment list of <?php echo $company->long_name;?>
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
        onClick="viewPaymentlist();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-arrow-circle-left"></i>
        </span>
        <span class="button-content"> Back </span>
    </a>
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" style="margin-right: 10px;" href="#"
        id="export_company_payment">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-download"></i>
        </span>
        <span class="button-content"> Download </span>
    </a>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $company->id; ?>">
    </form>
</h3>
<div class="my-msg"></div>
<div class="example-box">
    <div class="example-code">
        <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
            <thead>
                <tr>
                    <th style="display:none;"></th>
                    <th class="text-center"><input class="check-all" type="checkbox" /></th>
                    <th class="text-left">Shareholder Name</th>
                    <th class="text-left">Shareholder Id</th>
                    <th class="text-left">Total amount received</th>
                    <th class="text-left">Mode of payment</th>
                    <th class="text-left">Bank name</th>
                    <th class="text-center" width="20%"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
            </thead>

            <tbody>
                <?php $records = Payment::getPaymentByCompany($company->id);
                foreach ($records as $key => $record): ?>
                <tr id="<?php echo $record->id; ?>">
                    <td style="display:none;"><?php echo $key + 1; ?></td>
                    <td><input type="checkbox" class="bulkCheckbox" bulkId="<?php echo $record->id; ?>" /></td>
                    <td>
                        <div class="col-md-7">
                            <a href="javascript:void(0);" onClick="editRecord(<?php echo $record->id; ?>);"
                                class="loadingbar-demo"
                                title="<?php echo $record->shareholders_name; ?>"><?php echo $record->shareholders_name; ?></a>
                        </div>
                    </td>
                    <td>
                        <?php echo $record->internal_id; ?>
                    </td>
                    <td>
                        <?php echo $record->payment_amount; ?>
                    </td>
                    <td>
                        <?php echo $record->payment_mode; ?>
                    </td>
                    <td>
                        <?php echo $record->bank_name; ?>
                    </td>
                    <?php if($loginUser->type == 'admin') { ?>
                    <td class="text-center">
                        <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button"
                            data-placement="top" title="Edit" onclick="editRecord(<?php echo $record->id; ?>);">
                            <i class="glyph-icon icon-edit"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top"
                            title="Remove" onclick="recordDelete(<?php echo $record->id; ?>);">
                            <i class="glyph-icon icon-remove"></i>
                        </a>
                        <input name="sortId" type="hidden" value="<?php echo $record->id; ?>">
                    </td>
                    <?php } else { ?> <td>-</td> <?php } ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
<?php endif; ?>