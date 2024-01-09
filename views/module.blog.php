<?php
$bl =  '';

if (defined('BLOG_PAGE')) {
    $record = Blog::get_allblog();
    $linkTarget='';
    $pagelink='';
    if (!empty($record)) {
        
        
            $bl .= '
        <section class="page-header">
            <div class="page-header-bg" style="background-image: url('. BASE_URL .'template/web/assets/images/backgrounds/page-header-bg.jpg)">
            </div>
            <div class="container">
                <div class="page-header__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="' . BASE_URL . 'home">Home</a></li>
                        <li><span>/</span></li>
                        <li>News & Articles</li>
                    </ul>
                    <h2>Blog list</h2>
                </div>
            </div>
        </section>
        <section class="blog_sec mt-5">
        <div class="container">
            <div class="row">
            <div class="col-lg-9  col-md-12  col-xs-12">
                ';
        
            foreach ($record as $homebl) {
            
           if(!empty($homebl->linksrc)){
            // $pagelink = ($homebl->linktype == 1) ? ' target="_blank" ' : '';
            $linkTarget = ($homebl->linktype == 1) ? ' target="_blank" ' : '';
                $linksrc = ($homebl->linktype == 1) ? $homebl->linksrc : BASE_URL.$homebl->linksrc;
           }
           else{
                $linksrc= BASE_URL. 'blog/'. $homebl->slug;
           }
           $bl .='
           <div class="item">
                    <div class="col-xl-12 col-lg-12 wow fadeInUp" data-wow-delay="100ms">
                        <div class="news-one__single">
                            <div class="news-one__img">
                                <img src="' . IMAGE_PATH . 'blog/' . $homebl->image . '" alt="' . $homebl->title . '">
                            </div>
                            <div class="news-one__content-box">
                                <div class="news-one__date">
                                    <p>' . date("d M Y", strtotime($homebl->blog_date)) . '</p>
                                </div>
                                <div class="news-one__content">
                                    <p class="news-one__author">by www.merolagani.com</p>
                                    <h3 class="news-one__title"><a href="'.$linksrc.'" '.$linkTarget.'>' . $homebl->title . '</a></h3>
                                </div>
                                <div class="news-one__bottom">
                                    <a href="'.$linksrc.'" target="_blank" class="news-one__more"> <i
                                            class="fa fa-arrow-right"></i> Read More</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  
           ';
        }
        $bl.='</div>
        </section>';
    } else {
        redirect_to(BASE_URL);
    }
}
$jVars['module:bloglist'] = $bl;

$homebloglist = '';
$homeblogs ='';
if (defined('HOME_PAGE')) {
    $homeblog = Blog:: get_latestblog_by(3);
    // $homeblogs = Blog:: get_latestblog_by(3);
    if (!empty($homeblog)) {
        
        foreach ($homeblog as $homebl) {
            
           if(!empty($homebl->linksrc)){
            // $pagelink = ($homebl->linktype == 1) ? ' target="_blank" ' : '';
            $linkTarget = ($homebl->linktype == 1) ? ' target="_blank" ' : '';
                $linksrc = ($homebl->linktype == 1) ? $homebl->linksrc : BASE_URL.$homebl->linksrc;
           }
           else{
                $linksrc=  BASE_URL. 'blog/' .$homebl->slug;
           }
           $homebloglist .='
           <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="news-item">
                    <div class="news-image">
                        <img src="' . IMAGE_PATH . 'blog/' . $homebl->image . '" alt="' . $homebl->title . '">
                    </div>
                    <div class="news-content">
                        <p>' . date("d M Y", strtotime($homebl->blog_date)) . '</p>
                        <h4><a href="'.$linksrc.'" '.$linkTarget.'>' . $homebl->title . '</a></h4>
                        <div class="room-services">
                            <ul>
                                <li><i class="fa fa-user" aria-hidden="true"></i> by www.merolagani.com</li>
                            </ul>
                        </div>
                        <p>' . $Blogs->content . '</p>
                        <a href="'.$linksrc.'" target="_blank">READ MORE <i class="fas fa-angle-double-right"></i></a>
                    </div>
                       
                        <!--<div class="news-one__single">
                            <div class="news-one__img">
                                
                            </div>
                            <div class="news-one__content-box">
                                <div class="news-one__date">
                                    <p>' . date("d M Y", strtotime($homebl->blog_date)) . '</p>
                                </div>
                                <div class="news-one__content">
                                    <p class="news-one__author">by www.merolagani.com</p>
                                    <h3 class="news-one__title"><a href="'.$linksrc.'" '.$linkTarget.'>' . $homebl->title . '</a></h3>
                                </div>
                                <div class="news-one__bottom">
                                    <a href="'.$linksrc.'" target="_blank" class="news-one__more"> <i
                                            class="fa fa-arrow-right"></i> Read More</a>
                                    
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
                  
           ';
        }
        $homeblogs='<section class="details">
            <div class="container-xxl px-md-5 px-4">
                <div class="section-title text-center">
                    <span class="section-title__tagline">What’s Happening</span>
                    <h2 class="section-title__title">Latest news updates <br> & articles</h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="list-content">
                            <div class="row">
                <div class="gallery-one__carousel thm-owl__carousel owl-theme owl-carousel" id="gallery1" data-owl-options=\'{
                    "items": 3,
                    "margin": 0,
                    "smartSpeed": 700,
                    "loop":true,
                    "autoplay": 1000,
                    "nav":false,
                    "dots":false,
                    "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                    "responsive":{
                        "0":{
                            "items":1
                        },
                        "768":{
                            "items":2
                        },
                        "992":{
                            "items": 2
                        },
                        "1200":{
                            "items": 3
                        }
                    }
                }\'>
                
                '.$homebloglist.'
                </div>
            </div>
            </div>
            </div>
        </section>';
    }
}

