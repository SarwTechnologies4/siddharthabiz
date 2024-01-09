<?php $user_type  =  $session->get('user_type'); ?>
<!-- Sider menu Header-->
<div id="header-logo">
    <?php Config::getField('sitename');?>
    <a href="javascript:;" class="tooltip-button" data-placement="bottom" title="Close sidebar" id="close-sidebar">
        <i class="glyph-icon icon-align-justify"></i>
    </a>
    <a href="javascript:;" class="tooltip-button hidden" data-placement="bottom" title="Open sidebar" id="rm-close-sidebar">
        <i class="glyph-icon icon-align-justify"></i>
    </a>
    <a href="javascript:;" class="tooltip-button hidden" title="Navigation Menu" id="responsive-open-menu">
        <i class="glyph-icon icon-align-justify"></i>
    </a>
</div>  
<!-- Menu search Section -->
<div id="sidebar-search">
    <input type="text" placeholder="Menu category search..." class="autocomplete-input tooltip-button" data-placement="right" title="Type menu category name " id="" name="">
    <i class="glyph-icon icon-search"></i>
</div>
<!-- Sider menu from Database -->
<div id="sidebar-menu" class="scrollable-content">
<ul>
    <li <?php echo !isset($_REQUEST['page'])?'class="current-page"':'';?>>
        <a href="<?php echo ADMIN_URL;?>dashboard" title="Dashboard">
            <i class="glyph-icon icon-dashboard"></i>
            Dashboard
        </a>
    </li>


<?php
   if($user_type=='hotel'){
      $hotel_menu_array  =  array();
      $hotel_menu_array['hotelapi']  =  array('name'=>'Hotels',
                                              'link'=>'hotelapi/list',
                                              'mode'=>'hotelapi',
                                              'icon_link'=>'icon-hospital-o'
                                              );
      $accsid    =  $session->get('u_id'); 
       $records   =  Hotelapi::find_all_by_user_id($accsid); 
       if(count($records)>0){
      $hotel_menu_array['hotelapi']['child'][] = array('name'=>'Manage Hotels',
                                                      'link'=>'hotelapi/list/',
                                                      'mode'=>'hotelapi',
                                                      'icon_link'=>'icon-gear'
                                                      ); 
       }
       foreach($records as $record){
           $hotel_menu_array['hotelapi']['child'][] = array('name'=>$record->title,
                                                      'link'=>'hotelapi/profile/'.$record->code,
                                                      'mode'=>'hotelapi',
                                                      'icon_link'=>'icon-gear'
                                                      );
       }
       
    $page = (!empty($_REQUEST['page']) and isset($_REQUEST['page']))?$_REQUEST['page']:''; 
      foreach($hotel_menu_array as $key=>$val){ 
    if(!empty($page)): 
    $currpage = ($page==$val['mode'])?'current-page':'';
    else:
        $currpage='';
    endif;

    $actvpage = @($key==$page)?' active':'';
    if(isset($hotel_menu_array['hotelapi']['child'])){
    $childmenu = count($hotel_menu_array['hotelapi']['child']);
    }else{
        $childmenu = 0;
    }

    $pagelink  = !empty($childmenu)?'javascript:void(0);':ADMIN_URL.$val['link'];
    
    echo '<li class="'.$currpage.$actvpage.'">
            <a href="'.$pagelink.'" title="'.$val['name'].'">
                <i class="glyph-icon '.$val['icon_link'].'"></i>
                '.$val['name'].'
            </a>'; 
    if(!empty($childmenu)){
            echo '<ul>';
                foreach ($val['child'] as $k=>$v) { 
                    $subcurrent = ($page==$v['mode'])?'current-page':'';
                    echo '<li class="'.$subcurrent.'">
                            <a href="'.ADMIN_URL.$v['link'].'" title="'.$v['name'].'">
                                <i class="glyph-icon '.$v['icon_link'].'"></i>
                                '.$v['name'].'
                            </a>
                          </li>';
                }
            echo '</ul>';
            }
    echo '</li>';
    }} ?>


    <?php $parentmenu = Module::find_all_parent($user_type);
    //if($loginUser->type == 'hotel' AND $loginUser->package_status==0) { unset($parentmenu[2]); }
    //if($loginUser->type == 'hotel' AND $loginUser->vehicle_status==0) { unset($parentmenu[3]); }
    $page = (!empty($_REQUEST['page']) and isset($_REQUEST['page']))?$_REQUEST['page']:'';
    foreach ($parentmenu as $key=>$val){       
    if(!empty($page)): 
        $currpage = ($page==$val->mode)?'current-page':'';
    else:
        $currpage='';
    endif;
        $actvpage='';
        $pid = Module::check_parent($page);
        if($pid){
            $actvpage = ($pid->parent_id==$val->id)?' active':'';
        }

        $childmenu = Module::find_child_by($val->id,$user_type);
        $pagelink  = !empty($childmenu)?'javascript:void(0);':ADMIN_URL.$val->link;
    echo '<li class="'.$currpage.$actvpage.'">
            <a href="'.$pagelink.'" title="'.$val->name.'">
                <i class="glyph-icon '.$val->icon_link.'"></i>
                '.$val->name.'
            </a>';            
            if(!empty($childmenu)){
            echo '<ul>';
                foreach ($childmenu as $k=>$v) {
                    $subcurrent = ($page==$v->mode)?'current-page':'';
                    echo '<li class="'.$subcurrent.'">
                            <a href="'.ADMIN_URL.$v->link.'" title="'.$v->name.'">
                                <i class="glyph-icon '.$v->icon_link.'"></i>
                                '.$v->name.'
                            </a>
                          </li>';
                }
            echo '</ul>';
            }
    echo '</li>';
    }?>        	
</ul>
<div class="divider mrg5T mobile-hidden"></div>    
</div>