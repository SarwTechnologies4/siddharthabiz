<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
require_once("../includes/initialize.php");
$mode  =  isset($_REQUEST['mode']) ?  $_REQUEST['mode'] : "room_type";
$code  =  isset($_REQUEST['code']) ?  $_REQUEST['code'] : "";
if(!empty($code)){
$hotel_row    =  Hotelapi::find_by_code($code);
$hotel_id   =  $hotel_row->id; 
}else{
  $arr =  array('message'=>"No rooms found!");
  die(json_encode($arr));
}
$arr =  array();
$image  =  unserialize(base64_decode($hotel_row->image));
                        $img_arr =  array();
                        if(count($image)>0){
                          foreach($image as $img){
                            if( !empty($img) and file_exists(SITE_ROOT."images/hotelapi/".$img)){
                               $img_arr[]  =  array('large'=>IMAGE_PATH."hotelapi/".$img,
                                                    'thumb'=>IMAGE_PATH."hotelapi/thumbnails/".$img
                                                    );
                                 }
                             }
                        }
$logo_image  = "";
$img  = $hotel_row->logo;
if( !empty($img) and file_exists(SITE_ROOT."images/hotelapi/logo/".$img)){
 $logo_image  =  IMAGE_PATH."hotelapi/logo/".$img;
}                        
$arr['hotel_information'] =  array('name'=>$hotel_row->title,
                                   'long_name'=>$hotel_row->long_name,
                                   'slug'=>$hotel_row->slug,
                                   'code'=>$hotel_row->code,
                                   'contact_no'=>$hotel_row->contact_no,
                                   'email'=>$hotel_row->email,
                                   'street'=>$hotel_row->street,
                                   'city'=>$hotel_row->city,
                                   'zone'=>$hotel_row->zone,
                                   'website'=>$hotel_row->website,
                                   'district'=>$hotel_row->district,
                                   'logo'=>$logo_image,
                                   'image'=>$img_arr,
                                   'detail'=>htmlentities($hotel_row->detail),
                                   'content'=>htmlentities($hotel_row->content),
                                   'contact_person'=>$hotel_row->contact_person,
                                   'contact_person_contact_no'=>$hotel_row->contact_person_contact_no,
                                   'contact_person_email'=>$hotel_row->contact_person_email,

                                   );
