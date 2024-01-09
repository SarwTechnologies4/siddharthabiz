<?php 
// News list Home
$resnh='';

if(defined('HOMEPAGE')) {
	$hnewRec = News::get_news_list(3);
	if(!empty($hnewRec)) {
	$resnh.='<section class=" middle-padding">
                        <div class="container">
                            <div class="section-title">
                                
                                <h2>Blogs</h2>
                                
                                <p>Browse the latest articles from our blog.</p>
                            </div>
                            <div class="row home-posts">';
		foreach($hnewRec as $hnewRow) {
		
            $resnh.=' <div class="col-md-4">
                                    <article class="card-post">
                                        <div class="card-post-img fl-wrap">
                                            <a href="'.BASE_URL.'news/'.$hnewRow->slug.'"><img  src="'.IMAGE_PATH.'news/'.$hnewRow->image.'"   alt="'.$hnewRow->title.'"></a>
                                        </div>
                                        <div class="card-post-content fl-wrap">
                                            <h3><a href="'.BASE_URL.'news/'.$hnewRow->slug.'">'.$hnewRow->title.'</a></h3>
                                            <p>'.strip_tags($hnewRow->brief).'</p>
                                            
                                            <div class="post-opt">
                                                <ul>
                                                    <li><i class="fal fa-calendar"></i> <span>'.date('d M Y', strtotime($hnewRow->news_date)).'</span></li>
                                                    
                                                    <li><i class="fal fa-tags"></i> <a href="#">'.$hnewRow->tags.'</a>  </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                </div>';
		}
	$resnh.='</div>
                            <a href="'.BASE_URL.'newslist" class="btn    color-bg ">Read All News<i class="fas fa-caret-right"></i></a>
                        </div>
                        <div class="section-decor"></div>
                    </section>';
	}
}

$jVars['module:newsHome'] = $resnh;

// News list and detail
$newslist=$newsbread='';
//$newRec = News::find_all();
$page = (isset($_REQUEST["pageno"]) and !empty($_REQUEST["pageno"]))? $_REQUEST["pageno"] : 1;
         $year = (isset($_REQUEST["year"]) and !empty($_REQUEST["year"])) ? $_REQUEST["year"] : "";

        
        $sql = "SELECT * FROM tbl_news WHERE status='1' ORDER BY news_date DESC";
    
    $limit = 6;
        $total = $db->num_rows($db->query($sql));
        // print_r($total); die();
        $startpoint = ($page * $limit) - $limit; 
        $sql.=" LIMIT ".$startpoint.",".$limit;
        $query = $db->query($sql);
     $Records=News::find_by_sql($sql);
      $others=News::get_popularpkg(4);


