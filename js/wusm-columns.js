(function() {
	tinymce.create('tinymce.plugins.tinymce_dashicon', {

	/**
	 *
	 */
	init : function(ed, url) {
		ed.addButton('tinymce_dashicon', {
			title : 'Dummy Button',
			cmd   : 'tinymce_dashicon_cmd',
		});

		ed.addCommand('tinymce_dashicon_cmd', function() {
			var shortcode = 'YEA! Dashicons in TinyMCE';
			ed.execCommand( 'mceInsertContent', 0, shortcode );
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
tinymce.PluginManager.add( 'tinymce_dashicon', tinymce.plugins.tinymce_dashicon );
})();