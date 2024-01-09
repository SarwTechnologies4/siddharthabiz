<?php
$hall='';
$hall_listing='';
$hallmod='';
$hallemail='';
$pagel='';
$page = (isset($_REQUEST["pageno"]) and !empty($_REQUEST["pageno"]))? $_REQUEST["pageno"] : 1;
$dest = (isset($_REQUEST["dest"]) and !empty($_REQUEST["dest"]))? $_REQUEST["dest"] : '';
$sql1 = "SELECT rd.* FROM tbl_hall AS hd INNER JOIN tbl_apihotel AS rd 
ON rd.id = hd.hotel_id WHERE hd.status='1' and rd.status='1' GROUP BY hd.hotel_id ";


// SELECT hd.hotel_id FROM tbl_hall AS hd INNER JOIN tbl_apihotel AS rd 
// ON rd.id = hd.hotel_id WHERE hd.status='1' and rd.status='1' GROUP BY hd.hotel_id 
// SELECT hd.* FROM tbl_hall AS hd INNER JOIN tbl_apihotel AS rd
// ON rd.id = hd.hotel_id WHERE hd.status='1' and rd.destinationId='$dest' ORDER BY hd.sortorder DESC
// pr($dest);
if(!empty($dest)){
$sql = "SELECT * FROM tbl_hall WHERE status='1' and hotel_id='$dest' ORDER BY sortorder DESC";}
else{
    $sql= "SELECT * FROM tbl_hall WHERE status='1' ORDER BY sortorder DESC";
}
$location='';
$destination= Hotelapi::find_by_sql($sql1);
// pr($destination);
        foreach($destination as $destini){
        $location.='<a class="dropdown-item" href="'.BASE_URL.'meetingandevents/location/'.$destini->id.'/page/1">'.$destini->title.'</a>';
        }
    // pr($destini);
    $limit = 5;
    $total = $db->num_rows($db->query($sql));
    // print_r($total); die();
    $startpoint = ($page * $limit) - $limit; 
    $sql.=" LIMIT ".$startpoint.",".$limit;
    $query = $db->query($sql);
    $Records=Hallapi::find_by_sql($sql);
    if(!empty($dest)){
        $dpage='<li class="page-item">'.get_front_pagination($total, $limit, $page, BASE_URL . 'meetingandevents/location/'.$dest).'</li>';
    }
    else{
    $dpage='<li class="page-item">'.get_front_pagination($total, $limit, $page, BASE_URL . 'meetingandevents').'</li>';
    }
    // $pagea = $_GET['page'];
// $offset = ($page - 1) * $limit;
// $sql= "SELECT * from tbl_hall ORDER BY id DESC LIMIT {$offset},{$limit}";
// $query = $db->query($sql);
// $totno = $db->num_rows($query);

// $total_page = ceil($totno / $limit);
// pr($total_page);

// for($i =1; $i <= $total_page;$i++){
//     $pageno .= '<li><a href="'.BASE_URL.'meetingandevents?page='.$i.'">'.$i.'</a></li>';
// }