if(!empty($Records)) {
   
    $newsbread='<!--<section class="color-bg middle-padding ">
                        <div class="wave-bg wave-bg2"></div>
                        <div class="container">
                            <div class="flat-title-wrap">
                                <h2><span>Our News</span></h2>
                                <span class="section-separator"></span>
                                <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem.</h4>
                            </div>
                        </div>
                    </section>-->
                    <!--  section  end-->
                    <div class="breadcrumbs-fs fl-wrap">
                        <div class="container">
                            <div class="breadcrumbs fl-wrap"><a href="'.BASE_URL.'home">Home</a><span>News</span></div>
                        </div>
                    </div>';
    $newslist.='<section id="sec1" class="middle-padding grey-blue-bg">
                        <div class="container">
                            <div class="row">
                                <!--blog content -->
                                <div class="col-md-8">
                                    <!--post-container -->
                                    <div class="post-container fl-wrap">';
     foreach($Records as $RecRow) { 
        

        $newslist.=' <div class="article-masonry">
                                            <article class="card-post">
                                                <div class="card-post-img fl-wrap">
                                                    <a href="'.BASE_URL.'news/'.$RecRow->slug.'"><img  src="'.IMAGE_PATH.'news/'.$RecRow->image.'"   alt="'.$RecRow->title.'"></a>
                                                </div>

                                                <div class="card-post-content fl-wrap">
                                                    <h3><a href="'.BASE_URL.'news/'.$RecRow->slug.'">'.$RecRow->title.'</a></h3>
                                                    <p>'.strip_tags($RecRow->brief).'</p>
                                                    <!--<div class="post-author"><a href="#"><img src="images/avatar/1.jpg" alt=""><span>By , Mery Lynn</span></a></div>-->
                                                    <div class="post-opt">
                                                        <ul>
                                                            <li><i class="fal fa-calendar"></i> <span>'.date('d M Y', strtotime($RecRow->news_date)).'</span></li>
                                                            <!--<li><i class="fal fa-eye"></i> <span>264</span></li>-->
                                                            <li><i class="fal fa-tags"></i> <a href="#">'.$RecRow->tags.'</a>  </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>';
    }
    $newslist.='<!--article-masonry end -->                                      
                                        <!-- pagination-->
                                        '.get_pagination($total, $limit, $page, BASE_URL . 'newslist').';
                                        <!--<div class="pagination">
                                            <a href="#" class="prevposts-link"><i class="fa fa-caret-left"></i></a>
                                            <a href="#" >1</a>
                                            <a href="#" class="current-page">2</a>
                                            <a href="#">3</a>
                                            <a href="#">4</a>
                                            <a href="#" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
                                        </div>-->
                                        <!-- pagination end-->
                                    </div>
                                    <!--post-container end -->  
                                </div>
                                <div class="col-md-4">
                                    <!--box-widget-wrap -->  
                                    <div class="box-widget-wrap fl-wrap">
                                    <div class="box-widget-item fl-wrap">
                                            <div class="box-widget widget-posts">
                                                <div class="box-widget-content">
                                                    <div class="box-widget-item-header">
                                                        <h3>Popular Posts</h3>
                                                    </div>';
foreach ($others as $othe) {
           
       
$newslist.='<div class="box-image-widget">
                                                        <div class="box-image-widget-media"><img src="'.IMAGE_PATH.'news/'.$othe->image.'" alt="'.$othe->title.'">
                                                            <a href="'.BASE_URL.'news/'.$othe->slug.'" class="color-bg">Details</a>
                                                        </div>
                                                        <div class="box-image-widget-details">
                                                            <h4>'.$othe->title.'</h4>
                                                            <p>'.$othe->brief.'</p>
                                                            <span class="widget-posts-date"><i class="fal fa-calendar"></i> '.date('d M Y', strtotime($othe->news_date)).' </span>
                                                        </div>
                                                    </div>';
        }
$newslist.=' </div>
                                            </div>
                                        </div>
                                        <!--box-widget-item end -->';
$newslist.='<div class="box-widget-item fl-wrap">
                                            <div class="box-widget">
                                                <div class="box-widget-content">
                                                    <div class="box-widget-item-header">
                                                        <h3>Tags </h3>
                                                    </div>
                                                    <div class="list-single-tags tags-stylwrap  sb-tags">';

  foreach($Records as $RecRow) { 
                                                        $newslist.=' <a href="#">'.$RecRow->tags.'</a>';
                                                                                                 
                                    }             $newslist.='  </div>
                                                </div>
                                            </div>
                                        </div>';
$newslist.='</div>
                                    <!--box-widget-wrap end -->  
                                </div>
                                <!--   sidebar end  -->
                            </div>
                        </div>
                        <div class="limit-box fl-wrap"></div>
                    </section>';
  
}
$jVars['module:newslist'] = $newslist;
//var_dump($newslist);die();
$jVars['module:newsbread'] = $newsbread;

