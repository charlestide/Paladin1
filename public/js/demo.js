webpackJsonp([36],{

/***/ 125:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(126);


/***/ }),

/***/ 126:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var BlankonDemo = function () {

    // =========================================================================
    // SETTINGS APP
    // =========================================================================
    var adminCssPath = '/paladin/css/themes';

    return {

        // =========================================================================
        // CONSTRUCTOR APP
        // =========================================================================
        init: function init() {
            BlankonDemo.handleChooseThemes();
            BlankonDemo.handleNavbarColor();
            BlankonDemo.handleSidebarColor();
            BlankonDemo.handleLayoutSetting();
        },

        // =========================================================================
        // CHOOSE THEMES
        // =========================================================================
        handleChooseThemes: function handleChooseThemes() {
            // Check cookie for color schemes
            if ($.cookie('color_schemes')) {
                $('link#theme').attr('href', adminCssPath + '/themes/' + $.cookie('color_schemes') + '.theme.css');
            }
            // Check cookie for navbar color
            if ($.cookie('navbar_color')) {
                $('.navbar-toolbar').attr('class', 'navbar navbar-toolbar navbar-' + $.cookie('navbar_color'));
            }
            // Check cookie for sidebar color
            if ($.cookie('sidebar_color')) {
                // Check variant sidebar class
                if ($('#sidebar-left').hasClass('sidebar-box')) {
                    $('#sidebar-left').attr('class', 'sidebar-box sidebar-' + $.cookie('sidebar_color'));
                } else if ($('#sidebar-left').hasClass('sidebar-rounded')) {
                    $('#sidebar-left').attr('class', 'sidebar-rounded sidebar-' + $.cookie('sidebar_color'));
                } else if ($('#sidebar-left').hasClass('sidebar-circle')) {
                    $('#sidebar-left').attr('class', 'sidebar-circle sidebar-' + $.cookie('sidebar_color'));
                } else if ($('#sidebar-left').attr('class') == '') {
                    $('#sidebar-left').attr('class', 'sidebar-' + $.cookie('sidebar_color'));
                }
            }

            $('.color-schemes .theme').on('click', function () {

                // Create variable name selector file css
                var themename = $(this).find('.hide').text();

                // Add effect sound
                if ($('.page-sound').length) {
                    soundManager.play("camera_flashing_2");
                }

                // Add attribut href css theme
                $('link#theme').attr('href', adminCssPath + '/themes/' + themename + '.theme.css');

                // Set cookie theme name value to variable themename
                $.cookie('color_schemes', themename, { expires: 1 });
            });
        },

        // =========================================================================
        // NAVBAR COLOR
        // =========================================================================
        handleNavbarColor: function handleNavbarColor() {
            $('.navbar-color .theme').on('click', function () {
                // Create variable name selector file css
                var classname = $(this).find('.hide').text();
                // Add effect sound
                if ($('.page-sound').length) {
                    soundManager.play("camera_flashing_2");
                }
                // Add class navbar-color
                $('.navbar-toolbar').attr('class', 'navbar navbar-toolbar navbar-' + classname);
                // Set cookie theme name value to variable classname
                $.cookie('navbar_color', classname, { expires: 1 });
            });
        },

        // =========================================================================
        // SIDEBAR COLOR
        // =========================================================================
        handleSidebarColor: function handleSidebarColor() {
            $('.sidebar-color .theme').on('click', function () {
                // Create variable name selector file css
                var classname = $(this).find('.hide').text();
                // Add effect sound
                if ($('.page-sound').length) {
                    soundManager.play("camera_flashing_2");
                }
                // Check variant sidebar class
                if ($('#sidebar-left').hasClass('sidebar-box')) {
                    $('#sidebar-left').attr('class', 'sidebar-box sidebar-' + classname);
                } else if ($('#sidebar-left').hasClass('sidebar-rounded')) {
                    $('#sidebar-left').attr('class', 'sidebar-rounded sidebar-' + classname);
                } else if ($('#sidebar-left').hasClass('sidebar-circle')) {
                    $('#sidebar-left').attr('class', 'sidebar-circle sidebar-' + classname);
                } else if ($('#sidebar-left').attr('class') == '') {
                    $('#sidebar-left').attr('class', 'sidebar-' + classname);
                }
                // Set cookie theme name value to variable classname
                $.cookie('sidebar_color', classname, { expires: 1 });
            });
        },

        // =========================================================================
        // LAYOUT SETTING
        // =========================================================================
        handleLayoutSetting: function handleLayoutSetting() {
            // Check cookie for layout setting
            if ($.cookie('layout_setting')) {
                $('body').addClass($.cookie('layout_setting'));
            }

            // Check cookie for header layout setting
            if ($.cookie('header_layout_setting')) {
                $('body').addClass($.cookie('header_layout_setting'));
            }

            // Check cookie for sidebar layout setting
            if ($.cookie('sidebar_layout_setting')) {
                $('#sidebar-left').addClass($.cookie('sidebar_layout_setting'));
            }

            // Check cookie for sidebar type layout setting
            if ($.cookie('sidebar_type_setting')) {
                $('#sidebar-left').addClass($.cookie('sidebar_type_setting'));
            }

            // Check cookie for footer layout setting
            if ($.cookie('footer_layout_setting')) {
                $('body').addClass($.cookie('footer_layout_setting'));
            }

            // Check checked status input on layout setting
            if ($('body').not('.page-boxed')) {
                $('.layout-setting li:eq(0) input').attr('checked', 'checked');
            }
            if ($('body').hasClass('page-boxed')) {
                $('.layout-setting li:eq(1) input').attr('checked', 'checked');
                $('body').removeClass('page-header-fixed');
                $('body').removeClass('page-sidebar-fixed');
                $('body').removeClass('page-footer-fixed');
                $('.header-layout-setting li:eq(1) input').attr('disabled', 'disabled').next().css('text-decoration', 'line-through').parent('.rdio').attr({ 'data-toggle': 'tooltip', 'data-container': 'body', 'data-placement': 'left', 'data-title': 'Not working on page boxed' }).tooltip();
                $('.sidebar-layout-setting li:eq(1) input').attr('disabled', 'disabled').next().css('text-decoration', 'line-through').parent('.rdio').attr({ 'data-toggle': 'tooltip', 'data-container': 'body', 'data-placement': 'left', 'data-title': 'Not working on page boxed' }).tooltip();
                $('.footer-layout-setting li:eq(1) input').attr('disabled', 'disabled').next().css('text-decoration', 'line-through').parent('.rdio').attr({ 'data-toggle': 'tooltip', 'data-container': 'body', 'data-placement': 'left', 'data-title': 'Not working on page boxed' }).tooltip();
            }

            // Check checked status input on header layout setting
            if ($('body').not('.page-header-fixed')) {
                $('.header-layout-setting li:eq(0) input').attr('checked', 'checked');
            }
            if ($('body').hasClass('page-header-fixed')) {
                $('.header-layout-setting li:eq(1) input').attr('checked', 'checked');
            }

            // Check checked status input on sidebar layout setting
            if ($('body').not('.page-sidebar-fixed')) {
                $('.sidebar-layout-setting li:eq(0) input').attr('checked', 'checked');
            }
            if ($('body').hasClass('page-sidebar-fixed')) {
                $('.sidebar-layout-setting li:eq(1) input').attr('checked', 'checked');
            }

            // Check checked status input on sidebar type layout setting
            if ($('#sidebar-left').not('.sidebar-box, .sidebar-rounded, .sidebar-circle')) {
                $('.sidebar-type-setting li:eq(0) input').attr('checked', 'checked');
            }
            if ($('#sidebar-left').hasClass('sidebar-box')) {
                $('.sidebar-type-setting li:eq(1) input').attr('checked', 'checked');
            }
            if ($('#sidebar-left').hasClass('sidebar-rounded')) {
                $('.sidebar-type-setting li:eq(2) input').attr('checked', 'checked');
            }
            if ($('#sidebar-left').hasClass('sidebar-circle')) {
                $('.sidebar-type-setting li:eq(3) input').attr('checked', 'checked');
            }

            // Check checked status input on footer layout setting
            if ($('body').not('.page-footer-fixed')) {
                $('.footer-layout-setting li:eq(0) input').attr('checked', 'checked');
            }
            if ($('body').hasClass('page-footer-fixed')) {
                $('.footer-layout-setting li:eq(1) input').attr('checked', 'checked');
            }

            $('.layout-setting input').change(function () {

                // Create variable class name for layout setting
                var classname = $(this).val();

                // Add trigger change class on body HTML
                if ($('body').hasClass('page-boxed')) {
                    $('body').removeClass('page-boxed');
                    $('body').removeClass('page-header-fixed');
                    $('body').removeClass('page-sidebar-fixed');
                    $('body').removeClass('page-footer-fixed');
                    $('.header-layout-setting li:eq(1) input').removeAttr('disabled').next().css('text-decoration', 'inherit').parent('.rdio').tooltip('destroy');
                    $('.sidebar-layout-setting li:eq(1) input').removeAttr('disabled').next().css('text-decoration', 'inherit').parent('.rdio').tooltip('destroy');
                    $('.footer-layout-setting li:eq(1) input').removeAttr('disabled').next().css('text-decoration', 'inherit').parent('.rdio').tooltip('destroy');
                } else {
                    $('body').addClass($(this).val());
                    $('body').removeClass('page-header-fixed');
                    $('body').removeClass('page-sidebar-fixed');
                    $('body').removeClass('page-footer-fixed');
                    $('.header-layout-setting li:eq(1) input').attr('disabled', 'disabled').next().css('text-decoration', 'line-through').parent('.rdio').attr({ 'data-toggle': 'tooltip', 'data-container': 'body', 'data-placement': 'left', 'data-title': 'Not working on page boxed' }).tooltip();
                    $('.sidebar-layout-setting li:eq(1) input').attr('disabled', 'disabled').next().css('text-decoration', 'line-through').parent('.rdio').attr({ 'data-toggle': 'tooltip', 'data-container': 'body', 'data-placement': 'left', 'data-title': 'Not working on page boxed' }).tooltip();
                    $('.footer-layout-setting li:eq(1) input').attr('disabled', 'disabled').next().css('text-decoration', 'line-through').parent('.rdio').attr({ 'data-toggle': 'tooltip', 'data-container': 'body', 'data-placement': 'left', 'data-title': 'Not working on page boxed' }).tooltip();
                }

                // Set cookie theme name value to variable classname
                $.cookie('layout_setting', classname, { expires: 1 });
            });

            $('.header-layout-setting input').change(function () {

                // Create variable class name for layout setting
                var classname = $(this).val();

                // Add trigger change class on body HTML
                if ($('body').hasClass('page-header-fixed')) {
                    $('body').removeClass('page-header-fixed');
                    $('body').addClass($(this).val());
                }

                $('body').addClass($(this).val());

                // Set cookie theme name value to variable classname
                $.cookie('header_setting', classname, { expires: 1 });
            });

            $('.sidebar-layout-setting input').change(function () {

                // Create variable class name for layout setting
                var classname = $(this).val();

                // Add trigger change class on body HTML
                if ($('body').hasClass('page-sidebar-fixed')) {
                    $('body').removeClass('page-sidebar-fixed');
                    $('.header-layout-setting li:eq(0) input').removeAttr('disabled').next().css('text-decoration', 'inherit').parent('.rdio').tooltip('destroy');
                } else {
                    $('body').addClass($(this).val());
                    $('body').addClass('page-header-fixed');
                    $('.header-layout-setting li:eq(0) input').attr('disabled', 'disabled').next().css('text-decoration', 'line-through').parent('.rdio').attr({ 'data-toggle': 'tooltip', 'data-container': 'body', 'data-placement': 'left', 'data-title': 'Not working on sidebar fixed' }).tooltip();
                    $('.header-layout-setting li:eq(1) input').attr('checked', 'checked');
                }

                // Set cookie theme name value to variable classname
                $.cookie('sidebar_layout_setting', classname, { expires: 1 });
            });

            $('.sidebar-type-setting input').change(function () {

                // Create variable class name for layout setting
                var classname = $(this).val();

                // Add trigger change class on sidebar left element
                if ($('#sidebar-left').hasClass('sidebar-circle')) {
                    $('#sidebar-left').removeClass('sidebar-circle');
                    $('#sidebar-left').addClass($(this).val());
                }

                if ($('#sidebar-left').hasClass('sidebar-box')) {
                    $('#sidebar-left').removeClass('sidebar-box');
                    $('#sidebar-left').addClass($(this).val());
                }

                if ($('#sidebar-left').hasClass('sidebar-rounded')) {
                    $('#sidebar-left').removeClass('sidebar-rounded');
                    $('#sidebar-left').addClass($(this).val());
                }

                $('#sidebar-left').addClass($(this).val());

                // Set cookie theme name value to variable classname
                $.cookie('sidebar_type_setting', classname, { expires: 1 });
            });

            $('.footer-layout-setting input').change(function () {

                // Create variable class name for layout setting
                var classname = $(this).val();

                // Add trigger change class on body HTML
                if ($('body').hasClass('page-footer-fixed')) {
                    $('body').removeClass('page-footer-fixed');
                } else {
                    $('body').addClass($(this).val());
                }

                // Set cookie theme name value to variable classname
                $.cookie('footer_layout_setting', classname, { expires: 1 });
            });
        }

    };
}();

