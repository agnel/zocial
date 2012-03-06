jQuery(document).ready(function($) {
	
	var	bar 					= $('#zocial_main_buttons_bar'),
		clearMessage 			= 0,
		toolTipConf 			= {
						content: {
							attr: 'data-help'
						},
						position: {
							at: 'top center', 
							my: 'bottom center'
						},
						style: {
							classes: 'ui-tooltip-rounded ui-tooltip-shadow ui-tooltip-tipsy'
						}
					};
	
	function tabHandler(e,ui) {
			var id = ui.panel.id;
			bar
				.find("a")
					.show()
					.filter("a[data-hide~="+id+"]")
						.hide()
					.end()
					.filter("a[data-show]")
						.hide()
					.end()
					.filter("a[data-show~="+id+"]")
						.show()
					.end()
				.end();
			$("#"+id).prepend(bar);
	}
	
	$('a[data-help],label[data-help]').qtip(toolTipConf);
	$('#zocial_tabs').tabs({show:tabHandler});
	$('.zocial_button').button();
	$("#zocial_documentation table").addClass("widefat");
	$("#zocial_documentation table tr td:first-child").addClass("parameter");
	$("#zocial_documentation table tr:even").addClass("even");
	
});