$jVars['module:homebloglist'] = $homeblogs;

$blog_detail = $recent_posts = '';
if (defined("BLOG_PAGE") ) {
    $slug = !empty($_REQUEST['slug']) ? $_REQUEST['slug'] : '';
    $Blogs = Blog::find_by_slug($slug);
    //pr($Blogs);
   

    if (!empty($slug)) {
        $blog_detail .= '
        <section class="breadcrumb-outer noimg">
        <div class="container">
            <div class="breadcrumb-content">
                <h1 class="text-center text-white">Blogs</h1>
            </div>
        </div>
    </section>
        
               ';
        
        $blog_detail .= '
        <section class="single">
            <div class="container-xxl px-md-5 px-4">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12 pull-left">
                        <h1 class="text">' . $Blogs->title . '</h1>
                        <div class="single-image">
                            <img src="' . IMAGE_PATH . 'blog/' . $Blogs->image . '" alt="' . $Blogs->title . '">
                            <div class="single-image-date">
                                <p>' . date('d M Y', strtotime($Blogs->blog_date)) . '</p>
                            </div>
                        </div>
                        <div class="single-detail mar-top-30">
                            <div class="single-content">
                                <ul class="author">
                                    <li><i class="fa fa-user" aria-hidden="true"></i> by ' . $Blogs->author . '</li>
                                </ul>
                                <p>' . $Blogs->content . '</p>
                            </div>
                        </div>
                    </div>
                    
                        <!--<div class="news-details__left">
                            <div class="news-details__img">
                                <img src="' . IMAGE_PATH . 'blog/' . $Blogs->image . '" alt="' . $Blogs->title . '">
                                <div class="news-details__date">
                                    <p>' . date('d M Y', strtotime($Blogs->blog_date)) . '</p>
                                </div>
                            </div>
                            <div class="news-details__content">
                                <p class="news-details__author">by ' . $Blogs->author . '</p>
                                ' . $Blogs->content . '

                            </div>
                            <br/>
                        </div>-->
   ';
                                

        $recents = Blog::get_latestblog_by(3);
        if (!empty($recents)) {
            $blog_detail .='<div class="col-md-4 col-sm-12 col-xs-12">
                         <div class="detail-sidebar">
                            <div class="recent-post sidebar-item">
                                <h3>Recent Posts</h3>
                                ';
            foreach ($recents as $recent) {
                if ($recent->title != $Blogs->title) {
                    $blog_detail .= '
                    
                                    <div class="recent-item clearfix">
                                        <div class="recent-image">
                                            <img src="' . IMAGE_PATH . 'blog/' . $recent->image . '" alt="' . $recent->title . '">
                                        </div>
                                        <div class="recent-content">
                                            <h5 class="mar-bottom-10"><a href="' . BASE_URL . 'blog/' . $recent->slug . '">' . $recent->title . '</a></h5>
                                            <div class="room-services">
                                                <ul>
                                                    <li><i class="fa fa-user" aria-hidden="true"></i> By author</li>
                                                    <li><i
                                                        class="fas fa-calendar"></i>' . date("d M Y", strtotime($homebl->blog_date)) . '</li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <!--<div class="sidebar__post-content">
                                            <h3>
                                                <span class="sidebar__post-content-meta"><i
                                                        class="fas fa-calendar"></i>' . date("d M Y", strtotime($homebl->blog_date)) . '</span>
                                                <a href="' . BASE_URL . 'blog/' . $recent->slug . '">' . $recent->title . '</a>
                                            </h3>
                                        </div>-->
                                    </div>
                 ';
                }
                
            }
            $blog_detail .= '
            
            
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
        </section>';        
        }
    } else {
        $blog_detail .= '
        <section class="breadcrumb-outer offer-breadcrumb">
        <div class="container">
            <div class="breadcrumb-content">
                <h1 class="text-center text-white">Blogs</h1>
                <h2 class="text-center text-white"></h2>
            </div>
        </div>
    </section>
        <section class="news-one">
            <div class="container-xxl px-md-5 px-4 ">
                <div class="section-title text-center">  
                </div> <div class="blog_wrapper"> <div class="row">    
                ';
        $Blogs = Blog::get_allblog();
        //pr($Blogs);
         foreach ($Blogs as $homebl) {
            
           if(!empty($homebl->linksrc)){
            // $pagelink = ($homebl->linktype == 1) ? ' target="_blank" ' : '';
            $linkTarget = ($homebl->linktype == 1) ? ' target="_blank" ' : '';
                $linksrc = ($homebl->linktype == 1) ? $homebl->linksrc : BASE_URL.$homebl->linksrc;
           }
           else{
                $linksrc= BASE_URL. 'blog/'. $homebl->slug;
           }

           $blog_detail .='
           
           <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="news-item">
                    <div class="news-image">
                        <img src="' . IMAGE_PATH . 'blog/' . $homebl->image . '" alt="' . $homebl->title . '">
                    </div>
                    <div class="news-content">
                        <!--<p>' . date("d M Y", strtotime($homebl->blog_date)) . '</p>-->
                        <h4><a href="'.$linksrc.'" '.$linkTarget.'>' . $homebl->title . '</a></h4>
                        <div class="room-services">
                            <ul>
                                <li><i class="fa fa-calendar" aria-hidden="true"></i> ' . date("d M Y", strtotime($homebl->blog_date)) . '</li>
                            </ul>
                        </div>
                        <p>'.$homebl->brief.'</p>
                        <a href="'.$linksrc.'" target="_blank">READ MORE <i class="fas fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
            
           
                <!--<div class="item col-3" style="display: inline-block;">
                    <div class="col-xl-12 col-lg-12 wow fadeInUp" data-wow-delay="100ms">
                        <div class="news-one__single">
                            <div class="news-one__img">
                                <img src="' . IMAGE_PATH . 'blog/' . $homebl->image . '" alt="' . $homebl->title . '">
                            </div>
                            <div class="news-one__content-box">
                                <div class="news-one__date">
                                    <p>' . date("d M Y", strtotime($homebl->blog_date)) . '</p>
                                </div>
                                <div class="news-one__content">
                                    <p class="news-one__author">by www.merolagani.com</p>
                                    <h3 class="news-one__title"><a href="'.$linksrc.'" '.$linkTarget.'>' . $homebl->title . '</a></h3>
                                </div>
                                <div class="news-one__bottom">
                                    <a href="'.$linksrc.'" target="_blank" class="news-one__more"> <i
                                            class="fa fa-arrow-right"></i> Read More</a>
                                    
                                </div>
                            </div>
                        
                    </div>
                </div>-->
            
                  
           ';
    }
    $blog_detail .='
    </div></div>
    </div>
    </div>
    </section>';
    
    }
}


$jVars['module:blog-detail'] = $blog_detail;
$jVars['module:blog-recent-posts'] = $recent_posts;


?>