// Call main app init
BlankonDemo.init();

/***/ })

},[125]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2pzLzNyZC9ibGFua29uL2RlbW8uanMiXSwibmFtZXMiOlsiQmxhbmtvbkRlbW8iLCJhZG1pbkNzc1BhdGgiLCJpbml0IiwiaGFuZGxlQ2hvb3NlVGhlbWVzIiwiaGFuZGxlTmF2YmFyQ29sb3IiLCJoYW5kbGVTaWRlYmFyQ29sb3IiLCJoYW5kbGVMYXlvdXRTZXR0aW5nIiwiJCIsImNvb2tpZSIsImF0dHIiLCJoYXNDbGFzcyIsIm9uIiwidGhlbWVuYW1lIiwiZmluZCIsInRleHQiLCJsZW5ndGgiLCJzb3VuZE1hbmFnZXIiLCJwbGF5IiwiZXhwaXJlcyIsImNsYXNzbmFtZSIsImFkZENsYXNzIiwibm90IiwicmVtb3ZlQ2xhc3MiLCJuZXh0IiwiY3NzIiwicGFyZW50IiwidG9vbHRpcCIsImNoYW5nZSIsInZhbCIsInJlbW92ZUF0dHIiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7QUFBQSxJQUFJQSxjQUFjLFlBQVk7O0FBRTFCO0FBQ0E7QUFDQTtBQUNBLFFBQUlDLGVBQWUscUJBQW5COztBQUVBLFdBQU87O0FBRUg7QUFDQTtBQUNBO0FBQ0FDLGNBQU0sZ0JBQVk7QUFDZEYsd0JBQVlHLGtCQUFaO0FBQ0FILHdCQUFZSSxpQkFBWjtBQUNBSix3QkFBWUssa0JBQVo7QUFDQUwsd0JBQVlNLG1CQUFaO0FBQ0gsU0FWRTs7QUFZSDtBQUNBO0FBQ0E7QUFDQUgsNEJBQW9CLDhCQUFZO0FBQzVCO0FBQ0EsZ0JBQUlJLEVBQUVDLE1BQUYsQ0FBUyxlQUFULENBQUosRUFBK0I7QUFDM0JELGtCQUFFLFlBQUYsRUFBZ0JFLElBQWhCLENBQXFCLE1BQXJCLEVBQTZCUixlQUFhLFVBQWIsR0FBd0JNLEVBQUVDLE1BQUYsQ0FBUyxlQUFULENBQXhCLEdBQWtELFlBQS9FO0FBQ0g7QUFDRDtBQUNBLGdCQUFJRCxFQUFFQyxNQUFGLENBQVMsY0FBVCxDQUFKLEVBQThCO0FBQzFCRCxrQkFBRSxpQkFBRixF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RixFQUFtQmEsUUFBbkIsQ0FBNEJiLEVBQUUsSUFBRixFQUFRcUIsR0FBUixFQUE1QjtBQUNIOztBQUVEckIsa0JBQUUsZUFBRixFQUFtQmEsUUFBbkIsQ0FBNEJiLEVBQUUsSUFBRixFQUFRcUIsR0FBUixFQUE1Qjs7QUFFQTtBQUNBckIsa0JBQUVDLE1BQUYsQ0FBUyxzQkFBVCxFQUFnQ1csU0FBaEMsRUFBMkMsRUFBQ0QsU0FBUyxDQUFWLEVBQTNDO0FBRUgsYUExQkQ7O0FBNEJBWCxjQUFFLDhCQUFGLEVBQWtDb0IsTUFBbEMsQ0FBeUMsWUFBVTs7QUFFL0M7QUFDQSxvQkFBSVIsWUFBWVosRUFBRSxJQUFGLEVBQVFxQixHQUFSLEVBQWhCOztBQUVBO0FBQ0Esb0JBQUdyQixFQUFFLE1BQUYsRUFBVUcsUUFBVixDQUFtQixtQkFBbkIsQ0FBSCxFQUEyQztBQUN2Q0gsc0JBQUUsTUFBRixFQUFVZSxXQUFWLENBQXNCLG1CQUF0QjtBQUNILGlCQUZELE1BRUs7QUFDRGYsc0JBQUUsTUFBRixFQUFVYSxRQUFWLENBQW1CYixFQUFFLElBQUYsRUFBUXFCLEdBQVIsRUFBbkI7QUFDSDs7QUFFRDtBQUNBckIsa0JBQUVDLE1BQUYsQ0FBUyx1QkFBVCxFQUFpQ1csU0FBakMsRUFBNEMsRUFBQ0QsU0FBUyxDQUFWLEVBQTVDO0FBRUgsYUFmRDtBQWdCSDs7QUE3U0UsS0FBUDtBQWlUSCxDQXhUaUIsRUFBbEI7O0FBMFRBO0FBQ0FsQixZQUFZRSxJQUFaLEciLCJmaWxlIjoiL2pzL2RlbW8uanMiLCJzb3VyY2VzQ29udGVudCI6WyJ2YXIgQmxhbmtvbkRlbW8gPSBmdW5jdGlvbiAoKSB7XG5cbiAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgLy8gU0VUVElOR1MgQVBQXG4gICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgIGxldCBhZG1pbkNzc1BhdGggPSAnL3BhbGFkaW4vY3NzL3RoZW1lcyc7XG5cbiAgICByZXR1cm4ge1xuXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgLy8gQ09OU1RSVUNUT1IgQVBQXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgaW5pdDogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgQmxhbmtvbkRlbW8uaGFuZGxlQ2hvb3NlVGhlbWVzKCk7XG4gICAgICAgICAgICBCbGFua29uRGVtby5oYW5kbGVOYXZiYXJDb2xvcigpO1xuICAgICAgICAgICAgQmxhbmtvbkRlbW8uaGFuZGxlU2lkZWJhckNvbG9yKCk7XG4gICAgICAgICAgICBCbGFua29uRGVtby5oYW5kbGVMYXlvdXRTZXR0aW5nKCk7XG4gICAgICAgIH0sXG4gICAgICAgIFxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIC8vIENIT09TRSBUSEVNRVNcbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICBoYW5kbGVDaG9vc2VUaGVtZXM6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIC8vIENoZWNrIGNvb2tpZSBmb3IgY29sb3Igc2NoZW1lc1xuICAgICAgICAgICAgaWYgKCQuY29va2llKCdjb2xvcl9zY2hlbWVzJykpIHtcbiAgICAgICAgICAgICAgICAkKCdsaW5rI3RoZW1lJykuYXR0cignaHJlZicsIGFkbWluQ3NzUGF0aCsnL3RoZW1lcy8nKyQuY29va2llKCdjb2xvcl9zY2hlbWVzJykrJy50aGVtZS5jc3MnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIC8vIENoZWNrIGNvb2tpZSBmb3IgbmF2YmFyIGNvbG9yXG4gICAgICAgICAgICBpZiAoJC5jb29raWUoJ25hdmJhcl9jb2xvcicpKSB7XG4gICAgICAgICAgICAgICAgJCgnLm5hdmJhci10b29sYmFyJykuYXR0cignY2xhc3MnLCAnbmF2YmFyIG5hdmJhci10b29sYmFyIG5hdmJhci0nKyQuY29va2llKCduYXZiYXJfY29sb3InKSk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICAvLyBDaGVjayBjb29raWUgZm9yIHNpZGViYXIgY29sb3JcbiAgICAgICAgICAgIGlmICgkLmNvb2tpZSgnc2lkZWJhcl9jb2xvcicpKSB7XG4gICAgICAgICAgICAgICAgLy8gQ2hlY2sgdmFyaWFudCBzaWRlYmFyIGNsYXNzXG4gICAgICAgICAgICAgICAgaWYoJCgnI3NpZGViYXItbGVmdCcpLmhhc0NsYXNzKCdzaWRlYmFyLWJveCcpKXtcbiAgICAgICAgICAgICAgICAgICAgJCgnI3NpZGViYXItbGVmdCcpLmF0dHIoJ2NsYXNzJywnc2lkZWJhci1ib3ggc2lkZWJhci0nKyQuY29va2llKCdzaWRlYmFyX2NvbG9yJykpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBlbHNlIGlmKCQoJyNzaWRlYmFyLWxlZnQnKS5oYXNDbGFzcygnc2lkZWJhci1yb3VuZGVkJykpe1xuICAgICAgICAgICAgICAgICAgICAkKCcjc2lkZWJhci1sZWZ0JykuYXR0cignY2xhc3MnLCdzaWRlYmFyLXJvdW5kZWQgc2lkZWJhci0nKyQuY29va2llKCdzaWRlYmFyX2NvbG9yJykpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBlbHNlIGlmKCQoJyNzaWRlYmFyLWxlZnQnKS5oYXNDbGFzcygnc2lkZWJhci1jaXJjbGUnKSl7XG4gICAgICAgICAgICAgICAgICAgICQoJyNzaWRlYmFyLWxlZnQnKS5hdHRyKCdjbGFzcycsJ3NpZGViYXItY2lyY2xlIHNpZGViYXItJyskLmNvb2tpZSgnc2lkZWJhcl9jb2xvcicpKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgZWxzZSBpZigkKCcjc2lkZWJhci1sZWZ0JykuYXR0cignY2xhc3MnKSA9PSAnJyl7XG4gICAgICAgICAgICAgICAgICAgICQoJyNzaWRlYmFyLWxlZnQnKS5hdHRyKCdjbGFzcycsJ3NpZGViYXItJyskLmNvb2tpZSgnc2lkZWJhcl9jb2xvcicpKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICQoJy5jb2xvci1zY2hlbWVzIC50aGVtZScpLm9uKCdjbGljaycsZnVuY3Rpb24oKXtcblxuICAgICAgICAgICAgICAgIC8vIENyZWF0ZSB2YXJpYWJsZSBuYW1lIHNlbGVjdG9yIGZpbGUgY3NzXG4gICAgICAgICAgICAgICAgdmFyIHRoZW1lbmFtZSA9ICQodGhpcykuZmluZCgnLmhpZGUnKS50ZXh0KCk7XG5cbiAgICAgICAgICAgICAgICAvLyBBZGQgZWZmZWN0IHNvdW5kXG4gICAgICAgICAgICAgICAgaWYoJCgnLnBhZ2Utc291bmQnKS5sZW5ndGgpe1xuICAgICAgICAgICAgICAgICAgICBzb3VuZE1hbmFnZXIucGxheShcImNhbWVyYV9mbGFzaGluZ18yXCIpO1xuICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgIC8vIEFkZCBhdHRyaWJ1dCBocmVmIGNzcyB0aGVtZVxuICAgICAgICAgICAgICAgICQoJ2xpbmsjdGhlbWUnKS5hdHRyKCdocmVmJywgYWRtaW5Dc3NQYXRoKycvdGhlbWVzLycrdGhlbWVuYW1lKycudGhlbWUuY3NzJyk7XG5cbiAgICAgICAgICAgICAgICAvLyBTZXQgY29va2llIHRoZW1lIG5hbWUgdmFsdWUgdG8gdmFyaWFibGUgdGhlbWVuYW1lXG4gICAgICAgICAgICAgICAgJC5jb29raWUoJ2NvbG9yX3NjaGVtZXMnLHRoZW1lbmFtZSwge2V4cGlyZXM6IDF9KTtcblxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0sXG5cbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICAvLyBOQVZCQVIgQ09MT1JcbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICBoYW5kbGVOYXZiYXJDb2xvcjogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgJCgnLm5hdmJhci1jb2xvciAudGhlbWUnKS5vbignY2xpY2snLGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgLy8gQ3JlYXRlIHZhcmlhYmxlIG5hbWUgc2VsZWN0b3IgZmlsZSBjc3NcbiAgICAgICAgICAgICAgICB2YXIgY2xhc3NuYW1lID0gJCh0aGlzKS5maW5kKCcuaGlkZScpLnRleHQoKTtcbiAgICAgICAgICAgICAgICAvLyBBZGQgZWZmZWN0IHNvdW5kXG4gICAgICAgICAgICAgICAgaWYoJCgnLnBhZ2Utc291bmQnKS5sZW5ndGgpe1xuICAgICAgICAgICAgICAgICAgICBzb3VuZE1hbmFnZXIucGxheShcImNhbWVyYV9mbGFzaGluZ18yXCIpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAvLyBBZGQgY2xhc3MgbmF2YmFyLWNvbG9yXG4gICAgICAgICAgICAgICAgJCgnLm5hdmJhci10b29sYmFyJykuYXR0cignY2xhc3MnLCAnbmF2YmFyIG5hdmJhci10b29sYmFyIG5hdmJhci0nK2NsYXNzbmFtZSk7XG4gICAgICAgICAgICAgICAgLy8gU2V0IGNvb2tpZSB0aGVtZSBuYW1lIHZhbHVlIHRvIHZhcmlhYmxlIGNsYXNzbmFtZVxuICAgICAgICAgICAgICAgICQuY29va2llKCduYXZiYXJfY29sb3InLGNsYXNzbmFtZSwge2V4cGlyZXM6IDF9KTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9LFxuXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgLy8gU0lERUJBUiBDT0xPUlxuICAgICAgICAvLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gICAgICAgIGhhbmRsZVNpZGViYXJDb2xvcjogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgJCgnLnNpZGViYXItY29sb3IgLnRoZW1lJykub24oJ2NsaWNrJyxmdW5jdGlvbigpe1xuICAgICAgICAgICAgICAgIC8vIENyZWF0ZSB2YXJpYWJsZSBuYW1lIHNlbGVjdG9yIGZpbGUgY3NzXG4gICAgICAgICAgICAgICAgdmFyIGNsYXNzbmFtZSA9ICQodGhpcykuZmluZCgnLmhpZGUnKS50ZXh0KCk7XG4gICAgICAgICAgICAgICAgLy8gQWRkIGVmZmVjdCBzb3VuZFxuICAgICAgICAgICAgICAgIGlmKCQoJy5wYWdlLXNvdW5kJykubGVuZ3RoKXtcbiAgICAgICAgICAgICAgICAgICAgc291bmRNYW5hZ2VyLnBsYXkoXCJjYW1lcmFfZmxhc2hpbmdfMlwiKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgLy8gQ2hlY2sgdmFyaWFudCBzaWRlYmFyIGNsYXNzXG4gICAgICAgICAgICAgICAgaWYoJCgnI3NpZGViYXItbGVmdCcpLmhhc0NsYXNzKCdzaWRlYmFyLWJveCcpKXtcbiAgICAgICAgICAgICAgICAgICAgJCgnI3NpZGViYXItbGVmdCcpLmF0dHIoJ2NsYXNzJywnc2lkZWJhci1ib3ggc2lkZWJhci0nK2NsYXNzbmFtZSk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIGVsc2UgaWYoJCgnI3NpZGViYXItbGVmdCcpLmhhc0NsYXNzKCdzaWRlYmFyLXJvdW5kZWQnKSl7XG4gICAgICAgICAgICAgICAgICAgICQoJyNzaWRlYmFyLWxlZnQnKS5hdHRyKCdjbGFzcycsJ3NpZGViYXItcm91bmRlZCBzaWRlYmFyLScrY2xhc3NuYW1lKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgZWxzZSBpZigkKCcjc2lkZWJhci1sZWZ0JykuaGFzQ2xhc3MoJ3NpZGViYXItY2lyY2xlJykpe1xuICAgICAgICAgICAgICAgICAgICAkKCcjc2lkZWJhci1sZWZ0JykuYXR0cignY2xhc3MnLCdzaWRlYmFyLWNpcmNsZSBzaWRlYmFyLScrY2xhc3NuYW1lKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgZWxzZSBpZigkKCcjc2lkZWJhci1sZWZ0JykuYXR0cignY2xhc3MnKSA9PSAnJyl7XG4gICAgICAgICAgICAgICAgICAgICQoJyNzaWRlYmFyLWxlZnQnKS5hdHRyKCdjbGFzcycsJ3NpZGViYXItJytjbGFzc25hbWUpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAvLyBTZXQgY29va2llIHRoZW1lIG5hbWUgdmFsdWUgdG8gdmFyaWFibGUgY2xhc3NuYW1lXG4gICAgICAgICAgICAgICAgJC5jb29raWUoJ3NpZGViYXJfY29sb3InLGNsYXNzbmFtZSwge2V4cGlyZXM6IDF9KTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9LFxuXG4gICAgICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgICAgICAgLy8gTEFZT1VUIFNFVFRJTkdcbiAgICAgICAgLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICAgICAgICBoYW5kbGVMYXlvdXRTZXR0aW5nOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAvLyBDaGVjayBjb29raWUgZm9yIGxheW91dCBzZXR0aW5nXG4gICAgICAgICAgICBpZiAoJC5jb29raWUoJ2xheW91dF9zZXR0aW5nJykpIHtcbiAgICAgICAgICAgICAgICAkKCdib2R5JykuYWRkQ2xhc3MoJC5jb29raWUoJ2xheW91dF9zZXR0aW5nJykpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAvLyBDaGVjayBjb29raWUgZm9yIGhlYWRlciBsYXlvdXQgc2V0dGluZ1xuICAgICAgICAgICAgaWYgKCQuY29va2llKCdoZWFkZXJfbGF5b3V0X3NldHRpbmcnKSkge1xuICAgICAgICAgICAgICAgICQoJ2JvZHknKS5hZGRDbGFzcygkLmNvb2tpZSgnaGVhZGVyX2xheW91dF9zZXR0aW5nJykpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAvLyBDaGVjayBjb29raWUgZm9yIHNpZGViYXIgbGF5b3V0IHNldHRpbmdcbiAgICAgICAgICAgIGlmICgkLmNvb2tpZSgnc2lkZWJhcl9sYXlvdXRfc2V0dGluZycpKSB7XG4gICAgICAgICAgICAgICAgJCgnI3NpZGViYXItbGVmdCcpLmFkZENsYXNzKCQuY29va2llKCdzaWRlYmFyX2xheW91dF9zZXR0aW5nJykpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAvLyBDaGVjayBjb29raWUgZm9yIHNpZGViYXIgdHlwZSBsYXlvdXQgc2V0dGluZ1xuICAgICAgICAgICAgaWYgKCQuY29va2llKCdzaWRlYmFyX3R5cGVfc2V0dGluZycpKSB7XG4gICAgICAgICAgICAgICAgJCgnI3NpZGViYXItbGVmdCcpLmFkZENsYXNzKCQuY29va2llKCdzaWRlYmFyX3R5cGVfc2V0dGluZycpKTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgLy8gQ2hlY2sgY29va2llIGZvciBmb290ZXIgbGF5b3V0IHNldHRpbmdcbiAgICAgICAgICAgIGlmICgkLmNvb2tpZSgnZm9vdGVyX2xheW91dF9zZXR0aW5nJykpIHtcbiAgICAgICAgICAgICAgICAkKCdib2R5JykuYWRkQ2xhc3MoJC5jb29raWUoJ2Zvb3Rlcl9sYXlvdXRfc2V0dGluZycpKTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgLy8gQ2hlY2sgY2hlY2tlZCBzdGF0dXMgaW5wdXQgb24gbGF5b3V0IHNldHRpbmdcbiAgICAgICAgICAgIGlmKCQoJ2JvZHknKS5ub3QoJy5wYWdlLWJveGVkJykpe1xuICAgICAgICAgICAgICAgICQoJy5sYXlvdXQtc2V0dGluZyBsaTplcSgwKSBpbnB1dCcpLmF0dHIoJ2NoZWNrZWQnLCdjaGVja2VkJyk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICBpZigkKCdib2R5JykuaGFzQ2xhc3MoJ3BhZ2UtYm94ZWQnKSl7XG4gICAgICAgICAgICAgICAgJCgnLmxheW91dC1zZXR0aW5nIGxpOmVxKDEpIGlucHV0JykuYXR0cignY2hlY2tlZCcsJ2NoZWNrZWQnKTtcbiAgICAgICAgICAgICAgICAkKCdib2R5JykucmVtb3ZlQ2xhc3MoJ3BhZ2UtaGVhZGVyLWZpeGVkJyk7XG4gICAgICAgICAgICAgICAgJCgnYm9keScpLnJlbW92ZUNsYXNzKCdwYWdlLXNpZGViYXItZml4ZWQnKTtcbiAgICAgICAgICAgICAgICAkKCdib2R5JykucmVtb3ZlQ2xhc3MoJ3BhZ2UtZm9vdGVyLWZpeGVkJyk7XG4gICAgICAgICAgICAgICAgJCgnLmhlYWRlci1sYXlvdXQtc2V0dGluZyBsaTplcSgxKSBpbnB1dCcpLmF0dHIoJ2Rpc2FibGVkJywnZGlzYWJsZWQnKS5uZXh0KCkuY3NzKCd0ZXh0LWRlY29yYXRpb24nLCdsaW5lLXRocm91Z2gnKS5wYXJlbnQoJy5yZGlvJykuYXR0cih7J2RhdGEtdG9nZ2xlJzondG9vbHRpcCcsJ2RhdGEtY29udGFpbmVyJzonYm9keScsJ2RhdGEtcGxhY2VtZW50JzonbGVmdCcsJ2RhdGEtdGl0bGUnOidOb3Qgd29ya2luZyBvbiBwYWdlIGJveGVkJ30pLnRvb2x0aXAoKTtcbiAgICAgICAgICAgICAgICAkKCcuc2lkZWJhci1sYXlvdXQtc2V0dGluZyBsaTplcSgxKSBpbnB1dCcpLmF0dHIoJ2Rpc2FibGVkJywnZGlzYWJsZWQnKS5uZXh0KCkuY3NzKCd0ZXh0LWRlY29yYXRpb24nLCdsaW5lLXRocm91Z2gnKS5wYXJlbnQoJy5yZGlvJykuYXR0cih7J2RhdGEtdG9nZ2xlJzondG9vbHRpcCcsJ2RhdGEtY29udGFpbmVyJzonYm9keScsJ2RhdGEtcGxhY2VtZW50JzonbGVmdCcsJ2RhdGEtdGl0bGUnOidOb3Qgd29ya2luZyBvbiBwYWdlIGJveGVkJ30pLnRvb2x0aXAoKTtcbiAgICAgICAgICAgICAgICAkKCcuZm9vdGVyLWxheW91dC1zZXR0aW5nIGxpOmVxKDEpIGlucHV0JykuYXR0cignZGlzYWJsZWQnLCdkaXNhYmxlZCcpLm5leHQoKS5jc3MoJ3RleHQtZGVjb3JhdGlvbicsJ2xpbmUtdGhyb3VnaCcpLnBhcmVudCgnLnJkaW8nKS5hdHRyKHsnZGF0YS10b2dnbGUnOid0b29sdGlwJywnZGF0YS1jb250YWluZXInOidib2R5JywnZGF0YS1wbGFjZW1lbnQnOidsZWZ0JywnZGF0YS10aXRsZSc6J05vdCB3b3JraW5nIG9uIHBhZ2UgYm94ZWQnfSkudG9vbHRpcCgpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAvLyBDaGVjayBjaGVja2VkIHN0YXR1cyBpbnB1dCBvbiBoZWFkZXIgbGF5b3V0IHNldHRpbmdcbiAgICAgICAgICAgIGlmKCQoJ2JvZHknKS5ub3QoJy5wYWdlLWhlYWRlci1maXhlZCcpKXtcbiAgICAgICAgICAgICAgICAkKCcuaGVhZGVyLWxheW91dC1zZXR0aW5nIGxpOmVxKDApIGlucHV0JykuYXR0cignY2hlY2tlZCcsJ2NoZWNrZWQnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIGlmKCQoJ2JvZHknKS5oYXNDbGFzcygncGFnZS1oZWFkZXItZml4ZWQnKSl7XG4gICAgICAgICAgICAgICAgJCgnLmhlYWRlci1sYXlvdXQtc2V0dGluZyBsaTplcSgxKSBpbnB1dCcpLmF0dHIoJ2NoZWNrZWQnLCdjaGVja2VkJyk7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIC8vIENoZWNrIGNoZWNrZWQgc3RhdHVzIGlucHV0IG9uIHNpZGViYXIgbGF5b3V0IHNldHRpbmdcbiAgICAgICAgICAgIGlmKCQoJ2JvZHknKS5ub3QoJy5wYWdlLXNpZGViYXItZml4ZWQnKSl7XG4gICAgICAgICAgICAgICAgJCgnLnNpZGViYXItbGF5b3V0LXNldHRpbmcgbGk6ZXEoMCkgaW5wdXQnKS5hdHRyKCdjaGVja2VkJywnY2hlY2tlZCcpO1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgaWYoJCgnYm9keScpLmhhc0NsYXNzKCdwYWdlLXNpZGViYXItZml4ZWQnKSl7XG4gICAgICAgICAgICAgICAgJCgnLnNpZGViYXItbGF5b3V0LXNldHRpbmcgbGk6ZXEoMSkgaW5wdXQnKS5hdHRyKCdjaGVja2VkJywnY2hlY2tlZCcpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAvLyBDaGVjayBjaGVja2VkIHN0YXR1cyBpbnB1dCBvbiBzaWRlYmFyIHR5cGUgbGF5b3V0IHNldHRpbmdcbiAgICAgICAgICAgIGlmKCQoJyNzaWRlYmFyLWxlZnQnKS5ub3QoJy5zaWRlYmFyLWJveCwgLnNpZGViYXItcm91bmRlZCwgLnNpZGViYXItY2lyY2xlJykpe1xuICAgICAgICAgICAgICAgICQoJy5zaWRlYmFyLXR5cGUtc2V0dGluZyBsaTplcSgwKSBpbnB1dCcpLmF0dHIoJ2NoZWNrZWQnLCdjaGVja2VkJyk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICBpZigkKCcjc2lkZWJhci1sZWZ0JykuaGFzQ2xhc3MoJ3NpZGViYXItYm94Jykpe1xuICAgICAgICAgICAgICAgICQoJy5zaWRlYmFyLXR5cGUtc2V0dGluZyBsaTplcSgxKSBpbnB1dCcpLmF0dHIoJ2NoZWNrZWQnLCdjaGVja2VkJyk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICBpZigkKCcjc2lkZWJhci1sZWZ0JykuaGFzQ2xhc3MoJ3NpZGViYXItcm91bmRlZCcpKXtcbiAgICAgICAgICAgICAgICAkKCcuc2lkZWJhci10eXBlLXNldHRpbmcgbGk6ZXEoMikgaW5wdXQnKS5hdHRyKCdjaGVja2VkJywnY2hlY2tlZCcpO1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgaWYoJCgnI3NpZGViYXItbGVmdCcpLmhhc0NsYXNzKCdzaWRlYmFyLWNpcmNsZScpKXtcbiAgICAgICAgICAgICAgICAkKCcuc2lkZWJhci10eXBlLXNldHRpbmcgbGk6ZXEoMykgaW5wdXQnKS5hdHRyKCdjaGVja2VkJywnY2hlY2tlZCcpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAvLyBDaGVjayBjaGVja2VkIHN0YXR1cyBpbnB1dCBvbiBmb290ZXIgbGF5b3V0IHNldHRpbmdcbiAgICAgICAgICAgIGlmKCQoJ2JvZHknKS5ub3QoJy5wYWdlLWZvb3Rlci1maXhlZCcpKXtcbiAgICAgICAgICAgICAgICAkKCcuZm9vdGVyLWxheW91dC1zZXR0aW5nIGxpOmVxKDApIGlucHV0JykuYXR0cignY2hlY2tlZCcsJ2NoZWNrZWQnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIGlmKCQoJ2JvZHknKS5oYXNDbGFzcygncGFnZS1mb290ZXItZml4ZWQnKSl7XG4gICAgICAgICAgICAgICAgJCgnLmZvb3Rlci1sYXlvdXQtc2V0dGluZyBsaTplcSgxKSBpbnB1dCcpLmF0dHIoJ2NoZWNrZWQnLCdjaGVja2VkJyk7XG4gICAgICAgICAgICB9XG5cblxuICAgICAgICAgICAgJCgnLmxheW91dC1zZXR0aW5nIGlucHV0JykuY2hhbmdlKGZ1bmN0aW9uKCl7XG5cbiAgICAgICAgICAgICAgICAvLyBDcmVhdGUgdmFyaWFibGUgY2xhc3MgbmFtZSBmb3IgbGF5b3V0IHNldHRpbmdcbiAgICAgICAgICAgICAgICB2YXIgY2xhc3NuYW1lID0gJCh0aGlzKS52YWwoKTtcblxuICAgICAgICAgICAgICAgIC8vIEFkZCB0cmlnZ2VyIGNoYW5nZSBjbGFzcyBvbiBib2R5IEhUTUxcbiAgICAgICAgICAgICAgICBpZigkKCdib2R5JykuaGFzQ2xhc3MoJ3BhZ2UtYm94ZWQnKSl7XG4gICAgICAgICAgICAgICAgICAgICQoJ2JvZHknKS5yZW1vdmVDbGFzcygncGFnZS1ib3hlZCcpO1xuICAgICAgICAgICAgICAgICAgICAkKCdib2R5JykucmVtb3ZlQ2xhc3MoJ3BhZ2UtaGVhZGVyLWZpeGVkJyk7XG4gICAgICAgICAgICAgICAgICAgICQoJ2JvZHknKS5yZW1vdmVDbGFzcygncGFnZS1zaWRlYmFyLWZpeGVkJyk7XG4gICAgICAgICAgICAgICAgICAgICQoJ2JvZHknKS5yZW1vdmVDbGFzcygncGFnZS1mb290ZXItZml4ZWQnKTtcbiAgICAgICAgICAgICAgICAgICAgJCgnLmhlYWRlci1sYXlvdXQtc2V0dGluZyBsaTplcSgxKSBpbnB1dCcpLnJlbW92ZUF0dHIoJ2Rpc2FibGVkJykubmV4dCgpLmNzcygndGV4dC1kZWNvcmF0aW9uJywnaW5oZXJpdCcpLnBhcmVudCgnLnJkaW8nKS50b29sdGlwKCdkZXN0cm95Jyk7XG4gICAgICAgICAgICAgICAgICAgICQoJy5zaWRlYmFyLWxheW91dC1zZXR0aW5nIGxpOmVxKDEpIGlucHV0JykucmVtb3ZlQXR0cignZGlzYWJsZWQnKS5uZXh0KCkuY3NzKCd0ZXh0LWRlY29yYXRpb24nLCdpbmhlcml0JykucGFyZW50KCcucmRpbycpLnRvb2x0aXAoJ2Rlc3Ryb3knKTtcbiAgICAgICAgICAgICAgICAgICAgJCgnLmZvb3Rlci1sYXlvdXQtc2V0dGluZyBsaTplcSgxKSBpbnB1dCcpLnJlbW92ZUF0dHIoJ2Rpc2FibGVkJykubmV4dCgpLmNzcygndGV4dC1kZWNvcmF0aW9uJywnaW5oZXJpdCcpLnBhcmVudCgnLnJkaW8nKS50b29sdGlwKCdkZXN0cm95Jyk7XG4gICAgICAgICAgICAgICAgfWVsc2V7XG4gICAgICAgICAgICAgICAgICAgICQoJ2JvZHknKS5hZGRDbGFzcygkKHRoaXMpLnZhbCgpKTtcbiAgICAgICAgICAgICAgICAgICAgJCgnYm9keScpLnJlbW92ZUNsYXNzKCdwYWdlLWhlYWRlci1maXhlZCcpO1xuICAgICAgICAgICAgICAgICAgICAkKCdib2R5JykucmVtb3ZlQ2xhc3MoJ3BhZ2Utc2lkZWJhci1maXhlZCcpO1xuICAgICAgICAgICAgICAgICAgICAkKCdib2R5JykucmVtb3ZlQ2xhc3MoJ3BhZ2UtZm9vdGVyLWZpeGVkJyk7XG4gICAgICAgICAgICAgICAgICAgICQoJy5oZWFkZXItbGF5b3V0LXNldHRpbmcgbGk6ZXEoMSkgaW5wdXQnKS5hdHRyKCdkaXNhYmxlZCcsJ2Rpc2FibGVkJykubmV4dCgpLmNzcygndGV4dC1kZWNvcmF0aW9uJywnbGluZS10aHJvdWdoJykucGFyZW50KCcucmRpbycpLmF0dHIoeydkYXRhLXRvZ2dsZSc6J3Rvb2x0aXAnLCdkYXRhLWNvbnRhaW5lcic6J2JvZHknLCdkYXRhLXBsYWNlbWVudCc6J2xlZnQnLCdkYXRhLXRpdGxlJzonTm90IHdvcmtpbmcgb24gcGFnZSBib3hlZCd9KS50b29sdGlwKCk7XG4gICAgICAgICAgICAgICAgICAgICQoJy5zaWRlYmFyLWxheW91dC1zZXR0aW5nIGxpOmVxKDEpIGlucHV0JykuYXR0cignZGlzYWJsZWQnLCdkaXNhYmxlZCcpLm5leHQoKS5jc3MoJ3RleHQtZGVjb3JhdGlvbicsJ2xpbmUtdGhyb3VnaCcpLnBhcmVudCgnLnJkaW8nKS5hdHRyKHsnZGF0YS10b2dnbGUnOid0b29sdGlwJywnZGF0YS1jb250YWluZXInOidib2R5JywnZGF0YS1wbGFjZW1lbnQnOidsZWZ0JywnZGF0YS10aXRsZSc6J05vdCB3b3JraW5nIG9uIHBhZ2UgYm94ZWQnfSkudG9vbHRpcCgpO1xuICAgICAgICAgICAgICAgICAgICAkKCcuZm9vdGVyLWxheW91dC1zZXR0aW5nIGxpOmVxKDEpIGlucHV0JykuYXR0cignZGlzYWJsZWQnLCdkaXNhYmxlZCcpLm5leHQoKS5jc3MoJ3RleHQtZGVjb3JhdGlvbicsJ2xpbmUtdGhyb3VnaCcpLnBhcmVudCgnLnJkaW8nKS5hdHRyKHsnZGF0YS10b2dnbGUnOid0b29sdGlwJywnZGF0YS1jb250YWluZXInOidib2R5JywnZGF0YS1wbGFjZW1lbnQnOidsZWZ0JywnZGF0YS10aXRsZSc6J05vdCB3b3JraW5nIG9uIHBhZ2UgYm94ZWQnfSkudG9vbHRpcCgpO1xuICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgIC8vIFNldCBjb29raWUgdGhlbWUgbmFtZSB2YWx1ZSB0byB2YXJpYWJsZSBjbGFzc25hbWVcbiAgICAgICAgICAgICAgICAkLmNvb2tpZSgnbGF5b3V0X3NldHRpbmcnLGNsYXNzbmFtZSwge2V4cGlyZXM6IDF9KTtcblxuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgICQoJy5oZWFkZXItbGF5b3V0LXNldHRpbmcgaW5wdXQnKS5jaGFuZ2UoZnVuY3Rpb24oKXtcblxuICAgICAgICAgICAgICAgIC8vIENyZWF0ZSB2YXJpYWJsZSBjbGFzcyBuYW1lIGZvciBsYXlvdXQgc2V0dGluZ1xuICAgICAgICAgICAgICAgIHZhciBjbGFzc25hbWUgPSAkKHRoaXMpLnZhbCgpO1xuXG4gICAgICAgICAgICAgICAgLy8gQWRkIHRyaWdnZXIgY2hhbmdlIGNsYXNzIG9uIGJvZHkgSFRNTFxuICAgICAgICAgICAgICAgIGlmKCQoJ2JvZHknKS5oYXNDbGFzcygncGFnZS1oZWFkZXItZml4ZWQnKSl7XG4gICAgICAgICAgICAgICAgICAgICQoJ2JvZHknKS5yZW1vdmVDbGFzcygncGFnZS1oZWFkZXItZml4ZWQnKTtcbiAgICAgICAgICAgICAgICAgICAgJCgnYm9keScpLmFkZENsYXNzKCQodGhpcykudmFsKCkpO1xuICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgICQoJ2JvZHknKS5hZGRDbGFzcygkKHRoaXMpLnZhbCgpKTtcblxuICAgICAgICAgICAgICAgIC8vIFNldCBjb29raWUgdGhlbWUgbmFtZSB2YWx1ZSB0byB2YXJpYWJsZSBjbGFzc25hbWVcbiAgICAgICAgICAgICAgICAkLmNvb2tpZSgnaGVhZGVyX3NldHRpbmcnLGNsYXNzbmFtZSwge2V4cGlyZXM6IDF9KTtcblxuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgICQoJy5zaWRlYmFyLWxheW91dC1zZXR0aW5nIGlucHV0JykuY2hhbmdlKGZ1bmN0aW9uKCl7XG5cbiAgICAgICAgICAgICAgICAvLyBDcmVhdGUgdmFyaWFibGUgY2xhc3MgbmFtZSBmb3IgbGF5b3V0IHNldHRpbmdcbiAgICAgICAgICAgICAgICB2YXIgY2xhc3NuYW1lID0gJCh0aGlzKS52YWwoKTtcblxuICAgICAgICAgICAgICAgIC8vIEFkZCB0cmlnZ2VyIGNoYW5nZSBjbGFzcyBvbiBib2R5IEhUTUxcbiAgICAgICAgICAgICAgICBpZigkKCdib2R5JykuaGFzQ2xhc3MoJ3BhZ2Utc2lkZWJhci1maXhlZCcpKXtcbiAgICAgICAgICAgICAgICAgICAgJCgnYm9keScpLnJlbW92ZUNsYXNzKCdwYWdlLXNpZGViYXItZml4ZWQnKTtcbiAgICAgICAgICAgICAgICAgICAgJCgnLmhlYWRlci1sYXlvdXQtc2V0dGluZyBsaTplcSgwKSBpbnB1dCcpLnJlbW92ZUF0dHIoJ2Rpc2FibGVkJykubmV4dCgpLmNzcygndGV4dC1kZWNvcmF0aW9uJywnaW5oZXJpdCcpLnBhcmVudCgnLnJkaW8nKS50b29sdGlwKCdkZXN0cm95Jyk7XG4gICAgICAgICAgICAgICAgfWVsc2V7XG4gICAgICAgICAgICAgICAgICAgICQoJ2JvZHknKS5hZGRDbGFzcygkKHRoaXMpLnZhbCgpKTtcbiAgICAgICAgICAgICAgICAgICAgJCgnYm9keScpLmFkZENsYXNzKCdwYWdlLWhlYWRlci1maXhlZCcpO1xuICAgICAgICAgICAgICAgICAgICAkKCcuaGVhZGVyLWxheW91dC1zZXR0aW5nIGxpOmVxKDApIGlucHV0JykuYXR0cignZGlzYWJsZWQnLCdkaXNhYmxlZCcpLm5leHQoKS5jc3MoJ3RleHQtZGVjb3JhdGlvbicsJ2xpbmUtdGhyb3VnaCcpLnBhcmVudCgnLnJkaW8nKS5hdHRyKHsnZGF0YS10b2dnbGUnOid0b29sdGlwJywnZGF0YS1jb250YWluZXInOidib2R5JywnZGF0YS1wbGFjZW1lbnQnOidsZWZ0JywnZGF0YS10aXRsZSc6J05vdCB3b3JraW5nIG9uIHNpZGViYXIgZml4ZWQnfSkudG9vbHRpcCgpO1xuICAgICAgICAgICAgICAgICAgICAkKCcuaGVhZGVyLWxheW91dC1zZXR0aW5nIGxpOmVxKDEpIGlucHV0JykuYXR0cignY2hlY2tlZCcsJ2NoZWNrZWQnKTtcbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICAvLyBTZXQgY29va2llIHRoZW1lIG5hbWUgdmFsdWUgdG8gdmFyaWFibGUgY2xhc3NuYW1lXG4gICAgICAgICAgICAgICAgJC5jb29raWUoJ3NpZGViYXJfbGF5b3V0X3NldHRpbmcnLGNsYXNzbmFtZSwge2V4cGlyZXM6IDF9KTtcblxuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgICQoJy5zaWRlYmFyLXR5cGUtc2V0dGluZyBpbnB1dCcpLmNoYW5nZShmdW5jdGlvbigpe1xuXG4gICAgICAgICAgICAgICAgLy8gQ3JlYXRlIHZhcmlhYmxlIGNsYXNzIG5hbWUgZm9yIGxheW91dCBzZXR0aW5nXG4gICAgICAgICAgICAgICAgdmFyIGNsYXNzbmFtZSA9ICQodGhpcykudmFsKCk7XG5cbiAgICAgICAgICAgICAgICAvLyBBZGQgdHJpZ2dlciBjaGFuZ2UgY2xhc3Mgb24gc2lkZWJhciBsZWZ0IGVsZW1lbnRcbiAgICAgICAgICAgICAgICBpZigkKCcjc2lkZWJhci1sZWZ0JykuaGFzQ2xhc3MoJ3NpZGViYXItY2lyY2xlJykpe1xuICAgICAgICAgICAgICAgICAgICAkKCcjc2lkZWJhci1sZWZ0JykucmVtb3ZlQ2xhc3MoJ3NpZGViYXItY2lyY2xlJyk7XG4gICAgICAgICAgICAgICAgICAgICQoJyNzaWRlYmFyLWxlZnQnKS5hZGRDbGFzcygkKHRoaXMpLnZhbCgpKTtcbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICBpZigkKCcjc2lkZWJhci1sZWZ0JykuaGFzQ2xhc3MoJ3NpZGViYXItYm94Jykpe1xuICAgICAgICAgICAgICAgICAgICAkKCcjc2lkZWJhci1sZWZ0JykucmVtb3ZlQ2xhc3MoJ3NpZGViYXItYm94Jyk7XG4gICAgICAgICAgICAgICAgICAgICQoJyNzaWRlYmFyLWxlZnQnKS5hZGRDbGFzcygkKHRoaXMpLnZhbCgpKTtcbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICBpZigkKCcjc2lkZWJhci1sZWZ0JykuaGFzQ2xhc3MoJ3NpZGViYXItcm91bmRlZCcpKXtcbiAgICAgICAgICAgICAgICAgICAgJCgnI3NpZGViYXItbGVmdCcpLnJlbW92ZUNsYXNzKCdzaWRlYmFyLXJvdW5kZWQnKTtcbiAgICAgICAgICAgICAgICAgICAgJCgnI3NpZGViYXItbGVmdCcpLmFkZENsYXNzKCQodGhpcykudmFsKCkpO1xuICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgICQoJyNzaWRlYmFyLWxlZnQnKS5hZGRDbGFzcygkKHRoaXMpLnZhbCgpKTtcblxuICAgICAgICAgICAgICAgIC8vIFNldCBjb29raWUgdGhlbWUgbmFtZSB2YWx1ZSB0byB2YXJpYWJsZSBjbGFzc25hbWVcbiAgICAgICAgICAgICAgICAkLmNvb2tpZSgnc2lkZWJhcl90eXBlX3NldHRpbmcnLGNsYXNzbmFtZSwge2V4cGlyZXM6IDF9KTtcblxuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgICQoJy5mb290ZXItbGF5b3V0LXNldHRpbmcgaW5wdXQnKS5jaGFuZ2UoZnVuY3Rpb24oKXtcblxuICAgICAgICAgICAgICAgIC8vIENyZWF0ZSB2YXJpYWJsZSBjbGFzcyBuYW1lIGZvciBsYXlvdXQgc2V0dGluZ1xuICAgICAgICAgICAgICAgIHZhciBjbGFzc25hbWUgPSAkKHRoaXMpLnZhbCgpO1xuXG4gICAgICAgICAgICAgICAgLy8gQWRkIHRyaWdnZXIgY2hhbmdlIGNsYXNzIG9uIGJvZHkgSFRNTFxuICAgICAgICAgICAgICAgIGlmKCQoJ2JvZHknKS5oYXNDbGFzcygncGFnZS1mb290ZXItZml4ZWQnKSl7XG4gICAgICAgICAgICAgICAgICAgICQoJ2JvZHknKS5yZW1vdmVDbGFzcygncGFnZS1mb290ZXItZml4ZWQnKVxuICAgICAgICAgICAgICAgIH1lbHNle1xuICAgICAgICAgICAgICAgICAgICAkKCdib2R5JykuYWRkQ2xhc3MoJCh0aGlzKS52YWwoKSk7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgLy8gU2V0IGNvb2tpZSB0aGVtZSBuYW1lIHZhbHVlIHRvIHZhcmlhYmxlIGNsYXNzbmFtZVxuICAgICAgICAgICAgICAgICQuY29va2llKCdmb290ZXJfbGF5b3V0X3NldHRpbmcnLGNsYXNzbmFtZSwge2V4cGlyZXM6IDF9KTtcblxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH1cbiAgICAgICAgXG4gICAgfTtcblxufSgpO1xuXG4vLyBDYWxsIG1haW4gYXBwIGluaXRcbkJsYW5rb25EZW1vLmluaXQoKTtcblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9yZXNvdXJjZXMvYXNzZXRzL2pzLzNyZC9ibGFua29uL2RlbW8uanMiXSwic291cmNlUm9vdCI6IiJ9