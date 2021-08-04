/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.2
 */

jQuery(function($) {
	$('.advpoll-answer label').on('click', function (e) {
		setTimeout( function(){
			$('.advpoll-button-vote').trigger("click");
		}  , 1000 );
	});
});
