/**
 * @author simon
 */
 $(document).ready(function() {
 	
     $('.edit').editable(base_url + '/chinini/chinini_save.php', {
         indicator : 'Saving...',
		 cancel    : 'Cancel',
         submit    : 'OK',
         tooltip   : 'Click to edit...',
		 submitdata : function(value, settings) {
			var element_path = $(this).path('html');
    		return {current_file: current_file, element_path: element_path};
  		}
     });
	 
	 
     $('.edit_area').editable(base_url + '/chinini/chinini_save.php',{ 
         type      : 'textarea',
         cancel    : 'Cancel',
         submit    : 'OK',
         indicator : '<img src="'+ base_url + '/chinini/img/indicator.gif">',
         tooltip   : 'Click to edit...',
		 submitdata : function(value, settings) {
			var element_path = $(this).path('html');
    		return {current_file: current_file, element_path: element_path};
  		}
		 	 
     });
	 
 }); //END document.ready
 
jQuery.fn.extend({

/**
 * Return a valid simplexml selector for PHP
 * root - specify a root element from which to generate the path
 *
 * If no root is specified, then path is given from the document root
 * If root is same as element, no path is returned (undefined)
 * If root is not actually a parent of this element, then no path is returned (undefined);
 *
 */
path :  function(root) {
        var r;
        if(root) {
                r = $(root)[0];
        } else {
                r = $()[0];
        }
        var el = this[0];
        if(el) {
            var path = "";
            while(el && el.parentNode && el != r) {
                if(el.nodeType == 9) { return; } //reached document node, no root provided
                path = "->" + el.tagName.toLowerCase() + "[" + $(el).prevAll(el.tagName).size() + "]" + path;
                var el = el.parentNode;
            }
        }
        return path;
   }

}); 