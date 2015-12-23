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
	
	$('.edit_firstname').click(function(e){    
       e.stopPropagation();
       $('#firstname').editable('toggle');
	});   
	$('.edit_surname').click(function(e){    
       e.stopPropagation();
       $('#surname').editable('toggle');
	}); 
	$('.edit_email').click(function(e){    
       e.stopPropagation();
       $('#email').editable('toggle');
	}); 
	$('.edit_institution').click(function(e){    
       e.stopPropagation();
       $('#institution').editable('toggle');
	}); 
	$('.edit_country').click(function(e){    
       e.stopPropagation();
       $('#country').editable('toggle');
	});       
    
    //make elements editable 
	$('#firstname').editable({	
		params: function(params) {   
			params.validate = "string";
			params.required = "1";
			params.table = "authors";
			return params;
        },	
		success: function(response, newValue) {
        if(response.status == 'error') {
			return response.msg; //msg will be shown in editable form
		}
	}	
	});
	$('#surname').editable({	
		params: function(params) {   
			params.validate = "string";
			params.required = "1";
			params.table = "authors";
			return params;
        },	
		success: function(response, newValue) {
        if(response.status == 'error') {
			return response.msg; //msg will be shown in editable form
		}
	}	
	});
	$('#email').editable({	
		params: function(params) {   
			params.validate = "string";
			params.required = "1";
			params.table = "authors";
			return params;
        },	
		success: function(response, newValue) {
        if(response.status == 'error') {
			return response.msg; //msg will be shown in editable form
		}
	}	
	});
	$('#institution').editable({	
		params: function(params) {   
			params.validate = "string";
			params.required = "1";
			params.table = "authors";
			return params;
        },	
		success: function(response, newValue) {
        if(response.status == 'error') {
			return response.msg; //msg will be shown in editable form
		}
	}	
	});
	$('#country').editable({	
		params: function(params) {   
			params.validate = "string";
			params.required = "1";
			params.table = "authors";
			return params;
        },	
		success: function(response, newValue) {
        if(response.status == 'error') {
			return response.msg; //msg will be shown in editable form
		}
	}	
	});
    $('#title').editable({    
		source: [
              {value: 'Prof', text: 'Professor'},
              {value: 'Dr', text: 'Dr'},
              {value: 'Mr', text: 'Mr'},
			  {value: 'Miss', text: 'Miss'},
			  {value: 'Mrs', text: 'Mrs'}
           ],
		params: function(params) {   
			params.validate = "string";
			params.required = "1";
			params.table = "authors";
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