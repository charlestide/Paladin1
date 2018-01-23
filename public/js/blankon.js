webpackJsonp([36],{

/***/ 110:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(111);


/***/ }),

/***/ 111:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


/* ==========================================================================
 * Template: Blankon Fullpack Admin Theme
 * ---------------------------------------------------------------------------
 * Author: Djava UI
 * Website: http://djavaui.com
 * Email: support@djavaui.com
 * ========================================================================== */

var BlankonApp = function () {

    return {

        // =========================================================================
        // CONSTRUCTOR APP
        // =========================================================================
        init: function init() {
            BlankonApp.handleBaseURL();
            BlankonApp.handleIE();
            BlankonApp.handleCheckCookie();
            BlankonApp.handleSound();
            BlankonApp.handleBackToTop();
            BlankonApp.handleSidebarNavigation();
            BlankonApp.handleSidebarScroll();
            BlankonApp.handleSidebarResponsive();
            BlankonApp.handleNavbarScroll();
            BlankonApp.handlePanelScroll();
            BlankonApp.handleTypehead();
            BlankonApp.handleFullscreen();
            BlankonApp.handleSelect2();
            BlankonApp.handleTooltip();
            BlankonApp.handlePopover();
            BlankonApp.handlePanelToolAction();
            BlankonApp.handleSparkline();
            BlankonApp.handleClearCookie();
            BlankonApp.handleBoxModal();
            BlankonApp.handleTip();
            BlankonApp.handleErrors();
            BlankonApp.handleCopyrightYear();
        },

        // =========================================================================
        // SET UP BASE URL
        // =========================================================================
        handleBaseURL: function handleBaseURL() {
            //edited by charles
            var getUrl = window.location,
                baseUrl = getUrl.protocol + "//" + getUrl.host + "/"; //+ getUrl.pathname.split('/')[1];
            return baseUrl;
        },

        // =========================================================================
        // IE SUPPORT
        // =========================================================================
        handleIE: function handleIE() {
            // IE mode
            var isIE8 = false;
            var isIE9 = false;
            var isIE10 = false;

            // initializes main settings for IE
            isIE8 = !!navigator.userAgent.match(/MSIE 8.0/);
            isIE9 = !!navigator.userAgent.match(/MSIE 9.0/);
            isIE10 = !!navigator.userAgent.match(/MSIE 10.0/);

            if (isIE10) {
                $('html').addClass('ie10'); // detect IE10 version
            }

            if (isIE10 || isIE9 || isIE8) {
                $('html').addClass('ie'); // detect IE8, IE9, IE10 version
            }

            // Fix input placeholder issue for IE8 and IE9
            if (isIE8 || isIE9) {
                // ie8 & ie9
                // this is html5 placeholder fix for inputs, inputs with placeholder-no-fix class will be skipped(e.g: we need this for password fields)
                $('input[placeholder]:not(.placeholder-no-fix), textarea[placeholder]:not(.placeholder-no-fix)').each(function () {
                    var input = $(this);

                    if (input.val() == '' && input.attr("placeholder") != '') {
                        input.addClass("placeholder").val(input.attr('placeholder'));
                    }

                    input.focus(function () {
                        if (input.val() == input.attr('placeholder')) {
                            input.val('');
                        }
                    });

                    input.blur(function () {
                        if (input.val() == '' || input.val() == input.attr('placeholder')) {
                            input.val(input.attr('placeholder'));
                        }
                    });
                });
            }
        },

        // =========================================================================
        // CHECK COOKIE
        // =========================================================================
        handleCheckCookie: function handleCheckCookie() {
            // Check (onLoad) if the cookie is there and set the class if it is
            // Set cookie sidebar minimize page
            if ($.cookie('page_sidebar_minimize') == 'active') {
                $('body').addClass('page-sidebar-minimize');
            }
        },

        // =========================================================================
        // SOUNDS
        // =========================================================================
        handleSound: function handleSound() {
            if ($('.page-sound').length) {
                var sounds = [{ name: "beer_can_opening" }, { name: "bell_ring", volume: 0.6 }, { name: "branch_break", volume: 0.3 }, { name: "button_click" }, { name: "button_click_on" }, { name: "button_push" }, { name: "button_tiny", volume: 0.6 }, { name: "camera_flashing" }, { name: "camera_flashing_2", volume: 0.6 }, { name: "cd_tray", volume: 0.6 }, { name: "computer_error" }, { name: "door_bell" }, { name: "door_bump", volume: 0.3 }, { name: "glass" }, { name: "keyboard_desk" }, { name: "light_bulb_breaking", volume: 0.6 }, { name: "metal_plate" }, { name: "metal_plate_2" }, { name: "pop_cork" }, { name: "snap" }, { name: "staple_gun" }, { name: "tap", volume: 0.6 }, { name: "water_droplet" }, { name: "water_droplet_2" }, { name: "water_droplet_3", volume: 0.6 }];
                soundManager.setup({
                    onready: function onready() {
                        sounds.forEach(function (soundName) {
                            var sound = soundManager.createSound({
                                id: soundName.name,
                                url: "https://cdn.bootcss.com/ion-sound/3.0.7/sounds/" + soundName.name + '.mp3',
                                volumn: soundName.volume * 100,
                                autoLoad: true
                            });
                        });
                    }
                });
                // Add effect sound water droplet type 3
                $('.dropdown-toggle').on('click', function () {
                    soundManager.play("water_droplet_3");
                });

                // Input sounds
                $('input, textarea').on('input', function () {
                    soundManager.play("tap");
                });
                $('input[type=file]').on('click', function () {
                    soundManager.play("metal_plate_2");
                });
                $('input[type=checkbox], input[type=radio]').on('click', function () {
                    soundManager.play("button_tiny");
                });
                $('select').on('change', function () {
                    soundManager.play("snap");
                });
            }
        },

        // =========================================================================
        // BACK TOP
        // =========================================================================
        handleBackToTop: function handleBackToTop() {
            $('#back-top').hide();
            $(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    $('#back-top').addClass('show animated pulse');
                } else {
                    $('#back-top').removeClass('show animated pulse');
                }
            });
            // scroll body to 0px on click
            $('#back-top').click(function () {
                // Add sound
                soundManager.play("cd_tray");
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        },

        // =========================================================================
        // SIDEBAR NAVIGATION
        // =========================================================================
        handleSidebarNavigation: function handleSidebarNavigation() {
            // Create trigger click for open menu sidebar
            $('.submenu > a').click(function () {
                console.log('aa');
                var parentElement = $(this).parent('.submenu'),
                    nextElement = $(this).nextAll(),
                    arrowIcon = $(this).find('.arrow'),
                    plusIcon = $(this).find('.plus');

                // Add effect sound button click
                if ($('.page-sound').length) {
                    soundManager.play("button_click_on");
                }

                if (parentElement.parent('ul').find('ul:visible')) {
                    parentElement.parent('ul').find('ul:visible').slideUp('fast');
                    parentElement.parent('ul').find('.open').removeClass('open');
                }

                if (nextElement.is('ul:visible')) {
                    arrowIcon.removeClass('open');
                    plusIcon.removeClass('open');
                    nextElement.slideUp('fast');
                    arrowIcon.removeClass('fa-angle-double-down').addClass('fa-angle-double-right');
                }

                if (!nextElement.is('ul:visible')) {
                    arrowIcon.addClass('open');
                    plusIcon.addClass('open');
                    nextElement.slideDown('fast');
                    arrowIcon.removeClass('fa-angle-double-right').addClass('fa-angle-double-down');
                }
            });
        },

        // =========================================================================
        // SIDEBAR LEFT NICESCROLL
        // =========================================================================
        handleSidebarScroll: function handleSidebarScroll() {
            // Optimalisation: Store the references outside the event handler:
            function checkHeightSidebar() {
                // Check if there is class page-sidebar-fixed
                if ($('.page-sidebar-fixed').length) {
                    // Setting dinamic height sidebar menu
                    var heightSidebarLeft = $(window).outerHeight() - $('#header').outerHeight() - $('.sidebar-footer').outerHeight() - $('.sidebar-content').outerHeight();

                    $('#sidebar-left .sidebar-menu').height(heightSidebarLeft).niceScroll({
                        cursorwidth: '10px',
                        cursorborder: '0px',
                        railalign: 'left'
                    });
                }

                var heightSidebarRight = $(window).outerHeight() - $('#sidebar-right .panel-heading').outerHeight(),
                    heightSidebarRightChat = $(window).outerHeight() - $('#sidebar-right .panel-heading').outerHeight() - $('#sidebar-chat .form-horizontal').outerHeight();

                // Sidebar right profile
                $('#sidebar-profile .sidebar-menu').height(heightSidebarRight).niceScroll({
                    cursorwidth: '10px',
                    cursorborder: '0px'
                });

                // Sidebar right layout
                $('#sidebar-layout .sidebar-menu').height(heightSidebarRight).niceScroll({
                    cursorwidth: '10px',
                    cursorborder: '0px'
                });

                // Sidebar right setting
                $('#sidebar-setting .sidebar-menu').height(heightSidebarRight).niceScroll({
                    cursorwidth: '10px',
                    cursorborder: '0px'
                });

                // Sidebar right chat
                $('#sidebar-chat .sidebar-menu').height(heightSidebarRightChat).niceScroll({
                    cursorwidth: '10px',
                    cursorborder: '0px'
                });
            }
            // Execute on load
            checkHeightSidebar();
            // Bind event listener
            $(window).resize(checkHeightSidebar);
        },

        // =========================================================================
        // SIDEBAR RESPONSIVE
        // =========================================================================
        handleSidebarResponsive: function handleSidebarResponsive() {
            // Optimalisation: Store the references outside the event handler:
            var $window = $(window);
            function checkWidth() {
                var windowsize = $window.width();
                // Check if view screen on greater then 720px and smaller then 1024px
                if (windowsize > 768 && windowsize <= 1024) {
                    $('body').addClass('page-sidebar-minimize-auto');
                } else if (windowsize <= 768) {
                    $('body').removeClass('page-sidebar-minimize');
                    $('body').removeClass('page-sidebar-minimize-auto');
                } else {
                    $('body').removeClass('page-sidebar-minimize-auto');
                }
            }
            // Execute on load
            checkWidth();
            // Bind event listener
            $(window).resize(checkWidth);

            // When the minimize trigger is clicked
            $('.navbar-minimize a').on('click', function () {

                // Add effect sound button click
                if ($('.page-sound').length) {
                    soundManager.play("button_click");
                }

                // Check class sidebar right show
                if ($('.page-sidebar-right-show').length) {
                    $('body').removeClass('page-sidebar-right-show');
                }

                // Check class sidebar minimize auto
                if ($('.page-sidebar-minimize-auto').length) {
                    $('body').removeClass('page-sidebar-minimize-auto');
                } else {
                    // Toggle the class to the body
                    $('body').toggleClass('page-sidebar-minimize');
                }

                // Check the current cookie value
                // If the cookie is empty or set to not active, then add page_sidebar_minimize
                if ($.cookie('page_sidebar_minimize') == "undefined" || $.cookie('page_sidebar_minimize') == "not_active") {

                    // Set cookie value to active
                    $.cookie('page_sidebar_minimize', 'active', { expires: 1 });
                }

                // If the cookie was already set to active then remove it
                else {

                        // Remove cookie with name page_sidebar_minimize
                        $.removeCookie('page_sidebar_minimize');

                        // Create cookie with value to not_active
                        $.cookie('page_sidebar_minimize', 'not_active', { expires: 1 });
                    }
            });

            $('.navbar-setting a').on('click', function () {
                // Add effect sound button click
                if ($('.page-sound').length) {
                    soundManager.play("button_click");
                }
                if ($('.page-sidebar-minimize.page-sidebar-right-show').length) {
                    $('body').toggleClass('page-sidebar-minimize page-sidebar-right-show');
                } else if ($('.page-sidebar-minimize').length) {
                    $('body').toggleClass('page-sidebar-right-show');
                } else {
                    $('body').toggleClass('page-sidebar-minimize page-sidebar-right-show');
                }
            });

            // This action available on mobile view
            $('.navbar-minimize-mobile.left').on('click', function () {
                // Add effect sound button click
                if ($('.page-sound').length) {
                    soundManager.play("button_click");
                }
                if ($('body.page-sidebar-right-show').length) {
                    $('body').removeClass('page-sidebar-right-show');
                    $('body').removeClass('page-sidebar-minimize');
                }
                $('body').toggleClass('page-sidebar-left-show');
            });
            $('.navbar-minimize-mobile.right').on('click', function () {
                // Add effect sound button click
                if ($('.page-sound').length) {
                    soundManager.play("button_click");
                }
                if ($('body.page-sidebar-left-show').length) {
                    $('body').removeClass('page-sidebar-left-show');
                    $('body').removeClass('page-sidebar-minimize');
                }
                $('body').toggleClass('page-sidebar-right-show');
            });
        },

        // =========================================================================
        // MESSAGES NICESCROLL
        // =========================================================================
        handleNavbarScroll: function handleNavbarScroll() {
            if ($('.navbar-message .niceScroll').length) {
                $('.navbar-message .niceScroll').niceScroll({
                    cursorwidth: '10px',
                    cursorborder: '0px'
                });
            }

            // =========================================================================
            // NOTIFICATION NICESCROLL
            // =========================================================================
            if ($('.navbar-notification .niceScroll').length) {
                $('.navbar-notification .niceScroll').niceScroll({
                    cursorwidth: '10px',
                    cursorborder: '0px'
                });
            }
        },

        // =========================================================================
        // PANEL NICESCROLL
        // =========================================================================
        handlePanelScroll: function handlePanelScroll() {
            if ($('.panel-scrollable').length) {
                $('.panel-scrollable .panel-body').niceScroll({
                    cursorwidth: '10px',
                    cursorborder: '0px'
                });
            }
        },

        // =========================================================================
        // TYPEAHEAD
        // =========================================================================
        handleTypehead: function handleTypehead() {
            if ($('.typeahead').length) {
                var repos;

                // repos = new Bloodhound({
                //     datumTokenizer: function(d) { return d.tokens; },
                //     queryTokenizer: Bloodhound.tokenizers.whitespace,
                //     prefetch: BlankonApp.handleBaseURL()+'/assets/global/plugins/bower_components/typehead.js/dist/typeahead-sample.json'
                // });
                //
                // repos.initialize();
                //
                // $('.typeahead').typeahead(null, {
                //     name: 'typeahead-sample',
                //     source: repos.ttAdapter(),
                //     templates: {
                //         empty: [
                //             '<div class="empty-message">',
                //             'unable to find your type that match the current query',
                //             '</div>'
                //         ].join('\n'),
                //         suggestion: Handlebars.compile([
                //             '<a href="javascript:void(0);" class="media border-dotted animated fadeIn">',
                //             '<span class="media-left">' +
                //             '<span class="media-object">',
                //             '<i class="fa fa-{{icon}} bg-{{color}}"></i>',
                //             '</span>',
                //             '</span>',
                //             '<span class="media-body">',
                //             '<span class="media-heading">{{name}}</span>',
                //             '<span class="media-text">{{description}}</span>',
                //             '</span>',
                //             '</a>'
                //         ].join(''))
                //     }
                // });
            }
        },

        // =========================================================================
        // FULLSCREEN TRIGGER
        // =========================================================================
        handleFullscreen: function handleFullscreen() {
            var state;
            $('#fullscreen').on('click', function () {
                state = !state;
                if (state) {
                    // Trigger for fullscreen
                    // Add effect sound bell ring
                    if ($('.page-sound').length) {
                        soundManager.play("bell_ring");
                    }
                    $(this).toggleClass('fg-theme');
                    $(this).attr('data-original-title', 'Exit Fullscreen');
                    var docElement, request;
                    docElement = document.documentElement;
                    request = docElement.requestFullScreen || docElement.webkitRequestFullScreen || docElement.mozRequestFullScreen || docElement.msRequestFullScreen;
                    if (typeof request != "undefined" && request) {
                        request.call(docElement);
                    }
                } else {
                    // Trigger for exit fullscreen
                    // Add effect sound bell ring
                    if ($('.page-sound').length) {
                        soundManager.play("bell_ring");
                    }
                    $(this).removeClass('fg-theme');
                    $(this).attr('data-original-title', 'Fullscreen');
                    var docElement, request;
                    docElement = document;
                    request = docElement.cancelFullScreen || docElement.webkitCancelFullScreen || docElement.mozCancelFullScreen || docElement.msCancelFullScreen || docElement.exitFullscreen;
                    if (typeof request != "undefined" && request) {
                        request.call(docElement);
                    }
                }
            });
        },

        // =========================================================================
        // SELECT2
        // =========================================================================
        handleSelect2: function handleSelect2() {
            if ($('.select2').length) {
                $('.select2').select2();
            }
        },

        // =========================================================================
        // TOOLTIP
        // =========================================================================
        handleTooltip: function handleTooltip() {
            if ($('[data-toggle=tooltip]').length) {
                $('[data-toggle=tooltip]').tooltip({
                    animation: 'fade'
                });
            }
            if ($('.tooltips').length) {
                $('.tooltips').tooltip({
                    animation: 'fade'
                });
            }
        },

        // =========================================================================
        // POPOVER
        // =========================================================================
        handlePopover: function handlePopover() {
            if ($('[data-toggle=popover]').length) {
                $('[data-toggle=popover]').popover();
            }
        },

        // =========================================================================
        // PANEL TOOL ACTION
        // =========================================================================
        handlePanelToolAction: function handlePanelToolAction() {
            // Collapse panel
            $('[data-action=collapse]').on('click', function (e) {
                var targetCollapse = $(this).parents('.panel').find('.panel-body'),
                    targetCollapse2 = $(this).parents('.panel').find('.panel-sub-heading'),
                    targetCollapse3 = $(this).parents('.panel').find('.panel-footer');
                if (targetCollapse.is(':visible')) {
                    $(this).find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
                    targetCollapse.slideUp();
                    targetCollapse2.slideUp();
                    targetCollapse3.slideUp();
                } else {
                    $(this).find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
                    targetCollapse.slideDown();
                    targetCollapse2.slideDown();
                    targetCollapse3.slideDown();
                }
                e.stopImmediatePropagation();
            });

            // Remove panel
            $('[data-action=remove]').on('click', function () {
                $(this).parents('.panel').fadeOut();
                // Remove backdrop element panel full size
                if ($('body').find('.panel-fullsize').length) {
                    $('body').find('.panel-fullsize-backdrop').remove();
                }
            });

            // Expand panel
            $('[data-action=expand]').on('click', function () {
                if ($(this).parents(".panel").hasClass('panel-fullsize')) {
                    $('body').find('.panel-fullsize-backdrop').remove();
                    $(this).data('bs.tooltip').options.title = 'Expand';
                    $(this).find('i').removeClass('fa-compress').addClass('fa-expand');
                    $(this).parents(".panel").removeClass('panel-fullsize');
                } else {
                    $('body').append('<div class="panel-fullsize-backdrop"></div>');
                    $(this).data('bs.tooltip').options.title = 'Minimize';
                    $(this).find('i').removeClass('fa-expand').addClass('fa-compress');
                    $(this).parents(".panel").addClass('panel-fullsize');
                }
            });

            // Search panel
            $('[data-action=search]').on('click', function () {
                $(this).parents('.panel').find('.panel-search').toggle(100);
                return false;
            });
        },

        // =========================================================================
        // JQUERY SPARKLINE
        // =========================================================================
        handleSparkline: function handleSparkline() {
            if ($('.sparklines').length) {
                $('.average').sparkline('html', { type: 'bar', barColor: '#37BC9B', height: '30px' });
                $('.traffic').sparkline('html', { type: 'bar', barColor: '#8CC152', height: '30px' });
                $('.disk').sparkline('html', { type: 'bar', barColor: '#E9573F', height: '30px' });
                $('.cpu').sparkline('html', { type: 'bar', barColor: '#F6BB42', height: '30px' });
            }
        },

        // =========================================================================
        // CLEAR ALL COOKIE
        // =========================================================================
        handleClearCookie: function handleClearCookie() {
            $('#reset-setting').on('click', function () {
                var cookies = $.cookie();
                for (var cookie in cookies) {
                    $.removeCookie(cookie);
                }
                location.reload(true);
            });
        },

        // =========================================================================
        // BOX MODAL
        // =========================================================================
        handleBoxModal: function handleBoxModal() {
            $('#setting').on('click', function () {
                // Add sound
                soundManager.play('camera_flashing');
                bootbox.dialog({
                    message: 'I am a custom dialog setting',
                    title: 'Custom setting',
                    className: 'modal-success modal-center',
                    buttons: {
                        success: {
                            label: 'Success!',
                            className: 'btn-success',
                            callback: function callback() {
                                alert('You are so calm!');
                            }
                        },
                        danger: {
                            label: 'Danger!',
                            className: 'btn-danger',
                            callback: function callback() {
                                alert('You are so hot!');
                            }
                        },
                        main: {
                            label: 'Click ME!',
                            className: 'btn-primary',
                            callback: function callback() {
                                alert('Hello World');
                            }
                        }
                    }
                });
            });

            $('#lock-screen').on('click', function () {
                // Add sound
                soundManager.play('camera_flashing');
                bootbox.dialog({
                    message: 'Locker with notification display, Receive your notifications directly on your lock screen',
                    title: 'Lock Screen',
                    className: 'modal-lilac modal-center',
                    buttons: {
                        danger: {
                            label: 'No',
                            className: 'btn-danger'
                        },
                        success: {
                            label: 'Yes',
                            className: 'btn-success',
                            callback: function callback() {
                                window.location = $('#lock-screen').data('url');
                            }
                        }
                    }
                });
            });

            $('#logout').on('click', function () {
                // Add sound
                soundManager.play('camera_flashing');
                bootbox.dialog({
                    message: '确定要退出吗？',
                    title: '退出',
                    className: 'modal-danger modal-center',
                    buttons: {
                        danger: {
                            label: '不',
                            className: 'btn-danger'
                        },
                        success: {
                            label: '是',
                            className: 'btn-success',
                            callback: function callback() {
                                window.location = $('#logout').data('url');
                            }
                        }
                    }
                });
            });
        },

        handleTip: function handleTip() {
            toastr.options.progressBar = true;
            $(function () {
                var $tip = $('#tip');
                if ($tip.length) {
                    var message = $tip.text();
                    switch ($tip.attr('status')) {
                        case 'info':
                            toastr.info(message);
                            break;
                        case 'error':
                            toastr.error(message);
                            break;
                        case 'success':
                        default:
                            toastr.success(message);
                    }
                }
            });
        },
        handleErrors: function handleErrors() {
            toastr.options.progressBar = true;
            $(function () {
                var $errors = $('#errors');
                if ($errors.length && ($lis = $('li', $errors))) {
                    var message = $lis.text();
                    toastr.error(message);
                }
            });
        },


        // =========================================================================
        // COPYRIGHT YEAR
        // =========================================================================
        handleCopyrightYear: function handleCopyrightYear() {
            if ($('#copyright-year').length) {
                var today = new Date();
                $('#copyright-year').text(today.getFullYear());
            }
        }

    };
}();

