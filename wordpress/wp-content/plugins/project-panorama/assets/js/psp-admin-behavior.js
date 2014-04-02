jQuery(function() {  
        
        jQuery(".datepicker").datepicker(); 
        jQuery(".task-row :checked").each(function() { 
            jQuery(this).parent().parent().addClass('completed'); 
            jQuery(this).addClass('completed');
        });
        jQuery(".task-row :checkbox").change(function() { 
            if(jQuery(this).hasClass('completed')) { 
                jQuery(this).removeClass('completed'); 
                jQuery(this).parent().parent().removeClass('completed');
            } else { 
                jQuery(this).parent().parent().addClass('completed');
                jQuery(this).addClass('completed');    
            }
        });

});  
