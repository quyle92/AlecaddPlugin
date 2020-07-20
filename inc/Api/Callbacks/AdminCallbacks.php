<?php
namespace Inc\Api\Callbacks;
use  \Inc\Base\BaseController;

class AdminCallbacks extends BaseController{

	public function adminDashboard(){
		return require_once ($this->plugin_path . 'templates/admin.php');
	}

	public function adminCpt()
	{
		return require_once( "$this->plugin_path/templates/cpt.php" );
	}

	public function adminTaxonomy()
	{
		return require_once( "$this->plugin_path/templates/taxonomy.php" );
	}

	public function adminWidget()
	{
		return require_once( "$this->plugin_path/templates/widget.php" );
	}

	public function alecaddOptionsGroup( $input ) //this one process the input value from option_name
	{
		$output = sanitize_text_field( $input );
		$output = str_replace('@', "", $output ); 
		return $output;
	}

	public function alecaddAdminSection()
	{
		echo 'Check this nice section!';
	}

	public function alecaddTextExample()
	{
		$value =  esc_attr( get_option( 'text_example' ) );
		echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '"';
	}

	public function alecaddFirstName()
	{
		$value =  esc_attr( get_option( 'first_name' ) );
		echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '"';
	}
}