switch($mode):
//allroomsbyroom_type
case 'room_type':
$records  =  Roomtype::get_all($hotel_id);
if(sizeof($records)>0){
   $i=1;	
   foreach($records as $record){
   	   $type_id   =  $record->id;
       $arr['category'][$i]['id']    =  $type_id;
       $arr['category'][$i]['name']  =  $record->title;
       $arr['category'][$i]['slug']  =  $record->slug;
       $room_arr  =  array();
       $rooms  =   Roomapi::find_by_type($type_id);
       $arr['category'][$i]['has_rooms']  =  sizeof($rooms)>0 ? "yes" : "no";
             if(sizeof($rooms)>0){
				   $j=0;	
				   foreach($rooms as $room){
				   	      //pr($room);
				   	      $room_id  =  $room->id;
                          $room_arr[$j]['id']         			=  $room_id;  
                          $room_arr[$j]['title']      			=  $room->title; 
                          $room_arr[$j]['room_type_name']      	=  $record->title;
                          $room_arr[$j]['room_type_slug']      	=  $record->slug;
                          $room_arr[$j]['slug']      			=  $room->slug; 
                          $room_arr[$j]['max_people']		    =  $room->max_people;
                          $room_arr[$j]['max_child']  			=  $room->max_child;
                          $room_arr[$j]['no_rooms']   			=  $room->no_rooms;
                          $room_arr[$j]['room_size'] 	        =  $room->room_size;
                          $room_arr[$j]['room_size_label'] 	    =  $room->room_size_label;
                          $room_arr[$j]['smoking'] 	            =  $room->smoking;
                          $room_arr[$j]['single_bed'] 	        =  $room->single_bed;
                          $room_arr[$j]['double_bed'] 	        =  $room->double_bed;
                          $room_arr[$j]['large_double'] 	    =  $room->large_double;
                          $room_arr[$j]['extra_large_double'] 	=  $room->extra_large_double;
                          $room_arr[$j]['bunk_bed'] 	        =  $room->bunk_bed;
                          $room_arr[$j]['sofa_bed'] 	        =  $room->sofa_bed;
                          $room_arr[$j]['futon_mat'] 	        =  $room->futon_mat;
                          $room_arr[$j]['extra_bed'] 	        =  $room->extra_bed;
                          $image  =  unserialize( base64_decode($room->image) );
                          $img_arr =  array();
                          if(count($image)>0){
                          	foreach($image as $img){
                          		if( !empty($img) and file_exists(SITE_ROOT."images/roomapi/".$img)){
		                             $img_arr[]  =  array('large'=>IMAGE_PATH."roomapi/".$img,
                                                      'thumb'=>IMAGE_PATH."roomapi/thumbnails/".$img
                                                      );
		                               }
                          	   }
                          }
                          $room_arr[$j]['image'] 	            =  $img_arr;
                          $banner_image  = "";
                          $img  = $room->banner_image;
                          if( !empty($img) and file_exists(SITE_ROOT."images/roomapi/banner_image/".$img)){
                           $banner_image  =  IMAGE_PATH."roomapi/banner_image/".$img;
                          }
                          $room_arr[$j]['banner_image'] 	    =  $banner_image;
                          if($room->feature!=''){
                          $feature  =  unserialize(base64_decode($room->feature));
                           }else{ $feature = array(); }
                          $feature_arr =  array();
                          
                          if(count($feature)>0){
                          	$fi=0; 
                          	foreach($feature as $key=>$val){
                          		   foreach($val as $k=>$v){
                          		   	   if($k!='id')
                          		   	   {    $fisize=0;
                          		   	   	    if($k=='features'){
                          		   	   	        $feat = array();
                          		   	   	        //pr($v);
                          		   	   	        if(is_array($v) and sizeof($v)>0){
                          		   	   	           foreach($v as $a=>$b){
                          		   	   	           	   if(isset($b['id'])){ 
                          		   	   	           	      $feat[] = array("icon_class"=>$b['icon_class'],
                          		   	   	           	      	              "title"=>$b['title']
                          		   	   	           	      	              );
                          		   	   	           	        $fisize++; 
                          		   	   	           	    }  
                                                   }
                          		   	   	        }   
                                                $feature_arr[$fi][$k]  = $feat;
                                                if($fisize=='0'){
	                          		   	        	unset($feature_arr[$fi]);
	                          		   	        } 
                          		   	        }else{
                          		   	        	$feature_arr[$fi][$k]  = $v;  
                          		   	        }   
                          		   	        
                          		   	   	}
                          		   }
                          		   $fi++;
                          	   }
                          }
                          $room_arr[$j]['feature'] 	  			=  $feature_arr;
                          $room_arr[$j]['detail'] 	  			=  $room->detail;
                          $room_arr[$j]['content'] 	  			=  htmlentities($room->content);
                          $room_arr[$j]['currency'] 	        =  $room->currency;
                          
                          $price =  array();
                          $rooms_price  =   Roomapiprice::find_by_room_id($room_id);
                          if(sizeof($rooms_price)>0){
                          	   $p=0;
                          	   foreach($rooms_price as $key=>$val){
                          	   	    $price_val  =  array('1'  => $val->one_person,
                          	   	    	                 '2'  => $val->two_person,
                          	   	    	                 '3'=> $val->three_person,
                          	   	    	                 'extra_bed'   => $val->extra_bed
                          	   	    	                 );
                          	   	    if($val->season_id=='0')
                          	   	     {
                          	   	     	$price['default']  =  $price_val;
                          	   	     }
                          	   	     else{
                          	   	     	$p++;
                          	   	     	$season_id  =   $val->season_id;
                          	   	     	$season_row =   Season::find_by_id($season_id);
                          	   	     	$price_val['season']   = $season_row->season;
                          	   	     	$price_val['date_from']= $season_row->date_from;
                          	   	     	$price_val['date_to']  = $season_row->date_to;                               
                          	   	     	$price['season'][]  =  $price_val;
                          	   	     }
                                   
                          	   }
                          }
                          $room_arr[$j]['price'] 	  			=  $price;
                          $calender_arr =  array();
                          $calender     =   Calenderbooking::find_all_by_room($room_id);
                          if(sizeof($calender)>0){
                          	   $c=0;
                          	   foreach($calender as $key=>$val){
                          	   	   $calender_arr[$val->reserve_date] = $val->no_rooms;
                          	   }
                            $room_arr[$j]['available_by_date'] 	    =  $calender_arr;
                            } 

                            $discount_arr =  array();
                          $offers     =   Roomoffers::offer_list($hotel_id,$room->room_type,$room_id);
                          if(sizeof($offers)>0){
                               foreach($offers as $key=>$val){
                                   $discount_arr[$val->date_from.'/'.$val->date_to] = $val->discount;
                               }
                               $room_arr[$j]['offers']      =  $discount_arr;
                          }
                                
				   	 $j++;
				   }
				}
		$arr['category'][$i]['rooms'] =  $room_arr;		
       $i++;
   }
}
break;
//allrooms
case 'room':
       $room_arr  =  array();
       $rooms     =   Roomapi::find_by_active_room($hotel_id);
             if(sizeof($rooms)>0){
				   $j=0;	
				   foreach($rooms as $room){
				   	      //pr($room);
				   	      $room_id  =  $room->id;
                          $room_arr[$j]['id']         			=  $room_id;  
                          $room_arr[$j]['title']      			=  $room->title; 
                          $record  =  Roomtype::find_by_id($room->room_type);
                          $room_arr[$j]['room_type_name']      	=  $record->title;
                          $room_arr[$j]['room_type_slug']      	=  $record->slug;
                          $room_arr[$j]['slug']      			=  $room->slug; 
                          $room_arr[$j]['max_people']		    =  $room->max_people;
                          $room_arr[$j]['max_child']  			=  $room->max_child;
                          $room_arr[$j]['no_rooms']   			=  $room->no_rooms;
                          $room_arr[$j]['room_size'] 	        =  $room->room_size;
                          $room_arr[$j]['room_size_label'] 	    =  $room->room_size_label;
                          $room_arr[$j]['smoking'] 	            =  $room->smoking;
                          $room_arr[$j]['single_bed'] 	        =  $room->single_bed;
                          $room_arr[$j]['double_bed'] 	        =  $room->double_bed;
                          $room_arr[$j]['large_double'] 	    =  $room->large_double;
                          $room_arr[$j]['extra_large_double'] 	=  $room->extra_large_double;
                          $room_arr[$j]['bunk_bed'] 	        =  $room->bunk_bed;
                          $room_arr[$j]['sofa_bed'] 	        =  $room->sofa_bed;
                          $room_arr[$j]['futon_mat'] 	        =  $room->futon_mat;
                          $room_arr[$j]['extra_bed'] 	        =  $room->extra_bed;
                          $image  =  unserialize( base64_decode($room->image) );
                          $img_arr =  array();
                          if(count($image)>0){
                          	foreach($image as $img){
                          		if( !empty($img) and file_exists(SITE_ROOT."images/roomapi/".$img)){
		                             $img_arr[]  =  array('large'=>IMAGE_PATH."roomapi/".$img,
                                                      'thumb'=>IMAGE_PATH."roomapi/thumbnails/".$img
                                                      );
		                          }
                          	   }
                          }
                          $room_arr[$j]['image'] 	            =  $img_arr;
                          $banner_image  = "";
                          $img  = $room->banner_image;
                          if( !empty($img) and file_exists(SITE_ROOT."images/roomapi/banner_image/".$img)){
                           $banner_image  =  IMAGE_PATH."roomapi/banner_image/".$img;
                          }
                          $room_arr[$j]['banner_image'] 	    =  $banner_image;
                          if($room->feature!=''){
                          $feature  =  unserialize(base64_decode($room->feature));
                           }else{ $feature = array(); }
                          $feature_arr =  array();
                          
                          if(count($feature)>0){
                          	$fi=0; 
                          	foreach($feature as $key=>$val){
                          		   foreach($val as $k=>$v){
                          		   	   if($k!='id')
                          		   	   {    $fisize=0;
                          		   	   	    if($k=='features'){
                          		   	   	        $feat = array();
                          		   	   	        //pr($v);
                          		   	   	        if(is_array($v) and sizeof($v)>0){
                          		   	   	           foreach($v as $a=>$b){
                          		   	   	           	   if(isset($b['id'])){ 
                          		   	   	           	      $feat[] = array("icon_class"=>$b['icon_class'],
                          		   	   	           	      	              "title"=>$b['title']
                          		   	   	           	      	              );
                          		   	   	           	        $fisize++; 
                          		   	   	           	    }  
                                                   }
                          		   	   	        }   
                                                $feature_arr[$fi][$k]  = $feat;
                                                if($fisize=='0'){
	                          		   	        	unset($feature_arr[$fi]);
	                          		   	        } 
                          		   	        }else{
                          		   	        	$feature_arr[$fi][$k]  = $v;  
                          		   	        }   
                          		   	        
                          		   	   	}
                          		   }
                          		   $fi++;
                          	   }
                          }
                          $room_arr[$j]['feature'] 	  			=  $feature_arr;
                          $room_arr[$j]['detail'] 	  			=  $room->detail;
                          $room_arr[$j]['content'] 	  			=  htmlentities($room->content);
                          $room_arr[$j]['currency'] 	        =  $room->currency;
                          
                          $price =  array();
                          $rooms_price  =   Roomapiprice::find_by_room_id($room_id);
                          if(sizeof($rooms_price)>0){
                          	   $p=0;
                          	   foreach($rooms_price as $key=>$val){
                          	   	    $price_val  =  array('1'  => $val->one_person,
                                                       '2'  => $val->two_person,
                                                       '3'=> $val->three_person,
                                                       'extra_bed'   => $val->extra_bed
                                                       );
                          	   	    if($val->season_id=='0')
                          	   	     {
                          	   	     	$price['default']  =  $price_val;
                          	   	     }
                          	   	     else{
                          	   	     	$p++;
                          	   	     	$season_id  =   $val->season_id;
                          	   	     	$season_row =   Season::find_by_id($season_id);
                          	   	     	$price_val['season']   = $season_row->season;
                          	   	     	$price_val['date_from']= $season_row->date_from;
                          	   	     	$price_val['date_to']  = $season_row->date_to;                           
                          	   	     	$price['season'][]     =  $price_val;
                          	   	     }
                                   
                          	   }
                          }
                          $room_arr[$j]['price'] 	  			=  $price;
                          $calender_arr =  array();
                          $calender     =   Calenderbooking::find_all_by_room($room_id);
                          if(sizeof($calender)>0){
                          	   $c=0;
                          	   foreach($calender as $key=>$val){
                          	   	   $calender_arr[$val->reserve_date] = $val->no_rooms;
                          	   }
                            $room_arr[$j]['available_by_date'] 	    =  $calender_arr;
                            } 

                          $discount_arr =  array();
                          $offers     =   Roomoffers::offer_list($hotel_id,$room->room_type,$room_id);
                          if(sizeof($offers)>0){
                               foreach($offers as $key=>$val){
                                   $discount_arr[$val->date_from.'/'.$val->date_to] = $val->discount;
                               }
                               $room_arr[$j]['offers']      =  $discount_arr;
                          } 
                                
				   	 $j++;
				   }
				}
				$arr['room']  =  $room_arr;			
