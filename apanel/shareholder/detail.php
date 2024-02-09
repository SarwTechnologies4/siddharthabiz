<?php if (isset($_GET['id']) && !empty($_GET['id'])):
    $advId = addslashes($_REQUEST['id']);
    $advInfo = Shareholder::find_by_id($advId);
endif ?>

<h3>
    Shareholder Overview
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
        onClick="editRecord(<?php echo $advInfo->id; ?>);">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-edit"></i>
        </span>
        <span class="button-content"> Edit Shareholder </span>
    </a>
</h3>
<div class="example-box">
    <div class="example-code">
        <a href="javascript:void(0);" onClick="toggleAccess(<?php echo $advInfo->id; ?>);" 
            class="loadingbar-demo btn medium <?php echo $advInfo->access_granted ? 'bg-red' : 'bg-blue-alt'; ?>" id="accessToggleBtn">
            <span class="glyph-icon icon-separator">
                <i class="glyph-icon icon-share"></i>
            </span>
            <span class="button-content"> <?php echo $advInfo->access_granted ? 'Revoke Access' : 'Share Access'; ?> </span>
        </a>

        <hr>
        <h4>
            Transactions
        </h4>
        <?php $dividend = Dividend::find_by_shareHolder($advInfo->id); ?>
        <?php $investment = Investment::find_by_shareHolder($advInfo->id); ?>
        <?php $payment = Payment::find_by_shareHolder($advInfo->id); ?>
                                
        <div id="tabs">
            <ul>
                <li><a href="#dividend-tab">Dividend (<?php echo count($dividend)?>)</a></li>
                <li><a href="#investment-tab">Investment (<?php echo count($investment)?>)</a></li>
                <li><a href="#payment-tab">Payment (<?php echo count($payment)?>)</a></li>
            </ul>
            <div id="dividend-tab" class="shareholder-tabs">
                <h4>
                    Dividend
                    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
                        onClick="addDividend(<?php echo $advInfo->id; ?>);">
                        <span class="glyph-icon icon-separator">
                            <i class="glyph-icon icon-plus-square"></i>
                        </span>
                        <span class="button-content"> Add Dividend </span>
                    </a>
                </h4>
                <div class="example-box">
                    <div class="example-code">
                        <table cellpadding="0" cellspacing="0" border="0" class="table" id="dividend-table">
                            <thead>
                                <tr>
                                    <th style="display:none;"></th>
                                    <th class="text-left">Company</th>
                                    <th class="text-left">Dividend Amount</th>
                                    <th class="text-left">Fiscal Year</th>
                                    <th class="text-left">Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($dividend as $key => $record): ?>
                                <tr id="<?php echo $record->id; ?>">
                                    <td style="display:none;"><?php echo $key + 1; ?></td>
                                    <td> <?php echo $record->long_name; ?> </td>
                                    <td> <?php echo $record->payment_amount; ?> </td>
                                    <td> <?php echo $record->period_fiscal; ?> </td>
                                    <td> <?php echo $record->date; ?> </td>

                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="investment-tab" class="shareholder-tabs">
                <h4>
                    Investment
                    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
                        onClick="addInvestment(<?php echo $advInfo->id; ?>);">
                        <span class="glyph-icon icon-separator">
                            <i class="glyph-icon icon-plus-square"></i>
                        </span>
                        <span class="button-content"> Add Investment </span>
                    </a>
                </h4>
                <div class="example-box">
                    <div class="example-code">
                        <table cellpadding="0" cellspacing="0" border="0" class="table" id="investment-table">
                            <thead>
                                <tr>
                                    <th style="display:none;"></th>
                                    <th class="text-left">Company</th>
                                    <th class="text-left"># Share</th>
                                    <th class="text-left">Price per share</th>
                                    <th class="text-left">Investment Amount</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($investment as $key => $record): ?>
                                <tr id="<?php echo $record->id; ?>">
                                    <td style="display:none;">
                                        <?php echo $key + 1; ?>
                                    </td>
                                    <td> <?php echo $record->long_name; ?> </td>
                                    <td> <?php echo $record->alloted_quantity; ?> </td>
                                    <td> <?php echo $record->price_per_share; ?> </td>
                                    <td> <?php echo $record->alloted_quantity * $record->price_per_share; ?> </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="payment-tab" class="shareholder-tabs">
                <h4>
                    Payment
                    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
                        onClick="addPayment(<?php echo $advInfo->id; ?>);">
                        <span class="glyph-icon icon-separator">
                            <i class="glyph-icon icon-plus-square"></i>
                        </span>
                        <span class="button-content"> Add Payment </span>
                    </a>
                </h4>
                <div class="example-box">
                    <div class="example-code">
                        <table cellpadding="0" cellspacing="0" border="0" class="table" id="payment-table">
                            <thead>
                                <tr>
                                    <th style="display:none;"></th>
                                    <th class="text-left">Company</th>
                                    <th class="text-left">Payment mode</th>
                                    <th class="text-left">Bank</th>
                                    <th class="text-left">Payment Amount</th>
                                    <th class="text-left">Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($payment as $key => $record): ?>
                                <tr id="<?php echo $record->id; ?>">
                                    <td style="display:none;">
                                        <?php echo $key + 1; ?>
                                    </td>
                                    <td> <?php echo $record->long_name; ?> </td>
                                    <td> <?php echo $record->payment_mode; ?> </td>
                                    <td> <?php echo $record->bank_name; ?> </td>
                                    <td> <?php echo $record->payment_amount; ?> </td>
                                    <td> <?php echo $record->date; ?> </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
$(function() {
    $("#tabs").tabs();

    $('#dividend-table, #investment-table, #payment-table').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    })
});
</script>

<style>
#tabs {
    background: transparent;
    border: none;
}

#tabs .ui-widget-header {
    background: transparent;
    border: none;
    -moz-border-radius: 0px;
    -webkit-border-radius: 0px;
    border-radius: 0px;
}

#tabs .ui-tabs-nav .ui-state-default {
    background: transparent;
    border: none;
}

#tabs .ui-tabs-nav .ui-state-active {
    border: none;
    border-bottom: 2px solid #3a4049;
}

#tabs .ui-tabs-nav .ui-state-default a {
    color: #c0c0c0;
}

#tabs .ui-tabs-nav .ui-state-active a {
    color: #3a4049;
    font-weight: 600;
}

#tabs .shareholder-tabs {
    padding: 20px 0;
}

h4 {
    margin-bottom: 20px;
}
</style>