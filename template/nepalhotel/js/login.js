jQuery(function ($) {
    var currentYear = new Date().getFullYear();
    $(".year").html(function (i, currentHtml) {
        return currentHtml.replace("", currentYear + '/' + parseInt(currentYear + 1));
    });


})

jQuery('#lout').on('click', function () {
    var base_url = jQuery('base').attr('url');
    window.location.href = base_url + 'lout';
    return false;
 });

// jQuery('#lout').on("click", function (a) {
//     var base_url = jQuery('base').attr('url');
//     window.location.href(base_url + 'lout')
// });
//   all ------------------
function initEasybook() {
    "use strict";
    //   loader ------------------
    // $(".loader-wrap").fadeOut(300, function () {
    //     $("#main").animate({
    //         opacity: "1"
    //     }, 600);
    // });


    //   Background image ------------------
    var a = $(".bg");
    a.each(function (a) {
        if ($(this).attr("data-bg")) $(this).css("background-image", "url(" + $(this).data("bg") + ")");
    });
    //   perfectScrollbar------------------
    if ($(".scrollbar-inner").length > 0) {
        var aps = new PerfectScrollbar('.scrollbar-inner', {
            swipeEasing: true,
            minScrollbarLength: 20
        });
    }

    //   Isotope------------------
    function initIsotope() {
        if ($(".gallery-items").length) {
            var a = $(".gallery-items").isotope({
                singleMode: true,
                columnWidth: ".grid-sizer, .grid-sizer-second, .grid-sizer-three",
                itemSelector: ".gallery-item, .gallery-item-second, .gallery-item-three",
                transformsEnabled: true,
                transitionDuration: "700ms",
                resizable: true
            });
            a.imagesLoaded(function () {
                a.isotope("layout");
            });
        }
    }

    initIsotope();
    //   lightGallery------------------
    // $(".image-popup").lightGallery({
    //     selector: "this",
    //     cssEasing: "cubic-bezier(0.25, 0, 0.25, 1)",
    //     download: false,
    //     counter: false
    // });
    // var o = $(".lightgallery"),
    //     p = o.data("looped");
    // o.lightGallery({
    //     selector: ".lightgallery a.popup-image",
    //     cssEasing: "cubic-bezier(0.25, 0, 0.25, 1)",
    //     download: false,
    //     loop: false,
    //     counter: false
    // });

    function initHiddenGal() {
        $(".dynamic-gal").on('click', function () {
            var dynamicgal = eval($(this).attr("data-dynamicPath"));

            $(this).lightGallery({
                dynamic: true,
                dynamicEl: dynamicgal,
                download: false,
                loop: false,
                counter: false
            });

        });

        $(".rooms-menu a").on("click", function (a) {
            a.preventDefault();
            $(this).parent().addClass("current");
            $(this).parent().siblings().removeClass("current");
            var b = $(this).attr("href");
            $(".tab-content").not(b).css("display", "none");
            $(b).fadeIn();
        });

    }

    initHiddenGal();
    //   Alax modal------------------
    $(".ajax-link").on('click', function () {
        $("html, body").addClass("hid-body");
        $(".ajax-modal-overlay").fadeIn(400);
        $(".ajax-modal-container").animate({
            right: "0",
            opacity: 1
        }, 300);
        $.ajax({
            url: this.href,
            success: function (html) {
                $("#ajax-modal").empty().append(html);
                initHiddenGal();
                $(".ajax-modal-overlay , .ajax-modal-close").on('click', function () {
                    $("html, body").removeClass("hid-body");
                    $(".ajax-modal-overlay").fadeOut(100);
                    $(".ajax-modal-container").animate({
                        right: "-550px",
                        opacity: 0
                    }, 300);
                    setTimeout(function () {

                        $("#ajax-modal").empty();
                        $(".ajax-loader").fadeIn(100);
                    }, 300);
                });

            }
        });
        $(".ajax-loader").delay(700).fadeOut(400);
        setTimeout(function () {
            $(".ajax-modal-wrap").animate({
                opacity: "1"
            }, 300);
        }, 1000);


        return false;
    });
    //   appear------------------
    // $(".stats").appear(function () {
    //     $(".num").countTo();
    // });
    // Share   ------------------
    // $(".sfcs").on("click", function () {
    //     $(this).toggleClass("vis-buts h");
    //     $(".fixed-scroll-column-share-container").slideToggle(400);
    // });
    // $(".share-container").share({
    //     networks: ['facebook', 'pinterest', 'googleplus', 'twitter', 'linkedin']
    // });
    // var shrcn = $(".share-container");

    // function showShare() {
    //     shrcn.removeClass("isShare");
    //     shrcn.addClass("visshare");
    // }

    // function hideShare() {
    //     shrcn.addClass("isShare");
    //     shrcn.removeClass("visshare");
    // }

    // $(".showshare").on("click", function () {
    //     $(this).toggleClass("vis-butsh");
    //     $(this).find("span").text($(this).text() === 'Close' ? 'Share' : 'Close');
    //     if ($(".share-container").hasClass("isShare")) showShare();
    //     else hideShare();
    // });
    //   accordion ------------------
    $(".accordion a.toggle").on("click", function (a) {
        a.preventDefault();
        $(".accordion a.toggle").removeClass("act-accordion");
        $(this).addClass("act-accordion");
        if ($(this).next('div.accordion-inner').is(':visible')) {
            $(this).next('div.accordion-inner').slideUp();
        } else {
            $(".accordion a.toggle").next('div.accordion-inner').slideUp();
            $(this).next('div.accordion-inner').slideToggle();
        }
    });
    //   tabs------------------
    $(".tabs-menu a").on("click", function (a) {
        a.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var b = $(this).attr("href");
        $(".tab-content.login").not(b).css("display", "none");
        $(b).fadeIn();
    });
    //   weather------------------
    var datacityw = $("#weather-widget").data("city");
    $("#weather-widget").ideaboxWeather({
        location: datacityw,
    });

    // twitter ------------------
    if ($("#footer-twiit").length > 0) {
        var config1 = {
            "profile": {
                "screenName": 'envatomarket'
            },
            "domId": 'footer-twiit',
            "maxTweets": 2,
            "enableLinks": true,
            "showImages": false
        };
        twitterFetcher.fetch(config1);
    }
    //   Contact form------------------
    $(document).on('submit', '#contactform', function () {
        var a = $(this).attr("action");
        $("#message").slideUp(750, function () {
            $("#message").hide();
            $("#submit").attr("disabled", "disabled");
            $.post(a, {
                name: $("#name").val(),
                email: $("#email").val(),
                comments: $("#comments").val()
            }, function (a) {
                document.getElementById("message").innerHTML = a;
                $("#message").slideDown("slow");
                $("#submit").removeAttr("disabled");
                if (null != a.match("success")) $("#contactform").slideDown("slow");
            });
        });
        return false;
    });
    $(document).on('keyup', '#contactform input, #contactform textarea', function () {
        $("#message").slideUp(1500);
    });
    //   mailchimp------------------
    $("#subscribe").ajaxChimp({
        language: "eng",
        url: "http://kwst.us18.list-manage.com/subscribe/post?u=42df802713d4826a4b137cd9e&id=815d11e811"
    });
    $.ajaxChimp.translations.eng = {
        submit: "Submitting...",
        0: '<i class="fa fa-check"></i> We will be in touch soon!',
        1: '<i class="fa fa-warning"></i> You must enter a valid e-mail address.',
        2: '<i class="fa fa-warning"></i> E-mail address is not valid.',
        3: '<i class="fa fa-warning"></i> E-mail address is not valid.',
        4: '<i class="fa fa-warning"></i> E-mail address is not valid.',
        5: '<i class="fa fa-warning"></i> E-mail address is not valid.'
    };
    //   Video------------------
    var v = $(".background-youtube-wrapper").data("vid");
    var f = $(".background-youtube-wrapper").data("mv");
    $(".background-youtube-wrapper").YTPlayer({
        fitToBackground: true,
        videoId: v,
        pauseOnScroll: true,
        mute: f,
        callback: function () {
            var a = $(".background-youtube-wrapper").data("ytPlayer").player;
        }
    });
    var w = $(".background-vimeo").data("vim"),
        bvc = $(".background-vimeo"),
        bvmc = $(".media-container"),
        bvfc = $(".background-vimeo iframe "),
        vch = $(".video-container");
    bvc.append('<iframe src="//player.vimeo.com/video/' + w + '?background=1"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>');
    $(".video-holder").height(bvmc.height());
    if ($(window).width() > 1024) {
        if ($(".video-holder").length > 0)
            if (bvmc.height() / 9 * 16 > bvmc.width()) {
                bvfc.height(bvmc.height()).width(bvmc.height() / 9 * 16);
                bvfc.css({
                    "margin-left": -1 * $("iframe").width() / 2 + "px",
                    top: "-75px",
                    "margin-top": "0px"
                });
            } else {
                bvfc.width($(window).width()).height($(window).width() / 16 * 9);
                bvfc.css({
                    "margin-left": -1 * $("iframe").width() / 2 + "px",
                    "margin-top": -1 * $("iframe").height() / 2 + "px",
                    top: "50%"
                });
            }
    } else if ($(window).width() < 760) {
        $(".video-holder").height(bvmc.height());
        bvfc.height(bvmc.height());
    } else {
        $(".video-holder").height(bvmc.height());
        bvfc.height(bvmc.height());
    }
    vch.css("width", $(window).width() + "px");
    vch.css("height", 720 / 1280 * $(window).width()) + "px";
    if (vch.height() < $(window).height()) {
        vch.css("height", $(window).height() + "px");
        vch.css("width", 1280 / 720 * $(window).height()) + "px";
    }
    $(".scroll-init  ul ").singlePageNav({
        filter: ":not(.external)",
        updateHash: false,
        offset: 160,
        threshold: 150,
        speed: 1200,
        currentClass: "act-scrlink"
    });
    $(".rate-item-bg").each(function () {
        $(this).find(".rate-item-line").css({
            width: $(this).attr("data-percent")
        });
    });
    // scroll animation ------------------
    $(window).on("scroll", function (a) {
        if ($(this).scrollTop() > 150) {
            $(".to-top").fadeIn(500);
        } else {
            $(".to-top").fadeOut(500)
        }
    });
    //   scroll to------------------
    $(".custom-scroll-link").on("click", function () {
        var a = 150 + $(".scroll-nav-wrapper").height();
        if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") || location.hostname === this.hostname) {
            var b = $(this.hash);
            b = b.length ? b : $("[name=" + this.hash.slice(1) + "]");
            if (b.length) {
                $("html,body").animate({
                    scrollTop: b.offset().top - a
                }, {
                    queue: false,
                    duration: 1200,
                    easing: "easeInOutExpo"
                });
                return false;
            }
        }
    });
    $(".to-top").on("click", function (a) {
        a.preventDefault();
        $("html, body").animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    // modal ------------------
    var modal = {};
    modal.hide = function () {
        $('.modal , .reg-overlay').fadeOut(200);
        $("html, body").removeClass("hid-body");
    };
    $('.modal-open').on("click", function (e) {
        e.preventDefault();
        $('.modal , .reg-overlay').fadeIn(200);
        $("html, body").addClass("hid-body");
    });
    $('.close-reg , .reg-overlay').on("click", function () {
        modal.hide();
    });
    // Header ------------------
    $(".more-filter-option").on("click", function () {
        $(".hidden-listing-filter").slideToggle(500);
        $(this).find("span").toggleClass("mfilopact");
    });
    var headSearch = $(".header-search"),
        ssbut = $(".show-search-button"),
        wlwrp = $(".wishlist-wrap"),
        wllink = $(".wishlist-link");

    function showSearch() {
        headSearch.addClass("vis-head-search").removeClass("vis-search");
        ssbut.find("span").text("Close");
        ssbut.find("i").addClass("vis-head-search-close");
        hideWishlist();
    }

    function hideSearch() {
        headSearch.removeClass("vis-head-search").addClass("vis-search");
        ssbut.find("span").text("Search");
        ssbut.find("i").removeClass("vis-head-search-close");
    }

    ssbut.on("click", function () {
        if ($(".header-search").hasClass("vis-search")) showSearch();
        else hideSearch();
    });
    $(".close-header-search").on("click", function () {
        hideSearch();
    });

    function showWishlist() {
        wlwrp.fadeIn(1).addClass("vis-wishlist").removeClass("novis_wishlist")
        hideSearch();
        wllink.addClass("scwllink");
    }

    function hideWishlist() {
        wlwrp.fadeOut(1).removeClass("vis-wishlist").addClass("novis_wishlist");
        wllink.removeClass("scwllink");
    }

    wllink.on("click", function () {
        if (wlwrp.hasClass("novis_wishlist")) showWishlist();
        else hideWishlist();
    });
    $(".act-hiddenpanel").on("click", function () {
        $(this).toggleClass("active-hidden-opt-btn").find("span").text($(this).find("span").text() === 'Close options' ? 'More options' : 'Close options');
        $(".hidden-listing-filter").slideToggle(400);
    });
    // Forms ------------------
    $(document).on('change', '.leave-rating input', function () {
        var $radio = $(this);
        $('.leave-rating .selected').removeClass('selected');
        $radio.closest('label').addClass('selected');
    });
    $('.chosen-select').niceSelect();
    $(".range-slider").ionRangeSlider({
        type: "double",
        keyboard: true
    });
    $(".rate-range").ionRangeSlider({
        type: "single",
        hide_min_max: true,
    });
    $("form.book-form[name=bookFormCalc]").jAutoCalc("destroy");
    $("form.book-form[name=bookFormCalc]").jAutoCalc({
        initFire: true,
        decimalPlaces: 0,
        emptyAsZero: true
    });
    $("form[name=rangeCalc]").jAutoCalc("destroy");
    $("form[name=rangeCalc]").jAutoCalc({
        initFire: true,
        decimalPlaces: 1,
        emptyAsZero: false
    });

    $('input[name="header-search"]').daterangepicker({
        autoUpdateInput: false,
        parentEl: $(".date-parent"),
        locale: {
            cancelLabel: 'Clear'
        }
    });
    $('input[name="header-search"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });
    $('input[name="header-search"]').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
    $('input[name="dates"]').daterangepicker({
        autoUpdateInput: false,
        parentEl: $(".date-container"),
        locale: {
            cancelLabel: 'Clear'
        }
    });
    $('input[name="dates"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });
    $('input[name="dates"]').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
    $('input[name="bookdates"]').daterangepicker({
        autoUpdateInput: false,
        parentEl: $(".bookdate-container"),
        locale: {
            cancelLabel: 'Clear'
        }
    });
    $('input[name="bookdates"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });
    $('input[name="bookdates"]').on('apply.daterangepicker', function (ev, picker) {
        var start = moment(picker.startDate.format('MM/DD/YYYY')),
            end = moment(picker.endDate.format('MM/DD/YYYY')),
            c = 24 * 60 * 60 * 1000,
            diffDays = Math.round(Math.abs((start - end) / (c))),
            tdv = $("#totaldays").val(diffDays + 1).trigger('change');
        $(".bookdate-container-dayscounter strong").text($("#totaldays").val());
    });
    $('input[name="bookdates"]').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
    $('input[name="main-input-search"]').daterangepicker({
        autoUpdateInput: false,
        parentEl: $(".main-date-parent"),
        locale: {
            cancelLabel: 'Clear'
        }
    });
    $('input[name="main-input-search"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });
    $('input[name="main-input-search"]').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
    $('input[name="main-input-search_slider"]').daterangepicker({
        autoUpdateInput: false,
        drops: "up",
        parentEl: $(".main-date-parent3"),
        locale: {
            cancelLabel: 'Clear'
        }
    });
    $('input[name="main-input-search_slider"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });
    $('input[name="main-input-search_slider"]').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
    $(".qty-dropdown-header").on("click", function () {

        $(this).parent(".qty-dropdown").find(".qty-dropdown-content").slideToggle(400);
    });
    $(".show-hidden-map").on("click", function (e) {
        e.preventDefault();
        $(".show-hidden-map").find("span").text($(".show-hidden-map span").text() === 'Close' ? 'On The Map' : 'Close');
        $(".hidden-map-container").slideToggle(400);
    });

    function showColumnhiddenmap() {
        if ($(window).width() < 1064) {
            $(".hid-mob-map").animate({
                right: 0
            }, 500, "easeInOutExpo").addClass("fixed-mobile");
        }
    }

    $(".map-item , .schm").on("click", function (e) {
        e.preventDefault();
        showColumnhiddenmap();
    });
    $('.map-close').on("click", function (e) {
        $(".hid-mob-map").animate({
            right: "-100%"
        }, 500, "easeInOutExpo").removeClass("fixed-mobile");
    });
    $(".show-list-wrap-search").on("click", function (e) {
        $(".lws_mobile").slideToggle(400);

    });
    $(".eye").on("click touchstart", function () {
        var epi = $(this).parent(".pass-input-wrap").find("input");
        if (epi.attr("type") === "password") {
            epi.attr("type", "text");
        } else {
            epi.attr("type", "password");
        }
    });
    $(".tfp-btn").on("click", function () {
        $(this).toggleClass("rot_tfp-btn");
        $(".tfp-det").toggleClass("vis_tfp-det ");
    });
    // $(".dasboard-menu li").on({
    //     mouseenter: function () {

    //         $(this).find("a").css({
    //             "color": "#666",
    //             "background": "#fff"
    //         });

    //     },
    //     mouseleave: function () {
    //         $(this).find("a").css({
    //             "color": "#fff",
    //             "background": "none"
    //         });
    //     }
    // });
    var current_fs, next_fs, previous_fs;
    var left, opacity, scale;
    var animating;
    $(".next-form").on("click", function (e) {

        e.preventDefault();
        if (animating) return false;
        animating = true;
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        $("#progressbar li").eq($("fieldset.book_mdf").index(next_fs)).addClass("active");
        next_fs.show();
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        current_fs.animate({
            opacity: 0
        }, {

            step: function (now, mx) {
                scale = 1 - (1 - now) * 0.2;
                left = (now * 50) + "%";
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'position': 'absolute'
                });
                next_fs.css({
                    'left': left,
                    'opacity': opacity,
                    'position': 'relative'
                });
            },
            duration: 1200,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            easing: 'easeInOutBack'

        });
    });
    $(".back-form").on("click", function (e) {
        e.preventDefault();
        if (animating) return false;
        animating = true;
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        $("#progressbar li").eq($("fieldset.book_mdf").index(current_fs)).removeClass("active");
        previous_fs.show();
        current_fs.animate({
            opacity: 0
        }, {
            step: function (now, mx) {
                scale = 0.8 + (1 - now) * 0.2;
                left = ((1 - now) * 50) + "%";
                opacity = 1 - now;
                current_fs.css({
                    'left': left,
                    'position': 'absolute'
                });
                previous_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'opacity': opacity,
                    'position': 'relative'
                });
            },
            duration: 1200,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            easing: 'easeInOutBack'
        });
    });
    $('.faq-nav li a').on("click", function () {
        $('.faq-nav li a').removeClass("act-faq-link");
        $(this).addClass("act-faq-link");
    });
    $('.tariff-toggle').on("click", function () {
        if ($('#yearly-1').is(':checked')) {
            $('.price-item').addClass('year-mont');
        }
        if ($('#monthly-1').is(':checked')) {
            $('.price-item').removeClass('year-mont');
        }
    });
    //   scrollToFixed------------------
    $(".fixed-scroll-column-item").scrollToFixed({
        minWidth: 1064,
        marginTop: 200,
        removeOffsets: true,
        limit: function () {
            var a = $(".limit-box").offset().top - $(".fixed-scroll-column-item").outerHeight() - 46;
            return a;
        }
    });
    $(".fix-map").scrollToFixed({
        minWidth: 1064,
        zIndex: 0,
        marginTop: 110,
        removeOffsets: true,
        limit: function () {
            var a = $(".limit-box").offset().top - $(".fix-map").outerHeight(true);
            return a;
        }
    });


    $(".scroll-nav-wrapper").scrollToFixed({
        minWidth: 768,
        zIndex: 1112,
        marginTop: 0,
        removeOffsets: true,
        limit: function () {
            var a = $(".limit-box").offset().top - $(".scroll-nav-wrapper").outerHeight(true) - 190;
            return a;
        }
    });
    $(".back-to-filters").scrollToFixed({
        minWidth: 1064,
        zIndex: 12,
        marginTop: 190,
        removeOffsets: true,
        limit: function () {
            var a = $(".limit-box").offset().top - $(".back-to-filters").outerHeight(true) - 30;
            return a;
        }
    });


    $("#more").on('click', function () {
        $('.overview_content').css({height: 'auto'})
        $(this).addClass("d-none");

    });

    if ($('.incover').height() < $('.overview_content').height()) {
        $("#more").addClass("d-none");
    }


    $('#myTab .nav-link').click(function () {

        var imgId = $(this).attr("id");
        var imgSrc = $(this).find('img').attr("src");

        if (imgSrc.indexOf("-active") == -1) {
            $(this).find('img').attr("src", imgSrc.substring(0, imgSrc.length - 4) + "-active.svg");
            $("#myTab .nav-link").not(this).find("img").attr("src", function (i, orig) {
                return orig.replace("-active.svg", ".svg");
            });
        }
    })

    var base_url = jQuery('base').attr('url');

    /* ##### DOMESTIC FLIGHT START ##### */

    // Function to remove error message
    const errorSet = {}; // Flag to track if error has been set for an input
    var adultCounter = 0;
    function removeErrorMessage(input) {
        const inputId = input.attr('id');
        input.next('.validate-has-error').remove();
        input.removeClass('validate-has-error text-danger');
        delete errorSet[inputId];
    }

    function setErrorMessage(input, inputId) {
        if (!errorSet[inputId]) {
            // Remove existing error message, if any
            input.next('.validate-has-error').remove();

            // Add the error message
            input.after('<p class="form-text validate-has-error text-danger">This field is required.</p>');
            input.addClass('validate-has-error text-danger');
            errorSet[inputId] = true; // Set flag for this input
        }
    }

    function checkErrors(obj) {

        var isFormValid = true;

        if (typeof obj !== 'object' || obj === null || Array.isArray(obj)) {
            return;
        }

        for (var key in obj) {
            if (obj.hasOwnProperty(key)) {
                var value = obj[key];
                if (value === false) {
                    isFormValid = true;
                }
                else {
                    isFormValid = false;
                }
            }
        }
        
        return isFormValid;
    }

    function checkInputsAndSubmit(selector, counter, addButtonSelector, isNotEmptyArray) {
        $(`div[id^="${selector}-${counter}"]`).find('input[type=text], select').each(function() {
            isNotEmptyArray.push($(this).val() !== '');
        });

        let no_of_rows = $(`[id^="${selector}-"]`).length;
        
        if(no_of_rows > 1) {
            if (isNotEmptyArray.length > 0 && !isNotEmptyArray.includes(false)) {
                $(addButtonSelector).click();
                $("#domesticbookingform").submit();
            }
        }
    }

    $('#agree').on('change', function() {
        let isAgree = $(this).is(":checked");
        $(this).css('border-color', !isAgree ? 'red' : '');
    });

    if($("#domesticbookingform")[0]) {
        
        $("#domesticbookingform").validate({
            errorElement: 'span',
            errorClass: 'form-text validate-has-error text-danger',
            rules: {
                email: {required: true,},
                contactNumber: {required: true},
            },
            messages: {
                email: {required: "Please enter the verified Email Address."},
                contactNumber: {required: "Please enter the contact number."},
            },
            submitHandler: function (form) {
                const inputs = [];
                $('div[id^="adult-travellers-info-"], div[id^="child-travellers-info-"]').each(function() {
                    const currentRow = $(this);
                    currentRow.find('input[type=text], select').each(function() {
                        const input = $(this);
                        if (input.val() === '') {
                            inputs.push(input); // Collect inputs that need focus
                        }

                        input.on('input change', function() {
                            if (input.val() !== '') {
                                removeErrorMessage(input);
                            }
                            else {
                                setErrorMessage(input, input.attr('id'));
                            }
                        });
                    });
                });

                // Set focus and error message for empty inputs
                for (let i = inputs.length - 1; i >= 0; i--) {
                    const input = inputs[i];
                    const inputId = input.attr('id');

                    input.focus();

                    setErrorMessage(input, inputId);
                }

                var isAdultNotEmpty = [];
                var isChildNotEmpty = [];
                if(!checkErrors(errorSet)) {
                    checkInputsAndSubmit("adult-travellers-info", adultCounter, "#add-more-adult-travellers", isAdultNotEmpty);
                    checkInputsAndSubmit("child-travellers-info", childCounter, "#add-more-child-travellers", isChildNotEmpty);
                }
                else {
                    let isAgree = $('#agree').is(":checked");
                    if(!isAgree) {
                        // add error class
                        $('#agree').css('border-color', 'red');
                        return;
                    }

                    $('#secform').hide();
                    $('#secconfirm').show();

                    const formDataString = $("#domesticbookingform").serialize();
                    // console.log(formDataString);

                    $("#txt-email-address").text($("#email").val());
                    $("#txt-contact-number").text($("#contactNumber").val());
                    
                    const formData = new URLSearchParams(formDataString);

                    let rowAdult = 0, rowChild = 0;
                    formData.forEach((value, key) => {
                        if (!['email', 'contactNumber', 'agree'].some(field => key.includes(field))) {
                            if (['adultFirstName', 'adultLastName', 'adultGender'].some(field => key.startsWith(field))) {
                                // console.log(key, value);
                                $("#txt-email-address").val($("#email").val())
                                $(`#span-adultName${rowAdult}`).html(`${$(`#adultFirstName${rowAdult}`).val()} ${$(`#adultLastName${rowAdult}`).val()}`);
                                $(`#span-adultNationality-text${rowAdult}`).html(`${$(`#adultNationality${rowAdult}`).find(":selected").text()}`);
                                $(`#span-adultGender-text${rowAdult}`).html(`${$('input[name="adultGender'+rowAdult+'"]:checked').parent().text()}`);
                                rowAdult++;
                            }
                            if (['childFirstName', 'childLastName', 'childGender'].some(field => key.startsWith(field))) {
                                // console.log(key, value);
                                $(`#span-childName${rowChild}`).html(`${$(`#childFirstName${rowChild}`).val()} ${$(`#childLastName${rowChild}`).val()}`);
                                $(`#span-childNationality-text${rowChild}`).html(`${$(`#childNationality${rowChild}`).find(":selected").text()}`);
                                $(`#span-childGender-text${rowChild}`).html(`${$('input[name="childGender'+rowChild+'"]:checked').parent().text()}`);
                                rowChild++;
                            }
                            $(`#span-${key}`).html(value);
                        }
                    });
                }
            }
        });
    }

    // Add or Remove Adult Travellers - start
    
    $("#add-more-adult-travellers").click(function() {
        let adultRow = $(this).data('add');
        adultCounter = adultCounter + 1;
        
        $('#add-more').text(adultRow - adultCounter);

        if($('div[id^="adult-travellers-info-"]:eq(' + adultCounter +')')[0] !== undefined) {
            $('div[id^="adult-travellers-info-"]:eq(' + adultCounter +')').show();
        }
        if(adultRow === adultCounter) {
            // $("#remove-adult-traveller").show();
            $(this).hide();
        }
        // $("#domesticbookingform").submit();
    });

    /* $("#remove-adult-traveller").click(function() {
        let adultRow = $("#add-more-adult-travellers").data('add');
        if($('div[id^="adult-travellers-info-"]').length > 1) {
            adultCounter = adultCounter - 1;
            $('#add-more').text(adultRow - adultCounter);

            var $div = $('div[id^="adult-travellers-info-"]:last');
            
            $div.find('input[type=text], input:radio[value="M"], select').each(function() {
                const input = $(this);
                if (input.is(':radio'))
                    input.prop('checked', true);
                else
                    input.val('');
            });
            
            $div.hide();
            $(this).hide();
            $("#add-more-adult-travellers").show();
        }
    }); */

    // Add or Remove Adult Travellers - end


    // Add or Remove Child Travellers - start
    
    var childCounter = 0;
    $("#add-more-child-travellers").click(function() {
        let childRow = $(this).data('add');
        childCounter = childCounter + 1;
        
        $('#add-more-child').text(childRow - childCounter);

        if($('div[id^="child-travellers-info-"]:eq(' + childCounter +')')[0] !== undefined) {
            $('div[id^="child-travellers-info-"]:eq(' + childCounter +')').show();
        }
        if(childRow === childCounter) {
            // $("#remove-child-traveller").show();
            $(this).hide();
        }
        // $("#domesticbookingform").submit();
    });
    
    // Add or Remove Child Travellers - end

    // Handles increment, decrement for domestic travellers - start

    const number_el = $('#input-adult-number');
    const number_el_1 = $('#input-child-number');
    const label_traveller = $('#label-traveller');

    function updateTravellerLabel() {
        const adultVal = parseInt(number_el.val());
        const childVal = parseInt(number_el_1.val());
        label_traveller.text(adultVal + childVal);
    }

    function handleIncrement(target) {
        const val = parseInt(target.val());
        target.val(val + 1);
        updateTravellerLabel();
    }

    function handleDecrement(target, minValue) {
        let val = parseInt(target.val());
        if (val > minValue) {
            target.val(val - 1);
            updateTravellerLabel();
        }
    }

    $('#adult-increment').click(function(e) {
        handleIncrement(number_el);
    });

    $('#adult-decrement').click(function(e) {
        handleDecrement(number_el, 1);
    });

    $('#child-increment').click(function(e) {
        handleIncrement(number_el_1);
    });

    $('#child-decrement').click(function(e) {
        handleDecrement(number_el_1, 0);
    });

    // Handles increment, decrement for domestic travellers - end

    var departure_selected = false;
    var arrival_selected = false;

    $('#domestic_departure').click(function(e) {
        $(this).autocomplete({
            source: base_url + "domesticcomplete.php",
            showHintOnFocus: true,
            select: function (event, ui) {
                $('input[name="domestic_departure_code"]').val(ui.item.id);
                departure_selected = true;
                if(departure_selected == true && arrival_selected == true) {
                    $('#btn-domestic-search').prop('disabled', false);
                }
            }
        })
        .focus(function() {
            $(this).autocomplete('search', $(this).val())
        });
    });

    $('#domestic_arrival').click(function(e) {
        $(this).autocomplete({
            source: base_url + "domesticcomplete.php",
            showHintOnFocus: true,
            select: function (event, ui) {
                $('input[name="domestic_arrival_code"]').val(ui.item.id);
                arrival_selected = true;
                if(departure_selected == true && arrival_selected == true) {
                    $('#btn-domestic-search').prop('disabled', false);
                }
            }
        })
        .focus(function() {
            $(this).autocomplete('search', $(this).val())
        })
    });

    $('#tripType1').click(function() {
        if($('#tripType1').val() == 'O') {
            $(".returnDate").css('display', 'none');
        }
    });

    $('#tripType2').click(function() {
        if($('#tripType2').val() == 'R') {
            $(".returnDate").css('display', 'block');
        }
    });

    if($("#domesticsearchform")[0]) {

        const weekdays = [
            'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
        ];

        $('#d_checkin').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'MM dd, yy',
            minDate: '0',
            maxDate: '+2Y',
            onSelect: function (dateStr, inst) {
                var d1 = $(this).datepicker("getDate");
                d1.setDate(d1.getDate() + 1); // change to + 1 if necessary
                var d2 = $(this).datepicker("getDate");
                d2.setDate(d2.getDate() + 180); // change to + 180 if necessary
                $("#d_checkout").datepicker("option", "minDate", d1);
                $("#d_checkout").datepicker("option", "maxDate", d2);
                var start = $("#d_checkin").datepicker("getDate");
                var end = $("#d_checkout").datepicker("getDate");
                var days = (end - start) / 1000 / 60 / 60 / 24;
                if (end != null)
                    var dd = $(this).datepicker("getDate");
                $('#d_checkout').datepicker('setDate', d1);
                // console.log(d1);
                // find day
                const selectedDate = new Date(inst.currentYear, inst.currentMonth, inst.currentDay);
                $('#departureDay').text(weekdays[selectedDate.getDay()]);
                $('#returnDay').text(weekdays[d1.getDay()]);
            }
        });


        $('#d_checkout').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'MM dd, yy',
            minDate: $("#d_checkin").datepicker("getDate"),
            maxDate: '+2Y',
            onSelect: function (dateStr, inst) {
                const selectedDate = new Date(inst.currentYear, inst.currentMonth, inst.currentDay);
                $('#returnDay').text(weekdays[selectedDate.getDay()]);
                $('.returnDay').css('display', 'block');
            }
        });

        $("#domesticsearchform").validate({
            errorElement: 'span',
            errorClass: 'validate-has-error text-danger',
            rules: {
                domestic_departure: {required: true,},
                domestic_arrival: {required: true},
                /* adults: {required: true},
                nationality: {required: true}, */
                d_checkout: {required: true}
            },
            messages: {
                domestic_departure: {required: "Please enter a source."},
                domestic_arrival: {required: "Please enter a destination."},
                /* adults: {required: ''},
                nationality: {required: ''}, */
                d_checkout: {required: "Please enter a date."}
            },
            submitHandler: function (form) {

                if($('#nationality').val() == '') {
                    $('.flight-travelers-section-toggle').dropdown('toggle');
                    $('#nationality').addClass('validate-has-error text-danger')
                    return;
                }

                $('#sec0').show();
                $('#secmain').hide();
                
                var Frmval = $("#domesticsearchform").serialize();
                // $("#btn-search").attr("disabled", "true").html('Loading...');
                /* console.log("Frmval", Frmval);
                return; */
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: base_url + "domesticcomplete.php",
                    data: "action=getlink&" + Frmval,
                    success: function (data) {
                        var msg = eval(data);
                        window.location.href = base_url + "flight/search/" + data.url + "/" + data.tab;
                    }
                });
                return false;
            }
        });
    }

    /* ##### DOMESTIC FLIGHT END ##### */

    /* ##### HOTEL START ##### */

    if ($('#hotelsearchform')[0]) {

        $("#searchkey").autocomplete({
            source: base_url + "hotelcomplete.php",
            minLength: 0,
            showHintOnFocus: true,
            select: function (event, ui) {
                $('input[name="hotelid"]').val(ui.item.id);
            }
        }).focus(function () {
            $(this).autocomplete("search");
        });

        const weekdays = [
            'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
        ];

        $('#checkin').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            minDate: '0',
            maxDate: '+2Y',
            onSelect: function (dateStr, inst) {
                var d1 = $(this).datepicker("getDate");
                d1.setDate(d1.getDate() + 1); // change to + 1 if necessary
                var d2 = $(this).datepicker("getDate");
                d2.setDate(d2.getDate() + 180); // change to + 180 if necessary
                $("#checkout").datepicker("option", "minDate", d1);
                $("#checkout").datepicker("option", "maxDate", d2);
                var start = $("#checkin").datepicker("getDate");
                var end = $("#checkout").datepicker("getDate");
                var days = (end - start) / 1000 / 60 / 60 / 24;
                if (end != null)
                    var dd = $(this).datepicker("getDate");
                $('#checkout').datepicker('setDate', d1);
                // console.log(d1);
                // find day
                const selectedDate = new Date(inst.currentYear, inst.currentMonth, inst.currentDay);
                $('#checkinDay').text(weekdays[selectedDate.getDay()]);
                $('#checkoutDay').text(weekdays[d1.getDay()]);
            }
        });


        $('#checkout').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            minDate: $("#checkin").datepicker("getDate"),
            maxDate: '+2Y',
            onSelect: function (dateStr, inst) {
                const selectedDate = new Date(inst.currentYear, inst.currentMonth, inst.currentDay);
                $('#checkoutDay').text(weekdays[selectedDate.getDay()]);
            }
        });

        $("#hotelsearchform").validate({
            errorElement: 'span',
            errorClass: 'validate-has-error text-danger',
            rules: {
                searchkey: {required: true,},
                hotelid: {required: true}
            },
            messages: {
                searchkey: {required: "Please enter a destination to start searching.",},
                hotelid: {required: ''}
            },
            submitHandler: function (form) {
                var Frmval = $("#hotelsearchform").serialize();
                /* console.log("Frmval", Frmval);
                return; */
                $("#btn-search").attr("disabled", "true").html('Loading...');
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: base_url + "hotelcomplete.php",
                    data: "action=getlink&" + Frmval,
                    success: function (data) {
                        var msg = eval(data);
                        window.location.href = base_url + "search/" + data.url;
                    }
                });
                return false;
            }
        });
    }

    /* ##### HOTEL END ##### */

    /* ##### PACKAGE START ##### */

    $("#tourSearchBtn").click(function (e) {
        e.preventDefault();
        var Frmval = $("#toursearchform").serialize();
        $("#tourSearchBtn").attr("disabled", "true").html('Loading...');
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: base_url + "hotelcomplete.php",
            data: "action=getlinktour&" + Frmval,
            success: function (data) {
                var msg = eval(data);
                window.location.href = base_url + "package/search/" + data.url;
            }
        });
    });

    /* ##### PACKAGE END ##### */

    /* ##### VEHICLE START ##### */

    if ($('#vehicleForm')[0]) {
        $("#search-from").autocomplete({
            source: base_url + "routelist.php",
            // minLength: 2,
            showHintOnFocus: true,
            select: function (event, ui) {
                $('input[name="search_from"]').val(ui.item.id);
            }
        });
        $("#search-to").autocomplete({
            source: base_url + "routelist.php",
            // minLength: 2,
            showHintOnFocus: true,
            select: function (event, ui) {
                $('input[name="search_to"]').val(ui.item.id);
            }
        });
        $('#search-date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            minDate: '0',
            maxDate: '+2Y'
        });

        $("#vehicleForm").validate({
            errorElement: 'span',
            errorClass: 'validate-has-error text-danger ps-5',
            rules: {
                searchkey_from: {required: true},
                search_from: {required: true},
                searchkey_to: {required: true},
                search_to: {required: true},
                search_date: {required: true}
            },
            messages: {
                searchkey_from: {required: 'Required !'},
                search_from: {required: 'Required !'},
                searchkey_to: {required: 'Required !'},
                search_to: {required: 'Required !'},
                search_date: {required: 'Required !'}
            },
            onfocusout: function (element, event) {
                // console.log('>>', element, event);
            },
            submitHandler: function (form) {
                if (form) {
                    $(form).find('span.validate-has-error').remove();
                    var Frmval = $(form).serialize();
                    $("#btn-search-vehicle").attr("disabled", "true").html('Loading...');
                    $.ajax({
                        type: "POST",
                        dataType: "JSON",
                        url: base_url + "routelist.php",
                        data: "action=getlink&" + Frmval,
                        success: function (data) {
                            var msg = eval(data);
                            window.location.href = base_url + "vehicles/" + data.url;
                        }
                    });
                    return false;
                }
            }
        });
    }

    /* ##### VEHICLE END ##### */

    $(".dasboard-sidebar-content").scrollToFixed({
        minWidth: 1064,
        zIndex: 12,
        marginTop: 130,
        removeOffsets: true,
        limit: function () {
            var a = $(".limit-box").offset().top - $(".dasboard-sidebar-content").outerHeight(true) - 48;
            return a;
        }
    });
    $(".help-bar").scrollToFixed({
        minWidth: 1064,
        zIndex: 12,
        marginTop: 130,
        removeOffsets: true,
        limit: function () {
            var a = $(".limit-box").offset().top - $(".help-bar").outerHeight(true) + 10;
            return a;
        }
    });
    
    if ($(".fixed-bar").outerHeight(true) < $(".post-container").outerHeight(true)) {
        $(".fixed-bar").addClass("fixbar-action");
        $(".fixbar-action").scrollToFixed({
            minWidth: 1064,
            marginTop: 80,
            // function () {
            //     var a = $(window).height() - $(".fixed-bar").outerHeight(true)-200 ;
            //     if (a >= 0) return 20;
            //     return a;
            // }
            removeOffsets: true,
            limit: function () {
                var a = $(".limit-box").offset().top - $(".fixed-bar").outerHeight(true) - 170;
                return a;
            }
        });
    } else $(".fixed-bar").removeClass("fixbar-action");
    //   Slick------------------
    var sbp = $('.swiper-button-prev'),
        sbn = $('.swiper-button-next');
    $('.fw-carousel').slick({
        dots: true,
        infinite: true,
        speed: 600,
        slidesToShow: 1,
        centerMode: false,
        arrows: false,
        variableWidth: true
    });
    sbp.on("click", function () {
        $('.fw-carousel').slick('slickPrev');
    })

    sbn.on("click", function () {
        $('.fw-carousel').slick('slickNext');
    })
    $('.slideshow-container').slick({
        dots: true,
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        fade: true,
        cssEase: 'ease-in',
        infinite: true,
        speed: 1000,
    });
    $('.single-slider').slick({
        infinite: true,
        slidesToShow: 1,
        dots: true,
        arrows: false,
        adaptiveHeight: true
    });
    sbp.on("click", function () {
        $(this).closest(".single-slider-wrapper").find('.single-slider').slick('slickPrev');
    });
    sbn.on("click", function () {
        $(this).closest(".single-slider-wrapper").find('.single-slider').slick('slickNext');
    });
    $('.slider-container').slick({
        infinite: true,
        slidesToShow: 1,
        dots: true,
        arrows: false,
        adaptiveHeight: true,
    });
    $('.slider-container').on('init', function (event, slick) {
        initAutocomplete();
    });
    sbp.on("click", function () {
        $(this).closest(".slider-container-wrap").find('.slider-container').slick('slickPrev');

    });
    sbn.on("click", function () {
        $(this).closest(".slider-container-wrap").find('.slider-container').slick('slickNext');
    });
    $('.single-carousel').slick({
        infinite: true,
        slidesToShow: 3,
        dots: true,
        arrows: false,
        centerMode: true,
        responsive: [{
            breakpoint: 1224,
            settings: {
                slidesToShow: 2,
                centerMode: false,
            }
        },

            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                    centerPadding: '0',
                }
            }
        ]

    });
    sbp.on("click", function () {
        $(this).closest(".slider-carousel-wrap").find('.single-carousel').slick('slickPrev');
    });
    sbn.on("click", function () {
        $(this).closest(".slider-carousel-wrap").find('.single-carousel').slick('slickNext');
    });
    $('.inline-carousel').slick({
        infinite: true,
        slidesToShow: 3,
        dots: true,
        arrows: false,
        centerMode: false,
        responsive: [{
            breakpoint: 1224,
            settings: {
                slidesToShow: 4,
                centerMode: false,
            }
        },

            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                }
            }
        ]
    });
    $(".fc-cont-prev").on("click", function () {
        $(this).closest(".inline-carousel-wrap").find('.inline-carousel').slick('slickPrev');
    });
    $(".fc-cont-next").on("click", function () {
        $(this).closest(".inline-carousel-wrap").find('.inline-carousel').slick('slickNext');
    });
    $('.footer-carousel').slick({
        infinite: true,
        slidesToShow: 5,
        dots: false,
        arrows: false,
        centerMode: false,
        responsive: [{
            breakpoint: 1224,
            settings: {
                slidesToShow: 4,
                centerMode: false,
            }
        },

            {
                breakpoint: 568,
                settings: {
                    slidesToShow: 3,
                    centerMode: false,
                }
            }
        ]

    });
    $(".fc-cont-prev").on("click", function () {
        $(this).closest(".footer-carousel-wrap").find('.footer-carousel').slick('slickPrev');
    });
    $(".fc-cont-next").on("click", function () {
        $(this).closest(".footer-carousel-wrap").find('.footer-carousel').slick('slickNext');
    });
    $('.listing-carousel').slick({
        infinite: true,
        slidesToShow: 4,
        dots: true,
        arrows: false,
        centerMode: true,
        centerPadding: '60px',
        responsive: [{
            breakpoint: 1224,
            settings: {
                slidesToShow: 3,
            }
        },

            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,

                }
            },
            {
                breakpoint: 540,
                settings: {
                    slidesToShow: 1,
                    centerPadding: '0',
                }
            }
        ]

    });
    sbp.on("click", function () {
        $(this).closest(".list-carousel").find('.listing-carousel').slick('slickPrev');
    });
    sbn.on("click", function () {
        $(this).closest(".list-carousel").find('.listing-carousel').slick('slickNext');
    });
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        dots: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows: false,
        centerMode: true,
        focusOnSelect: true
    });
    sbp.on("click", function () {
        $(this).closest(".single-slider-wrapper").find('.slider-for').slick('slickPrev');
    });
    sbn.on("click", function () {
        $(this).closest(".single-slider-wrapper").find('.slider-for').slick('slickNext');
    });
    $('.light-carousel').slick({
        infinite: true,
        slidesToShow: 2,
        dots: false,
        arrows: false,
        centerMode: false,
        responsive: [{
            breakpoint: 1224,
            settings: {
                slidesToShow: 2,
                centerMode: false,
            }
        },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                    centerPadding: '0',
                }
            }
        ]
    });
    $(".lc-prev").on("click", function () {
        $(this).closest(".light-carousel-wrap").find('.light-carousel').slick('slickPrev');
    });
    $(".lc-next").on("click", function () {
        $(this).closest(".light-carousel-wrap").find('.light-carousel').slick('slickNext');
    });
    // Styles ------------------
    if ($("footer.main-footer").hasClass("fixed-footer")) {
        $('<div class="height-emulator fl-wrap"></div>').appendTo("#main");
    }

    function csselem() {
        $(".height-emulator").css({
            height: $(".fixed-footer").outerHeight(true)
        });
        $(".slideshow-container .slideshow-item").css({
            height: $(".slideshow-container").outerHeight(true)
        });
        $(".slider-container .slider-item").css({
            height: $(".slider-container").outerHeight(true)
        });
        $(".map-container.column-map").css({
            height: $(window).outerHeight(true) - 110 + "px"
        });
    }

    csselem();
    // Mob Menu------------------
    $(".nav-button-wrap").on("click", function () {
        $(".main-menu").toggleClass("vismobmenu");
    });

    // function mobMenuInit() {
    //     var ww = $(window).width();
    //     if (ww < 1064) {
    //         $(".menusb").remove();
    //         $(".main-menu").removeClass("nav-holder");
    //         $(".main-menu nav").clone().addClass("menusb").appendTo(".main-menu");
    //         $(".menusb").menu();
    //         $(".map-container.fw-map.big_map.hid-mob-map").css({
    //             height: $(window).outerHeight(true) - 110 + "px"
    //         });
    //     } else {
    //         $(".menusb").remove();
    //         $(".main-menu").addClass("nav-holder");
    //         $(".map-container.fw-map.big_map.hid-mob-map").css({
    //             height: 550 + "px"
    //         });
    //     }
    // }

    //mobMenuInit();
    //   css ------------------
    var $window = $(window);
    $window.on("resize", function () {
        csselem();
        //mobMenuInit();
        if ($(window).width() > 1064) {
            $(".lws_mobile , .dasboard-menu-wrap").addClass("vishidelem");
            $(".map-container.fw-map.big_map.hid-mob-map").css({
                "right": "0"
            });
            $(".map-container.column-map.hid-mob-map").css({
                "right": "0"
            });
        } else {
            $(".lws_mobile , .dasboard-menu-wrap").removeClass("vishidelem");
            $(".map-container.fw-map.big_map.hid-mob-map").css({
                "right": "-100%"
            });
            $(".map-container.column-map.hid-mob-map").css({
                "right": "-100%"
            });
        }
    });
    $(".box-cat").on({
        mouseenter: function () {
            var a = $(this).data("bgscr");
            $(".bg-ser").css("background-image", "url(" + a + ")");
        }
    });
    $(".header-user-name").on("click", function () {
        $(".header-user-menu ul").toggleClass("hu-menu-vis");
        $(this).toggleClass("hu-menu-visdec");
    });
    // Counter ------------------
    if ($(".counter-widget").length > 0) {
        var countCurrent = $(".counter-widget").attr("data-countDate");
        $(".countdown").downCount({
            date: countCurrent,
            offset: 0
        });
    }

    function showBookingForm() {
        $(".booking-modal-wrap , .bmw-overlay").fadeIn(400);
        $("html, body").addClass("hid-body");
    }

    function hideBookingForm() {
        $(".booking-modal-wrap , .bmw-overlay").fadeOut(400);
        $("html, body").removeClass("hid-body");
    }

    $(".booking-modal-close , .bmw-overlay").on("click", function () {
        hideBookingForm();
    });
    $(".book-btn").on("click", function (e) {
        e.preventDefault();
        showBookingForm();
    });

    $('.filter_toggle').on('click', function () {

        $(this).removeClass('d-block').addClass('d-none');
        $('.asidebar').removeClass('d-none').addClass('d-block');
    })
}

