<?php
/** op-unit-notice:/index.php
 *
 * @created   2018-04-13
 * @version   1.0
 * @package   op-unit-notice
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2019-02-22
 */
namespace OP;

//	...
include(__DIR__.'/Notice.class.php');

//	...
register_shutdown_function(function(){
	//	...
	if( Env::isAdmin() ){
		try{
			//	...
			Unit::Load('webpack');

			/* @var $webpack \OP\UNIT\WebPack */
			$webpack = Unit('Webpack');
			$webpack->Js (__DIR__.'/notice');
			$webpack->Css(__DIR__.'/notice');

		}catch( \Exception $e ){
			//	...
			echo $e->getMessage();

			//	...
			echo '<script>';
			include(__DIR__.'/notice.js');
			echo '</script>';

			//	...
			echo '<style>';
			include(__DIR__.'/notice.css');
			echo '</style>';
		};
	};
});
