(function() {
	tinymce.create('tinymce.plugins.wusm_columns', {

	/**
	 *
	 */
	init : function(ed, url) {
		ed.addButton('wusm_columns', {
			title : 'Add columns',
			cmd   : 'wusm_columns_cmd',
		});

		ed.addCommand('wusm_columns_cmd', function() {
			var divhtml = "<div class='half-width'></div><div class='half-width'></div>";
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