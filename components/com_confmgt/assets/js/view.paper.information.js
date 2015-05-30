/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
(function ( $ ) { 
$(document).ready(function() {
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'inline';
	
	$('.edit_title').click(function(e){    
       e.stopPropagation();
       $('#title').editable('toggle');
	}); 
	
	$('.edit_keywords').click(function(e){    
       e.stopPropagation();
       $('#keywords').editable('toggle');
	});     
    
    //make all elements with edit class editable 
    $('#title').editable({	
		params: function(params) {   
			params.validate = "string";
			params.required = "1";
			params.table = "papers";
			return params;
        },	
		success: function(response, newValue) {
        if(response.status == 'error') {
			return response.msg; //msg will be shown in editable form
		}
	}	
	});
	
	$('#keywords').editable({	
		params: function(params) {   
			params.validate = "string";
			params.required = "1";
			params.table = "papers";
			return params;
        },	
		success: function(response, newValue) {
        if(response.status == 'error') {
			return response.msg; //msg will be shown in editable form
		}
	}	
	});
});  
}( jQuery ));