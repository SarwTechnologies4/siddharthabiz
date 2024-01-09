<?php
    $dmenu='';
    $level='';
    $property=''; 
    $userId = $session->get("user_id");
    
    $page = (isset($_REQUEST["pageno"]) and !empty($_REQUEST["pageno"]))? $_REQUEST["pageno"] : 1;
    // pr($page);
    $sql = "SELECT * FROM tbl_points WHERE user_id='$userId' ORDER BY id DESC";
   
    $limit = 5;
    $total = $db->num_rows($db->query($sql));
    // print_r($total); die();
    // pr($total);
    $startpoint = ($page * $limit) - $limit; 
    $sql.=" LIMIT ".$startpoint.",".$limit;
    $query = $db->query($sql);
    
    // pr($_SESSION);
    $rewd='';
    if (defined('DASHBOARD_PAGE')) {
    if(!empty($userId)){
        
        $rewards =  Reward::find_by_id($userId);
        $sidebar = $dmenu = '';
        $points='';
        $user = Generaluser::find_by_id($userId);
        $memeber = Hotelapi:: find_by_id($userId);
        $user_get = Generaluser::find_by_id($userId);
        $count= Level::greater_level_count($user_get->actual_point);
        $data = Level::get_level($user_get->actual_point, $count);   
        $level=($data)?$data[0]->title:'Undefined';

        $records ='';

        $user_get = Generaluser::find_by_id($userId);
        $count= Level::greater_level_count($user_get->actual_point,$count);
        $data = Level::get_level($user_get->actual_point,$count);  
        if($data){
        $records = Reward::find_by_slug($data[0]->slug);      
        }
                    if($records){             
                    foreach ($records as $key => $record){ 
                         $rewd .=' <tr id= '.$record->id.'>
                            <td>
                              
                                    '.$record->title.'
                             
                            </td>
                            <td>
                                '.$record->description.' 
                            </td>
                            <td>
                            '.$record->point.'
                            </td>
 
                            
                        </tr>';
                    }
                    

                    
// foreach($rewards as $rew){
//     $rewd .=' <tr>
//     <td>'.$rew->title.'</td>
//     <td>'.$rew->description.'</td>
//     <td>'.$rew->point.'</td>
    
// </tr>';
}
                        
    $usersInfo = Generaluser::find_by_id($userId); 
                            
    $r=Generaluser::find_by_id($userId);
    if(!empty($userId)){
        $property= Hotelapi::find_by_id($usersInfo->prop_id);
    // $property= Hotelapi::field_by_id($usersInfo->prop_id,'title');
    }
    
    if(!empty($property)){
        $hproprty=$property->title;
    }
    else{
        $hproprty='';
    }
    if($user->gender==1){
        $gen= 'Male';
    }
    elseif($user->gender==0){
        $gen='Female';
    }
    $active='';
    if($user->status==1){
        $active="Active";
    }else{
        $active="Inactive";

    }

     
                    $records = Point::find_by_sql($sql);
                    // pr($records);
                    if($records){
                    foreach ($records as $key => $record){
                        // $desId = !empty($user->prop_id) ? $user->prop_id : '';
                        $va =!empty($record->propertyid)?$record->propertyid:'';
                        $dat=Hotelapi::find_by_userid($va);

                        $mop = '';
                        if($record->status == 1){
                            $mop = 'Cash';
                        }elseif($record->status == 2){
                            $mop = 'Points';
                        }elseif($record->status == 3){
                            $mop = 'Prize';
        
                        }
                        
                        $prop= (!empty($dat->title)?$dat->title:'');
                                    
                                $points .='
                            <tr id="'. $record->id .'">
                            <td>
                                
                                '.date("d M Y", strtotime($record->reg_date)).'
                               
                            </td>
                            <td>
                                '.$record->particulars.'
                            </td>
                            <td>
                                '. $mop .'
                            </td>
                            <td>
                            '.$record->point.'
                            </td>
                            <td>
                              '.$record->usable_point.'
                            </td>

                            <td>
                                '.$record->actual_point.'
                            </td>
                            <td>'. $prop
                            . '
                            </td>
    
                        </tr>';
                     } 
                    }
                    $property_id = Hotelapi::find_by_id($user->prop_id);
                    $user_id = (!empty($property_id->prop_code ) && !empty($user->id)) ? $property_id->prop_code . "-" . $user->id : '';

            $dmenu .= '
            <section class="rooms">
            <div class="container-xxl ">
                <div class="row">
                    <div class="col-sm-4">
                        <h4>Member Details</h4>
                        <form id="editProfileForm">

                        <table class="table table-borderless">
                        <tr>
                        <div class="col-sm-3">
                        <div class="add-list-media-wrap">
                            <!--<form class="fuzone">
                                <div class="fu-text">
                                    <span><i class="far fa-cloud-upload-alt"></i> Click here or drop files to upload</span>
                                    <div class="photoUpload-files fl-wrap"></div>
                                </div>
                                <input type="file" class="upload">
                            </form>-->
                            <input type="file" id="img" name="img" accept="image/*">
                        <div id="preview_Image">
                            ';
if (!empty($user->image) && file_exists(SITE_ROOT . "images/user/thumbnails/" . $user->image)) {
    $dmenu .= '

    <div class="" id="removeSavedimg1">
        <div class="infobox info-bg">
            <div class="button-group" data-toggle="buttons">
                <a class="btn btn-sm small float-right" href="javascript:void(0);" onclick="deleteSavedimage(1);">
                    X<i class="glyph-icon icon-trash-o"></i>
                </a>
            </div>
            <img src="' . IMAGE_PATH . 'user/' . $user->image . '" style="width:100%"/>
            <input type="hidden" name="imageArrayname" value="' . $user->image . '" class=""/>
        </div>
    </div>
    
';
}

$dmenu .= '
            </div>
                        </div>
                    </div>

                        </tr>
                        <tr>
                        <input type="hidden" name="user_id" id="user_id" value="'.$user->id.'">
                            </tr>
                            <tr>
                                <td>Code</td>
                                <td>'.$user_id.'</td>
                            </tr>
                            <tr>
                                <td>Full Name</td>
                                <td>'.$user->first_name.' '.$user->last_name.'</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>'.$user->address.'</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>'.$gen.'</td>
                            </tr>
                            <tr>
                                <td>Contact</td>
                                <td>
                                    <input name="contact" type="text" value="'.$user->contact.'">
                                </td>
                            </tr>
                            <tr>
                                <td>DOB</td>
                                <td>
                                    <input name="dob" type="date" class="mb-0" format="YYYY-MM-DD" value="'.$user->dob.'">
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>'.$active.'</td>
                            </tr>
                            <tr>
                                <td>Member of</td>
                                <td>'.$hproprty.'</td>
                            </tr>
                            <tr>
                                <td>Level</td>
                                <td>'.$level.'</td>
                            </tr>
                            
                        </table>
                        <button class="btn    color2-bg  float-btn " id="submitProfile" type="submit">Save Changes</button>
                        </form>

                        
                    </div>
                    <div class="col-sm-8 ">
                        <div class="card mb-3">
                        <div class="card-body">
                        <div class=" d-flex rounded-2">
                            <div class="border-end me-3 pe-3">Usable Points: '.$user->usable_point.'</div>
                            <div>Lifetime Points: '.$user->actual_point.'</div>
                        </div>
                        </div></div>
                        <div class="rewards mb-4">
                            <h4>Reward Points</h4>
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-hover">
                                    <tr>
                        <th class="text-left" width="20%">Date</th>
                        <th class="text-left" width="40%">Particulars</th>
                        <th class="text-left" width="5%" title="Method of Payment">MOP</th>

                        <th class="text-left" width="5%" title="Points">Pts.</th>
                        <th class="text-left width="5%" title="Usable Points">UP</th>
                        <th class="text-left" width="5%" title="Lifetime Points">LFT</th>
                        <th class="text-left" width="35%">Branch</th>
                    </tr>
                                    '. $points .'
                                    </table>
                                    <ul class="pagination">
    
    <li class="page-item">'.get_front_pagination($total, $limit, $page, BASE_URL . 'dashboard').'</li></ul>
                                </div>
                            </div>
                            
                        </div>
                        <div class="prize">
                            <h4>Prize</h4>
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Particular</th>
                                            <th>Description</th>
                                            <th width="10%">Points</th>
                                            
                                        </tr>
                                        '.$rewd.'
                                    </table>
                                </div>
                            </div>
                        </div>
        
                    </div>
                </div>
            
            </div>
          </section>
            ';
       
        
    
    
}
else {
        redirect_to(BASE_URL);}

    }
$jVars['module:user:dashboard-menu'] = $dmenu;


?>
