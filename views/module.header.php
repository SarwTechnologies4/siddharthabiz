<?php
$siteRegulars = Config::find_by_id(1);
$contact_no = Hotelapi::find_all('hotel_page', true);
$dest_no = Destination::find_all('hotel_page', true);
$userId = $session->get("user_id");
$tellinked = '';
    $telno = explode(",", $siteRegulars->contact_info);
    foreach ($telno as $tel) {
        $tellinked .= '<a href="tel:' . $tel . '" target="_blank">' . $tel . '</a><br>';
    }
$all_contact='';
$desti='';
// pr($contact_no);

foreach($contact_no as $cont){
    $t = Destination::find_by_id($cont->destinationId);
    $cont_link = '';
    $rec = explode(',', $cont->contact_no);
    $i = 1;
    foreach($rec as $cont_ind){
        if($i>1){
            $cont_link .= " / ";
        }
        $cont_link .= '<a href="tel:'.$cont_ind.'">'.$cont_ind.'</a>';
        $i++;
    }
    $all_contact .='<li><a class="dropdown-item" href="#"><small>'. $cont_link.' <span class="d-block">('.$t->title.')</span></small></a></li>';
}
if(!empty($userId)){
    $dash='<div class="btn-group"> <a class="btn btn-sm btn-primary" href="' . BASE_URL . 'dashboard">Profile</a> <a href="#" id="lout" class="log-out-btn color-bg btn btn-sm btn-primary">Log Out</a></div>';
}
else
{
    $dash='<a href="#" class="modal-open btn btn-primary btn-sm" id="signinn" data-toggle="modal" data-target="#login"><i class="fa fa-user" aria-hidden="true"></i> Sign In</a>';
}

//pr($desti);
?>
    
<?php


$header = '
<header id="header">
        <div class="head">
            <div class="container d-flex  ">
                <a href="'.BASE_URL.'" class="d-flex align-items-center mb-md-3 mb-lg-0 me-lg-5 text-dark text-decoration-none">
                    <img alt="Image" src="' . IMAGE_PATH . '/preference/' .  $siteRegulars->logo_upload .'" class="logo-black">
                </a>

                <nav class="navbar navbar-expand-lg d-flex flex-column justify-content-between flex-fill align-items-end">
                    <div class="text-end">
                        <div class="btn-group">
                            <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                            ' .  $siteRegulars->contact_phone .' 
                            </button>
                            <ul class="dropdown-menu cstm_height">
                            '.$all_contact.'
                            </ul>
                        </div>
                        '.$dash.'
                        
                    </div>
                    <div class="d-lg-flex d-none me-auto">'. $jVars['module:res-menu'] .'</div>
                    

                    <!-- mobile menu -->
                    <div class="d-block d-lg-none">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse mobmenu p-4" id="navbarNavDarkDropdown">
                        '. $jVars['module:res-menu'] .'    
                        
                        </div>
                    </div>
                    <!-- mobile menu end -->
                </nav>
            </div>
        </div>
           
        <div class="hotel_menu py-5">
            <div class="container">
            <a href="javascript:void(0);" class="closemenu" ><img src="'.BASE_URL.'template/nepalhotel/images/icon/close.png" alt="Close" width="40px" /></a>
                <div class="menunav pt-5">'.$jVars['module:hmenu'].'</div>

              
            </div>
        </div>
    </header>

    
    
    ';
$jVars['module:header'] = $header;