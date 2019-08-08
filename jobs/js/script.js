/*jslint browser: true*/
/*global $, jQuery, alert, console, grecaptcha*/
$(function () {
    'use strict';
    $('[data-toggle="tooltip"]').tooltip();
	
	if ($(window).width() <= 768) {
		$('[data-toggle="tooltip"]').tooltip('destroy');
	}
	
});