//   Parallax ------------------
function initparallax() {
    var a = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function () {
            return a.Android() || a.BlackBerry() || a.iOS() || a.Opera() || a.Windows();
        }
    };
    trueMobile = a.any();
    if (null === trueMobile) {
        var b = new Scrollax();
        b.reload();
        b.init();
    }
    if (trueMobile) $(".bgvid , .background-vimeo , .background-youtube-wrapper ").remove();
}

//   Star Raiting ------------------
function cardRaining() {
    $.fn.duplicate = function (a, b) {
        var c = [];
        for (var d = 0; d < a; d++) $.merge(c, this.clone(b).get());
        return this.pushStack(c);
    };
    var cr = $(".card-popup-raining"),
        sts = $(".section-title-separator span");
    cr.each(function (cr) {
        var starcount = $(this).attr("data-starrating");
        $("<i class='fas fa-star'></i>").duplicate(starcount).prependTo(this);
    });
    sts.each(function (sts) {
        $("<i class='fas fa-star'></i>").duplicate(3).prependTo(this);
    })
}

cardRaining();
var cr2 = $(".card-popup-rainingvis");
cr2.each(function (cr) {
    var starcount2 = $(this).attr("data-starrating2");
    $("<i class='fa fa-star'></i>").duplicate(starcount2).prependTo(this);
});
$(".location a , .loc-act").on("click", function (e) {
    e.preventDefault();
    $.get("http://ipinfo.io", function (response) {
        $(".location input , .qodef-archive-places-search").val(response.city);

    }, "jsonp");
});

