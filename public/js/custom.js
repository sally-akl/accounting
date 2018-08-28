/*global $,console*/
$(function () {

    'use strict';

    $('#m_aside_left_minimize_toggle').click(function () {
        $(this).toggleClass('activeExitMenu');
        if ($(this).hasClass('activeExitMenu')) {
            $('.imageUsername').css('width', '50px');
            $('.imageUsername').css('height', '50px');
            $('.menu_linkss').hide();
            $('.levelAdmin').hide();
        } else {
            $('.imageUsername').css('width', '100px');
            $('.imageUsername').css('height', '100px');
            $('.menu_linkss').show();
            $('.levelAdmin').show();
        }
    });
    
    
    $('.m-menu__item--submenu').click(function () {
        
        var a = $(this).children('a'),
        
            i = a.children('i:last-of-type');
        
        $(this).toggleClass('iconActive');
        
        if ($(this).hasClass('iconActive')) {
        
            i.replaceWith('<i class="m-menu__ver-arrow fa fa-angle-left"></i>');

        } else {
            i.replaceWith('<i class="m-menu__ver-arrow fa fa-angle-down"></i>');
        }
    });
    
    $('.m-menu__item--submenu a i:last-of-type').click(function () {
        $(this).attr('class', 'fa-angle-right');
    });
    
    $('#m_aside_left_offcanvas_toggle').click(function () {
       
        $('.inputSearchDashboardS').show();
        
        $('#icnoSearchS').show();
        
    });
   
    $('#m_aside_left_close_btn').click(function () {
       
        $('.inputSearchDashboardS').hide();
        
        $('#icnoSearchS').hide();
        
    });
    
    var shows = setInterval(function () {
        
        if (($(window).width()) >= 1011) {
            $('.inputSearchDashboardS').hide();
            $('.inputSearchDashboardS').addClass('blo');
            $('#icnoSearchS').hide();
        }
        
    }, 1);
    
    if ($('.inputSearchDashboardS').hasClass('blo')) {
        clearInterval(shows);
    }
    
    $('.showCheckBox').click(function () {
        $('.inputCheckBox').toggleClass('checcked');
        if ($('.inputCheckBox').hasClass('checcked')) {
            $('.inputCheckBox').attr('checked', 'checked');
            $(this).css('background', '#4389a3');
            $(this).css('color', '#ffffff');
            
        } else {
            $('.inputCheckBox').removeAttr('checked');
            $(this).css('background', '#e5e3ef');
            $(this).css('color', '#666');
            $(this).css('color', 'transparent');
        }
    });
    
    $('.inputSearchYellow').click(function () {
       
        $(this).toggleClass('activeSearchAdvanced');
        
        if ($(this).hasClass('activeSearchAdvanced')) {
        
            $('.datePickr').show();
        
            $('.advancedSearch').animate({
                height: '60px',
                opacity: '1',
                display: 'inline-block'
            }, 600);
            
        } else {
        
            $('.advancedSearch').animate({
                height: '0',
                opacity: '0'
            }, 600);
            
            $('.datePickr').hide(700);
            
        }
                
    });

    
});