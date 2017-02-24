/* [ ---- Ebro Admin - wysiwg editor  ---- ] */

    $(function() {
		ebro_wysiwg.init();
	})
	
	ebro_wysiwg = {
		init: function() {
			if($('#wysiwg_editor').length) { 
				CKEDITOR.replace( 'wysiwg_editor',
					CKEDITOR.tools.extend (
					{
						height: 300,
						extraPlugins: 'autogrow',
						autoGrow_maxHeight: 400
					})
				);
			}
                        if($('#wysiwg_editor1').length) { 
				CKEDITOR.replace( 'wysiwg_editor1',
					CKEDITOR.tools.extend (
					{
						height: 300,
						extraPlugins: 'autogrow',
						autoGrow_maxHeight: 400
					})
				);
			}
                        
                        if($('#wysiwg_editor2').length) { 
				CKEDITOR.replace( 'wysiwg_editor2',
					CKEDITOR.tools.extend (
					{
						height: 300,
						extraPlugins: 'autogrow',
						autoGrow_maxHeight: 400
					})
				);
			}
                        
                        if($('#wysiwg_editor3').length) { 
				CKEDITOR.replace( 'wysiwg_editor3',
					CKEDITOR.tools.extend (
					{
						height: 300,
						extraPlugins: 'autogrow',
						autoGrow_maxHeight: 400
					})
				);
			}
                        
                        if($('#wysiwg_editor4').length) { 
				CKEDITOR.replace( 'wysiwg_editor4',
					CKEDITOR.tools.extend (
					{
						height: 300,
						extraPlugins: 'autogrow',
						autoGrow_maxHeight: 400
					})
				);
			}
                        
                        if($('#wysiwg_editor5').length) { 
				CKEDITOR.replace( 'wysiwg_editor5',
					CKEDITOR.tools.extend (
					{
						height: 300,
						extraPlugins: 'autogrow',
						autoGrow_maxHeight: 400
					})
				);
			}
                        
                        if($('#nearest_airport_info').length) { 
				CKEDITOR.replace( 'nearest_airport_info',
					CKEDITOR.tools.extend (
					{
						height: 300,
						extraPlugins: 'autogrow',
						autoGrow_maxHeight: 400
					})
				);
			}                        
                        
                        if($('#airport_taxi_info').length) { 
				CKEDITOR.replace( 'airport_taxi_info',
					CKEDITOR.tools.extend (
					{
						height: 300,
						extraPlugins: 'autogrow',
						autoGrow_maxHeight: 400
					})
				);
			}
                        
                        if($('#explore_things_todo').length) { 
				CKEDITOR.replace( 'explore_things_todo',
					CKEDITOR.tools.extend (
					{
						height: 300,
						extraPlugins: 'autogrow',
						autoGrow_maxHeight: 400
					})
				);
			}
			if($('#wysiwg_simple').length) {
				CKEDITOR.replace( 'wysiwg_simple',
					CKEDITOR.tools.extend (
					{
						height: 300,
						extraPlugins: 'autogrow',
						autoGrow_maxHeight: 400
					})
				);
			}
                        if($('#wysiwg_simple1').length) {
				CKEDITOR.replace( 'wysiwg_simple1',
					CKEDITOR.tools.extend (
					{
						height: 300,
						extraPlugins: 'autogrow',
						autoGrow_maxHeight: 400
					})
				);
			}
                         if($('#wysiwg_editor10').length) {
				CKEDITOR.replace( 'wysiwg_editor10',
					CKEDITOR.tools.extend (
					{
						height: 450,
					})
				);
			}
                          if($('#wysiwg_editor11').length) {
				CKEDITOR.replace( 'wysiwg_editor11',
					CKEDITOR.tools.extend (
					{
						height: 450,
					})
				);
			}
                        /*
			if($('#wysiwg_simple').length) {
				var basicConfig = {
					height:200,
					plugins: 'basicstyles,clipboard,list,indent,enterkey,entities,link,pastetext,toolbar,undo,wysiwygarea,smiley,autogrow',
					forcePasteAsPlainText : true,
					removeButtons: 'Anchor,Strike,Subscript,Superscript',
					toolbarGroups: [
						{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
						{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
						{ name: 'forms' },
						{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
						{ name: 'paragraph',   groups: [ 'list', 'blocks', 'align' ] },
						{ name: 'insert' },
						{ name: 'tools' },
					]
				};

				CKEDITOR.replace( 'wysiwg_simple' ,
					CKEDITOR.tools.extend( basicConfig )
				);
			}
			
                        if($('#wysiwg_simple1').length) {
				var basicConfig = {
					height:200,
					plugins: 'basicstyles,clipboard,list,indent,enterkey,entities,link,pastetext,toolbar,undo,wysiwygarea,smiley,autogrow',
					forcePasteAsPlainText : true,
					removeButtons: 'Anchor,Strike,Subscript,Superscript',
					toolbarGroups: [
						{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
						{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
						{ name: 'forms' },
						{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
						{ name: 'paragraph',   groups: [ 'list', 'blocks', 'align' ] },
						{ name: 'insert' },
						{ name: 'tools' },
					]
				};

				CKEDITOR.replace( 'wysiwg_simple1' ,
					CKEDITOR.tools.extend( basicConfig )
				);
			}
                        */
		}
	}