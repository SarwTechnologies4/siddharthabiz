<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<?php
$moduleTablename = "tbl_dividend"; // Database table name
$moduleId = 407;                // module id >>>>> tbl_modules
$moduleFoldername = "dividend";        // Image folder name

if (isset($_GET['page']) && $_GET['page'] == "dividend" && isset($_GET['mode']) && $_GET['mode'] == "list"):
    ?>
<h3>
    List dividend
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
        onClick="AddNewDividend();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-plus-square"></i>
        </span>
        <span class="button-content"> Add New </span>
    </a>
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
        style="margin-right: 10px;"
        onClick="viewReport();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-plus-square"></i>
        </span>
        <span class="button-content"> View Report </span>
    </a>
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
                    <th class="text-left">Total Dividend Paid</th>
                    <th class="text-left">Fiscal Year</th>
                    <th class="text-left">Year</th>
                    <th class="text-center" width="20%"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
            </thead>

            <tbody>
                <?php $records = Dividend::agg_data();   
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
                    <td>
                        <?php echo $record->period_fiscal;?>
                    </td>
                    <td>
                        <?php echo $record->date;?>
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

<?php elseif (isset($_GET['mode']) && ($_GET['mode'] == "addEdit" || $_GET['mode'] == "addNew")): ?>
    <?php include_once("form.php") ?>    
<?php  elseif (isset($_GET['mode']) && $_GET['mode'] == "viewDividend"): ?>
    <?php include_once("viewDividend.php");?>
<?php elseif (isset($_GET['page']) && $_GET['page'] == "dividend" && isset($_GET['mode']) && $_GET['mode'] == "viewReport"):    ?>
    <?php include_once("dividendReport.php");?>
<?php endif; ?>