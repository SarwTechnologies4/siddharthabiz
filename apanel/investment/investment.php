<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
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
    </h3>
    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                <thead>
                <tr>
                    <th style="display:none;"></th>
                    <th class="text-center"><input class="check-all" type="checkbox"/></th>
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
                        <td><input type="checkbox" class="bulkCheckbox" bulkId="<?php echo $record->id; ?>"/></td>
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

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "addEdit"):
    $shareHolders = Shareholder::find_all();
    $companies = Hotelapi::find_all_active();

    if (isset($_GET['id']) && !empty($_GET['id'])):
        $investmentId = addslashes($_REQUEST['id']);
        $investmentInfo = Investment::find_by_id($investmentId);

        $company = Hotelapi::find_by_id($investmentInfo->company_id);
        $shareHolder = Shareholder::find_by_id($investmentInfo->shareholder_id);
    endif;
    // echo "<pre>";print_r($shareHolder);exit;
    ?>
    <h3>
        <?php echo (isset($_GET['id'])) ? 'Edit investment' : 'Add investment'; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
           onClick="viewInvestmentlist();">
            <span class="glyph-icon icon-separator">
                <i class="glyph-icon icon-arrow-circle-left"></i>
            </span>
            <span class="button-content"> Back </span>
        </a>
    </h3>

    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <form action="" class="col-md-12 center-margin" id="investment_frm">
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="company_names">
                            Company Name :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="Company Name" class="col-md-6 validate[required]"
                               type="text" name="company_names" id="company_names"
                               value="<?php echo !empty($company->long_name) ? $company->long_name : ""; ?>">
                    </div>
                </div>   

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="shareholder_internal_id">
                            Shareholder ID :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="Shareholder Id" class="col-md-6 validate[required]" type="text"
                            name="shareholder_internal_id" id="shareholder_internal_id"
                               value="<?php echo !empty($shareHolder->internal_id) ? $shareHolder->internal_id : ""; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="shareholder_name">
                            Shareholder Name :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="Shareholder Name" class="col-md-6 validate[required]" type="text" 
                        id="shareholder_name"  value="<?php echo !empty($shareHolder->name) ? $shareHolder->name : ""; ?>">
                    </div>
                </div>                

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="shareholder_father">
                            Shareholder Father Name :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="Shareholder Father Name" class="col-md-6" type="text" 
                        id="shareholder_father" disabled id="shareholder_name"
                        value="<?php echo !empty($shareHolder->father) ? $shareHolder->father : ""; ?>">
                    </div>
                </div>              

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="shareholder_mobile">
                            Shareholder Mobile :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="Shareholder Mobile" class="col-md-6" type="text" 
                        id="shareholder_mobile" disabled value="<?php echo !empty($shareHolder->mobile) ? $shareHolder->mobile : ""; ?>">
                    </div>
                </div>   

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="alloted_quantity">
                            Alloted Quantity :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="Alloted Quantity" class="col-md-6 validate[required]" type="number" name="alloted_quantity" 
                        id="alloted_quantity" min="0" value="<?php echo !empty($investmentInfo->alloted_quantity) ? $investmentInfo->alloted_quantity : 0; ?>">
                    </div>
                </div>   

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="price_per_share">
                            Price Per Share :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="Price Per Share" class="col-md-6 validate[required]" type="number" name="price_per_share" 
                        id="price_per_share" min="0" step="0.01" value="<?php echo !empty($investmentInfo->price_per_share) ? $investmentInfo->price_per_share : 0; ?>">
                    </div>
                </div> 
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="investment_amount">
                            Investment Amount :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="Investment Amount" class="col-md-6" type="number" id="investment_amount" 
                        disabled value="<?php echo !empty($investmentInfo->investment_amount) ? $investmentInfo->investment_amount : 0; ?>">
                    </div>
                </div> 
                <!-- <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="percentage">
                            Percentage :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="Percentage" class="col-md-6" type="number" id="percentage" disabled>
                    </div>
                </div>  -->

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
                <input type="hidden" name="company_id" value="<?php echo !empty($company->id) ? $company->id : ""; ?>" id="company_id" />
                <input type="hidden" name="shareholder_id" value="<?php echo !empty($shareHolder->id) ? $shareHolder->id : ""; ?>" id="shareholder_id" />
                <input myaction='0' type="hidden" name="idValue" id="idValue"
                       value="<?php echo !empty($investmentInfo->id) ? $investmentInfo->id : 0; ?>"/>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function () {
            
            let companies = (<?php echo json_encode($companies);?>);
            var hotels = companies.map(
                function (sh){ return {
                    value: sh.id,
                    label: sh.long_name,
                }
            });          

            $( "#company_names" ).autocomplete({
                source: hotels,
                minLength: 2,
                showHintOnFocus: true,
                select: function( event, ui ) {
                    $('#company_names').val( ui.item.label );
                    $('#company_id').val( ui.item.value );
                    return false;
                },
                change: function(event, ui) {
                    if (!ui.item) {
                        $('#company_names').val( '' );
                        $('#company_id').val( '' );
                    }
                }
            }).data("ui-autocomplete")
            ._renderItem = function(ul, item) {
                return renderItem(item)
                        .appendTo( ul )
            };

            let shareholders = (<?php echo json_encode($shareHolders);?>);
            var shareholder_ids = shareholders.map(
                function (sh){ return {
                    value: sh.id,
                    label: sh.internal_id,
                    name: sh.name,
                    father: sh.father,
                    mobile: sh.mobile
                }
            }); 

            var shareholder_names = shareholders.map(
                function (sh){ return {
                    value: sh.id,
                    label: sh.name,
                    internal_id: sh.internal_id,
                    father: sh.father,
                    mobile: sh.mobile
                }
            }); 

            $( "#shareholder_internal_id" ).autocomplete({
                source: shareholder_ids,
                minLength: 2,
                showHintOnFocus: true,
                select: function( event, ui ) {
                    selectItem(ui.item ,'shareholder_ids');
                    return false;
                },                
                change: function(event, ui) {
                    console.log(ui.item);
                    if (!ui.item) {
                        resetShareholder();
                    }
                }
            }).data("ui-autocomplete")
            ._renderItem = function(ul, item) {
                return renderItem(item)
                        .appendTo( ul )
            };

            $( "#shareholder_name" ).autocomplete({
                source: shareholder_names,
                minLength: 2,
                showHintOnFocus: true,
                select: function( event, ui ) {
                    selectItem(ui.item, 'shareholder_name');
                    return false;
                },               
                change: function(event, ui) {
                    if (!ui.item) {
                        resetShareholder();
                    }
                }
            }).data("ui-autocomplete")
            ._renderItem = function(ul, item) {
                return renderItem(item)
                        .appendTo( ul )
            };

            function renderItem(item) {
                return $( "<li>" )
                        .append( item.label );
            }

            function selectItem(item, inputType) {
                if (inputType === 'shareholder_name') {
                    $('#shareholder_name').val( item.label );
                    $('#shareholder_internal_id').val( item.internal_id );
                } else {
                    $('#shareholder_internal_id').val( item.label );
                    $('#shareholder_name').val( item.name );
                }
                $('#shareholder_id').val( item.value );
                $('#shareholder_father').val( item.father );
                $('#shareholder_mobile').val( item.mobile );
            }
            

            function resetShareholder() {
                $('#shareholder_name').val( '' );
                $('#shareholder_internal_id').val( '' );
                $('#shareholder_id').val( '' );
                $('#shareholder_father').val( '' );
                $('#shareholder_mobile').val( '' );
            }

            $('#alloted_quantity').on('change', function () {
                let price = parseFloat($('#price_per_share').val()) || 0;
                if (!price) return;

                $('#investment_amount').val(parseFloat(parseFloat($(this).val()) * price), 2);

            });

            $('#price_per_share').on('change', function () {
                let alloted_quantity = parseFloat($('#alloted_quantity').val()) || 0;
                if (!alloted_quantity) return;

                $('#investment_amount').val(parseFloat(parseFloat($(this).val()) * alloted_quantity), 2);

            });
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
    </h3>
    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                <thead>
                <tr>
                    <th style="display:none;"></th>
                    <th class="text-center"><input class="check-all" type="checkbox"/></th>
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
                        <td><input type="checkbox" class="bulkCheckbox" bulkId="<?php echo $record->id; ?>"/></td>
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
<?php endif; ?>