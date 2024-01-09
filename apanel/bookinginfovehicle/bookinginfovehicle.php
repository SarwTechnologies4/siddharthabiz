<?php
$moduleTablename = "tbl_bookinginfo_vehicle"; // Database table name
$moduleId = 72;                // module id >>>>> tbl_modules
$moduleFoldername = "";        // Image folder name

if (isset($_GET['page']) && $_GET['page'] == "bookinginfovehicle" && isset($_GET['mode']) && $_GET['mode'] == "list"):
    ?>
    <h3>List Booking Info</h3>
    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                <thead>
                <tr>
                    <th class="text-center">S.No.</th>
                    <th>Code</th>
                    <th>Fullname</th>
                    <th>Contact Info</th>
                    <th>Date</th>
                    <th>Pay Type</th>
                    <th class="text-center"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
                </thead>

                <tbody>
                <?php
                $add_query = '';
                if ($user_type != 'admin') {
                    $u_id = $session->get('u_id');
                    $sql = "SELECT Bv.id, Bv.accesskey, Bv.person_fname, Bv.person_lname, Bv.person_email, Bv.person_phone, Bv.date, Bv.pay_type, Bv.status, Bve.vendor_id 
                        FROM " . $moduleTablename . " AS Bv
                        INNER JOIN tbl_bookinginfo_vehicle_extra AS Bve
                        ON Bv.id = Bve.booking_id
                        WHERE Bve.vendor_id = {$u_id} 
                        ORDER BY Bv.sortorder DESC";
                } else {
                    $sql = "SELECT * FROM " . $moduleTablename . " AS Bv ORDER BY Bv.sortorder DESC";
                }
                $result_set = $db->query($sql);
                $records = array();
                while ($row = $db->fetch_object($result_set)) {
                    $records[] = $row;
                }
                $cn = 1;
                foreach ($records as $record): ?>
                    <tr id="<?php echo $record->id; ?>">
                        <td class="text-center"><?php echo $cn++; ?></td>
                        <td><?php echo set_na($record->accesskey); ?></td>
                        <td><?php echo set_na($record->person_fname . ' ' . $record->person_lname); ?></td>
                        <td>Email : <?php echo set_na($record->person_email); ?><br/>Contact No. : <?php echo set_na($record->person_phone); ?></td>
                        <td><?php echo $record->date; ?></td>
                        <td><?php echo set_na($record->pay_type); ?></td>
                        <td class="text-center">
                            <a href="javascript:void(0);" class="loadingbar-demo btn small bg-green tooltip-button" data-placement="top" title="View"
                               onclick="viewRecord(<?php echo $record->id; ?>);">
                                <i class="glyph-icon icon-eye"></i>
                            </a>
                            <?php if ($record->status != '1') { ?>
                                <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top" title="Remove"
                                   onclick="recordDelete(<?php echo $record->id; ?>);">
                                    <i class="glyph-icon icon-remove"></i>
                                </a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "view"):
    if (isset($_GET['id']) && !empty($_GET['id'])):
        $bookingId = addslashes($_REQUEST['id']);
        $bookingRow = Bookinginfovehicle::find_by_id($bookingId);

        $RouteFrom = Route::find_by_id($bookingRow->route_from);
        $RouteTo = Route::find_by_id($bookingRow->route_to);
    endif;
    ?>

    <h3>
        View Booking Info (<?php echo $bookingRow->accesskey; ?>)
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="viewBookinglist();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-arrow-circle-left"></i>
        </span>
            <span class="button-content"> Back </span>
        </a>
    </h3>
    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <div class="col-sm-6">
                <h3>Personal Information</h3>
                <ul>
                    <li><strong>Fullname : </strong><?php echo $bookingRow->person_fname . ' ' . $bookingRow->person_lname; ?></li>
                    <li><strong>Contact No. : </strong><?php echo set_na($bookingRow->person_phone); ?></li>
                    <li><strong>Email Address : </strong><?php echo set_na($bookingRow->person_email); ?></li>
                    <li><strong>Country : </strong><?php echo set_na($bookingRow->person_country); ?></li>
                    <li><strong>Country Code : </strong><?php echo set_na($bookingRow->person_country_code); ?></li>
                    <li><strong>City : </strong><?php echo set_na($bookingRow->person_city); ?></li>
                    <li><strong>Requirements : </strong><?php echo set_na($bookingRow->person_comment); ?></li>
                    <!-- <li><strong>Address : </strong><?php echo set_na($bookingRow->person_address); ?></li> -->
                    <!-- <li><strong>Postal / Zip Code : </strong><?php echo set_na($bookingRow->person_postal); ?></li> -->
                    <!-- <li><strong>Contact Type : </strong><?php echo set_na($bookingRow->person_ctype); ?></li> -->
                </ul>
            </div>

            <div class="col-sm-6">
                <h3>Booking Information</h3>
                <ul>
                    <li><strong>Order Id : </strong><?php echo set_na($bookingRow->accesskey); ?></li>
                    <li><strong>From : </strong><?php echo set_na(Route::field_by_id($RouteFrom->parent_id, 'title')); ?>
                        , <?php echo set_na($RouteFrom->title); ?></li>
                    <li><strong>To : </strong><?php echo set_na(Route::field_by_id($RouteTo->parent_id, 'title')); ?>
                        , <?php echo set_na($RouteTo->title); ?></li>
                    <li><strong>Date : </strong><?php echo set_na($bookingRow->date); ?></li>
                    <li><strong>Total Price : </strong><?php echo set_na($bookingRow->currency . ' ' . $bookingRow->pay_amt); ?></li>
                    <li><strong>No. of Pax. : </strong><?php echo set_na($bookingRow->pax); ?></li>
                    <li><strong>Inquiry Date : </strong><?php echo set_na($bookingRow->added_date); ?></li>
                    <li><strong>Inquiry Ip : </strong><?php echo set_na($bookingRow->ip_address); ?></li>
                </ul>
            </div>
            <div class="clear"></div>

            <div class="col-sm-12">
                <h4>Vehicles List</h4>
                <ul class="col-sm-12 row">
                    <?php
                    if ($user_type != 'admin') {
                        $u_id = $session->get('u_id');
                        $sql = "SELECT * FROM tbl_bookinginfo_vehicle_extra WHERE booking_id='$bookingRow->id' AND vendor_id='$u_id' ORDER BY id ASC ";
                    } else {
                        $sql = "SELECT * FROM tbl_bookinginfo_vehicle_extra WHERE booking_id='$bookingRow->id' ORDER BY id ASC ";
                    }
                    $query = $db->query($sql);
                    $tot = $db->num_rows($query);
                    if ($tot > 0) { ?>
                        <li>
                            <table class="table form-input">
                                <tr class="trip-info">
                                    <th>Vehicle Name</th>
                                    <?php if ($user_type == 'admin') { ?>
                                        <th>Vendor Name</th>
                                    <?php } ?>
                                    <th>Qty</th>
                                    <th>Price(USD)</th>
                                    <th>Total Price(USD)</th>
                                </tr>
                                <?php while ($row = $db->fetch_object($query)) {
                                    $vehicleIndo = Vehicle::find_by_id($row->vehicle_id);
                                    $vendorInfo = User::find_by_id($row->vendor_id); ?>
                                    <tr>
                                        <td><?php echo $vehicleIndo->title; ?></a></td>
                                        <?php if ($user_type == 'admin') { ?>
                                            <td><?php echo @$vendorInfo->first_name . ' ' . @$vendorInfo->last_name; ?></a></td>
                                        <?php } ?>
                                        <td><?php echo $row->vehicle_qnt; ?></td>
                                        <td><?php echo $row->vehicle_price; ?></td>
                                        <td><?php echo $row->vehicle_price * $row->vehicle_qnt; ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="clear"></div>

            <div class="col-sm-12">
                <h3>Payment Information</h3>
                <ul>
                    <?php if ($bookingRow->status == 1) { ?>
                        <li><strong>Payment Type : </strong>Online Payment (<?php echo $bookingRow->pay_type; ?>)</li>
                        <li><strong>Transaction Code : </strong><?php echo set_na($bookingRow->tranRef); ?></li>
                        <li><strong>Paid Amount (US $) : </strong><?php echo set_na(($bookingRow->hbl_amount / 100)); ?></li>
                        <li><strong>Confirm Date : </strong><?php echo set_na($bookingRow->confirm_date); ?></li>
                        <li><strong>Confirm IP : </strong><?php echo set_na($bookingRow->confirm_ip); ?></li>
                    <?php } else { ?>
                        <li><strong>Payment Type : </strong>Online <?php echo $bookingRow->pay_type; ?></li>
                    <?php } ?>
                </ul>
            </div>

        </div>
    </div>
<?php endif; ?>