if (defined('INNER_PAGE')) {
    
    
    $pkgRec = Hallapi::find_all();
    foreach($pkgRec as $key => $subpkg){
    $hallemail= Hotelapi:: find_by_hotel($subpkg->hotel_id);
        foreach($hallemail as $key => $hmail){
            $hallmail = $hmail->meet_email;
            $hallproperty = $hmail->title;
            $hotelslug = $hmail->slug;
        }
    }
    if(!empty($Records)){
    foreach ($Records as $key => $subpkgRow) {
    
        
        
        $imgall = unserialize(base64_decode($subpkgRow->image));
        $images = '';

        if (is_array($imgall)) {

            for ($i = 0; $i < count($imgall); $i++) {
                if ($i != count($imgall) - 1) {
                    if (file_exists(SITE_ROOT . "images/hallapi/" . @$imgall[$i])) {
                        $images .= IMAGE_PATH . 'hallapi/' . $imgall[$i] . ',';
                    }
                } else {
                    if (file_exists(SITE_ROOT . "images/hallapi/" . @$imgall[$i])) {
                        $images .= IMAGE_PATH . 'hallapi/' . @$imgall[$i];
                    }
                }
            }
        }

        // checking if checkin and checkout dates are available
        $dateQuery = '';
        $checkinDate = $session->get('checkin');
        $checkoutDate = $session->get('checkout');
        if (!empty($checkinDate) and !empty($checkoutDate)) {
            $dateQuery = "&hotel_check_in=$checkinDate&hotel_check_out=$checkoutDate";
        }

        $userIdQuery = '';
        $usserId = $session->get('user_id');
        if (!empty($usserId)) {
            $userIdQuery = "&user_id=$usserId";
        }
        $adults = (!empty($session->get('adults'))) ? $session->get('adults') : 1;
        $child = (!empty($session->get('child'))) ? $session->get('child') : 0;
       
        
        $reviews = Review::find_by_package($subpkgRow->id);
        ($subpkgRow->hall_size_label == 'feet')? $hallabel = ' sq.ft.': $hallabel =' sq.m.';

        $hall .='
        
        <div class=" row my-4">
        <div class="col-lg-5 col-md-6 col-sm-6">
            <div class="grid-image">
                <img src="'.$images.'" alt="image">
            </div>
        </div>

        <div class="col-lg-7 col-md-6 col-sm-6">
            <div class="grid-content">
                <div class="hall-title">
                    <h4>'.$subpkgRow->title.'</h4>
                    <a href="'.BASE_URL.'hotel/'.$hotelslug.'"><small>'.$hallproperty.'</small></a>
                    <div class="room-services">
                    <ul>';
                    $hall.=  ($subpkgRow->max_people!=0) ? '<li>Capacity:'.$subpkgRow->max_people.' pax</li>
                        <li>|</li>' : '';
                    $hall.=  ($subpkgRow->hall_size!=0) ? ' <li>Area: '.$subpkgRow->hall_size.' '.$hallabel.'</li>
                        <li>|</li>':'';
                    $hall.=  ($subpkgRow->no_hall!=0) ? ' <li>Dimension: '.$subpkgRow->no_hall.' sq.ft.</li>
                        <li>|</li>':'';
                    $hall.=  ($subpkgRow->max_child!=0) ? ' <li>Height: '.$subpkgRow->max_child.' ft.</li>':'';
        $hall.='
                    </ul>
                    </div>
                </div>

                <div class="room-detail">
                '.$subpkgRow->detail.'
                </div>
                
                <div class="grid-btn mar-top-20">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h5>Seating Style</h5>
                        </div>
                    
                        <div class="col-lg-12 col-md-6">
                        <ul class="row">';
                        $hall.=($subpkgRow->seat_a != '-')?'<li class="col-md-4 col-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/theatre.svg"></div>
                                    <div class="flex-grow-1 ms-3">
                                        <small><strong>Theatre:</strong> <br> '.$subpkgRow->seat_a.' pax</small>
                                    </div>
                                </div>    
                            </li>':''; 
                        $hall.=($subpkgRow->seat_b != '-')?'<li class="col-md-4 col-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/circular.svg"></div>
                                    <div class="flex-grow-1 ms-3">
                                        <small><strong>Circular:</strong> <br> '.$subpkgRow->seat_b.' pax</small>
                                    </div>
                                </div> 
                           </li>':''; 
                           $hall.=($subpkgRow->seat_c != '-')? '
                            <li class="col-md-4 col-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/ushape.svg"></div>
                                    <div class="flex-grow-1 ms-3">
                                        <small><strong>U-shaped:</strong> <br> '.$subpkgRow->seat_c.' pax</small>
                                    </div>
                                </div> 
                            </li>':''; 
                            $hall.=($subpkgRow->seat_d != '-')? '
                        
                            <li class="col-md-4 col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/classroom.svg"></div>
                                <div class="flex-grow-1 ms-3">
                                    <small><strong>Classroom:</strong> <br> '.$subpkgRow->seat_d.' pax</small>
                                </div>
                            </div> 
                        </li>':''; 
                            $hall.=($subpkgRow->seat_e != '-')? '
                            <li class="col-md-4 col-6 mb-3">
                            <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/board.svg"></div>
                                    <div class="flex-grow-1 ms-3">
                                        <small><strong>Sit-down:</strong> <br> '.$subpkgRow->seat_e.' pax</small>
                                    </div>
                                </div> 
                            </li>
                           ':''; 
                            $hall.=($subpkgRow->seat_f != '-')? '
                            <li class="col-md-4 col-6 mb-3"><div class="d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/reception.svg"></div>
                                    <div class="flex-grow-1 ms-3">
                                        <small><strong>Reception:</strong> <br> '.$subpkgRow->seat_f.' pax</small>
                                    </div>
                                </div> 
                          </li>':''; 
                          $hall.= '</ul>
                        </div>

                        <div class="col-lg-3 col-md-6 mar-top-25">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Enquiry</button>
                        </div>
                    </div>
                </div>
            </div>
        
        </div> </div>';
        $hallmod='
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Enquiry Mail</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body hall-enquiry45">
                  <div class="container-xxl px-12">
                  <div class="col-md-12">
                      <div id="contact-form" class="contact-form">
                          
                          <div id="contactform-error-msg"></div>
      
                          <form method="post" action="enquery_mail.php" name="contactform" id="frm_contact">
                              <div class="form-group">
                                  <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                              </div>
                              <div class="form-group">
                                  <input type="hidden" name="hall" class="form-control" id="hall" value="'.$subpkgRow->title.'"placeholder="Name">
                              </div>
                              <div class="form-group">
                              <input type="hidden" name="property" class="form-control" id="property" value="'.$hallproperty.'"placeholder="Name">
                          </div>
                          <div class="form-group">
                              <input type="hidden" name="meetemail" class="form-control" id="meetemail" value="'.$hallmail.'"placeholder="Name">
                          </div>
                              <div class="form-group">
                                  <input type="email" name="email"  class="form-control" id="email" placeholder="Email">
                              </div>
      
                              <div class="form-group">
                                  <input type="text" name="phone" class="form-control" id="number" placeholder="Phone">
                              </div>
      
                              <div class="textarea">
                                  <textarea name="message" id="message" placeholder="Message"></textarea>
                              </div>
                              <div class="msg" id="msg" name="msg"></div>
                              <div class="comment-btn text-right">
                                  <input type="submit" class="btn btn-orange" id="submit" value="Enquiry Now">
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
              </div>
            </div>
          </div>
        </div>';


    }
}
else{
    $hall='there are no halls for this property';
}
    $hall_listing='
    <div class="dropdown-center text-center">
        <div class="dropdown" style="width:30%;">
            <input type="text" id="myInput" onkeyup="myFunction()" onclick="showAllOptions()" placeholder="Search by Property / Destination" title="Type in a name">
            <div class="dropdown-content dropdown-menu overflow-auto" id="myDropdown">
            '.$location.'
            </div>
        </div>
    </div>
    <div class="overview-two mar-top-50">
        <div class="room-grid"><div class="d-grid gap-5">'.$hall.'</div> </div>                
    </div>
    <nav aria-label="Page navigation example">
  <ul class="pagination">
    
  '.$dpage.'
    
  </ul>
</nav>
    ';
   
}
// pr($page);

$jVars['module:halllist'] = $hall_listing;
$jVars['module:hallmodal'] = $hallmod;






