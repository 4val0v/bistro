CKEDITOR.plugins.add( 'pagecut',
{
    init: function( editor )
    {	    
            ﻿CKEDITOR.addCss("div.pagecut {background: no-repeat center url('"+this.path+"images/large.png');height: 75px;width: 150px;border: #000 3px dashed;}");
	
            editor.addCommand( 'insertPagecut',
            {
                exec: function( editor )
                {                                    
                    var element = CKEDITOR.dom.element.createFromHtml( '<div class="pagecut" contenteditable="false" ><!-- CUT --></div>' );
                    editor.insertElement( element );
                }
            });
            
            editor.ui.addButton( 'Pagecut',
            {
                label: 'Вставить кат',
                command: 'insertPagecut',
                icon: this.path + 'images/icon.png'
            } );
    }
} );