break;

case 'room_type_detail':
      $id   =  $_REQUEST['id'];
       if(is_numeric($id)){ $record  =  Roomtype::find_by_id_type($hotel_id,$id);
       }else{  $record     =   Roomtype::find_by_slug_type($hotel_id,$id); }
       if($record){
       $type_id      =  $record->id;
       $arr['id']    =  $type_id;
       $arr['name']  =  $record->title;
       $arr['slug']  =  $record->slug;
       $room_arr  =  array();
       $rooms  =   Roomapi::find_by_type($type_id);
       $arr['has_rooms']  =  sizeof($rooms)>0 ? "yes" : "no";
             if(sizeof($rooms)>0){
				   $j=0;	
				   foreach($rooms as $room){
				   	      //pr($room);
				   	      $room_id  =  $room->id;
                          $room_arr[$j]['id']         			=  $room_id;  
                          $room_arr[$j]['title']      			=  $room->title; 
                          $room_arr[$j]['room_type_name']      	=  $record->title;
                          $room_arr[$j]['room_type_slug']      	=  $record->slug;
                          $room_arr[$j]['slug']      			=  $room->slug; 
                          $room_arr[$j]['max_people']		    =  $room->max_people;
                          $room_arr[$j]['max_child']  			=  $room->max_child;
                          $room_arr[$j]['no_rooms']   			=  $room->no_rooms;
                          $room_arr[$j]['room_size'] 	        =  $room->room_size;
                          $room_arr[$j]['room_size_label'] 	    =  $room->room_size_label;
                          $room_arr[$j]['smoking'] 	            =  $room->smoking;
                          $room_arr[$j]['single_bed'] 	        =  $room->single_bed;
                          $room_arr[$j]['double_bed'] 	        =  $room->double_bed;
                          $room_arr[$j]['large_double'] 	    =  $room->large_double;
                          $room_arr[$j]['extra_large_double'] 	=  $room->extra_large_double;
                          $room_arr[$j]['bunk_bed'] 	        =  $room->bunk_bed;
                          $room_arr[$j]['sofa_bed'] 	        =  $room->sofa_bed;
                          $room_arr[$j]['futon_mat'] 	        =  $room->futon_mat;
                          $room_arr[$j]['extra_bed'] 	        =  $room->extra_bed;
                          $image  =  unserialize( base64_decode($room->image) );
                          $img_arr =  array();
                          if(count($image)>0){
                          	foreach($image as $img){
                          		if( !empty($img) and file_exists(SITE_ROOT."images/roomapi/".$img)){
		                             $img_arr[]  =  array('large'=>IMAGE_PATH."roomapi/".$img,
                                                      'thumb'=>IMAGE_PATH."roomapi/thumbnails/".$img
                                                      );
		                          }
                          	   }
                          }
                          $room_arr[$j]['image'] 	            =  $img_arr;
                          $banner_image  = "";
                          $img  = $room->banner_image;
                          if( !empty($img) and file_exists(SITE_ROOT."images/roomapi/banner_image/".$img)){
                           $banner_image  =  IMAGE_PATH."roomapi/banner_image/".$img;
                          }
                          $room_arr[$j]['banner_image'] 	    =  $banner_image;
                          if($room->feature!=''){
                          $feature  =  unserialize(base64_decode($room->feature));
                           }else{ $feature = array(); }
                          $feature_arr =  array();
                          
                          if(count($feature)>0){
                          	$fi=0; 
                          	foreach($feature as $key=>$val){
                          		   foreach($val as $k=>$v){
                          		   	   if($k!='id')
                          		   	   {    $fisize=0;
                          		   	   	    if($k=='features'){
                          		   	   	        $feat = array();
                          		   	   	        //pr($v);
                          		   	   	        if(is_array($v) and sizeof($v)>0){
                          		   	   	           foreach($v as $a=>$b){
                          		   	   	           	   if(isset($b['id'])){ 
                          		   	   	           	      $feat[] = array("icon_class"=>$b['icon_class'],
                          		   	   	           	      	              "title"=>$b['title']
                          		   	   	           	      	              );
                          		   	   	           	        $fisize++; 
                          		   	   	           	    }  
                                                   }
                          		   	   	        }   
                                                $feature_arr[$fi][$k]  = $feat;
                                                if($fisize=='0'){
	                          		   	        	unset($feature_arr[$fi]);
	                          		   	        } 
                          		   	        }else{
                          		   	        	$feature_arr[$fi][$k]  = $v;  
                          		   	        }   
                          		   	        
                          		   	   	}
                          		   }
                          		   $fi++;
                          	   }
                          }
                          $room_arr[$j]['feature'] 	  			=  $feature_arr;
                          $room_arr[$j]['detail'] 	  			=  $room->detail;
                          $room_arr[$j]['content'] 	  			=  htmlentities($room->content);
                          $room_arr[$j]['currency'] 	        =  $room->currency;
                          
                          $price =  array();
                          $rooms_price  =   Roomapiprice::find_by_room_id($room_id);
                          if(sizeof($rooms_price)>0){
                          	   $p=0;
                          	   foreach($rooms_price as $key=>$val){
                          	   	    $price_val  =  array('1'  => $val->one_person,
                                                       '2'  => $val->two_person,
                                                       '3'=> $val->three_person,
                                                       'extra_bed'   => $val->extra_bed
                                                       );
                          	   	    if($val->season_id=='0')
                          	   	     {
                          	   	     	$price['default']  =  $price_val;
                          	   	     }
                          	   	     else{
                          	   	     	$p++;
                          	   	     	$season_id  =   $val->season_id;
                          	   	     	$season_row =   Season::find_by_id($season_id);
                          	   	     	$price_val['season']   = $season_row->season;
                          	   	     	$price_val['date_from']= $season_row->date_from;
                          	   	     	$price_val['date_to']  = $season_row->date_to;                               
                          	   	     	$price['season'][]  =  $price_val;
                          	   	     }
                                   
                          	   }
                          }
                          $room_arr[$j]['price'] 	  			=  $price;
                          $calender_arr =  array();
                          $calender     =   Calenderbooking::find_all_by_room($room_id);
                          if(sizeof($calender)>0){
                          	   $c=0;
                          	   foreach($calender as $key=>$val){
                          	   	   $calender_arr[$val->reserve_date] = $val->no_rooms;
                          	   }
                            $room_arr[$j]['available_by_date'] 	    =  $calender_arr;
                            } 

                          $discount_arr =  array();
                          $offers     =   Roomoffers::offer_list($hotel_id,$room->room_type,$room_id);
                          if(sizeof($offers)>0){
                               foreach($offers as $key=>$val){
                                   $discount_arr[$val->date_from.'/'.$val->date_to] = $val->discount;
                               }
                               $room_arr[$j]['offers']      =  $discount_arr;
                          }
                                
				   	 $j++;
				   }
				}
    unset($arr['hotel_information']);    
		$arr['rooms'] =  $room_arr;			
	
	}else {$arr =  array('message'=>"No rooms found!");	}		
			
