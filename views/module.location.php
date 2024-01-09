<?php
$result='';

$configRec  = Config::find_by_id(1);
if($configRec):
    $result.= ($configRec->location_type==1)?'<iframe src="'.$configRec->location_map.'" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>':'<img src="'.IMAGE_PATH.'preference/locimage/'.$configRec->location_image .'" alt="'.$configRec->sitetitle.'">';
else:
    $result.= '404';
endif;

$jVars['module:officeLocation'] = $result;

/*
* Footer brief
*/
$resftb='';

$resftb.= $configRec->breif;

$jVars['module:footerBrief'] = $resftb;

/*
* Contact Form Location Info
*/
$reslocinfo= '';

$reslocinfo.='<ul class="contact-list">
<li><i class=" lin lin-location-pin"></i>&nbsp; '.$siteRegulars->fiscal_address.'</li>
<li><i class=" lin lin-phone"></i>&nbsp;<a href="tel:'.$siteRegulars->contact_info.'">'.$siteRegulars->contact_info.'</a></li>
<li><i class=" lin lin-envelope"></i>&nbsp;<a href="mailto:'.$siteRegulars->email_address.'">'.$siteRegulars->email_address.'</a></li>
</ul>';

$jVars['module:locationinfo'] = $reslocinfo;


$rescnts= '';

$rescnts.='  <ul  class="footer-contacts fl-wrap">
                                            <li><span><i class="fal fa-envelope"></i> Mail :</span><a href="mailto:'.$siteRegulars->email_address.'" target="_blank">'.$siteRegulars->email_address.'</a></li>
                                            <li> <span><i class="fal fa-map-marker-alt"></i> Address :</span><a href="" target="_blank">'.$siteRegulars->fiscal_address.'</a></li>
                                            <li><span><i class="fal fa-phone"></i> Phone :</span><a href="tel:'.$siteRegulars->contact_info.'">'.$siteRegulars->contact_info.'</a></li>
                                        </ul>';

$jVars['module:footer-contactinfo'] = $rescnts;


$t='';
$t.=' <div class="customer-support-widget fl-wrap">
                                    <h4>Customer support : </h4>
                                    <a href="tel:'.$siteRegulars->contact_info.'" class="cs-mumber">'.$siteRegulars->contact_info.'</a>
                                    <a href="tel:'.$siteRegulars->contact_info.'" class="cs-mumber-button color2-bg">Call Now <i class="far fa-phone-volume"></i></a>
                                </div>
                               ';

$jVars['module:customersupport'] = $t;


$contacts='';

$contacts.=' <div class="box-widget-list mar-top">
                                <ul>
                                    <li><span><i class="fal fa-map-marker"></i> Address :</span> <a href="#">'.$siteRegulars->fiscal_address.'</a></li>
                                    <li><span><i class="fal fa-phone"></i> Phone :</span> <a href="tel:'.$siteRegulars->contact_info.'">+'.$siteRegulars->contact_info.'</a></li>
                                    <li><span><i class="fal fa-envelope"></i> Mail :</span> <a href="mailto:'.$siteRegulars->email_address.'">'.$siteRegulars->email_address.'</a></li>
                                </ul>
                            </div>';
$jVars['module:contactsinfo'] = $contacts;

?>