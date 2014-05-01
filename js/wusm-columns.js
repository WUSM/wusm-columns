(function() {
	tinymce.create('tinymce.plugins.wusm_columns', {

	/**
	 *
	 */
	init : function(ed, url) {
		ed.addButton('wusm_columns', {
			icon  : 'code',
			title : 'Add columns',
			cmd   : 'wusm_columns_cmd',
		});

		ed.addCommand('wusm_columns_cmd', function() {
			var cols = prompt( "Number of columns? (up to 4)" ),
				divhtml = "";
			if ( cols < 2 )
				cols = 2;
			if ( cols > 4 )
				cols = 4;
			for (var i = 0; i < cols; i++) {
				divhtml += "<div class='cols-" + cols + "'></div>";
			}
			ed.execCommand( 'mceInsertContent', 0, divhtml );
		});
	},

	/**
	 *
	 */
	createControl : function(n, cm) {
		return null;
	},

	/**
	 *
	 */
	getInfo : function() {
		return {
			longname  : 'Add button with dashicon',
			author    : 'Aaron Graham',
			authorurl : '',
			infourl   : '',
			version   : "0.1"
		};
	}
});

// Register plugin
tinymce.PluginManager.add( 'wusm_columns', tinymce.plugins.wusm_columns );
})();