<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<?php
$moduleTablename = "tbl_investment"; // Database table name
$moduleId = 404;                // module id >>>>> tbl_modules
$moduleFoldername = "investment";        // Image folder name

if (isset($_GET['page']) && $_GET['page'] == "investment" && isset($_GET['mode']) && $_GET['mode'] == "list"):
    ?>
<h3>
    List investment
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
        onClick="AddNewInvestment();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-plus-square"></i>
        </span>
        <span class="button-content"> Add New </span>
    </a>
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" style="margin-right: 10px;"
        onClick="viewReport();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-plus-square"></i>
        </span>
        <span class="button-content"> View Report </span>
    </a>
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" style="margin-right: 10px;" href="#"
        id="export_investment">
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
                    <th class="text-left"># Share holders</th>
                    <th class="text-left">Total Amount Collected</th>
                    <th class="text-center" width="20%"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
            </thead>

            <tbody>
                <?php $records = Investment::agg_data();   
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
                        <?php echo $record->shareholders_number;?>
                    </td>
                    <td>
                        <?php echo $record->investment_amount;?>
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
<?php include_once('form.php')?>
<?php  elseif (isset($_GET['mode']) && $_GET['mode'] == "viewInvestment"): ?>
<?php $company = Hotelapi::find_by_id($_GET["id"]);?>
<h3>
    Investment list of <?php echo $company->long_name;?>
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
        onClick="viewInvestmentlist();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-arrow-circle-left"></i>
        </span>
        <span class="button-content"> Back </span>
    </a>
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" style="margin-right: 10px;" href="#"
        id="export_company_investment">
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
                    <th class="text-left"># Share</th>
                    <th class="text-left">Price per share</th>
                    <th class="text-left">Investment Amount</th>
                    <th class="text-center" width="20%"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
            </thead>

            <tbody>
                <?php $records = Investment::getInvestmentByCompany($company->id);
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
                        <?php echo $record->alloted_quantity; ?>
                    </td>
                    <td>
                        <?php echo $record->price_per_share; ?>
                    </td>
                    <td>
                        <?php echo $record->investment_amount; ?>
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
<?php elseif (isset($_GET['page']) && $_GET['page'] == "investment" && isset($_GET['mode']) && $_GET['mode'] == "viewReport"):    ?>
<?php include("investmentReport.php");?>
<?php endif; ?>