// Call main app init
BlankonApp.init();

/***/ })

},[110]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2pzLzNyZC9ibGFua29uL2JsYW5rb24uanMiXSwibmFtZXMiOlsiQmxhbmtvbkFwcCIsImluaXQiLCJoYW5kbGVCYXNlVVJMIiwiaGFuZGxlSUUiLCJoYW5kbGVDaGVja0Nvb2tpZSIsImhhbmRsZVNvdW5kIiwiaGFuZGxlQmFja1RvVG9wIiwiaGFuZGxlU2lkZWJhck5hdmlnYXRpb24iLCJoYW5kbGVTaWRlYmFyU2Nyb2xsIiwiaGFuZGxlU2lkZWJhclJlc3BvbnNpdmUiLCJoYW5kbGVOYXZiYXJTY3JvbGwiLCJoYW5kbGVQYW5lbFNjcm9sbCIsImhhbmRsZVR5cGVoZWFkIiwiaGFuZGxlRnVsbHNjcmVlbiIsImhhbmRsZVNlbGVjdDIiLCJoYW5kbGVUb29sdGlwIiwiaGFuZGxlUG9wb3ZlciIsImhhbmRsZVBhbmVsVG9vbEFjdGlvbiIsImhhbmRsZVNwYXJrbGluZSIsImhhbmRsZUNsZWFyQ29va2llIiwiaGFuZGxlQm94TW9kYWwiLCJoYW5kbGVUaXAiLCJoYW5kbGVFcnJvcnMiLCJoYW5kbGVDb3B5cmlnaHRZZWFyIiwiZ2V0VXJsIiwid2luZG93IiwibG9jYXRpb24iLCJiYXNlVXJsIiwicHJvdG9jb2wiLCJob3N0IiwiaXNJRTgiLCJpc0lFOSIsImlzSUUxMCIsIm5hdmlnYXRvciIsInVzZXJBZ2VudCIsIm1hdGNoIiwiJCIsImFkZENsYXNzIiwiZWFjaCIsImlucHV0IiwidmFsIiwiYXR0ciIsImZvY3VzIiwiYmx1ciIsImNvb2tpZSIsImxlbmd0aCIsInNvdW5kcyIsIm5hbWUiLCJ2b2x1bWUiLCJzb3VuZE1hbmFnZXIiLCJzZXR1cCIsIm9ucmVhZHkiLCJmb3JFYWNoIiwic291bmROYW1lIiwic291bmQiLCJjcmVhdGVTb3VuZCIsImlkIiwidXJsIiwidm9sdW1uIiwiYXV0b0xvYWQiLCJvbiIsInBsYXkiLCJoaWRlIiwic2Nyb2xsIiwic2Nyb2xsVG9wIiwicmVtb3ZlQ2xhc3MiLCJjbGljayIsImFuaW1hdGUiLCJjb25zb2xlIiwibG9nIiwicGFyZW50RWxlbWVudCIsInBhcmVudCIsIm5leHRFbGVtZW50IiwibmV4dEFsbCIsImFycm93SWNvbiIsImZpbmQiLCJwbHVzSWNvbiIsInNsaWRlVXAiLCJpcyIsInNsaWRlRG93biIsImNoZWNrSGVpZ2h0U2lkZWJhciIsImhlaWdodFNpZGViYXJMZWZ0Iiwib3V0ZXJIZWlnaHQiLCJoZWlnaHQiLCJuaWNlU2Nyb2xsIiwiY3Vyc29yd2lkdGgiLCJjdXJzb3Jib3JkZXIiLCJyYWlsYWxpZ24iLCJoZWlnaHRTaWRlYmFyUmlnaHQiLCJoZWlnaHRTaWRlYmFyUmlnaHRDaGF0IiwicmVzaXplIiwiJHdpbmRvdyIsImNoZWNrV2lkdGgiLCJ3aW5kb3dzaXplIiwid2lkdGgiLCJ0b2dnbGVDbGFzcyIsImV4cGlyZXMiLCJyZW1vdmVDb29raWUiLCJyZXBvcyIsInN0YXRlIiwiZG9jRWxlbWVudCIsInJlcXVlc3QiLCJkb2N1bWVudCIsImRvY3VtZW50RWxlbWVudCIsInJlcXVlc3RGdWxsU2NyZWVuIiwid2Via2l0UmVxdWVzdEZ1bGxTY3JlZW4iLCJtb3pSZXF1ZXN0RnVsbFNjcmVlbiIsIm1zUmVxdWVzdEZ1bGxTY3JlZW4iLCJjYWxsIiwiY2FuY2VsRnVsbFNjcmVlbiIsIndlYmtpdENhbmNlbEZ1bGxTY3JlZW4iLCJtb3pDYW5jZWxGdWxsU2NyZWVuIiwibXNDYW5jZWxGdWxsU2NyZWVuIiwiZXhpdEZ1bGxzY3JlZW4iLCJzZWxlY3QyIiwidG9vbHRpcCIsImFuaW1hdGlvbiIsInBvcG92ZXIiLCJlIiwidGFyZ2V0Q29sbGFwc2UiLCJwYXJlbnRzIiwidGFyZ2V0Q29sbGFwc2UyIiwidGFyZ2V0Q29sbGFwc2UzIiwic3RvcEltbWVkaWF0ZVByb3BhZ2F0aW9uIiwiZmFkZU91dCIsInJlbW92ZSIsImhhc0NsYXNzIiwiZGF0YSIsIm9wdGlvbnMiLCJ0aXRsZSIsImFwcGVuZCIsInRvZ2dsZSIsInNwYXJrbGluZSIsInR5cGUiLCJiYXJDb2xvciIsImNvb2tpZXMiLCJyZWxvYWQiLCJib290Ym94IiwiZGlhbG9nIiwibWVzc2FnZSIsImNsYXNzTmFtZSIsImJ1dHRvbnMiLCJzdWNjZXNzIiwibGFiZWwiLCJjYWxsYmFjayIsImFsZXJ0IiwiZGFuZ2VyIiwibWFpbiIsInRvYXN0ciIsInByb2dyZXNzQmFyIiwiJHRpcCIsInRleHQiLCJpbmZvIiwiZXJyb3IiLCIkZXJyb3JzIiwiJGxpcyIsInRvZGF5IiwiRGF0ZSIsImdldEZ1bGxZZWFyIl0sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7Ozs7Ozs7O0FBQUE7Ozs7Ozs7O0FBUUEsSUFBSUEsYUFBYSxZQUFVOztBQUV2QixXQUFPOztBQUVIO0FBQ0E7QUFDQTtBQUNBQyxjQUFNLGdCQUFZO0FBQ2RELHVCQUFXRSxhQUFYO0FBQ0FGLHVCQUFXRyxRQUFYO0FBQ0FILHVCQUFXSSxpQkFBWDtBQUNBSix1QkFBV0ssV0FBWDtBQUNBTCx1QkFBV00sZUFBWDtBQUNBTix1QkFBV08sdUJBQVg7QUFDQVAsdUJBQVdRLG1CQUFYO0FBQ0FSLHVCQUFXUyx1QkFBWDtBQUNBVCx1QkFBV1Usa0JBQVg7QUFDQVYsdUJBQVdXLGlCQUFYO0FBQ0FYLHVCQUFXWSxjQUFYO0FBQ0FaLHVCQUFXYSxnQkFBWDtBQUNBYix1QkFBV2MsYUFBWDtBQUNBZCx1QkFBV2UsYUFBWDtBQUNBZix1QkFBV2dCLGFBQVg7QUFDQWhCLHVCQUFXaUIscUJBQVg7QUFDQWpCLHVCQUFXa0IsZUFBWDtBQUNBbEIsdUJBQVdtQixpQkFBWDtBQUNBbkIsdUJBQVdvQixjQUFYO0FBQ0FwQix1QkFBV3FCLFNBQVg7QUFDQXJCLHVCQUFXc0IsWUFBWDtBQUNBdEIsdUJBQVd1QixtQkFBWDtBQUNILFNBNUJFOztBQThCSDtBQUNBO0FBQ0E7QUFDQXJCLHVCQUFlLHlCQUFZO0FBQ3ZCO0FBQ0EsZ0JBQUlzQixTQUFTQyxPQUFPQyxRQUFwQjtBQUFBLGdCQUNJQyxVQUFVSCxPQUFRSSxRQUFSLEdBQW1CLElBQW5CLEdBQTBCSixPQUFPSyxJQUFqQyxHQUF3QyxH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UyxNQUF4QixFQUErQjtBQUMzQixvQkFBSStHLFFBQVEsSUFBSUMsSUFBSixFQUFaO0FBQ0F6SCxrQkFBRSxpQkFBRixFQUFxQm1ILElBQXJCLENBQTBCSyxNQUFNRSxXQUFOLEVBQTFCO0FBQ0g7QUFDSjs7QUE3dUJFLEtBQVA7QUFndkJILENBbHZCZ0IsRUFBakI7O0FBb3ZCQTtBQUNBOUosV0FBV0MsSUFBWCxHIiwiZmlsZSI6Ii9qcy9ibGFua29uLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLyogPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAqIFRlbXBsYXRlOiBCbGFua29uIEZ1bGxwYWNrIEFkbWluIFRoZW1lXG4gKiAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAqIEF1dGhvcjogRGphdmEgVUlcbiAqIFdlYnNpdGU6IGh0dHA6Ly9kamF2YXVpLmNvbVxuICogRW1haWw6IHN1cHBvcnRAZGphdmF1aS5jb21cbiAqID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09ICovXG5cbnZhciBCbGFua29uQXBwID0gZnVuY3Rpb24oKXtcblxuICAgIHJldHVybiB7XG5cbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICAvLyBDT05TVFJVQ1RPUiBBUFBcbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICBpbml0OiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBCbGFua29uQXBwLmhhbmRsZUJhc2VVUkwoKTtcbiAgICAgICAgICAgIEJsYW5rb25BcHAuaGFuZGxlSUUoKTtcbiAgICAgICAgICAgIEJsYW5rb25BcHAuaGFuZGxlQ2hlY2tDb29raWUoKTtcbiAgICAgICAgICAgIEJsYW5rb25BcHAuaGFuZGxlU291bmQoKTtcbiAgICAgICAgICAgIEJsYW5rb25BcHAuaGFuZGxlQmFja1RvVG9wKCk7XG4gICAgICAgICAgICBCbGFua29uQXBwLmhhbmRsZVNpZGViYXJOYXZpZ2F0aW9uKCk7XG4gICAgICAgICAgICBCbGFua29uQXBwLmhhbmRsZVNpZGViYXJTY3JvbGwoKTtcbiAgICAgICAgICAgIEJsYW5rb25BcHAuaGFuZGxlU2lkZWJhclJlc3BvbnNpdmUoKTtcbiAgICAgICAgICAgIEJsYW5rb25BcHAuaGFuZGxlTmF2YmFyU2Nyb2xsKCk7XG4gICAgICAgICAgICBCbGFua29uQXBwLmhhbmRsZVBhbmVsU2Nyb2xsKCk7XG4gICAgICAgICAgICBCbGFua29uQXBwLmhhbmRsZVR5cGVoZWFkKCk7XG4gICAgICAgICAgICBCbGFua29uQXBwLmhhbmRsZUZ1bGxzY3JlZW4oKTtcbiAgICAgICAgICAgIEJsYW5rb25BcHAuaGFuZGxlU2VsZWN0MigpO1xuICAgICAgICAgICAgQmxhbmtvbkFwcC5oYW5kbGVUb29sdGlwKCk7XG4gICAgICAgICAgICBCbGFua29uQXBwLmhhbmRsZVBvcG92ZXIoKTtcbiAgICAgICAgICAgIEJsYW5rb25BcHAuaGFuZGxlUGFuZWxUb29sQWN0aW9uKCk7XG4gICAgICAgICAgICBCbGFua29uQXBwLmhhbmRsZVNwYXJrbGluZSgpO1xuICAgICAgICAgICAgQmxhbmtvbkFwcC5oYW5kbGVDbGVhckNvb2tpZSgpO1xuICAgICAgICAgICAgQmxhbmtvbkFwcC5oYW5kbGVCb3hNb2RhbCgpO1xuICAgICAgICAgICAgQmxhbmtvbkFwcC5oYW5kbGVUaXAoKTtcbiAgICAgICAgICAgIEJsYW5rb25BcHAuaGFuZGxlRXJyb3JzKCk7XG4gICAgICAgICAgICBCbGFua29uQXBwLmhhbmRsZUNvcHlyaWdodFllYXIoKTtcbiAgICAgICAgfSxcblxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIC8vIFNFVCBVUCBCQVNFIFVSTFxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIGhhbmRsZUJhc2VVUkw6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIC8vZWRpdGVkIGJ5IGNoYXJsZXNcbiAgICAgICAgICAgIHZhciBnZXRVcmwgPSB3aW5kb3cubG9jYXRpb24sXG4gICAgICAgICAgICAgICAgYmFzZVVybCA9IGdldFVybCAucHJvdG9jb2wgKyBcIi8vXCIgKyBnZXRVcmwuaG9zdCArIFwiL1wiIDsvLysgZ2V0VXJsLnBhdGhuYW1lLnNwbGl0KCcvJylbMV07XG4gICAgICAgICAgICByZXR1cm4gYmFzZVVybDtcbiAgICAgICAgfSxcblxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIC8vIElFIFNVUFBPUlRcbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICBoYW5kbGVJRTogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgLy8gSUUgbW9kZVxuICAgICAgICAgICAgdmFyIGlzSUU4ID0gZmFsc2U7XG4gICAgICAgICAgICB2YXIgaXNJRTkgPSBmYWxzZTtcbiAgICAgICAgICAgIHZhciBpc0lFMTAgPSBmYWxzZTtcblxuICAgICAgICAgICAgLy8gaW5pdGlhbGl6ZXMgbWFpbiBzZXR0aW5ncyBmb3IgSUVcbiAgICAgICAgICAgIGlzSUU4ID0gISEgbmF2aWdhdG9yLnVzZXJBZ2VudC5tYXRjaCgvTVNJRSA4LjAvKTtcbiAgICAgICAgICAgIGlzSUU5ID0gISEgbmF2aWdhdG9yLnVzZXJBZ2VudC5tYXRjaCgvTVNJRSA5LjAvKTtcbiAgICAgICAgICAgIGlzSUUxMCA9ICEhIG5hdmlnYXRvci51c2VyQWdlbnQubWF0Y2goL01TSUUgMTAuMC8pO1xuXG4gICAgICAgICAgICBpZiAoaXNJRTEwKSB7XG4gICAgICAgICAgICAgICAgJCgnaHRtbCcpLmFkZENsYXNzKCdpZTEwJyk7IC8vIGRldGVjdCBJRTEwIHZlcnNpb25cbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgaWYgKGlzSUUxMCB8fCBpc0lFOSB8fCBpc0lFOCkge1xuICAgICAgICAgICAgICAgICQoJ2h0bWwnKS5hZGRDbGFzcygnaWUnKTsgLy8gZGV0ZWN0IElFOCwgSUU5LCBJRTEwIHZlcnNpb25cbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgLy8gRml4IGlucHV0IHBsYWNlaG9sZGVyIGlzc3VlIGZvciBJRTggYW5kIElFOVxuICAgICAgICAgICAgaWYgKGlzSUU4IHx8IGlzSUU5KSB7IC8vIGllOCAmIGllOVxuICAgICAgICAgICAgICAgIC8vIHRoaXMgaXMgaHRtbDUgcGxhY2Vob2xkZXIgZml4IGZvciBpbnB1dHMsIGlucHV0cyB3aXRoIHBsYWNlaG9sZGVyLW5vLWZpeCBjbGFzcyB3aWxsIGJlIHNraXBwZWQoZS5nOiB3ZSBuZWVkIHRoaXMgZm9yIHBhc3N3b3JkIGZpZWxkcylcbiAgICAgICAgICAgICAgICAkKCdpbnB1dFtwbGFjZWhvbGRlcl06bm90KC5wbGFjZWhvbGRlci1uby1maXgpLCB0ZXh0YXJlYVtwbGFjZWhvbGRlcl06bm90KC5wbGFjZWhvbGRlci1uby1maXgpJykuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgIHZhciBpbnB1dCA9ICQodGhpcyk7XG5cbiAgICAgICAgICAgICAgICAgICAgaWYgKGlucHV0LnZhbCgpID09ICcnICYmIGlucHV0LmF0dHIoXCJwbGFjZWhvbGRlclwiKSAhPSAnJykge1xuICAgICAgICAgICAgICAgICAgICAgICAgaW5wdXQuYWRkQ2xhc3MoXCJwbGFjZWhvbGRlclwiKS52YWwoaW5wdXQuYXR0cigncGxhY2Vob2xkZXInKSk7XG4gICAgICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgICAgICBpbnB1dC5mb2N1cyhmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBpZiAoaW5wdXQudmFsKCkgPT0gaW5wdXQuYXR0cigncGxhY2Vob2xkZXInKSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlucHV0LnZhbCgnJyk7XG4gICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICAgICAgICAgIGlucHV0LmJsdXIoZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgaWYgKGlucHV0LnZhbCgpID09ICcnIHx8IGlucHV0LnZhbCgpID09IGlucHV0LmF0dHIoJ3BsYWNlaG9sZGVyJykpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBpbnB1dC52YWwoaW5wdXQuYXR0cigncGxhY2Vob2xkZXInKSk7XG4gICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfVxuICAgICAgICB9LFxuXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgLy8gQ0hFQ0sgQ09PS0lFXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgaGFuZGxlQ2hlY2tDb29raWU6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIC8vIENoZWNrIChvbkxvYWQpIGlmIHRoZSBjb29raWUgaXMgdGhlcmUgYW5kIHNldCB0aGUgY2xhc3MgaWYgaXQgaXNcbiAgICAgICAgICAgIC8vIFNldCBjb29raWUgc2lkZWJhciBtaW5pbWl6ZSBwYWdlXG4gICAgICAgICAgICBpZiAoJC5jb29raWUoJ3BhZ2Vfc2lkZWJhcl9taW5pbWl6ZScpID09ICdhY3RpdmUnKSB7XG4gICAgICAgICAgICAgICAgJCgnYm9keScpLmFkZENsYXNzKCdwYWdlLXNpZGViYXItbWluaW1pemUnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSxcblxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIC8vIFNPVU5EU1xuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIGhhbmRsZVNvdW5kOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBpZigkKCcucGFnZS1zb3VuZCcpLmxlbmd0aCkge1xuICAgICAgICAgICAgICAgIGxldCBzb3VuZHMgPSBbXG4gICAgICAgICAgICAgICAgICAgIHtuYW1lOiBcImJlZXJfY2FuX29wZW5pbmdcIn0sXG4gICAgICAgICAgICAgICAgICAgIHtuYW1lOiBcImJlbGxfcmluZ1wiLCB2b2x1bWU6IDAuNn0sXG4gICAgICAgICAgICAgICAgICAgIHtuYW1lOiBcImJyYW5jaF9icmVha1wiLCB2b2x1bWU6IDAuM30sXG4gICAgICAgICAgICAgICAgICAgIHtuYW1lOiBcImJ1dHRvbl9jbGlja1wifSxcbiAgICAgICAgICAgICAgICAgICAge25hbWU6IFwiYnV0dG9uX2NsaWNrX29uXCJ9LFxuICAgICAgICAgICAgICAgICAgICB7bmFtZTogXCJidXR0b25fcHVzaFwifSxcbiAgICAgICAgICAgICAgICAgICAge25hbWU6IFwiYnV0dG9uX3RpbnlcIiwgdm9sdW1lOiAwLjZ9LFxuICAgICAgICAgICAgICAgICAgICB7bmFtZTogXCJjYW1lcmFfZmxhc2hpbmdcIn0sXG4gICAgICAgICAgICAgICAgICAgIHtuYW1lOiBcImNhbWVyYV9mbGFzaGluZ18yXCIsIHZvbHVtZTogMC42fSxcbiAgICAgICAgICAgICAgICAgICAge25hbWU6IFwiY2RfdHJheVwiLCB2b2x1bWU6IDAuNn0sXG4gICAgICAgICAgICAgICAgICAgIHtuYW1lOiBcImNvbXB1dGVyX2Vycm9yXCJ9LFxuICAgICAgICAgICAgICAgICAgICB7bmFtZTogXCJkb29yX2JlbGxcIn0sXG4gICAgICAgICAgICAgICAgICAgIHtuYW1lOiBcImRvb3JfYnVtcFwiLCB2b2x1bWU6IDAuM30sXG4gICAgICAgICAgICAgICAgICAgIHtuYW1lOiBcImdsYXNzXCJ9LFxuICAgICAgICAgICAgICAgICAgICB7bmFtZTogXCJrZXlib2FyZF9kZXNrXCJ9LFxuICAgICAgICAgICAgICAgICAgICB7bmFtZTogXCJsaWdodF9idWxiX2JyZWFraW5nXCIsIHZvbHVtZTogMC42fSxcbiAgICAgICAgICAgICAgICAgICAge25hbWU6IFwibWV0YWxfcGxhdGVcIn0sXG4gICAgICAgICAgICAgICAgICAgIHtuYW1lOiBcIm1ldGFsX3BsYXRlXzJcIn0sXG4gICAgICAgICAgICAgICAgICAgIHtuYW1lOiBcInBvcF9jb3JrXCJ9LFxuICAgICAgICAgICAgICAgICAgICB7bmFtZTogXCJzbmFwXCJ9LFxuICAgICAgICAgICAgICAgICAgICB7bmFtZTogXCJzdGFwbGVfZ3VuXCJ9LFxuICAgICAgICAgICAgICAgICAgICB7bmFtZTogXCJ0YXBcIiwgdm9sdW1lOiAwLjZ9LFxuICAgICAgICAgICAgICAgICAgICB7bmFtZTogXCJ3YXRlcl9kcm9wbGV0XCJ9LFxuICAgICAgICAgICAgICAgICAgICB7bmFtZTogXCJ3YXRlcl9kcm9wbGV0XzJcIn0sXG4gICAgICAgICAgICAgICAgICAgIHtuYW1lOiBcIndhdGVyX2Ryb3BsZXRfM1wiLCB2b2x1bWU6IDAuNn1cbiAgICAgICAgICAgICAgICBdO1xuICAgICAgICAgICAgICAgIHNvdW5kTWFuYWdlci5zZXR1cCh7XG4gICAgICAgICAgICAgICAgICAgIG9ucmVhZHk6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHNvdW5kcy5mb3JFYWNoKGZ1bmN0aW9uIChzb3VuZE5hbWUpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBsZXQgc291bmQgPSBzb3VuZE1hbmFnZXIuY3JlYXRlU291bmQoe1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZDogc291bmROYW1lLm5hbWUsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHVybDogXCJodHRwczovL2Nkbi5ib290Y3NzLmNvbS9pb24tc291bmQvMy4wLjcvc291bmRzL1wiICsgc291bmROYW1lLm5hbWUgKyAnLm1wMycsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHZvbHVtbjogc291bmROYW1lLnZvbHVtZSAqIDEwMCxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgYXV0b0xvYWQ6IHRydWVcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgLy8gQWRkIGVmZmVjdCBzb3VuZCB3YXRlciBkcm9wbGV0IHR5cGUgM1xuICAgICAgICAgICAgICAgICQoJy5kcm9wZG93bi10b2dnbGUnKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xuICAgICAgICAgICAgICAgICAgICBzb3VuZE1hbmFnZXIucGxheShcIndhdGVyX2Ryb3BsZXRfM1wiKTtcbiAgICAgICAgICAgICAgICB9KTtcblxuXG4gICAgICAgICAgICAgICAgLy8gSW5wdXQgc291bmRzXG4gICAgICAgICAgICAgICAgJCgnaW5wdXQsIHRleHRhcmVhJykub24oJ2lucHV0JywgZnVuY3Rpb24oKXtcbiAgICAgICAgICAgICAgICAgICAgc291bmRNYW5hZ2VyLnBsYXkoXCJ0YXBcIik7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgJCgnaW5wdXRbdHlwZT1maWxlXScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgICAgIHNvdW5kTWFuYWdlci5wbGF5KFwibWV0YWxfcGxhdGVfMlwiKTtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICAkKCdpbnB1dFt0eXBlPWNoZWNrYm94XSwgaW5wdXRbdHlwZT1yYWRpb10nKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xuICAgICAgICAgICAgICAgICAgICBzb3VuZE1hbmFnZXIucGxheShcImJ1dHRvbl90aW55XCIpO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICQoJ3NlbGVjdCcpLm9uKCdjaGFuZ2UnLCBmdW5jdGlvbigpe1xuICAgICAgICAgICAgICAgICAgICBzb3VuZE1hbmFnZXIucGxheShcInNuYXBcIik7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0sXG5cbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICAvLyBCQUNLIFRPUFxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIGhhbmRsZUJhY2tUb1RvcDogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgJCgnI2JhY2stdG9wJykuaGlkZSgpO1xuICAgICAgICAgICAgJCh3aW5kb3cpLnNjcm9sbChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgaWYgKCQodGhpcykuc2Nyb2xsVG9wKCkgPiAxMDApIHtcbiAgICAgICAgICAgICAgICAgICAgJCgnI2JhY2stdG9wJykuYWRkQ2xhc3MoJ3Nob3cgYW5pbWF0ZWQgcHVsc2UnKTtcbiAgICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICAgICAkKCcjYmFjay10b3AnKS5yZW1vdmVDbGFzcygnc2hvdyBhbmltYXRlZCBwdWxzZScpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgLy8gc2Nyb2xsIGJvZHkgdG8gMHB4IG9uIGNsaWNrXG4gICAgICAgICAgICAkKCcjYmFjay10b3AnKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgLy8gQWRkIHNvdW5kXG4gICAgICAgICAgICAgICAgc291bmRNYW5hZ2VyLnBsYXkoXCJjZF90cmF5XCIpO1xuICAgICAgICAgICAgICAgICQoJ2JvZHksaHRtbCcpLmFuaW1hdGUoe1xuICAgICAgICAgICAgICAgICAgICBzY3JvbGxUb3A6IDBcbiAgICAgICAgICAgICAgICB9LCA4MDApO1xuICAgICAgICAgICAgICAgIHJldHVybiBmYWxzZTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9LFxuXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgLy8gU0lERUJBUiBOQVZJR0FUSU9OXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgaGFuZGxlU2lkZWJhck5hdmlnYXRpb246IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIC8vIENyZWF0ZSB0cmlnZ2VyIGNsaWNrIGZvciBvcGVuIG1lbnUgc2lkZWJhclxuICAgICAgICAgICAgJCgnLnN1Ym1lbnUgPiBhJykuY2xpY2soZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2coJ2FhJyk7XG4gICAgICAgICAgICAgICAgdmFyIHBhcmVudEVsZW1lbnQgPSAkKHRoaXMpLnBhcmVudCgnLnN1Ym1lbnUnKSxcbiAgICAgICAgICAgICAgICAgICAgbmV4dEVsZW1lbnQgPSAkKHRoaXMpLm5leHRBbGwoKSxcbiAgICAgICAgICAgICAgICAgICAgYXJyb3dJY29uID0gJCh0aGlzKS5maW5kKCcuYXJyb3cnKSxcbiAgICAgICAgICAgICAgICAgICAgcGx1c0ljb24gPSAkKHRoaXMpLmZpbmQoJy5wbHVzJyk7XG5cbiAgICAgICAgICAgICAgICAvLyBBZGQgZWZmZWN0IHNvdW5kIGJ1dHRvbiBjbGlja1xuICAgICAgICAgICAgICAgIGlmKCQoJy5wYWdlLXNvdW5kJykubGVuZ3RoKXtcbiAgICAgICAgICAgICAgICAgICAgc291bmRNYW5hZ2VyLnBsYXkoXCJidXR0b25fY2xpY2tfb25cIik7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgaWYocGFyZW50RWxlbWVudC5wYXJlbnQoJ3VsJykuZmluZCgndWw6dmlzaWJsZScpKXtcbiAgICAgICAgICAgICAgICAgICAgcGFyZW50RWxlbWVudC5wYXJlbnQoJ3VsJykuZmluZCgndWw6dmlzaWJsZScpLnNsaWRlVXAoJ2Zhc3QnKTtcbiAgICAgICAgICAgICAgICAgICAgcGFyZW50RWxlbWVudC5wYXJlbnQoJ3VsJykuZmluZCgnLm9wZW4nKS5yZW1vdmVDbGFzcygnb3BlbicpO1xuICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgIGlmKG5leHRFbGVtZW50LmlzKCd1bDp2aXNpYmxlJykpIHtcbiAgICAgICAgICAgICAgICAgICAgYXJyb3dJY29uLnJlbW92ZUNsYXNzKCdvcGVuJyk7XG4gICAgICAgICAgICAgICAgICAgIHBsdXNJY29uLnJlbW92ZUNsYXNzKCdvcGVuJyk7XG4gICAgICAgICAgICAgICAgICAgIG5leHRFbGVtZW50LnNsaWRlVXAoJ2Zhc3QnKTtcbiAgICAgICAgICAgICAgICAgICAgYXJyb3dJY29uLnJlbW92ZUNsYXNzKCdmYS1hbmdsZS1kb3VibGUtZG93bicpLmFkZENsYXNzKCdmYS1hbmdsZS1kb3VibGUtcmlnaHQnKTtcbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICBpZighbmV4dEVsZW1lbnQuaXMoJ3VsOnZpc2libGUnKSkge1xuICAgICAgICAgICAgICAgICAgICBhcnJvd0ljb24uYWRkQ2xhc3MoJ29wZW4nKTtcbiAgICAgICAgICAgICAgICAgICAgcGx1c0ljb24uYWRkQ2xhc3MoJ29wZW4nKTtcbiAgICAgICAgICAgICAgICAgICAgbmV4dEVsZW1lbnQuc2xpZGVEb3duKCdmYXN0Jyk7XG4gICAgICAgICAgICAgICAgICAgIGFycm93SWNvbi5yZW1vdmVDbGFzcygnZmEtYW5nbGUtZG91YmxlLXJpZ2h0JykuYWRkQ2xhc3MoJ2ZhLWFuZ2xlLWRvdWJsZS1kb3duJyk7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSxcblxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIC8vIFNJREVCQVIgTEVGVCBOSUNFU0NST0xMXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgaGFuZGxlU2lkZWJhclNjcm9sbDogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgLy8gT3B0aW1hbGlzYXRpb246IFN0b3JlIHRoZSByZWZlcmVuY2VzIG91dHNpZGUgdGhlIGV2ZW50IGhhbmRsZXI6XG4gICAgICAgICAgICBmdW5jdGlvbiBjaGVja0hlaWdodFNpZGViYXIoKSB7XG4gICAgICAgICAgICAgICAgLy8gQ2hlY2sgaWYgdGhlcmUgaXMgY2xhc3MgcGFnZS1zaWRlYmFyLWZpeGVkXG4gICAgICAgICAgICAgICAgaWYoJCgnLnBhZ2Utc2lkZWJhci1maXhlZCcpLmxlbmd0aCl7XG4gICAgICAgICAgICAgICAgICAgIC8vIFNldHRpbmcgZGluYW1pYyBoZWlnaHQgc2lkZWJhciBtZW51XG4gICAgICAgICAgICAgICAgICAgIHZhciBoZWlnaHRTaWRlYmFyTGVmdCAgICAgICA9ICQod2luZG93KS5vdXRlckhlaWdodCgpIC0gJCgnI2hlYWRlcicpLm91dGVySGVpZ2h0KCkgLSAkKCcuc2lkZWJhci1mb290ZXInKS5vdXRlckhlaWdodCgpIC0gJCgnLnNpZGViYXItY29udGVudCcpLm91dGVySGVpZ2h0KCk7XG5cbiAgICAgICAgICAgICAgICAgICAgJCgnI3NpZGViYXItbGVmdCAuc2lkZWJhci1tZW51JykuaGVpZ2h0KGhlaWdodFNpZGViYXJMZWZ0KVxuICAgICAgICAgICAgICAgICAgICAgICAgLm5pY2VTY3JvbGwoe1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGN1cnNvcndpZHRoOiAnMTBweCcsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY3Vyc29yYm9yZGVyOiAnMHB4JyxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICByYWlsYWxpZ246ICdsZWZ0J1xuICAgICAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgdmFyIGhlaWdodFNpZGViYXJSaWdodCAgICAgID0gJCh3aW5kb3cpLm91dGVySGVpZ2h0KCkgLSAkKCcjc2lkZWJhci1yaWdodCAucGFuZWwtaGVhZGluZycpLm91dGVySGVpZ2h0KCksXG4gICAgICAgICAgICAgICAgICAgIGhlaWdodFNpZGViYXJSaWdodENoYXQgID0gJCh3aW5kb3cpLm91dGVySGVpZ2h0KCkgLSAkKCcjc2lkZWJhci1yaWdodCAucGFuZWwtaGVhZGluZycpLm91dGVySGVpZ2h0KCkgLSAkKCcjc2lkZWJhci1jaGF0IC5mb3JtLWhvcml6b250YWwnKS5vdXRlckhlaWdodCgpO1xuXG4gICAgICAgICAgICAgICAgLy8gU2lkZWJhciByaWdodCBwcm9maWxlXG4gICAgICAgICAgICAgICAgJCgnI3NpZGViYXItcHJvZmlsZSAuc2lkZWJhci1tZW51JykuaGVpZ2h0KGhlaWdodFNpZGViYXJSaWdodClcbiAgICAgICAgICAgICAgICAgICAgLm5pY2VTY3JvbGwoe1xuICAgICAgICAgICAgICAgICAgICAgICAgY3Vyc29yd2lkdGg6ICcxMHB4JyxcbiAgICAgICAgICAgICAgICAgICAgICAgIGN1cnNvcmJvcmRlcjogJzBweCdcbiAgICAgICAgICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgICAgICAvLyBTaWRlYmFyIHJpZ2h0IGxheW91dFxuICAgICAgICAgICAgICAgICQoJyNzaWRlYmFyLWxheW91dCAuc2lkZWJhci1tZW51JykuaGVpZ2h0KGhlaWdodFNpZGViYXJSaWdodClcbiAgICAgICAgICAgICAgICAgICAgLm5pY2VTY3JvbGwoe1xuICAgICAgICAgICAgICAgICAgICAgICAgY3Vyc29yd2lkdGg6ICcxMHB4JyxcbiAgICAgICAgICAgICAgICAgICAgICAgIGN1cnNvcmJvcmRlcjogJzBweCdcbiAgICAgICAgICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgICAgICAvLyBTaWRlYmFyIHJpZ2h0IHNldHRpbmdcbiAgICAgICAgICAgICAgICAkKCcjc2lkZWJhci1zZXR0aW5nIC5zaWRlYmFyLW1lbnUnKS5oZWlnaHQoaGVpZ2h0U2lkZWJhclJpZ2h0KVxuICAgICAgICAgICAgICAgICAgICAubmljZVNjcm9sbCh7XG4gICAgICAgICAgICAgICAgICAgICAgICBjdXJzb3J3aWR0aDogJzEwcHgnLFxuICAgICAgICAgICAgICAgICAgICAgICAgY3Vyc29yYm9yZGVyOiAnMHB4J1xuICAgICAgICAgICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgICAgIC8vIFNpZGViYXIgcmlnaHQgY2hhdFxuICAgICAgICAgICAgICAgICQoJyNzaWRlYmFyLWNoYXQgLnNpZGViYXItbWVudScpLmhlaWdodChoZWlnaHRTaWRlYmFyUmlnaHRDaGF0KVxuICAgICAgICAgICAgICAgICAgICAubmljZVNjcm9sbCh7XG4gICAgICAgICAgICAgICAgICAgICAgICBjdXJzb3J3aWR0aDogJzEwcHgnLFxuICAgICAgICAgICAgICAgICAgICAgICAgY3Vyc29yYm9yZGVyOiAnMHB4J1xuICAgICAgICAgICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgfVxuICAgICAgICAgICAgLy8gRXhlY3V0ZSBvbiBsb2FkXG4gICAgICAgICAgICBjaGVja0hlaWdodFNpZGViYXIoKTtcbiAgICAgICAgICAgIC8vIEJpbmQgZXZlbnQgbGlzdGVuZXJcbiAgICAgICAgICAgICQod2luZG93KS5yZXNpemUoY2hlY2tIZWlnaHRTaWRlYmFyKTtcbiAgICAgICAgfSxcblxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIC8vIFNJREVCQVIgUkVTUE9OU0lWRVxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIGhhbmRsZVNpZGViYXJSZXNwb25zaXZlOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAvLyBPcHRpbWFsaXNhdGlvbjogU3RvcmUgdGhlIHJlZmVyZW5jZXMgb3V0c2lkZSB0aGUgZXZlbnQgaGFuZGxlcjpcbiAgICAgICAgICAgIHZhciAkd2luZG93ID0gJCh3aW5kb3cpO1xuICAgICAgICAgICAgZnVuY3Rpb24gY2hlY2tXaWR0aCgpIHtcbiAgICAgICAgICAgICAgICB2YXIgd2luZG93c2l6ZSA9ICR3aW5kb3cud2lkdGgoKTtcbiAgICAgICAgICAgICAgICAvLyBDaGVjayBpZiB2aWV3IHNjcmVlbiBvbiBncmVhdGVyIHRoZW4gNzIwcHggYW5kIHNtYWxsZXIgdGhlbiAxMDI0cHhcbiAgICAgICAgICAgICAgICBpZiAod2luZG93c2l6ZSA+IDc2OCAmJiB3aW5kb3dzaXplIDw9IDEwMjQpIHtcbiAgICAgICAgICAgICAgICAgICAgJCgnYm9keScpLmFkZENsYXNzKCdwYWdlLXNpZGViYXItbWluaW1pemUtYXV0bycpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBlbHNlIGlmICh3aW5kb3dzaXplIDw9IDc2OCkge1xuICAgICAgICAgICAgICAgICAgICAkKCdib2R5JykucmVtb3ZlQ2xhc3MoJ3BhZ2Utc2lkZWJhci1taW5pbWl6ZScpO1xuICAgICAgICAgICAgICAgICAgICAkKCdib2R5JykucmVtb3ZlQ2xhc3MoJ3BhZ2Utc2lkZWJhci1taW5pbWl6ZS1hdXRvJyk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIGVsc2V7XG4gICAgICAgICAgICAgICAgICAgICQoJ2JvZHknKS5yZW1vdmVDbGFzcygncGFnZS1zaWRlYmFyLW1pbmltaXplLWF1dG8nKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICAvLyBFeGVjdXRlIG9uIGxvYWRcbiAgICAgICAgICAgIGNoZWNrV2lkdGgoKTtcbiAgICAgICAgICAgIC8vIEJpbmQgZXZlbnQgbGlzdGVuZXJcbiAgICAgICAgICAgICQod2luZG93KS5yZXNpemUoY2hlY2tXaWR0aCk7XG5cbiAgICAgICAgICAgIC8vIFdoZW4gdGhlIG1pbmltaXplIHRyaWdnZXIgaXMgY2xpY2tlZFxuICAgICAgICAgICAgJCgnLm5hdmJhci1taW5pbWl6ZSBhJykub24oJ2NsaWNrJyxmdW5jdGlvbigpe1xuXG4gICAgICAgICAgICAgICAgLy8gQWRkIGVmZmVjdCBzb3VuZCBidXR0b24gY2xpY2tcbiAgICAgICAgICAgICAgICBpZigkKCcucGFnZS1zb3VuZCcpLmxlbmd0aCl7XG4gICAgICAgICAgICAgICAgICAgIHNvdW5kTWFuYWdlci5wbGF5KFwiYnV0dG9uX2NsaWNrXCIpO1xuICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgIC8vIENoZWNrIGNsYXNzIHNpZGViYXIgcmlnaHQgc2hvd1xuICAgICAgICAgICAgICAgIGlmKCQoJy5wYWdlLXNpZGViYXItcmlnaHQtc2hvdycpLmxlbmd0aCl7XG4gICAgICAgICAgICAgICAgICAgICQoJ2JvZHknKS5yZW1vdmVDbGFzcygncGFnZS1zaWRlYmFyLXJpZ2h0LXNob3cnKTtcbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICAvLyBDaGVjayBjbGFzcyBzaWRlYmFyIG1pbmltaXplIGF1dG9cbiAgICAgICAgICAgICAgICBpZigkKCcucGFnZS1zaWRlYmFyLW1pbmltaXplLWF1dG8nKS5sZW5ndGgpe1xuICAgICAgICAgICAgICAgICAgICAkKCdib2R5JykucmVtb3ZlQ2xhc3MoJ3BhZ2Utc2lkZWJhci1taW5pbWl6ZS1hdXRvJyk7XG4gICAgICAgICAgICAgICAgfWVsc2V7XG4gICAgICAgICAgICAgICAgICAgIC8vIFRvZ2dsZSB0aGUgY2xhc3MgdG8gdGhlIGJvZHlcbiAgICAgICAgICAgICAgICAgICAgJCgnYm9keScpLnRvZ2dsZUNsYXNzKCdwYWdlLXNpZGViYXItbWluaW1pemUnKTtcbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICAvLyBDaGVjayB0aGUgY3VycmVudCBjb29raWUgdmFsdWVcbiAgICAgICAgICAgICAgICAvLyBJZiB0aGUgY29va2llIGlzIGVtcHR5IG9yIHNldCB0byBub3QgYWN0aXZlLCB0aGVuIGFkZCBwYWdlX3NpZGViYXJfbWluaW1pemVcbiAgICAgICAgICAgICAgICBpZiAoJC5jb29raWUoJ3BhZ2Vfc2lkZWJhcl9taW5pbWl6ZScpID09IFwidW5kZWZpbmVkXCIgfHwgJC5jb29raWUoJ3BhZ2Vfc2lkZWJhcl9taW5pbWl6ZScpID09IFwibm90X2FjdGl2ZVwiKSB7XG5cbiAgICAgICAgICAgICAgICAgICAgLy8gU2V0IGNvb2tpZSB2YWx1ZSB0byBhY3RpdmVcbiAgICAgICAgICAgICAgICAgICAgJC5jb29raWUoJ3BhZ2Vfc2lkZWJhcl9taW5pbWl6ZScsJ2FjdGl2ZScsIHtleHBpcmVzOiAxfSk7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgLy8gSWYgdGhlIGNvb2tpZSB3YXMgYWxyZWFkeSBzZXQgdG8gYWN0aXZlIHRoZW4gcmVtb3ZlIGl0XG4gICAgICAgICAgICAgICAgZWxzZSB7XG5cbiAgICAgICAgICAgICAgICAgICAgLy8gUmVtb3ZlIGNvb2tpZSB3aXRoIG5hbWUgcGFnZV9zaWRlYmFyX21pbmltaXplXG4gICAgICAgICAgICAgICAgICAgICQucmVtb3ZlQ29va2llKCdwYWdlX3NpZGViYXJfbWluaW1pemUnKTtcblxuICAgICAgICAgICAgICAgICAgICAvLyBDcmVhdGUgY29va2llIHdpdGggdmFsdWUgdG8gbm90X2FjdGl2ZVxuICAgICAgICAgICAgICAgICAgICAkLmNvb2tpZSgncGFnZV9zaWRlYmFyX21pbmltaXplJywnbm90X2FjdGl2ZScsICB7ZXhwaXJlczogMX0pO1xuXG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgJCgnLm5hdmJhci1zZXR0aW5nIGEnKS5vbignY2xpY2snLGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgLy8gQWRkIGVmZmVjdCBzb3VuZCBidXR0b24gY2xpY2tcbiAgICAgICAgICAgICAgICBpZigkKCcucGFnZS1zb3VuZCcpLmxlbmd0aCl7XG4gICAgICAgICAgICAgICAgICAgIHNvdW5kTWFuYWdlci5wbGF5KFwiYnV0dG9uX2NsaWNrXCIpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBpZigkKCcucGFnZS1zaWRlYmFyLW1pbmltaXplLnBhZ2Utc2lkZWJhci1yaWdodC1zaG93JykubGVuZ3RoKXtcbiAgICAgICAgICAgICAgICAgICAgJCgnYm9keScpLnRvZ2dsZUNsYXNzKCdwYWdlLXNpZGViYXItbWluaW1pemUgcGFnZS1zaWRlYmFyLXJpZ2h0LXNob3cnKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgZWxzZSBpZigkKCcucGFnZS1zaWRlYmFyLW1pbmltaXplJykubGVuZ3RoKXtcbiAgICAgICAgICAgICAgICAgICAgJCgnYm9keScpLnRvZ2dsZUNsYXNzKCdwYWdlLXNpZGViYXItcmlnaHQtc2hvdycpO1xuICAgICAgICAgICAgICAgIH1lbHNle1xuICAgICAgICAgICAgICAgICAgICAkKCdib2R5JykudG9nZ2xlQ2xhc3MoJ3BhZ2Utc2lkZWJhci1taW5pbWl6ZSBwYWdlLXNpZGViYXItcmlnaHQtc2hvdycpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICAvLyBUaGlzIGFjdGlvbiBhdmFpbGFibGUgb24gbW9iaWxlIHZpZXdcbiAgICAgICAgICAgICQoJy5uYXZiYXItbWluaW1pemUtbW9iaWxlLmxlZnQnKS5vbignY2xpY2snLGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgLy8gQWRkIGVmZmVjdCBzb3VuZCBidXR0b24gY2xpY2tcbiAgICAgICAgICAgICAgICBpZigkKCcucGFnZS1zb3VuZCcpLmxlbmd0aCl7XG4gICAgICAgICAgICAgICAgICAgIHNvdW5kTWFuYWdlci5wbGF5KFwiYnV0dG9uX2NsaWNrXCIpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBpZigkKCdib2R5LnBhZ2Utc2lkZWJhci1yaWdodC1zaG93JykubGVuZ3RoKXtcbiAgICAgICAgICAgICAgICAgICAgJCgnYm9keScpLnJlbW92ZUNsYXNzKCdwYWdlLXNpZGViYXItcmlnaHQtc2hvdycpO1xuICAgICAgICAgICAgICAgICAgICAkKCdib2R5JykucmVtb3ZlQ2xhc3MoJ3BhZ2Utc2lkZWJhci1taW5pbWl6ZScpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAkKCdib2R5JykudG9nZ2xlQ2xhc3MoJ3BhZ2Utc2lkZWJhci1sZWZ0LXNob3cnKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgJCgnLm5hdmJhci1taW5pbWl6ZS1tb2JpbGUucmlnaHQnKS5vbignY2xpY2snLGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgLy8gQWRkIGVmZmVjdCBzb3VuZCBidXR0b24gY2xpY2tcbiAgICAgICAgICAgICAgICBpZigkKCcucGFnZS1zb3VuZCcpLmxlbmd0aCl7XG4gICAgICAgICAgICAgICAgICAgIHNvdW5kTWFuYWdlci5wbGF5KFwiYnV0dG9uX2NsaWNrXCIpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBpZigkKCdib2R5LnBhZ2Utc2lkZWJhci1sZWZ0LXNob3cnKS5sZW5ndGgpe1xuICAgICAgICAgICAgICAgICAgICAkKCdib2R5JykucmVtb3ZlQ2xhc3MoJ3BhZ2Utc2lkZWJhci1sZWZ0LXNob3cnKTtcbiAgICAgICAgICAgICAgICAgICAgJCgnYm9keScpLnJlbW92ZUNsYXNzKCdwYWdlLXNpZGViYXItbWluaW1pemUnKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgJCgnYm9keScpLnRvZ2dsZUNsYXNzKCdwYWdlLXNpZGViYXItcmlnaHQtc2hvdycpO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0sXG5cbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICAvLyBNRVNTQUdFUyBOSUNFU0NST0xMXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgaGFuZGxlTmF2YmFyU2Nyb2xsOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBpZigkKCcubmF2YmFyLW1lc3NhZ2UgLm5pY2VTY3JvbGwnKS5sZW5ndGgpe1xuICAgICAgICAgICAgICAgICQoJy5uYXZiYXItbWVzc2FnZSAubmljZVNjcm9sbCcpLm5pY2VTY3JvbGwoe1xuICAgICAgICAgICAgICAgICAgICBjdXJzb3J3aWR0aDogJzEwcHgnLFxuICAgICAgICAgICAgICAgICAgICBjdXJzb3Jib3JkZXI6ICcwcHgnXG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgICAgIC8vIE5PVElGSUNBVElPTiBOSUNFU0NST0xMXG4gICAgICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgICAgICBpZigkKCcubmF2YmFyLW5vdGlmaWNhdGlvbiAubmljZVNjcm9sbCcpLmxlbmd0aCl7XG4gICAgICAgICAgICAgICAgJCgnLm5hdmJhci1ub3RpZmljYXRpb24gLm5pY2VTY3JvbGwnKS5uaWNlU2Nyb2xsKHtcbiAgICAgICAgICAgICAgICAgICAgY3Vyc29yd2lkdGg6ICcxMHB4JyxcbiAgICAgICAgICAgICAgICAgICAgY3Vyc29yYm9yZGVyOiAnMHB4J1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfVxuICAgICAgICB9LFxuXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgLy8gUEFORUwgTklDRVNDUk9MTFxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIGhhbmRsZVBhbmVsU2Nyb2xsOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBpZigkKCcucGFuZWwtc2Nyb2xsYWJsZScpLmxlbmd0aCl7XG4gICAgICAgICAgICAgICAgJCgnLnBhbmVsLXNjcm9sbGFibGUgLnBhbmVsLWJvZHknKS5uaWNlU2Nyb2xsKHtcbiAgICAgICAgICAgICAgICAgICAgY3Vyc29yd2lkdGg6ICcxMHB4JyxcbiAgICAgICAgICAgICAgICAgICAgY3Vyc29yYm9yZGVyOiAnMHB4J1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfVxuICAgICAgICB9LFxuXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgLy8gVFlQRUFIRUFEXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgaGFuZGxlVHlwZWhlYWQ6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIGlmKCQoJy50eXBlYWhlYWQnKS5sZW5ndGgpe1xuICAgICAgICAgICAgICAgIHZhciByZXBvcztcblxuICAgICAgICAgICAgICAgIC8vIHJlcG9zID0gbmV3IEJsb29kaG91bmQoe1xuICAgICAgICAgICAgICAgIC8vICAgICBkYXR1bVRva2VuaXplcjogZnVuY3Rpb24oZCkgeyByZXR1cm4gZC50b2tlbnM7IH0sXG4gICAgICAgICAgICAgICAgLy8gICAgIHF1ZXJ5VG9rZW5pemVyOiBCbG9vZGhvdW5kLnRva2VuaXplcnMud2hpdGVzcGFjZSxcbiAgICAgICAgICAgICAgICAvLyAgICAgcHJlZmV0Y2g6IEJsYW5rb25BcHAuaGFuZGxlQmFzZVVSTCgpKycvYXNzZXRzL2dsb2JhbC9wbHVnaW5zL2Jvd2VyX2NvbXBvbmVudHMvdHlwZWhlYWQuanMvZGlzdC90eXBlYWhlYWQtc2FtcGxlLmpzb24nXG4gICAgICAgICAgICAgICAgLy8gfSk7XG4gICAgICAgICAgICAgICAgLy9cbiAgICAgICAgICAgICAgICAvLyByZXBvcy5pbml0aWFsaXplKCk7XG4gICAgICAgICAgICAgICAgLy9cbiAgICAgICAgICAgICAgICAvLyAkKCcudHlwZWFoZWFkJykudHlwZWFoZWFkKG51bGwsIHtcbiAgICAgICAgICAgICAgICAvLyAgICAgbmFtZTogJ3R5cGVhaGVhZC1zYW1wbGUnLFxuICAgICAgICAgICAgICAgIC8vICAgICBzb3VyY2U6IHJlcG9zLnR0QWRhcHRlcigpLFxuICAgICAgICAgICAgICAgIC8vICAgICB0ZW1wbGF0ZXM6IHtcbiAgICAgICAgICAgICAgICAvLyAgICAgICAgIGVtcHR5OiBbXG4gICAgICAgICAgICAgICAgLy8gICAgICAgICAgICAgJzxkaXYgY2xhc3M9XCJlbXB0eS1tZXNzYWdlXCI+JyxcbiAgICAgICAgICAgICAgICAvLyAgICAgICAgICAgICAndW5hYmxlIHRvIGZpbmQgeW91ciB0eXBlIHRoYXQgbWF0Y2ggdGhlIGN1cnJlbnQgcXVlcnknLFxuICAgICAgICAgICAgICAgIC8vICAgICAgICAgICAgICc8L2Rpdj4nXG4gICAgICAgICAgICAgICAgLy8gICAgICAgICBdLmpvaW4oJ1xcbicpLFxuICAgICAgICAgICAgICAgIC8vICAgICAgICAgc3VnZ2VzdGlvbjogSGFuZGxlYmFycy5jb21waWxlKFtcbiAgICAgICAgICAgICAgICAvLyAgICAgICAgICAgICAnPGEgaHJlZj1cImphdmFzY3JpcHQ6dm9pZCgwKTtcIiBjbGFzcz1cIm1lZGlhIGJvcmRlci1kb3R0ZWQgYW5pbWF0ZWQgZmFkZUluXCI+JyxcbiAgICAgICAgICAgICAgICAvLyAgICAgICAgICAgICAnPHNwYW4gY2xhc3M9XCJtZWRpYS1sZWZ0XCI+JyArXG4gICAgICAgICAgICAgICAgLy8gICAgICAgICAgICAgJzxzcGFuIGNsYXNzPVwibWVkaWEtb2JqZWN0XCI+JyxcbiAgICAgICAgICAgICAgICAvLyAgICAgICAgICAgICAnPGkgY2xhc3M9XCJmYSBmYS17e2ljb259fSBiZy17e2NvbG9yfX1cIj48L2k+JyxcbiAgICAgICAgICAgICAgICAvLyAgICAgICAgICAgICAnPC9zcGFuPicsXG4gICAgICAgICAgICAgICAgLy8gICAgICAgICAgICAgJzwvc3Bhbj4nLFxuICAgICAgICAgICAgICAgIC8vICAgICAgICAgICAgICc8c3BhbiBjbGFzcz1cIm1lZGlhLWJvZHlcIj4nLFxuICAgICAgICAgICAgICAgIC8vICAgICAgICAgICAgICc8c3BhbiBjbGFzcz1cIm1lZGlhLWhlYWRpbmdcIj57e25hbWV9fTwvc3Bhbj4nLFxuICAgICAgICAgICAgICAgIC8vICAgICAgICAgICAgICc8c3BhbiBjbGFzcz1cIm1lZGlhLXRleHRcIj57e2Rlc2NyaXB0aW9ufX08L3NwYW4+JyxcbiAgICAgICAgICAgICAgICAvLyAgICAgICAgICAgICAnPC9zcGFuPicsXG4gICAgICAgICAgICAgICAgLy8gICAgICAgICAgICAgJzwvYT4nXG4gICAgICAgICAgICAgICAgLy8gICAgICAgICBdLmpvaW4oJycpKVxuICAgICAgICAgICAgICAgIC8vICAgICB9XG4gICAgICAgICAgICAgICAgLy8gfSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0sXG5cbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICAvLyBGVUxMU0NSRUVOIFRSSUdHRVJcbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICBoYW5kbGVGdWxsc2NyZWVuOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICB2YXIgc3RhdGU7XG4gICAgICAgICAgICAkKCcjZnVsbHNjcmVlbicpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgICAgIHN0YXRlID0gIXN0YXRlO1xuICAgICAgICAgICAgICAgIGlmIChzdGF0ZSkge1xuICAgICAgICAgICAgICAgICAgICAvLyBUcmlnZ2VyIGZvciBmdWxsc2NyZWVuXG4gICAgICAgICAgICAgICAgICAgIC8vIEFkZCBlZmZlY3Qgc291bmQgYmVsbCByaW5nXG4gICAgICAgICAgICAgICAgICAgIGlmKCQoJy5wYWdlLXNvdW5kJykubGVuZ3RoKXtcbiAgICAgICAgICAgICAgICAgICAgICAgIHNvdW5kTWFuYWdlci5wbGF5KFwiYmVsbF9yaW5nXCIpO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgICQodGhpcykudG9nZ2xlQ2xhc3MoJ2ZnLXRoZW1lJyk7XG4gICAgICAgICAgICAgICAgICAgICQodGhpcykuYXR0cignZGF0YS1vcmlnaW5hbC10aXRsZScsJ0V4aXQgRnVsbHNjcmVlbicpO1xuICAgICAgICAgICAgICAgICAgICB2YXIgZG9jRWxlbWVudCwgcmVxdWVzdDtcbiAgICAgICAgICAgICAgICAgICAgZG9jRWxlbWVudCA9IGRvY3VtZW50LmRvY3VtZW50RWxlbWVudDtcbiAgICAgICAgICAgICAgICAgICAgcmVxdWVzdCA9IGRvY0VsZW1lbnQucmVxdWVzdEZ1bGxTY3JlZW4gfHwgZG9jRWxlbWVudC53ZWJraXRSZXF1ZXN0RnVsbFNjcmVlbiB8fCBkb2NFbGVtZW50Lm1velJlcXVlc3RGdWxsU2NyZWVuIHx8IGRvY0VsZW1lbnQubXNSZXF1ZXN0RnVsbFNjcmVlbjtcbiAgICAgICAgICAgICAgICAgICAgaWYodHlwZW9mIHJlcXVlc3QhPVwidW5kZWZpbmVkXCIgJiYgcmVxdWVzdCl7XG4gICAgICAgICAgICAgICAgICAgICAgICByZXF1ZXN0LmNhbGwoZG9jRWxlbWVudCk7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICAgICAvLyBUcmlnZ2VyIGZvciBleGl0IGZ1bGxzY3JlZW5cbiAgICAgICAgICAgICAgICAgICAgLy8gQWRkIGVmZmVjdCBzb3VuZCBiZWxsIHJpbmdcbiAgICAgICAgICAgICAgICAgICAgaWYoJCgnLnBhZ2Utc291bmQnKS5sZW5ndGgpe1xuICAgICAgICAgICAgICAgICAgICAgICAgc291bmRNYW5hZ2VyLnBsYXkoXCJiZWxsX3JpbmdcIik7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgJCh0aGlzKS5yZW1vdmVDbGFzcygnZmctdGhlbWUnKTtcbiAgICAgICAgICAgICAgICAgICAgJCh0aGlzKS5hdHRyKCdkYXRhLW9yaWdpbmFsLXRpdGxlJywnRnVsbHNjcmVlbicpXG4gICAgICAgICAgICAgICAgICAgIHZhciBkb2NFbGVtZW50LCByZXF1ZXN0O1xuICAgICAgICAgICAgICAgICAgICBkb2NFbGVtZW50ID0gZG9jdW1lbnQ7XG4gICAgICAgICAgICAgICAgICAgIHJlcXVlc3QgPSBkb2NFbGVtZW50LmNhbmNlbEZ1bGxTY3JlZW58fCBkb2NFbGVtZW50LndlYmtpdENhbmNlbEZ1bGxTY3JlZW4gfHwgZG9jRWxlbWVudC5tb3pDYW5jZWxGdWxsU2NyZWVuIHx8IGRvY0VsZW1lbnQubXNDYW5jZWxGdWxsU2NyZWVuIHx8IGRvY0VsZW1lbnQuZXhpdEZ1bGxzY3JlZW47XG4gICAgICAgICAgICAgICAgICAgIGlmKHR5cGVvZiByZXF1ZXN0IT1cInVuZGVmaW5lZFwiICYmIHJlcXVlc3Qpe1xuICAgICAgICAgICAgICAgICAgICAgICAgcmVxdWVzdC5jYWxsKGRvY0VsZW1lbnQpO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0sXG5cbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICAvLyBTRUxFQ1QyXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgaGFuZGxlU2VsZWN0MjogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgaWYoJCgnLnNlbGVjdDInKS5sZW5ndGgpe1xuICAgICAgICAgICAgICAgICQoJy5zZWxlY3QyJykuc2VsZWN0MigpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9LFxuXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgLy8gVE9PTFRJUFxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIGhhbmRsZVRvb2x0aXA6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIGlmKCQoJ1tkYXRhLXRvZ2dsZT10b29sdGlwXScpLmxlbmd0aCl7XG4gICAgICAgICAgICAgICAgJCgnW2RhdGEtdG9nZ2xlPXRvb2x0aXBdJykudG9vbHRpcCh7XG4gICAgICAgICAgICAgICAgICAgIGFuaW1hdGlvbjogJ2ZhZGUnXG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICBpZigkKCcudG9vbHRpcHMnKS5sZW5ndGgpe1xuICAgICAgICAgICAgICAgICQoJy50b29sdGlwcycpLnRvb2x0aXAoe1xuICAgICAgICAgICAgICAgICAgICBhbmltYXRpb246ICdmYWRlJ1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfVxuICAgICAgICB9LFxuXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgLy8gUE9QT1ZFUlxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIGhhbmRsZVBvcG92ZXI6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIGlmKCQoJ1tkYXRhLXRvZ2dsZT1wb3BvdmVyXScpLmxlbmd0aCl7XG4gICAgICAgICAgICAgICAgJCgnW2RhdGEtdG9nZ2xlPXBvcG92ZXJdJykucG9wb3ZlcigpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9LFxuXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgLy8gUEFORUwgVE9PTCBBQ1RJT05cbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICBoYW5kbGVQYW5lbFRvb2xBY3Rpb246IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIC8vIENvbGxhcHNlIHBhbmVsXG4gICAgICAgICAgICAkKCdbZGF0YS1hY3Rpb249Y29sbGFwc2VdJykub24oJ2NsaWNrJywgZnVuY3Rpb24oZSl7XG4gICAgICAgICAgICAgICAgdmFyIHRhcmdldENvbGxhcHNlID0gJCh0aGlzKS5wYXJlbnRzKCcucGFuZWwnKS5maW5kKCcucGFuZWwtYm9keScpLFxuICAgICAgICAgICAgICAgICAgICB0YXJnZXRDb2xsYXBzZTIgPSAkKHRoaXMpLnBhcmVudHMoJy5wYW5lbCcpLmZpbmQoJy5wYW5lbC1zdWItaGVhZGluZycpLFxuICAgICAgICAgICAgICAgICAgICB0YXJnZXRDb2xsYXBzZTMgPSAkKHRoaXMpLnBhcmVudHMoJy5wYW5lbCcpLmZpbmQoJy5wYW5lbC1mb290ZXInKVxuICAgICAgICAgICAgICAgIGlmKCh0YXJnZXRDb2xsYXBzZS5pcygnOnZpc2libGUnKSkpIHtcbiAgICAgICAgICAgICAgICAgICAgJCh0aGlzKS5maW5kKCdpJykucmVtb3ZlQ2xhc3MoJ2ZhLWFuZ2xlLXVwJykuYWRkQ2xhc3MoJ2ZhLWFuZ2xlLWRvd24nKTtcbiAgICAgICAgICAgICAgICAgICAgdGFyZ2V0Q29sbGFwc2Uuc2xpZGVVcCgpO1xuICAgICAgICAgICAgICAgICAgICB0YXJnZXRDb2xsYXBzZTIuc2xpZGVVcCgpO1xuICAgICAgICAgICAgICAgICAgICB0YXJnZXRDb2xsYXBzZTMuc2xpZGVVcCgpO1xuICAgICAgICAgICAgICAgIH1lbHNle1xuICAgICAgICAgICAgICAgICAgICAkKHRoaXMpLmZpbmQoJ2knKS5yZW1vdmVDbGFzcygnZmEtYW5nbGUtZG93bicpLmFkZENsYXNzKCdmYS1hbmdsZS11cCcpO1xuICAgICAgICAgICAgICAgICAgICB0YXJnZXRDb2xsYXBzZS5zbGlkZURvd24oKTtcbiAgICAgICAgICAgICAgICAgICAgdGFyZ2V0Q29sbGFwc2UyLnNsaWRlRG93bigpO1xuICAgICAgICAgICAgICAgICAgICB0YXJnZXRDb2xsYXBzZTMuc2xpZGVEb3duKCk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIGUuc3RvcEltbWVkaWF0ZVByb3BhZ2F0aW9uKCk7XG4gICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgLy8gUmVtb3ZlIHBhbmVsXG4gICAgICAgICAgICAkKCdbZGF0YS1hY3Rpb249cmVtb3ZlXScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgJCh0aGlzKS5wYXJlbnRzKCcucGFuZWwnKS5mYWRlT3V0KCk7XG4gICAgICAgICAgICAgICAgLy8gUmVtb3ZlIGJhY2tkcm9wIGVsZW1lbnQgcGFuZWwgZnVsbCBzaXplXG4gICAgICAgICAgICAgICAgaWYoJCgnYm9keScpLmZpbmQoJy5wYW5lbC1mdWxsc2l6ZScpLmxlbmd0aClcbiAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICQoJ2JvZHknKS5maW5kKCcucGFuZWwtZnVsbHNpemUtYmFja2Ryb3AnKS5yZW1vdmUoKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcblxuXG5cbiAgICAgICAgICAgIC8vIEV4cGFuZCBwYW5lbFxuICAgICAgICAgICAgJCgnW2RhdGEtYWN0aW9uPWV4cGFuZF0nKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xuICAgICAgICAgICAgICAgIGlmKCQodGhpcykucGFyZW50cyhcIi5wYW5lbFwiKS5oYXNDbGFzcygncGFuZWwtZnVsbHNpemUnKSlcbiAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICQoJ2JvZHknKS5maW5kKCcucGFuZWwtZnVsbHNpemUtYmFja2Ryb3AnKS5yZW1vdmUoKTtcbiAgICAgICAgICAgICAgICAgICAgJCh0aGlzKS5kYXRhKCdicy50b29sdGlwJykub3B0aW9ucy50aXRsZSA9ICdFeHBhbmQnO1xuICAgICAgICAgICAgICAgICAgICAkKHRoaXMpLmZpbmQoJ2knKS5yZW1vdmVDbGFzcygnZmEtY29tcHJlc3MnKS5hZGRDbGFzcygnZmEtZXhwYW5kJyk7XG4gICAgICAgICAgICAgICAgICAgICQodGhpcykucGFyZW50cyhcIi5wYW5lbFwiKS5yZW1vdmVDbGFzcygncGFuZWwtZnVsbHNpemUnKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgZWxzZVxuICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgJCgnYm9keScpLmFwcGVuZCgnPGRpdiBjbGFzcz1cInBhbmVsLWZ1bGxzaXplLWJhY2tkcm9wXCI+PC9kaXY+Jyk7XG4gICAgICAgICAgICAgICAgICAgICQodGhpcykuZGF0YSgnYnMudG9vbHRpcCcpLm9wdGlvbnMudGl0bGUgPSAnTWluaW1pemUnO1xuICAgICAgICAgICAgICAgICAgICAkKHRoaXMpLmZpbmQoJ2knKS5yZW1vdmVDbGFzcygnZmEtZXhwYW5kJykuYWRkQ2xhc3MoJ2ZhLWNvbXByZXNzJyk7XG4gICAgICAgICAgICAgICAgICAgICQodGhpcykucGFyZW50cyhcIi5wYW5lbFwiKS5hZGRDbGFzcygncGFuZWwtZnVsbHNpemUnKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgLy8gU2VhcmNoIHBhbmVsXG4gICAgICAgICAgICAkKCdbZGF0YS1hY3Rpb249c2VhcmNoXScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgJCh0aGlzKS5wYXJlbnRzKCcucGFuZWwnKS5maW5kKCcucGFuZWwtc2VhcmNoJykudG9nZ2xlKDEwMCk7XG4gICAgICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgfSxcblxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIC8vIEpRVUVSWSBTUEFSS0xJTkVcbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICBoYW5kbGVTcGFya2xpbmU6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIGlmKCQoJy5zcGFya2xpbmVzJykubGVuZ3RoKXtcbiAgICAgICAgICAgICAgICAkKCcuYXZlcmFnZScpLnNwYXJrbGluZSgnaHRtbCcse3R5cGU6ICdiYXInLCBiYXJDb2xvcjogJyMzN0JDOUInLCBoZWlnaHQ6ICczMHB4J30pO1xuICAgICAgICAgICAgICAgICQoJy50cmFmZmljJykuc3BhcmtsaW5lKCdodG1sJyx7dHlwZTogJ2JhcicsIGJhckNvbG9yOiAnIzhDQzE1MicsIGhlaWdodDogJzMwcHgnfSk7XG4gICAgICAgICAgICAgICAgJCgnLmRpc2snKS5zcGFya2xpbmUoJ2h0bWwnLHt0eXBlOiAnYmFyJywgYmFyQ29sb3I6ICcjRTk1NzNGJywgaGVpZ2h0OiAnMzBweCd9KTtcbiAgICAgICAgICAgICAgICAkKCcuY3B1Jykuc3BhcmtsaW5lKCdodG1sJyx7dHlwZTogJ2JhcicsIGJhckNvbG9yOiAnI0Y2QkI0MicsIGhlaWdodDogJzMwcHgnfSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0sXG5cbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICAvLyBDTEVBUiBBTEwgQ09PS0lFXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgaGFuZGxlQ2xlYXJDb29raWU6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICQoJyNyZXNldC1zZXR0aW5nJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKXtcbiAgICAgICAgICAgICAgICB2YXIgY29va2llcyA9ICQuY29va2llKCk7XG4gICAgICAgICAgICAgICAgZm9yKHZhciBjb29raWUgaW4gY29va2llcykge1xuICAgICAgICAgICAgICAgICAgICAkLnJlbW92ZUNvb2tpZShjb29raWUpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBsb2NhdGlvbi5yZWxvYWQodHJ1ZSk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSxcblxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIC8vIEJPWCBNT0RBTFxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIGhhbmRsZUJveE1vZGFsOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAkKCcjc2V0dGluZycpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgLy8gQWRkIHNvdW5kXG4gICAgICAgICAgICAgICAgc291bmRNYW5hZ2VyLnBsYXkoJ2NhbWVyYV9mbGFzaGluZycpO1xuICAgICAgICAgICAgICAgIGJvb3Rib3guZGlhbG9nKHtcbiAgICAgICAgICAgICAgICAgICAgbWVzc2FnZTogJ0kgYW0gYSBjdXN0b20gZGlhbG9nIHNldHRpbmcnLFxuICAgICAgICAgICAgICAgICAgICB0aXRsZTogJ0N1c3RvbSBzZXR0aW5nJyxcbiAgICAgICAgICAgICAgICAgICAgY2xhc3NOYW1lOiAnbW9kYWwtc3VjY2VzcyBtb2RhbC1jZW50ZXInLFxuICAgICAgICAgICAgICAgICAgICBidXR0b25zOiB7XG4gICAgICAgICAgICAgICAgICAgICAgICBzdWNjZXNzOiB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgbGFiZWw6ICdTdWNjZXNzIScsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY2xhc3NOYW1lOiAnYnRuLXN1Y2Nlc3MnLFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNhbGxiYWNrOiBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgYWxlcnQoJ1lvdSBhcmUgc28gY2FsbSEnKTtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgICAgICAgICAgZGFuZ2VyOiB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgbGFiZWw6ICdEYW5nZXIhJyxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjbGFzc05hbWU6ICdidG4tZGFuZ2VyJyxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjYWxsYmFjazogZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGFsZXJ0KCdZb3UgYXJlIHNvIGhvdCEnKTtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgICAgICAgICAgbWFpbjoge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGxhYmVsOiAnQ2xpY2sgTUUhJyxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjbGFzc05hbWU6ICdidG4tcHJpbWFyeScsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY2FsbGJhY2s6IGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBhbGVydCgnSGVsbG8gV29ybGQnKTtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICAkKCcjbG9jay1zY3JlZW4nKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xuICAgICAgICAgICAgICAgIC8vIEFkZCBzb3VuZFxuICAgICAgICAgICAgICAgIHNvdW5kTWFuYWdlci5wbGF5KCdjYW1lcmFfZmxhc2hpbmcnKTtcbiAgICAgICAgICAgICAgICBib290Ym94LmRpYWxvZyh7XG4gICAgICAgICAgICAgICAgICAgIG1lc3NhZ2U6ICdMb2NrZXIgd2l0aCBub3RpZmljYXRpb24gZGlzcGxheSwgUmVjZWl2ZSB5b3VyIG5vdGlmaWNhdGlvbnMgZGlyZWN0bHkgb24geW91ciBsb2NrIHNjcmVlbicsXG4gICAgICAgICAgICAgICAgICAgIHRpdGxlOiAnTG9jayBTY3JlZW4nLFxuICAgICAgICAgICAgICAgICAgICBjbGFzc05hbWU6ICdtb2RhbC1saWxhYyBtb2RhbC1jZW50ZXInLFxuICAgICAgICAgICAgICAgICAgICBidXR0b25zOiB7XG4gICAgICAgICAgICAgICAgICAgICAgICBkYW5nZXI6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBsYWJlbDogJ05vJyxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjbGFzc05hbWU6ICdidG4tZGFuZ2VyJ1xuICAgICAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgICAgICAgIHN1Y2Nlc3M6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBsYWJlbDogJ1llcycsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY2xhc3NOYW1lOiAnYnRuLXN1Y2Nlc3MnLFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNhbGxiYWNrOiBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgd2luZG93LmxvY2F0aW9uID0gJCgnI2xvY2stc2NyZWVuJykuZGF0YSgndXJsJyk7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgJCgnI2xvZ291dCcpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgLy8gQWRkIHNvdW5kXG4gICAgICAgICAgICAgICAgc291bmRNYW5hZ2VyLnBsYXkoJ2NhbWVyYV9mbGFzaGluZycpO1xuICAgICAgICAgICAgICAgIGJvb3Rib3guZGlhbG9nKHtcbiAgICAgICAgICAgICAgICAgICAgbWVzc2FnZTogJ+ehruWumuimgemAgOWHuuWQl++8nycsXG4gICAgICAgICAgICAgICAgICAgIHRpdGxlOiAn6YCA5Ye6JyxcbiAgICAgICAgICAgICAgICAgICAgY2xhc3NOYW1lOiAnbW9kYWwtZGFuZ2VyIG1vZGFsLWNlbnRlcicsXG4gICAgICAgICAgICAgICAgICAgIGJ1dHRvbnM6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGRhbmdlcjoge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGxhYmVsOiAn5LiNJyxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjbGFzc05hbWU6ICdidG4tZGFuZ2VyJ1xuICAgICAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgICAgICAgIHN1Y2Nlc3M6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBsYWJlbDogJ+aYrycsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY2xhc3NOYW1lOiAnYnRuLXN1Y2Nlc3MnLFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNhbGxiYWNrOiBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgd2luZG93LmxvY2F0aW9uID0gJCgnI2xvZ291dCcpLmRhdGEoJ3VybCcpO1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0sXG5cbiAgICAgICAgaGFuZGxlVGlwKCkge1xuICAgICAgICAgICAgdG9hc3RyLm9wdGlvbnMucHJvZ3Jlc3NCYXIgPSB0cnVlO1xuICAgICAgICAgICAgJChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgbGV0ICR0aXAgPSAkKCcjdGlwJyk7XG4gICAgICAgICAgICAgICAgaWYgKCR0aXAubGVuZ3RoKSB7XG4gICAgICAgICAgICAgICAgICAgIGxldCBtZXNzYWdlID0gJHRpcC50ZXh0KCk7XG4gICAgICAgICAgICAgICAgICAgIHN3aXRjaCAoJHRpcC5hdHRyKCdzdGF0dXMnKSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgY2FzZSAnaW5mbyc6XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgdG9hc3RyLmluZm8obWVzc2FnZSk7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICAgICAgICAgICAgICBjYXNlICdlcnJvcic6XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgdG9hc3RyLmVycm9yKG1lc3NhZ2UpO1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgICAgICAgICAgICAgY2FzZSAnc3VjY2Vzcyc6XG4gICAgICAgICAgICAgICAgICAgICAgICBkZWZhdWx0OlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHRvYXN0ci5zdWNjZXNzKG1lc3NhZ2UpO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0sXG5cbiAgICAgICAgaGFuZGxlRXJyb3JzKCkge1xuICAgICAgICAgICAgdG9hc3RyLm9wdGlvbnMucHJvZ3Jlc3NCYXIgPSB0cnVlO1xuICAgICAgICAgICAgJChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgbGV0ICRlcnJvcnMgPSAkKCcjZXJyb3JzJyk7XG4gICAgICAgICAgICAgICAgaWYgKCRlcnJvcnMubGVuZ3RoICYmICgkbGlzID0gJCgnbGknLCRlcnJvcnMpKSkge1xuICAgICAgICAgICAgICAgICAgICBsZXQgbWVzc2FnZSA9ICRsaXMudGV4dCgpO1xuICAgICAgICAgICAgICAgICAgICB0b2FzdHIuZXJyb3IobWVzc2FnZSk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0sXG5cbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICAvLyBDT1BZUklHSFQgWUVBUlxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIGhhbmRsZUNvcHlyaWdodFllYXIgOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBpZigkKCcjY29weXJpZ2h0LXllYXInKS5sZW5ndGgpe1xuICAgICAgICAgICAgICAgIHZhciB0b2RheSA9IG5ldyBEYXRlKCk7XG4gICAgICAgICAgICAgICAgJCgnI2NvcHlyaWdodC15ZWFyJykudGV4dCh0b2RheS5nZXRGdWxsWWVhcigpKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuXG4gICAgfTtcbn0oKTtcblxuLy8gQ2FsbCBtYWluIGFwcCBpbml0XG5CbGFua29uQXBwLmluaXQoKTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL3Jlc291cmNlcy9hc3NldHMvanMvM3JkL2JsYW5rb24vYmxhbmtvbi5qcyJdLCJzb3VyY2VSb290IjoiIn0=