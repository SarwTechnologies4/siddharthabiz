<?php 
/*
* Hotel detail by Slug
*/
$resbread=$reshotel='';

if(defined('HOTELDETAIL_PAGE') and !empty($_REQUEST['slug'])) {
	$slug = addslashes($_REQUEST['slug']);
	$recRow = Hotelapi::find_by_slug($slug);
	if(!empty($recRow)) {
		$imgall = unserialize(base64_decode($recRow->image));
		$images='';
		if(is_array($imgall)) {
			for($i=0; $i <count($imgall); $i++) { 
				if ($i != count($imgall)-1) {
				if(file_exists(SITE_ROOT."images/hotelapi/".@$imgall[$i])) {
					$images.=IMAGE_PATH.'hotelapi/'.$imgall[$i].',';
					}
				}
				else{
					if(file_exists(SITE_ROOT."images/hotelapi/".@$imgall[$i])) {
					$images.=IMAGE_PATH.'hotelapi/'.@$imgall[$i];
					}
				}
			}
				  
				 
		}
		$resbread.=' <div class="theme-hero-area">
		<div class="theme-hero-area-bg-wrap">
		  <div class="theme-hero-area-bg ws-action" style="background-image:url('.IMAGE_PATH.'hotelapi/'.$imgall[0].');" data-parallax="true"></div>
		  <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
		</div>
		<div class="theme-hero-area-body">
		  <div class="container">
			<div class="theme-item-page-header _pb-50 _pt-150 theme-item-page-header-white">
			  <div class="theme-item-page-header-body">
				<div class="theme-item-page-header-rating">
			 
				
				</div>
				<h1 class="theme-item-page-header-title">'.$recRow->title.'</h1>
				<ul class="theme-breadcrumbs">
				  <li>
					<p class="theme-breadcrumbs-item-title">
					  <a href="'.BASE_URL.'">Home</a>
					</p>
				  </li>
				  <li>
					<p class="theme-breadcrumbs-item-title">
					  <a href="#">'.$recRow->title.'</a>
					</p>
				  
				  </li>
				  <li>
					<p class="theme-breadcrumbs-item-title">
					  <a href="#">Hotel Detail</a>
					</p>
				   
				  </li>
				</ul>
				<a class="btn _tt-uc _ls-0 _mt-30 _p-15 magnific-gallery-link btn-default btn-white" data-items="'.$images.'" href="#">
				  <i class="btn-icon fa fa-camera"></i>Show Photos
				</a>
			  </div>
			</div>
		  </div>
		</div>
	  </div>';

		// Hotel Detail
		
		$reshotel.='<div class="col-md-8">
		<div class="theme-item-page-tabs _mt-mob-30">
		<div class="tabbable">
		  <ul class="nav nav-tabs nav-white nav-no-br nav-sqr nav-mob-inline" role="tablist">';
		  $reshotel.='<li class="active"><a href="#hotel-description" data-toggle="tab">Description</a></li>
		  <li><a href="#hotel-amenities" data-toggle="tab">Amenities</a></li>';
	
	$reshotel.='</ul>
		  <div class="tab-content _p-30 _bg-w _bsh-xl">
		  <div class="tab-pane fade in active" id="hotel-description">
			 
			  <div class="long-description">';
				  $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->content));	
				  $content = implode(" ", $content);
				  $reshotel.= $content;
			  $reshotel.='</div>
		  </div>
		  
		  <div class="tab-pane fade" id="hotel-amenities">';
			  $rtypRec = Roomtype::get_all($recRow->id);

			  // echo '<pre>';
			  // print_r($rtypRec);

			  if(!empty($rtypRec)) {
				  foreach($rtypRec as $rtRow) {		                                		
					  $room     =   Roomapi::find_by_id_type($rtRow->hotel_id, $rtRow->id);
					  if(!empty($room)) {
						  if($room->feature!='') {
						  $reshotel.='<h4 >'.$room->title.'</h2>';														
							  $feature  =  unserialize(base64_decode($room->feature));
							  $reshotel.='<ul class="amenities list-group "  style="column-count: 2;">';	                                        
							  foreach($feature as $key=>$val) {															
								  foreach($val['features'] as $k=>$v) {																															
									  if(array_key_exists('id', $v)) {
										  if($k!='id') {
											  $reshotel.='<li class=" list-group-item ">
												  <div class="icon-box style1"><i class="'.$v['icon_class'].'"></i>&nbsp;&nbsp; '.$v['title'].'</div>
											  </li>';
										  }
									  }																
								  }
							  }
							  $reshotel.='</ul>';
						  }
					  }
				  }
			  }
			  
		  $reshotel.='</div>
		  </div>
		  </div>
		  
		  </div>
		  </div>
		  <div class="col-md-4">
		  <div class="sticky-col _mob-h">
		  <div class="theme-search-area theme-search-area-white theme-search-area-vert">
		  <h3 class="text-center">Hotel Informations</h3>
		  <table class="table mt-20">
		  <tbody>
		 <!-- <tr>
			  <th width="40%">Hotel type:</th>
			  <td width="60%" class="red">4 star</td>
		  </tr>       -->             
		  <tr>
			  <th width="40%">Contact No :</th>
			  <td width="60%" class="red">'.$recRow->contact_no.'</td>
		  </tr>
		  <tr>
			  <th width="40%">Email :</th>
			  <td width="60%" class="red">'.$recRow->email.'</td>
		  </tr>
		  <tr>
			  <th width="40%">Street :</th>
			  <td width="60%" class="red">'.$recRow->street.'</td>
		  </tr>
		  <tr>
			  <th width="40%">City :</th>
			  <td width="60%" class="red">'.$recRow->city.'</td>
		  </tr> 
		  <tr>
			  <th>Zone :</th>
			  <td class="red">'.$recRow->zone.'</td>
		  </tr>
		  <tr>
			  <th>District :</th>
			  <td class="red">'.$recRow->district.'</td>
		  </tr>
		  <tr>
		  <th>Website :</th>
		  <td class="red">'.$recRow->website.'</td>
	  </tr>
	  </tbody></table>
	  <a href="'.BASE_URL.'result.php?hotel_code='.$recRow->code.'"><button class="theme-search-area-submit _mt-0 _tt-uc">Book Now</button></a>
		  </div>
		  
		</div>
			  
		  </div>
	  </div>
		  </div>';


	
	}
}

$jVars['module:hotelbreadcrumb'] = $resbread;
$jVars['module:hoteldetails'] = $reshotel;