function initAutocomplete() {
    var acInputs = document.getElementsByClassName("autocomplete-input");
    for (var i = 0; i < acInputs.length; i++) {
        var autocomplete = new google.maps.places.Autocomplete(acInputs[i]);
        autocomplete.inputId = acInputs[i].id;
    }
}


//   Init All ------------------
$(document).ready(function () {
    initEasybook();
    initparallax();
});


// form validations
var base_url = $('base').attr('url');

$.validator.addMethod("minDob", function(value, element) {
    var minDobDate = new Date();
    minDobDate.setFullYear(minDobDate.getFullYear() - 18);
    minDobDate.setHours(0);
    minDobDate.setMinutes(0);
    minDobDate.setSeconds(0);
    var inputDate = new Date(value);
    inputDate.setHours(0);
    inputDate.setMinutes(0);
    inputDate.setSeconds(0);
    if (inputDate <= minDobDate)
        return true;
    return false;
}, "Age must be above 18 years old!");

let registerFormRules = {
    'customer' : {
        customer_user_type: {required: !0},
        customer_name: {required: !0},
        customer_username: {required: !0},
        customer_email: {required: !0, email: !0},
        customer_contact_number: {required: !0},
        customer_address: {required: !0},
        customer_nationality: {required: !0}
    },
    'organization' : {
        organization_user_type: {required: !0},
        organization_name: {required: !0},
        organization_username: {required: !0},
        organization_email: {required: !0, email: !0},
        organization_contact_number: {required: !0},
        organization_address: {required: !0},
        organization_nationality: {required: !0},
        organization_type: {required: !0},
        organization_contact_person_name: {required: !0},
        organization_contact_person_email: {required: !0},
        organization_contact_person_contact_number: {required: !0}
    },
    'agency' : {
        agency_user_type: {required: !0},
        agency_name: {required: !0},
        agency_username: {required: !0},
        agency_email: {required: !0, email: !0},
        agency_contact_number: {required: !0},
        agency_address: {required: !0},
        agency_dob: {required: !0, minDob: !0},
        agency_province_id: {required: !0},
        agency_district_id: {required: !0},
        agency_ward: {required: !0},
        agency_occupation: {required: !0}
    }
}

