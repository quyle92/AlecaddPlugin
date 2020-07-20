<div class="wrap">
	<h1>Alecadd Plugin </h1>
	<?php settings_errors();//print out success or error messages after updating custom field?>

	<ul class="nav-tabs">
		<li class="active"><a href="#tab-1">Manage Settings</a></li>
		<li><a href="#tab-2">Updates</a></li>
		<li><a href="#tab-3">About</a></li>
	</ul>
	
	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">
			<form method="post" action="options.php"><!-- option.php is where to handle all save, update, delete action of custom field -->
				<?php
					settings_fields( "alecadd_options_group" );// same as option_name at setSettings() in Admin.php
					do_settings_sections( 'alecadd_plugin' );// same as page in setSections() in Admin.php
					submit_button();
				?>
			</form>
		</div>
		
		<div id="tab-2" class="tab-pane">
			<h3>Updates</h3>
		</div>

		<div id="tab-3" class="tab-pane">
			<h3>About</h3>
		</div>
	</div>
</div>