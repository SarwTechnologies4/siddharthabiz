<?php 
/*
* Contact us 
*/
$rescont='';
  $restbread='';

if(defined('CONTACTUS_PAGE')) {
	$confRec  = Config::find_by_id(1);
    $restbread.=' 

    <section class="breadcrumb-outer noimg" >
        <div class="container">
            <div class="breadcrumb-content">
                <h1 class="text-white">Contact Us</h1>
            </div>
        </div>
    </section>';
	$rescont.='
    <section class="contact  pad-bottom-10 contact1">
    <div class="container-xxl px-md-5 px-4">
        <div class="contact-info">
            <div class="row">
                <div class="col-md-6">
                    <div id="contact-form" class="contact-form">
                        
                        <div id="contactform-error-msg"></div>

                        <form method="post" action="enquery_mail.php" name="contactform" id="frm_contact">
                            <div class="form-group mb-5">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name *">
                            </div>
                            
                            <div class="form-group mb-5">
                                <input type="email" name="email"  class="form-control" id="email" placeholder="Email *">
                            </div>

                            <div class="form-group mb-5">
                                <input type="text" name="phone" class="form-control" id="number" placeholder="Phone *">
                            </div>

                            <div class="textarea mb-5">
                                <textarea name="message" id="message" placeholder="Message *"></textarea>
                            </div>
                            <div id="g-recaptcha-response" class="g-recaptcha col-md-8 form-group" data-sitekey="6LdJHKooAAAAAENO9EGHiNjnNX9xFltb9tvtr2Oe"></div>

                            <div class="comment-btn text-right">
                                <input type="submit" class="btn btn-orange" id="submit" value="Send Feedback">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="contact-info1">
                        '.$confRec->breif.'
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
';
}

$jVars['module:contactus'] = $rescont;
$jVars['module:contactbreadcum'] = $restbread;