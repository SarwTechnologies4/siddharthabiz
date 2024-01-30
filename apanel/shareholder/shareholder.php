<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<?php
$image_types = [
    'citizenship_image' => 'Citizenship image',
    'pan_image' => 'Pan image',
    'license_image' => 'License image',
    'pp_image' => 'PP size photo',
    'company_image' => 'Company photo',
];
$moduleTablename = "tbl_shareholders"; // Database table name
$moduleId = 402;                // module id >>>>> tbl_modules

$shareHolderTypes = ShareholderType::find_by_sql("SELECT * from tbl_shareholders_type where `status` = 1");

if (isset($_GET['page']) && $_GET['page'] == "shareholder" && isset($_GET['mode']) && $_GET['mode'] == "list"):
    clearImages($moduleTablename, "shareholder");

    clearImages($moduleTablename, "shareholder/citizenship_image", "citizenship_image");
    clearImages($moduleTablename, "shareholder/citizenship_image/thumbnails", "citizenship_image");

    clearImages($moduleTablename, "shareholder/company_image", "company_image");
    clearImages($moduleTablename, "shareholder/company_image/thumbnails", "company_image");

    clearImages($moduleTablename, "shareholder/license_image", "license_image");
    clearImages($moduleTablename, "shareholder/license_image/thumbnails", "license_image");

    clearImages($moduleTablename, "shareholder/pan_image", "pan_image");
    clearImages($moduleTablename, "shareholder/pan_image/thumbnails", "pan_image");

    clearImages($moduleTablename, "shareholder/pp_image", "pp_image");
    clearImages($moduleTablename, "shareholder/pp_image/thumbnails", "pp_image");

    // clearImages($moduleTablename, "shareholder/listimage", "list_image");
    // clearImages($moduleTablename, "shareholder/listimage/thumbnails", "list_image");
    ?>
<h3>
    List Shareholders
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
        onClick="AddNewShareholder();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-plus-square"></i>
        </span>
        <span class="button-content"> Add New </span>
    </a>
</h3>
<div class="my-msg"></div>
<div class="example-box">
    <div class="example-code">
        <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
            <thead>
                <tr>
                    <th style="display:none;"></th>
                    <th class="text-center" width="5%"><input class="check-all" type="checkbox" /></th>
                    <th class="text-left">Name</th>
                    <th class="text-left">Internal ID</th>
                    <th class="text-left">Mobile</th>
                    <!-- <th>Link</th> -->
                    <th class="text-center" width="10%"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
            </thead>

            <tbody>
                <?php $records = Shareholder::find_by_sql("SELECT * FROM " . $moduleTablename . " ORDER BY sortorder DESC ");
                foreach ($records as $key => $record): ?>
                <tr id="<?php echo $record->id; ?>">
                    <td style="display:none;"><?php echo $key + 1; ?></td>
                    <td><input type="checkbox" class="bulkCheckbox" bulkId="<?php echo $record->id; ?>" /></td>
                    <td>
                        <a href="javascript:void(0);" data-id="<?php echo $record->id; ?>" class="clicker loadingbar-demo"
                            title="<?php echo $record->name; ?>">
                            <?php echo $record->name; ?></a>
                    </td>
                    <td>
                        <?php echo $record->internal_id; ?>
                    </td>
                    <td>
                        <?php echo $record->mobile; ?>
                    </td>
                    <td class="text-center">
                        <?php
                            $statusImage = ($record->status == 1) ? "bg-green" : "bg-red";
                            $statusText = ($record->status == 1) ? $GLOBALS['basic']['clickUnpub'] : $GLOBALS['basic']['clickPub'];
                            ?>
                        <a href="javascript:void(0);"
                            class="btn small <?php echo $statusImage; ?> tooltip-button statusToggler"
                            data-placement="top" title="<?php echo $statusText; ?>"
                            status="<?php echo $record->status; ?>" id="imgHolder_<?php echo $record->id; ?>"
                            moduleId="<?php echo $record->id; ?>">
                            <i class="glyph-icon icon-flag"></i>
                        </a>
                        <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button"
                            data-placement="top" title="View" onclick="viewDetail(<?php echo $record->id; ?>);">
                            <i class="glyph-icon icon-eye"></i>
                        </a>
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
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="pad0L col-md-2">
        <select name="dropdown" id="groupTaskField" class="custom-select">
            <option value="0"><?php echo $GLOBALS['basic']['choseAction']; ?></option>
            <option value="delete"><?php echo $GLOBALS['basic']['delete']; ?></option>
            <option value="toggleStatus"><?php echo $GLOBALS['basic']['toggleStatus']; ?></option>
        </select>
    </div>
    <a class="btn medium primary-bg" href="javascript:void(0);" id="applySelected_btn">
        <span class="glyph-icon icon-separator float-right">
            <i class="glyph-icon icon-cog"></i>
        </span>
        <span class="button-content"> Click </span>
    </a>
</div>

<script type="text/javascript">
$(function() {
    $(".clicker").on('dblclick', function(){
        let $this = $(this);
        viewDetail($this.data('id'));
    });
    $(".clicker").on('click', function(){
        let $this = $(this);
        editRecord($this.data('id'));
    });
});
</script>
<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "addEdit"): ?>
<?php include_once("form.php"); ?>
<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "viewDetail"): ?>
<?php include_once("detail.php"); ?>
<?php endif; ?>