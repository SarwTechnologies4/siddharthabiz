<?php
$faqdetails='';
$faqlisting='';
if (defined('FAQ_PAGE')) {
    
    
    $faqrec = Hotelfaq::find_all();

    foreach($faqrec as $i =>$faq){
        $collapsed = ($i == 0) ? 'collapsed' : '';
        $show = ($i == 0) ? 'show' : '';
        $faqlisting .='
        <div class="accordion-item border-0">
        <h2 class="accordion-header " id="head'.$faq->id.'">
            <button class="fw-bold text-primary px-0 accordion-button '.$collapsed.'" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$faq->id.'" aria-expanded="true" aria-controls="collapseOne">
            '.$faq->title.'
            </button>
        </h2>
        <div id="collapse'.$faq->id.'" class="accordion-collapse collapse '.$show.'" aria-labelledby="head'.$faq->id.'" data-bs-parent="#accordionExample">
            <div class="accordion-body p-0 pb-3">
            '.$faq->content.'
            </div>
        </div>
    </div>';
    }

    $faqdetails .= ' <div class="overview-one">
   
    <div class="accordion" id="accordionExample">
    '.$faqlisting.'

    </div>
</div>';
}

$jVars['module:faqlist'] = $faqdetails;
