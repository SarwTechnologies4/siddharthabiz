<h3>
    Investment Report
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
      onClick="viewInvestmentlist();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-arrow-circle-left"></i>
        </span>
        <span class="button-content"> Back </span>
    </a>
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
      style="margin-right: 10px;"
      onClick="exportReport();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-download"></i>
        </span>
        <span class="button-content"> Download </span>
    </a>
</h3>
<div class="my-msg"></div>
<div class="example-box">
    <div class="example-code">
        <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
            <thead>
                <tr>
                    <th style="display:none;"></th>
                    <th class="text-left">Shareholder ID</th>
                    <th class="text-left">Shareholder Name</th>
                    <th class="text-left">Company Name</th>
                    <th class="text-left">Alloted Share</th>
                    <th class="text-left">Total Price</th>
                    <th class="text-left">Paid Amount</th>
                    <th class="text-left">Due Amount</th>
                </tr>
            </thead>

            <tbody>
                <?php $records = Investment::list_report();
                foreach ($records as $key => $record): ?>
                    <tr id="<?php echo $record->id; ?>">
                        <td style="display:none;"><?php echo $key + 1; ?></td>
                        <td>
                            <?php echo $record->internal_id; ?>
                        </td>
                        <td>
                            <?php echo $record->name; ?>
                        </td>
                        <td>
                            <?php echo $record->long_name; ?>
                        </td>
                        <td>
                            <?php echo $record->alloted_quantity; ?>
                        </td>
                        <td>
                            <?php echo $record->investment_amount; ?>
                        </td>
                        <td>
                            <?php echo $record->payment_amount; ?>
                        </td>
                        <td>
                            <?php echo $record->investment_amount - $record->payment_amount; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>