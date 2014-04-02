(function() {
    tinymce.create('tinymce.plugins.pspButtons', {

          init : function(ed, url) {
                            
                ed.addButton('currentprojects', {
                    title : 'Display All Active Projects',
                    cmd : 'activeprojects',
                    image : url + '/active-projects.png'
                });
                 
                ed.addCommand('activeprojects', function() {
                    return_text = '[project_list]';
                    ed.execCommand('mceInsertContent',0,return_text);
                });

                ed.addButton('singleproject', {
                    title : 'Embed a Project',
                    cmd : 'displayproject',
                    image : url + '/single-project.png'
                });
                
                
                ed.addCommand('displayproject', function() { 
                     var number = prompt("Please enter the ID of the project you want to show"),
                        shortcode;
                    if(number !== null) { 
                        number = parseInt(number);
                        shortcode = '[project_status id="'+number+'"]';
                        ed.execCommand('mceInsertContent',0,shortcode);
                    } else { 
                        alert('That ID is invalid, please enter a number');
                    }
                });
                /*
                ed.addCommand('displayproject', function() { 
                    ed.windowManager.open({
                       title: 'Embed a Project',
                       body: [ 
                            {   type: 'listbox',
                                name: 'project', 
                                label: 'Project', 
                                'values': [
                                    { text: 'Project Name', value: '1' },
                                    { text: 'Project #2', value: '2' }
                                ] 
                            }
                       ],
                       onsubmit: function(e) { 
                            shortcode = '[project_status id="'+e+'"]';
                            ed.execCommand('mceInsertContent',0,shortcode);
                       } 
                        
                    });
                }); */
                 
             },
 
        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
        },
 
        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'PSP Buttons',
                author : '37 Media',
                authorurl : 'http://37mediallc.com',
                infourl : 'http://37mediallc.com',
                version : "0.1"
            };
        }
    });
 
    // Register plugin
    tinymce.PluginManager.add( 'pspbuttons', tinymce.plugins.pspButtons );
})();