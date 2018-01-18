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
require('./img/egeries.jpg');
require('./img/katarina-jectovic/katarina-jectovic-1.jpg');
require('./img/katarina-jectovic/katarina-jectovic-2.jpg');
require('./img/katarina-jectovic/katarina-jectovic-3.jpg');
require('./img/katarina-jectovic/katarina-jectovic-4.jpg');
require('./img/katarina-jectovic/katarina-jectovic-5.jpg');
require('./img/katarina-jectovic/katarina-jectovic-6.jpg');
require('./img/katarina-jectovic/katarina-jectovic-7.jpg');
require('./img/katarina-jectovic/katarina-jectovic-8.jpg');
require('./img/katarina-jectovic/katarina-jectovic-9.jpg');
require('./img/katarina-jectovic/katarina-jectovic-10.jpg');
require('./img/katarina-jectovic/katarina-jectovic-11.jpg');
require('./img/katarina-jectovic/katarina-jectovic-12.jpg');
require('./img/katarina-jectovic/katarina-jectovic-13.jpg');
require('./img/katarina-jectovic/katarina-jectovic-14.jpg');
require('./img/katarina-jectovic/katarina-jectovic-15.jpg');

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
});