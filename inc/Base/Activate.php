<?php
namespace Inc\Base;

if ( !class_exists('Activate') )
{
	class Activate 

	{
		public static function activate(){
			flush_rewrite_rules();
		}
	}
}