$renewsdetail=$renewsbread= '';
if (defined('NEWS_PAGE') and isset($_REQUEST['slug'])) {
$slug = !empty($_REQUEST['slug'])? addslashes($_REQUEST['slug']) : '';
    $detspRec = News::find_by_slug($slug);
    $others= News::get_relatedpkg($detspRec->id, 4);
    
if (!empty($detspRec)) {
   
        $renewsdetail.='  <section  id="sec1" class="middle-padding grey-blue-bg">
                        <div class="container">
                            <div class="row">
                                <!--blog content -->
                                <div class="col-md-8">
                                    <!--post-container -->
                                    <div class="post-container fl-wrap">
                                    <article class="post-article">
                                            <div class="list-single-main-media fl-wrap">
                                                <div class="single-slider-wrapper fl-wrap">
            
                                        <div class="single-slider fl-wrap"  >';
        $imglink='';
         $pkgImg = $detspRec->gallery;
          if($pkgImg != "a:0:{}") { 
                $pkgImgList = unserialize($pkgImg);
                        foreach ($pkgImgList as $pkgImg) {

                             $file_path = SITE_ROOT.'images/news/gallery/'.$pkgImg;
                         
                            if(file_exists($file_path)) {
                                $imglink = IMAGE_PATH.'news/gallery/'.$pkgImg;
                            $renewsdetail.=' <div class="slick-slide-item"><img src="'. $imglink.'" alt="'.$detspRec->title.'"></div>';
                       
                            }
                            else {
                                $imglink = '';
                            }
            
                        }

                            
                       }


     
                                                     $renewsdetail.='</div>
                                                    <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                                                    <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
                                                </div>
                                            </div>
                                            <div class="list-single-main-item fl-wrap">
                                                <div class="list-single-main-item-title fl-wrap">
                                                    <h3>'.$detspRec->brief.'</h3>
                                                </div>
                                                <p>'.$detspRec->content.'</p>
                                               
                                                <div class="post-opt">
                                                    <ul>
                                                        <li><i class="fal fa-calendar"></i> <span>'.date('d M Y', strtotime($detspRec->news_date)).'</span></li>

                                                        <li><i class="fal fa-tags"></i> <a href="#">'.$detspRec->tags.'</a> </li>
                                                    </ul>
                                                </div>
                                                <span class="fw-separator"></span>
                                                
                                               
                                            </div>
                                           
                                            <!-- list-single-main-item end -->                                             
                                        </article>
                                        <!-- article end -->                                
                                    </div>
                                    <!--post-container end -->  
                                </div>';
        $renewsdetail.='<div class="col-md-4">
                                    <!--box-widget-wrap -->  
                                    <div class="box-widget-wrap fl-wrap fixed-bar">
                                        <!--box-widget-item -->
                                        
                                        <!--box-widget-item end --> 
                                        <!--box-widget-item -->
                                        <div class="box-widget-item fl-wrap">
                                            <div class="box-widget widget-posts">
                                                <div class="box-widget-content">
                                                    <div class="box-widget-item-header">
                                                        <h3>Other Posts</h3>
                                                    </div>';
                   foreach ($others as $other) {
                                                        
                                                                                    
                $renewsdetail.=' <div class="box-image-widget">
                                                        <div class="box-image-widget-media"><img src="'.IMAGE_PATH.'news/'.$other->image.'" alt="'.$other->title.'">
                                                            <a href="'.BASE_URL.'news/'.$other->slug.'" class="color-bg">Details</a>
                                                        </div>
                                                        <div class="box-image-widget-details">
                                                            <h4>'.$other->title.'</h4>
                                                            <p>'.$other->brief.'</p>
                                                            <span class="widget-posts-date"><i class="fal fa-calendar"></i> '.date('d M Y', strtotime($othe->news_date)).' </span>
                                                        </div>
                                                    </div>
                                                    <!--box-image-widget end -->';
                                              
                                              }                                                         
                                                                                                             
                                                $renewsdetail.='</div>
                                            </div>
                                        </div>
                                        <!--box-widget-item end -->                                         
                                        <!--box-widget-item -->
                                       
                                        <!--box-widget-item end -->                                       
                                        <!--box-widget-item -->
                                      
                                        <!--box-widget-item end -->                            
                                        <!--box-widget-item -->
                                       
                                        <!--box-widget-item end -->   ';                          
                                    $renewsdetail.=' </div>
                                    <!--box-widget-wrap end -->  
                                </div>';
            $renewsdetail.='     <!--   sidebar end  -->
                            </div>
                        </div>
                        <div class="limit-box fl-wrap"></div>
                    </section>';
                        
             $renewsbread .= '  <section class="color-bg middle-padding ">
                        <div class="wave-bg wave-bg2"></div>
                        <div class="container">
                            <div class="flat-title-wrap">
                                <h2><span>' . $detspRec->title . '</span></h2>
                                <span class="section-separator"></span>
                                <!--<h4>'.strip_tags($detspRec->brief).'</h4>-->
                            </div>
                        </div>
                    </section>
                    <!--  section  end-->
                    <div class="breadcrumbs-fs fl-wrap">
                        <div class="container">
                            <div class="breadcrumbs fl-wrap"><a href="'.BASE_URL.'home">Home</a><a href="'.BASE_URL.'newslist">News</a><span>' . $detspRec->title . '</span></div>
                        </div>
                    </div>';
}
    }
        $jVars['module:news-detail'] = $renewsdetail;
$jVars['module:news-bread'] = $renewsbread;