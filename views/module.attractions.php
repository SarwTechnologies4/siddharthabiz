<?php

/**
 *          Attraction Detail Page
 */

if (defined('ATTRACTION_PAGE') and !empty($_REQUEST['slug'])) {
    $slug = addslashes($_REQUEST['slug']);
    $innRec = Attractions::find_by_slug($slug);

    if (!empty($innRec)) {
        $resinn = ob_start();
        ?>
        <div class="breadcrumbs-fs fl-wrap">
            <div class="container">
                <div class="breadcrumbs fl-wrap"><a href="<?= BASE_URL ?>home">Home</a><span><?= $innRec->title ?></span></div>
            </div>
        </div>
        <section id="sec1" class="middle-padding">
            <div class="container">
                <!--about-wrap -->
                <div class="about-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="list-single-main-item-title fl-wrap">
                                <h3><?= $innRec->title ?></h3>
                            </div>
                            <?= $innRec->content ?>
                        </div>
                    </div>
                </div>
                <!-- about-wrap end  -->
            </div>
        </section>
        <?php
        $resinn = ob_get_clean();
    }
}

$jVars['module:attractions:detail'] = $resinn;