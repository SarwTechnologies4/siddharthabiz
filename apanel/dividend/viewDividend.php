<?php $company = Hotelapi::find_by_id($_GET["id"]); ?>
<h3>
    Dividend list of <?php echo $company->long_name; ?>
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
      onClick="viewDividendlist();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-arrow-circle-left"></i>
        </span>
        <span class="button-content"> Back </span>
    </a>
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" style="margin-right: 10px;" href="#"
        id="export_company_dividend">
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
                    <th class="text-left">Dividend Amount</th>
                    <th class="text-left">Fiscal Year</th>
                    <th class="text-left">Payment date</th>
                    <th class="text-center" width="20%"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
            </thead>

            <tbody>
                <?php $records = Dividend::getDividendByCompany($company->id);
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
                            <?php echo $record->payment_amount; ?>
                        </td>
                        <td>
                            <?php echo $record->period_fiscal; ?>
                        </td>
                        <td>
                            <?php echo $record->date; ?>
                        </td>
                        <?php if ($loginUser->type == 'admin') { ?>
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