<?php
	include widget_config_form('title');
	include widget_config_form('forum');
	widget_config_extra_begin();		
	include widget_config_form( 'file', array(
		'name'		=>	'icon',
		'caption'	=>	'icon (12x12)'
		)
	);
	include widget_config_form('css');
	widget_config_extra_end();