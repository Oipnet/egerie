var $ = require('jquery');
window.Noty = require('noty');
require('popper.js')
require('bootstrap');
var Waves = require('node-waves');
require('mdbootstrap/js/mdb')
require('@fengyuanchen/datepicker');
require('./css/global.scss');
require('./img/casting-logo.png');
require('./img/favicon.ico');
require('./img/presentation.png');

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
});