break;

case 'room_detail':
       $id   =  $_REQUEST['id'];
       $room_arr  =  array();
       if(is_numeric($id)){ $room     =   Roomapi::find_by_id_type($hotel_id,$id);
       }else{  $room     =   Roomapi::find_by_slug_type($hotel_id,$id); }
       if($room){
             	   	      //pr($room);
				   	      $room_id  =  $room->id;
                          $room_arr['id']         			=  $room_id;  
                          $room_arr['title']      			=  $room->title; 
                          $record  =  Roomtype::find_by_id($room->room_type);
                          $room_arr['room_type_name']      	=  $record->title;
                          $room_arr['room_type_slug']      	=  $record->slug;
                          $room_arr['slug']      			=  $room->slug; 
                          $room_arr['max_people']		    =  $room->max_people;
                          $room_arr['max_child']  			=  $room->max_child;
                          $room_arr['no_rooms']   			=  $room->no_rooms;
                          $room_arr['room_size'] 	        =  $room->room_size;
                          $room_arr['room_size_label'] 	    =  $room->room_size_label;
                          $room_arr['smoking'] 	            =  $room->smoking;
                          $room_arr['single_bed'] 	        =  $room->single_bed;
                          $room_arr['double_bed'] 	        =  $room->double_bed;
                          $room_arr['large_double'] 	    =  $room->large_double;
                          $room_arr['extra_large_double'] 	=  $room->extra_large_double;
                          $room_arr['bunk_bed'] 	        =  $room->bunk_bed;
                          $room_arr['sofa_bed'] 	        =  $room->sofa_bed;
                          $room_arr['futon_mat'] 	        =  $room->futon_mat;
                          $room_arr['extra_bed'] 	        =  $room->extra_bed;
                          $image  =  unserialize( base64_decode($room->image) );
                          $img_arr =  array();
                          if(count($image)>0){
                          	foreach($image as $img){
                          		if( !empty($img) and file_exists(SITE_ROOT."images/roomapi/".$img)){
		                             $img_arr[]  =  array('large'=>IMAGE_PATH."roomapi/".$img,
                                                      'thumb'=>IMAGE_PATH."roomapi/thumbnails/".$img
                                                      );
		                          }
                          	   }
                          }
                          $room_arr['image'] 	            =  $img_arr;
                          $banner_image  = "";
                          $img  = $room->banner_image;
                          if( !empty($img) and file_exists(SITE_ROOT."images/roomapi/banner_image/".$img)){
                           $banner_image  =  IMAGE_PATH."roomapi/banner_image/".$img;
                          }
                          $room_arr['banner_image'] 	    =  $banner_image;
                          if($room->feature!=''){
                          $feature  =  unserialize(base64_decode($room->feature));
                           }else{ $feature = array(); }
                          $feature_arr =  array();
                          
                          if(count($feature)>0){
                          	$fi=0; 
                          	foreach($feature as $key=>$val){
                          		   foreach($val as $k=>$v){
                          		   	   if($k!='id')
                          		   	   {    $fisize=0;
                          		   	   	    if($k=='features'){
                          		   	   	        $feat = array();
                          		   	   	        //pr($v);
                          		   	   	        if(is_array($v) and sizeof($v)>0){
                          		   	   	           foreach($v as $a=>$b){
                          		   	   	           	   if(isset($b['id'])){ 
                          		   	   	           	      $feat[] = array("icon_class"=>$b['icon_class'],
                          		   	   	           	      	              "title"=>$b['title']
                          		   	   	           	      	              );
                          		   	   	           	        $fisize++; 
                          		   	   	           	    }  
                                                   }
                          		   	   	        }   
                                                $feature_arr[$fi][$k]  = $feat;
                                                if($fisize=='0'){
	                          		   	        	unset($feature_arr[$fi]);
	                          		   	        } 
                          		   	        }else{
                          		   	        	$feature_arr[$fi][$k]  = $v;  
                          		   	        }   
                          		   	        
                          		   	   	}
                          		   }
                          		   $fi++;
                          	   }
                          }
                          $room_arr['feature'] 	  			=  $feature_arr;
                          $room_arr['detail'] 	  			=  $room->detail;
                          $room_arr['content'] 	  			=  htmlentities($room->content);
                          $room_arr['currency'] 	        =  $room->currency;
                          
                          $price =  array();
                          $rooms_price  =   Roomapiprice::find_by_room_id($room_id);
                          if(sizeof($rooms_price)>0){
                          	   $p=0;
                          	   foreach($rooms_price as $key=>$val){
                          	   	    $price_val  =  array('1'  => $val->one_person,
                                                       '2'  => $val->two_person,
                                                       '3'=> $val->three_person,
                                                       'extra_bed'   => $val->extra_bed
                                                       );
                          	   	    if($val->season_id=='0')
                          	   	     {
                          	   	     	$price['default']  =  $price_val;
                          	   	     }
                          	   	     else{
                          	   	     	$p++;
                          	   	     	$season_id  =   $val->season_id;
                          	   	     	$season_row =   Season::find_by_id($season_id);
                          	   	     	$price_val['season']   = $season_row->season;
                          	   	     	$price_val['date_from']= $season_row->date_from;
                          	   	     	$price_val['date_to']  = $season_row->date_to;                           
                          	   	     	$price['season'][]     =  $price_val;
                          	   	     }
                                   
                          	   }
                          }
                          $room_arr['price'] 	  			=  $price;
                          $calender_arr =  array();
                          $calender     =   Calenderbooking::find_all_by_room($room_id);
                          if(sizeof($calender)>0){
                          	   $c=0;
                          	   foreach($calender as $key=>$val){
                          	   	   $calender_arr[$val->reserve_date] = $val->no_rooms;
                          	   }
                            $room_arr['available_by_date'] 	    =  $calender_arr;
                            }  

                          $discount_arr =  array();
                          $offers     =   Roomoffers::offer_list($hotel_id,$room->room_type,$room_id);
                          if(sizeof($offers)>0){
                               foreach($offers as $key=>$val){
                                   $discount_arr[$val->date_from.'/'.$val->date_to] = $val->discount;
                               }
                               $room_arr['offers']      =  $discount_arr;
                          }                             
				unset($arr['hotel_information']);   	
				$arr['rooms'] =   $room_arr;	
	}else {$arr =  array('message'=>"No detail found!");	}						
break;

default:
   $arr =  array('message'=>"No rooms found!");
break;

endswitch;
die(json_encode($arr));
?>