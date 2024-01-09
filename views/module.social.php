<?php
/*
* Social link module
*/

$socialRec = SocialNetworking::getSocialNetwork();

// Header Social link
$hdresult='' ;

if($socialRec):
$hdresult.='<ul class="quick-menu pull-right">';    
    foreach($socialRec as $socialRow):
	$hdresult.='<li class="">
		<a target="_blank" href="'.$socialRow->linksrc.'" title="'.$socialRow->title.'" data-toggle="tooltip">
			<i class="'.$socialRow->image.'"></i>
		</a>
	</li>';
	endforeach;
$hdresult.='</ul>';
endif;

$jVars['module:header-sociaLink'] = $hdresult;

// float Social link
$hdresult1='' ;

if($socialRec):
$hdresult1.='<ul class="theme-footer-section-list list-inline social"><strong>Follow Us :</strong>';    
    foreach($socialRec as $socialRow):
	$hdresult1.='<li class="">
		<a target="_blank" href="'.$socialRow->linksrc.'" title="'.$socialRow->title.'" data-toggle="tooltip">
			<i class="fa '.$socialRow->image.'"></i>
		</a>
	</li>';
	endforeach;
$hdresult1.='</ul>';
endif;

$jVars['module:social'] = $hdresult1;


// Footer Social link
$ftresult='';


if(($socialRec)) {
	$ftresult.=' <div class="list-widget-social">
                                <ul>';
		foreach($socialRec as $socialRow) {
			$ftresult.=' <li><a target="_blank" href="'.$socialRow->linksrc.'"><i class="'.$socialRow->image.'"></i></a>
                                    </li>';
		}
		$ftresult.='</ul>
	</div>';
}

$jVars['module:sociaLink']= $ftresult;


$configRec  = Config::find_by_id(1);
$resbtn='';
if($socialRec):
	$resbtn.=' <div class="col-md-2 col-sm-6 col-xs-12">
	<div class="Rooms copyright-content">
		<h4>Connect With Us</h4>
		<ul>';
		foreach($socialRec as $socialRow):
		$resbtn.='
		<li><a href="'.$socialRow->linksrc.'" class="white"><i class="'.$socialRow->image.'" aria-hidden="true"></i></a></li>
		<li>
		';
	    endforeach;
	$resbtn.='</ul>
	</div>
</div>';
endif;
$jVars['module:socialbottom']= $resbtn;

?>