let registerFormMessages = {
    customer_user_type: {required: "Select Membership Type"}, agency_user_type: {required: "Select Membership Type"}, organization_user_type: {required: "Select Membership Type"},
    customer_name: {required: "Enter your Full Name"}, agency_name: {required: "Enter your Full Name"}, organization_name: {required: "Enter your Full Name"},
    customer_username: {required: "Enter your User Name"}, agency_username: {required: "Enter your User Name"}, organization_username: {required: "Enter your User Name"},
    customer_email: {
        required: "Enter your Email Address",
        email: "Enter a valid email address"
    },
    agency_email: {
        required: "Enter your Email Address",
        email: "Enter a valid email address"
    },
    organization_email: {
        required: "Enter your Email Address",
        email: "Enter a valid email address"
    },
    customer_contact_number: {required: "Enter your Contact Number"}, agency_contact_number: {required: "Enter your Contact Number"}, organization_contact_number: {required: "Enter your Contact Number"},
    customer_address: {required: "Enter your address"}, agency_address: {required: "Enter your address"}, organization_address: {required: "Enter your address"},
    customer_nationality: {required: "Enter your Nationality"}, agency_nationality: {required: "Enter your Nationality"}, organization_nationality: {required: "Enter your Nationality"},
    customer_password: {required: "Enter your Password"}, agency_password: {required: "Enter your Password"}, organization_password: {required: "Enter your Password"},
    organization_type: {required: "Enter your Organization Type"},
    organization_contact_person_name: {required: "Enter Full Name"},
    organization_contact_person_email: {required: "Enter Email"},
    organization_contact_person_contact_number: {required: "Enter Contact Number"},
    agency_dob: {required: "Enter your DOB"},
    agency_province_id: {required: "Enter your Province"}, organization_province_id: {required: "Enter your Province"},
    agency_district_id: {required: "Enter your District"}, organization_district_id: {required: "Enter your District"},
    agency_ward: {required: "Enter your Ward No"}, organization_ward: {required: "Enter your Ward No"},
    agency_occupation: {required: "Enter your Occupation"}
};



