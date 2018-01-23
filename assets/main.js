var $ = require('jquery');
window.Noty = require('noty');
require('lightbox2');
require('popper.js')
require('bootstrap');
var Waves = require('node-waves');
require('mdbootstrap/js/mdb')
require('@fengyuanchen/datepicker');
require('./css/global.scss');
require('./img/casting-logo.png');
require('./img/favicon.ico');
require('./img/presentation.png');
require('./img/egeries.png');
require('./img/katarina-jevtovic/katarina-jevtovic-1.jpg');
require('./img/katarina-jevtovic/katarina-jevtovic-2.jpg');
require('./img/katarina-jevtovic/katarina-jevtovic-3.jpg');
require('./img/katarina-jevtovic/katarina-jevtovic-4.jpg');
require('./img/katarina-jevtovic/katarina-jevtovic-5.jpg');
require('./img/katarina-jevtovic/katarina-jevtovic-6.jpg');
require('./img/katarina-jevtovic/katarina-jevtovic-7.jpg');
require('./img/katarina-jevtovic/katarina-jevtovic-8.jpg');
require('./img/katarina-jevtovic/katarina-jevtovic-9.jpg');
require('./img/katarina-jevtovic/katarina-jevtovic-10.jpg');
require('./img/katarina-jevtovic/katarina-jevtovic-11.jpg');
require('./img/katarina-jevtovic/katarina-jevtovic-12.jpg');
require('./img/katarina-jevtovic/katarina-jevtovic-13.jpg');
require('./img/katarina-jevtovic/katarina-jevtovic-14.jpg');
require('./img/katarina-jevtovic/katarina-jevtovic-15.jpg');

$(document).ready(function () {
    $('#jumbo_more_btn').click(e => {
        e.preventDefault();
        $('#jumbo_more_btn').hide();
        $('#jumbo_more').slideDown(400);
    });

    $('.about .card').height($('.about .about_participate').height());

    $('.js-datepicker').datepicker({
        format: 'yyyy-mm-dd',
    });

    $('input[type="date"]').attr('type', 'text');

    $('.candidate_portrait .img-thumbnail').click(function () {
        var srcPortrait = $(this).attr('src');
        var srcFullBody = $('.candidate_fullBody img').attr('src');

        $('.candidate_fullBody img').attr('src', srcPortrait);
        $(this).attr('src', srcFullBody);
    });

    $('.candidate_portrait').hover(function () {
        $('.candidate_portrait .zoom').removeClass('d-none');
    }, function () {
        $('.candidate_portrait .zoom').addClass('d-none');
    });

    $('nav .dropdown').hover(function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(150).slideDown();
    }, function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp()
    });
});