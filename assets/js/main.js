// loads the Bootstrap jQuery plugins
var $ = require('jquery');
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.min.js';
import 'bootstrap-datepicker/dist/css/bootstrap-datepicker3.css';
import 'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js';
import '../css/main.css';

$(document).ready(function() {

    $(".datepicker").datepicker({
        language: 'ru'
    });

    $('form').on('submit', function () {
        $('button[type=submit]').attr('disabled', true);
    });

});