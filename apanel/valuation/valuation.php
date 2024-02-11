<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<?php
$moduleTablename = "tbl_valuation"; // Database table name
$moduleId = 406;                // module id >>>>> tbl_modules
$moduleFoldername = "valuation";        // Image folder name

if (isset($_GET['page']) && $_GET['page'] == "valuation" && isset($_GET['mode']) && $_GET['mode'] == "list"):
    ?>
<h3>
    List valuation
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
        onClick="AddNewValuation();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-plus-square"></i>
        </span>
        <span class="button-content"> Add New </span>
    </a>
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" style="margin-right: 10px;" href="#"
        id="export_valuation">
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
                    <th class="text-left">Market Value Per Share</th>
                    <th class="text-left">Value of Company</th>
                    <th class="text-left">Valuation Date</th>
                    <th class="text-center" width="20%"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
            </thead>

            <tbody>
                <?php $records = Valuation::agg_data();   
                foreach ($records as $key => $record): ?>
                <tr id="<?php echo $record->id; ?>">
                    <td style="display:none;"><?php echo $key + 1; ?></td>
                    <td><input type="checkbox" class="bulkCheckbox" bulkId="<?php echo $record->id; ?>" /></td>
                    <td>
                        <div class="col-md-7">
                            <a href="javascript:void(0);" onClick="editRecord(<?php echo $record->id; ?>);"
                                class="loadingbar-demo"
                                title="<?php echo $record->long_name; ?>"><?php echo $record->long_name; ?></a>
                        </div>
                    </td>
                    <td>
                        <?php echo $record->share_value;?>
                    </td>
                    <td>
                        <?php echo $record->company_value;?>
                    </td>
                    <td>
                        <?php echo $record->date;?>
                    </td>
                    <?php if($loginUser->type == 'admin') { ?>
                    <td class="text-center">
                        <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button"
                            data-placement="top" title="Edit" onclick="editRecord(<?php echo $record->id; ?>);">
                            <i class="glyph-icon icon-edit"></i>
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

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "addEdit"):
    $companies = Hotelapi::find_all_active();

    if (isset($_GET['id']) && !empty($_GET['id'])):
        $valuationId = addslashes($_REQUEST['id']);
        $valuationInfo = Valuation::find_by_id($valuationId);

        $company = Hotelapi::find_by_id($valuationInfo->company_id);
    endif;
    ?>
<h3>
    <?php echo (isset($_GET['id'])) ? 'Edit valuation' : 'Add valuation'; ?>
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
        onClick="viewValuationlist();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-arrow-circle-left"></i>
        </span>
        <span class="button-content"> Back </span>
    </a>
</h3>

<div class="my-msg"></div>
<div class="example-box">
    <div class="example-code">
        <form action="" class="col-md-12 center-margin" id="valuation_frm">
            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="company_names">
                        Company Name :
                    </label>
                </div>
                <div class="form-input col-md-10">
                    <input placeholder="Company Name" class="col-md-6 validate[required]" type="text"
                        name="company_names" id="company_names"
                        value="<?php echo !empty($company->long_name) ? $company->long_name : ""; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="share_value">
                        Market Value Per Share :
                    </label>
                </div>
                <div class="form-input col-md-10">
                    <input placeholder="Market Value Per Share" class="col-md-6 validate[required]" type="number"
                        min="0" name="share_value" id="share_value"
                        value="<?php echo !empty($valuationInfo->share_value) ? $valuationInfo->share_value : ''; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="company_value">
                        Value of Company :
                    </label>
                </div>
                <div class="form-input col-md-10">
                    <input placeholder="Value of Company" class="col-md-6 validate[required]" type="number" min="0"
                        name="company_value" id="company_value"
                        value="<?php echo !empty($valuationInfo->company_value) ? $valuationInfo->company_value : ''; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="date">
                        Valuation Date :
                    </label>
                </div>
                <div class="form-input col-md-10">
                    <input placeholder="Valuation Date" class="col-md-6 validate[required]" type="date" name="date"
                        id="date"
                        value="<?php echo !empty($valuationInfo->date) ? $valuationInfo->date : date('m/d/Y'); ?>">
                </div>
            </div>

            <button btn-action='0' type="submit" name="submit"
                class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                id="btn-submit" title="Save">
                <span class="button-content">
                    Save
                </span>
            </button>
            <button btn-action='1' type="submit" name="submit"
                class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                id="btn-submit" title="Save">
                <span class="button-content">
                    Save & More
                </span>
            </button>
            <button btn-action='2' type="submit" name="submit"
                class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                id="btn-submit" title="Save">
                <span class="button-content">
                    Save & quit
                </span>
            </button>
            <input type="hidden" name="company_id" value="<?php echo !empty($company->id) ? $company->id : ""; ?>"
                id="company_id" />
            <input myaction='0' type="hidden" name="idValue" id="idValue"
                value="<?php echo !empty($valuationInfo->id) ? $valuationInfo->id : 0; ?>" />
        </form>
    </div>
</div>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function() {

    let companies = (<?php echo json_encode($companies);?>);
    var hotels = companies.map(
        function(sh) {
            return {
                value: sh.id,
                label: sh.long_name,
            }
        });

    $("#company_names").autocomplete({
            source: hotels,
            minLength: 2,
            showHintOnFocus: true,
            select: function(event, ui) {
                $('#company_names').val(ui.item.label);
                $('#company_id').val(ui.item.value);
                return false;
            },
            change: function(event, ui) {
                if (!ui.item) {
                    $('#company_names').val('');
                    $('#company_id').val('');
                }
            }
        }).data("ui-autocomplete")
        ._renderItem = function(ul, item) {
            return renderItem(item)
                .appendTo(ul)
        };

    function renderItem(item) {
        return $("<li>")
            .append(item.label);
    }
});
// ]]>
</script>

<style>
.ui-menu.ui-autocomplete {
    max-height: 200px;
    overflow-y: auto;

    li {
        padding: 5px 0 5px 10px;

        &:hover {
            cursor: pointer;
        }

        &:nth-child(even) {
            background: #ececec;
        }
    }

}
</style>
<?php endif; ?>