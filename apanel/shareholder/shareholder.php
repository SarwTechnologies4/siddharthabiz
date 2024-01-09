<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
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
    clearImages($moduleTablename, "shareholder/thumbnails");

    clearImages($moduleTablename, "shareholder/listimage", "list_image");
    clearImages($moduleTablename, "shareholder/listimage/thumbnails", "list_image");
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
                    <th class="text-center" width="5%"><input class="check-all" type="checkbox"/></th>
                    <th class="text-left">Title</th>
                    <!-- <th>Link</th> -->
                    <th class="text-center" width="10%"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
                </thead>

                <tbody>
                <?php $records = Shareholder::find_by_sql("SELECT * FROM " . $moduleTablename . " ORDER BY sortorder DESC ");
                foreach ($records as $key => $record): ?>
                    <tr id="<?php echo $record->id; ?>">
                        <td style="display:none;"><?php echo $key + 1; ?></td>
                        <td><input type="checkbox" class="bulkCheckbox" bulkId="<?php echo $record->id; ?>"/></td>
                        <td>
                            <div class="col-md-7">
                                <a href="javascript:void(0);" onClick="editRecord(<?php echo $record->id; ?>);"
                                   class="loadingbar-demo"
                                   title="<?php echo $record->name; ?>"><?php echo $record->name; ?></a>
                            </div>
                        </td>
                        <td class="text-center">
                            <?php
                            $statusImage = ($record->status == 1) ? "bg-green" : "bg-red";
                            $statusText = ($record->status == 1) ? $GLOBALS['basic']['clickUnpub'] : $GLOBALS['basic']['clickPub'];
                            ?>
                            <a href="javascript:void(0);"
                               class="btn small <?php echo $statusImage; ?> tooltip-button statusToggler"
                               data-placement="top" title="<?php echo $statusText; ?>"
                               status="<?php echo $record->status; ?>"
                               id="imgHolder_<?php echo $record->id; ?>" moduleId="<?php echo $record->id; ?>">
                                <i class="glyph-icon icon-flag"></i>
                            </a>
                            <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button"
                               data-placement="top"
                               title="Edit" onclick="editRecord(<?php echo $record->id; ?>);">
                                <i class="glyph-icon icon-edit"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top"
                               title="Remove"
                               onclick="recordDelete(<?php echo $record->id; ?>);">
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

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "addEdit"):
    if (isset($_GET['id']) && !empty($_GET['id'])):
        $advId = addslashes($_REQUEST['id']);
        $advInfo = Shareholder::find_by_id($advId);
        $status = ($advInfo->status == 1) ? "checked" : " ";
    endif;
    ?>
    <h3>
        <?php echo (isset($_GET['id'])) ? 'Edit Shareholder' : 'Add Shareholder'; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
           onClick="viewShareholderlist();">
    <span class="glyph-icon icon-separator">
    	<i class="glyph-icon icon-arrow-circle-left"></i>
    </span>
            <span class="button-content"> Back </span>
        </a>
    </h3>

    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <form action="" class="col-md-12 center-margin" id="shareholder_frm">
                <h5><strong>Shareholder details</strong></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="type_id"> Type : </label></div>
                            <div class="form-input col-md-5">
                                <select name="type_id" id="type_id" class="custom-select">
                                    <?php foreach ($shareHolderTypes as $shareHolderType) { ?>
                                        <option value="<?php echo $shareHolderType->id; ?>"
                                            <?php echo !empty($advInfo->type_id) && $shareHolderType->id === $advInfo->type_id ? 'selected' : '' ?>>
                                            <?php echo $shareHolderType->title; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="form-checkbox-radio" style="padding-top: 0">
                                    <a class="btn medium bg-blue" href="javascript:void(0);"
                                       onClick="toggleTypeForm();">
                                            <span class="glyph-icon icon-separator float-right">
                                                <i class="glyph-icon icon-caret-down"></i>
                                            </span>
                                        <span class="button-content"> Add type </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="hide type_form">
                            <div class="type-alert"></div>
                            <div class="form-row">
                                <div class="col-md-4"></div>
                                <div class="form-input col-md-6">
                                    <h5>Shareholder type</h5>
                                    <input placeholder="Type title" type="text" name="type_title" id="type_title"
                                           value="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    <button type="button" name="submit_type"
                                            class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                                            id="btn-submit" title="Save type" onClick="saveType()">
                                        <span class="button-content">
                                            Save type
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="internal_id"> Internal Id : <span class="required">*</span></label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Internal Id" class="validate[required,length[0,50]]"
                                       type="text" name="internal_id" id="internal_id"
                                       value="<?php echo !empty($advInfo->internal_id) ? $advInfo->internal_id : ""; ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="name"> Name : <span class="required">*</span></label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Shareholder Name" class="validate[required,length[0,50]]"
                                       type="text" name="name" id="name"
                                       value="<?php echo !empty($advInfo->name) ? $advInfo->name : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for=""> Gender : </label></div>
                            <div class="form-checkbox-radio col-md-8">
                                <input type="radio" class="custom-radio" name="gender" id="male"
                                       value="male" <?php echo empty($advInfo->gender) || (!empty($advInfo->gender) && $advInfo->gender == 'male') ? 'checked' : ""; ?>>
                                <label for="male">Male</label>
                                <input type="radio" class="custom-radio" name="gender" id="female"
                                       value="female" <?php echo !empty($advInfo->gender) && $advInfo->gender == 'female' ? 'checked' : ""; ?>>
                                <label for="female">Female</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="citizenship">Citizenship number :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Citizenship number"
                                       type="text" name="citizenship" id="citizenship"
                                       value="<?php echo !empty($advInfo->citizenship) ? $advInfo->citizenship : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="citizenship_district">Citizenship issue
                                    district :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Citizenship issue district"
                                       type="text" name="citizenship_district" id="citizenship_district"
                                       value="<?php echo !empty($advInfo->citizenship_district) ? $advInfo->citizenship_district : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="citizenship_issue_date">Citizenship issue date
                                    :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Citizenship issue date"
                                       type="date" name="citizenship_issue_date" id="citizenship_issue_date"
                                       value="<?php echo !empty($advInfo->citizenship_issue_date) ? $advInfo->citizenship_issue_date : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="father">Father :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Father"
                                       type="text" name="father" id="father"
                                       value="<?php echo !empty($advInfo->father) ? $advInfo->father : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="grand_father">Grand father :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Grand father"
                                       type="text" name="grand_father" id="grand_father"
                                       value="<?php echo !empty($advInfo->grand_father) ? $advInfo->grand_father : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="mother">Mother :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Mother"
                                       type="text" name="mother" id="mother"
                                       value="<?php echo !empty($advInfo->mother) ? $advInfo->mother : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="spouse">Spouse :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Spouse"
                                       type="text" name="spouse" id="spouse"
                                       value="<?php echo !empty($advInfo->spouse) ? $advInfo->spouse : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="nominee">Nominee :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Nominee"
                                       type="text" name="nominee" id="nominee"
                                       value="<?php echo !empty($advInfo->nominee) ? $advInfo->nominee : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="nominee_citizenship">Nominee citizenship
                                    :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Nominee citizenship"
                                       type="text" name="nominee_citizenship" id="nominee_citizenship"
                                       value="<?php echo !empty($advInfo->nominee_citizenship) ? $advInfo->nominee_citizenship : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="nominee_relationship">Nominee relationship
                                    :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Nominee relationship"
                                       type="text" name="nominee_relationship" id="nominee_relationship"
                                       value="<?php echo !empty($advInfo->nominee_relationship) ? $advInfo->nominee_relationship : ""; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h5><strong>Other details</strong></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="permanent_address">Permanent address :</label>
                            </div>
                            <div class="form-input col-md-8">
                                <input placeholder="Permanent address"
                                       type="text" name="permanent_address" id="permanent_address"
                                       value="<?php echo !empty($advInfo->permanent_address) ? $advInfo->permanent_address : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="temporary_address">Temporary address :</label>
                            </div>
                            <div class="form-input col-md-8">
                                <input placeholder="Temporary address"
                                       type="text" name="temporary_address" id="temporary_address"
                                       value="<?php echo !empty($advInfo->temporary_address) ? $advInfo->temporary_address : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="changed_address">Changed address :</label>
                            </div>
                            <div class="form-input col-md-8">
                                <input placeholder="Changed address"
                                       type="text" name="changed_address" id="changed_address"
                                       value="<?php echo !empty($advInfo->changed_address) ? $advInfo->changed_address : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="pan_number">Pan number :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Pan number"
                                       type="text" name="pan_number" id="pan_number"
                                       value="<?php echo !empty($advInfo->pan_number) ? $advInfo->pan_number : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="phone">Phone :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Phone"
                                       type="text" name="phone" id="phone"
                                       value="<?php echo !empty($advInfo->phone) ? $advInfo->phone : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="mobile">Mobile : <span class="required">*</span></label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Mobile" class="validate[required,length[0,10]]"
                                       type="text" name="mobile" id="mobile"
                                       value="<?php echo !empty($advInfo->mobile) ? $advInfo->mobile : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="email">Email :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Email"
                                       type="email" name="email" id="email"
                                       value="<?php echo !empty($advInfo->email) ? $advInfo->email : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="bank">Bank :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Bank"
                                       type="text" name="bank" id="bank"
                                       value="<?php echo !empty($advInfo->bank) ? $advInfo->bank : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="bank_account">Account number :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Account number"
                                       type="text" name="bank_account" id="bank_account"
                                       value="<?php echo !empty($advInfo->bank_account) ? $advInfo->bank_account : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="bank_branch">Bank branch :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Bank branch"
                                       type="text" name="bank_branch" id="bank_branch"
                                       value="<?php echo !empty($advInfo->bank_branch) ? $advInfo->bank_branch : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="bank_account_name">Account name :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Account name"
                                       type="text" name="bank_account_name" id="bank_account_name"
                                       value="<?php echo !empty($advInfo->bank_account_name) ? $advInfo->bank_account_name : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="terminated_date">Terminated date :</label>
                            </div>
                            <div class="form-input col-md-8">
                                <input placeholder="Terminated date"
                                       type="date" name="terminated_date" id="terminated_date"
                                       value="<?php echo !empty($advInfo->terminated_date) ? $advInfo->terminated_date : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="terminated_amount">Terminated amount :</label>
                            </div>
                            <div class="form-input col-md-8">
                                <input placeholder="Terminated amount"
                                       type="text" name="terminated_amount" id="terminated_amount"
                                       value="<?php echo !empty($advInfo->terminated_amount) ? $advInfo->terminated_amount : ""; ?>">
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <h5><strong>Company Details</strong></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="company_name">Company name :</label>
                            </div>
                            <div class="form-input col-md-8">
                                <input placeholder="Company name"
                                       type="text" name="company_name" id="company_name"
                                       value="<?php echo !empty($advInfo->company_name) ? $advInfo->company_name : ""; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="company_address">Company address :</label>
                            </div>
                            <div class="form-input col-md-8">
                                <input placeholder="Company address"
                                       type="text" name="company_address" id="company_address"
                                       value="<?php echo !empty($advInfo->company_address) ? $advInfo->company_address : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="company_pan">Company pan number :</label>
                            </div>
                            <div class="form-input col-md-8">
                                <input placeholder="Company pan number"
                                       type="text" name="company_pan" id="company_pan"
                                       value="<?php echo !empty($advInfo->company_pan) ? $advInfo->company_pan : ""; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <h5><strong>Images</strong></h5>
                <div class="row">
                    <?php
                    $count = 1;
                    $objArray = !empty($advInfo) ? (array)$advInfo : [];
                    foreach ($image_types as $key => $type) : ?>
                    <?php if(($count - 1) % 2 == 0) echo '</div><div class="row">';?>
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-label col-md-4">
                                    <label for="">
                                        <?php echo $type ?> :
                                    </label>
                                </div>

                                <div class="col-md-6">
                                    <?php if (!empty($objArray[$key])): ?>
                                        <div id="removeSavedimg<?php echo $count; ?>">
                                            <div class="infobox info-bg">
                                                <div class="button-group" data-toggle="buttons">
                                                <span class="float-left">
                                                    <?php
                                                    if (file_exists(SITE_ROOT . "images/shareholder/" . $key . "/" . $objArray[$key])):
                                                        $filesize = filesize(SITE_ROOT . "images/shareholder/" . $key . "/" . $objArray[$key]);
                                                        echo 'Size : ' . getFileFormattedSize($filesize);
                                                    endif;
                                                    ?>
                                                </span>
                                                    <a class="btn small float-right" href="javascript:void(0);"
                                                       onclick="deleteSavedShareholderimage(<?php echo $count; ?>)">
                                                        <i class="glyph-icon icon-trash-o"></i>
                                                    </a>
                                                </div>
                                                <img src="<?php echo IMAGE_PATH . 'shareholder/' . $key . '/thumbnails/' . $objArray[$key]; ?>"
                                                     style="width:100%"/>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <div class="form-input uploader<?php echo $count; ?> <?php echo !empty($objArray[$key]) ? "hide" : ""; ?>">
                                        <input type="file" name="<?php echo $key; ?>" id="<?php echo $key; ?>_upload"
                                               class="transparent no-shadow">
                                        <label>
                                            <small>Image Dimensions (620 px X 560 px)</small>
                                        </label>
                                    </div>
                                    <!-- Upload user image preview -->
                                    <div id="preview_Image<?php echo $count; ?>"></div>
                                </div>
                            </div>
                        </div>
                        <?php $count++;
                    endforeach; ?>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-label col-md-2"><label for=""> Status : </label></div>
                            <div class="form-checkbox-radio col-md-9">
                                <input type="radio" class="custom-radio" name="status" id="check1"
                                       value="1" <?php echo !empty($status) ? $status : "checked"; ?>>
                                <label for="check1">Published</label>
                                <input type="radio" class="custom-radio" name="status" id="check0"
                                       value="0" <?php echo !empty($unstatus) ? $unstatus : ""; ?>>
                                <label for="check0">Un-Published</label>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-md-6">
                        <div class="form-row">
                            <div class="form-label col-md-4"><label for="sortorder">Sort order :</label></div>
                            <div class="form-input col-md-8">
                                <input placeholder="Sort order"
                                       type="text" name="sortorder" id="sortorder"
                                       value="<?php /*echo !empty($advInfo->sortorder) ? $advInfo->sortorder : ""; */?>">
                            </div>
                        </div>
                    </div>-->
                </div>

                <!-- Meta Tags-->
                <div class="form-row">
                    <div class="form-checkbox-radio col-md-9">
                        <a class="btn medium bg-blue" href="javascript:void(0);" onClick="toggleMetadata();">
                        <span class="glyph-icon icon-separator float-right">
                        	<i class="glyph-icon icon-caret-down"></i>
                        </span>
                            <span class="button-content"> Metadata Info </span>
                        </a>
                    </div>
                </div>
                <div class="form-row <?php echo (!empty($advInfo->meta_keywords) || !empty($advInfo->meta_description)) ? '' : 'hide'; ?> metadata">
                    <div class="col-md-6">
                        <textarea placeholder="Meta Keyword" name="meta_keywords" id="meta_keywords"
                                  class="character-keyword validate[required]"><?php echo !empty($advInfo->meta_keywords) ? $advInfo->meta_keywords : ""; ?></textarea>
                        <div class="keyword-remaining clear input-description">250 characters left</div>
                    </div>
                    <div class="col-md-6">
                        <textarea placeholder="Meta Description" name="meta_description" id="meta_description"
                                  class="character-description validate[required]"><?php echo !empty($advInfo->meta_description) ? $advInfo->meta_description : ""; ?></textarea>
                        <div class="description-remaining clear input-description">160 characters left</div>
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
                <input myaction='0' type="hidden" name="idValue" id="idValue"
                       value="<?php echo !empty($advInfo->id) ? $advInfo->id : 0; ?>"/>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo ASSETS_PATH; ?>uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function () {
            <?php
            $count = 1;
            foreach ($image_types as $key => $type) : ?>
            $('#<?php echo $key;?>_upload').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
                'formData': {
                    PROJECT: '<?php echo SITE_FOLDER;?>',
                    targetFolder: 'images/shareholder/<?php echo $key;?>/',
                    thumb_width: 200,
                    thumb_height: 200
                },
                'method': 'post',
                'cancelImg': '<?php echo BASE_URL;?>uploadify/cancel.png',
                'auto': true,
                'multi': false,
                'hideButton': false,
                'buttonText': 'Upload Image',
                'width': 125,
                'height': 21,
                'removeCompleted': true,
                'progressData': 'speed',
                'uploadLimit': 100,
                'fileTypeExts': '*.gif; *.jpg; *.jpeg;  *.png; *.GIF; *.JPG; *.JPEG; *.PNG;',
                'buttonClass': 'button formButtons',
                /* 'checkExisting' : '/uploadify/check-exists.php',*/
                'onUploadSuccess': function (file, data, response) {
                    var filename = data;
                    $.post('<?php echo BASE_URL;?>apanel/shareholder/<?php echo $key;?>.php', {imagefile: filename}, function (msg) {
                        $('#preview_Image<?php echo $count;?>').html(msg).show();
                    });

                },
                'onDialogOpen': function (event, ID, fileObj) {
                },
                'onUploadError': function (file, errorCode, errorMsg, errorString) {
                    alert(errorMsg);
                },
                'onUploadComplete': function (file) {
                    //alert('The file ' + file.name + ' was successfully uploaded');
                }
            });
            <?php $count++; endforeach; ?>
        });
        // ]]>
    </script>
<?php endif; ?>