$(document).ready(function () {
    $("#main-register-form2").validate({
        rules: {
            email: {
                required: !0,
                email: !0
            }
        },
        messages: {
            email: {
                required: "Enter your email address",
                email: "Enter a valid email address"
            }
        },
        errorElement: 'p',
        errorClass: 'text-danger',
        
        messages: registerFormMessages,
        submitHandler: function (form) {
            if (form) {
                var data = $('#main-register-form2').serialize();
                queryString = "action=registerNewFrontUser&" + data;
                // console.log(queryString);
                $("button#submitRegister").attr("disabled", "true").text('Processing...');
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: base_url + "includes/controllers/ajax.user.php",
                    data: queryString ,
                    success: function (data) {
                        var msg = eval(data);
                        $("button#submitRegister").removeAttr("disabled").text('Register');
                        if (msg.action == 'success') {
                            $('#msgRegister').html(msg.message).css('display', 'block').fadeOut(8000);
                            $("form#main-register-form2")[0].reset();
                        }
                        if (msg.action == 'error') {
                            $('#msgRegister').html(msg.message).css('display', 'block').fadeOut(8000);
                        }
                    }
                });
                return !1;
            }
        }
    })

    // for google
    $("#google-register-form2").validate({
        errorElement: 'p',
        errorClass: 'text-danger',
        rules: {
            ...registerFormRules.customer,
            ...registerFormRules.agency,
            ...registerFormRules.organization
        },
        messages: registerFormMessages,
        submitHandler: function (form) {
            if (form) {
                let userType = $(".user-type-btn-check:checked").val();
                // var Frmval = $("#google-register-form2").serialize();
                var Frmval = $(`#google-register-form2 .${userType}-register-fields`).find('select, textarea, input').serialize();
                Frmval = `${Frmval}&user_type=${userType}`;
                $("button#submitRegister").attr("disabled", "true").text('Processing...');
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: base_url + "includes/controllers/ajax.user.php",
                    data: "action=registerNewFrontUserFromGoogleLogin&" + Frmval,
                    success: function (data) {
                        // console.log(data)
                        var msg = eval(data);
                        $("button#submitRegister").removeAttr("disabled").text('Register');
                        if (msg.action == 'success') {
                            $('#msgRegister').html(msg.message).css('display', 'block').fadeOut(8000);
                            $("form#google-register-form2")[0].reset();
                            $("#otp-verification-form2").show();
                            $("#google-register-form2").hide();
                        }
                        if (msg.action == 'error') {
                            $('#msgRegister').html(msg.message).css('display', 'block').fadeOut(8000);
                        }
                    },
                    error: function (data) {
                        var msg = eval(data);
                        $("button#submitRegister").removeAttr("disabled").text('Register');
                        if(data.responseText.startsWith("Could not instantiate mail function")) {
                            $('#msgOtpNotification').html("OTP mailing service is currently unavailable. Please contact administrator (database).");
                            $("#otp-verification-form2").show();
                            $("#google-register-form2").hide();
                        } else {
                            $(".main-register-wrap").hide();
                            alert("Something went wrong");
                        }
                        
                    }
                });

                return !1;
            }
        }
    })

    $("#otp-verification-form2").validate({
        errorElement: 'p',
        errorClass: 'text-danger',
        rules: {
            otp: {minlength: 6, maxlength: 6, required: !0},
        },
        messages: {
            otp: {minlength: "Enter a 6-digit OTP", maxlength:"Enter a 6-digit OTP", required:"Enter a 6-digit OTP"},
        },
        submitHandler: function (form) {
            if (form) {
                var Frmval = $("#otp-verification-form2").serialize() + `&email=${$("input[name='google_email']").val()}`;
                $("button#submitOtp").attr("disabled", "true").text('Processing...');
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: base_url + "includes/controllers/ajax.user.php",
                    data: "action=otpVerificationForGoogleRegister&" + Frmval,
                    success: function (data) {
                        // console.log(data)
                        var msg = eval(data);
                        $("button#submitOtp").removeAttr("disabled").text('Register');
                        if (msg.action == 'success') {
                            $('#msgOtpVerificationSuccess').html(msg.message).css('display', 'block').fadeOut(8000);
                            $("form#otp-verification-form2")[0].reset();
                            setTimeout(function () {
                                return window.location.href = base_url;
                            }, 2000);
                        }
                        if (msg.action == 'error') {
                            $('#msgOtpVerificationFail').html(msg.message).css('display', 'block').fadeOut(8000);
                        }
                    },
                    error: function (data) {
                        // console.log("error...");
                        $("button#submitOtp").removeAttr("disabled").text('Register');
                    }
                });

                return !1;
            }
        }
    }) 

    // Login Form
    $("#main-login-form2").validate({
        errorElement: 'p',
        errorClass: 'text-danger',
        rules: {
            email: {
                required: !0
            },
            password: {required: !0}
        },
        messages: {
            name: {
                required: "Enter your Full Name"
            },
            username: {
                required: "Enter your User Name"
            },
            email: {
                required: "Enter your Username or Email Address"
            },
            password: {required: "Enter your Password"}
        },
        submitHandler: function (form) {
            if (form) {
                var Frmval = $("#main-login-form2").serialize();
                $("button#submitLogin").attr("disabled", "true").text('Processing...');
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: base_url + "includes/controllers/ajax.user.php",
                    data: "action=frontlogin&" + Frmval,
                    success: function (data) {
                        var msg = eval(data);
                        $("button#submitLogin").removeAttr("disabled").text('Log In');
                        if (msg.action == 'success') {
                            $('#msgLogin').html(msg.message).css('display', 'block').fadeOut(8000);
                            setTimeout(function () {
                                return window.location.href = "";
                                $('.modal , .reg-overlay').fadeOut(200);
                                $("html, body").removeClass("hid-body");
                            }, 2000);
                            $("form#main-login-form2")[0].reset();
                        }
                        if (msg.action == 'error') {
                            $('#msgLogin').html(msg.message).css('display', 'block').fadeOut(8000);
                        }
                    }
                });
                return !1;
            }
        }
    })

   

    // Forgot Password
    $("#main-forgot-password-form2").validate({
        rules: {
            email: {
                required: !0,
                email: !0
            }
        },
        messages: {
            email: {
                required: "Enter your email address",
                email: "Enter a valid email address"
            }
        },
        submitHandler: function (form) {
            if (form) {
                var Frmval = $("#main-forgot-password-form2").serialize();
                $('#submitForgot').attr("disabled", "true").text('Processing...');
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: base_url + "includes/controllers/ajax.user.php",
                    data: "action=forgetuserpassword&" + Frmval,
                    success: function (data) {
                        var msg = eval(data);
                        $("#submitForgot").removeAttr("disabled").text('Recover Password');
                        if (msg.action == 'success') {
                            $('#msgForgot').html(msg.message).css('display', 'block').fadeOut(8000);
                            setTimeout(function () {
                                return window.location.href = "";
                            }, 5000);
                            $("form#main-forgot-password-form2")[0].reset();
                        }
                        if (msg.action == 'unsuccess') {
                            $('#msgForgot').html(msg.message).css('display', 'block').fadeOut(8000);
                        }
                    }
                });
                return !1;
            }
        }
    })

    // Package Review
    $("#add-comment").validate({
        errorElement: 'p',
        errorClass: 'text-danger',
        rules: {
            review: {required: !0},
            rating: {required: !0},
            user_id: {required: !0},
            package_id: {required: !0},
        },
        messages: {
            review: {required: "Enter review"},
            rating: {required: "Enter rating"},
            user_id: {required: "An issue has occured"},
            package_id: {required: "An issue has occured"},
        },
        submitHandler: function (form) {
            if (form) {
                var Frmval = $("#add-comment").serialize();
                $('#review').attr("disabled", "true").text('Processing...');

                let actionDetails = null;
                switch ($('#add-comment #review_type').val()) {
                    case "package":
                        actionDetails = {
                            page: "ajax.package.php",
                            action: "addpackagereview"
                        }
                        break;

                    case "hotel":
                        actionDetails = {
                            page: "ajax.hotelapi.php",
                            action: "addreview"
                        }
                        break;
                
                    default:
                        break;
                }

                if(actionDetails !== null) {
                    $.ajax({
                        type: "POST",
                        dataType: "JSON",
                        url: base_url + `includes/controllers/${actionDetails.page}`,
                        data: `action=${actionDetails.action}&` + Frmval,
                        success: function (data) {
                            var msg = eval(data);
                            $("#review").removeAttr("disabled").text('Submit Review');
                            if (msg.action == 'success') {
                                // $('#msgForgot').html(msg.message).css('display', 'block').fadeOut(8000);
                                setTimeout(function () {
                                    alert("Review Submitted for approval");
                                    return window.location.href = "";
                                }, /* 5000 */ 1000);
                                $("form#add-comment")[0].reset();
                            }
                            if (msg.action == 'unsuccess') {
                                // $('#msgForgot').html(msg.message).css('display', 'block').fadeOut(8000);
                            }
                        }
                    });
                }
                
                return !1;
            }
        }
    })

    $('.user-type-btn-check').click(function() {
        $('.register-fields-section').hide();
        $(`.${$(this).val()}-register-fields`).show();
    })
    

    $('.currency-select').click(function() {
        let $this = $(this);
        let selectedCurrencyCode = $this.data('currency-code');

        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: base_url + `includes/controllers/ajax.user.php`,
            data: `action=update_currency_setting&currency_code=${selectedCurrencyCode}`,
            success: function (data) {
                var msg = eval(data);
                if(msg.action=='warning'){
                    alert('something went wrong');
                }
                if(msg.action=='success'){
                    $('#btn-currency-select').html(selectedCurrencyCode);
                    $('.currency-select').removeClass('active');
                    $this.addClass('active');
                    window.location.reload();
                }
                if(msg.action=='error'){
                    alert(msg.message);
                }
                
            }
        });
    })
});

function redirectToHomePage() {
    window.history.replaceState('', '', base_url)
}