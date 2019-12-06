<?php
/**
 * unit-notice:/function/mail.php
 *
 * @created   2019-12-05
 * @version   1.0
 * @package   unit-notice
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2019-12-05
 */
namespace OP\UNIT\NOTICE\FUNCTIONS;

/** use
 *
 */
use OP\Env;
use function OP\Json;
use function OP\Decode;
use function OP\CompressPath;

/** Send email of notice.
 *
 * @param array $notice
 */
function Mail( $notice )
{
	static $to, $from, $file_path;

	//	...
	if( !$to ){

		//	...
		if(!$to = Env::Get(Env::_ADMIN_MAIL_) ){
			echo '<p class="error">Has not been set admin mail address.</p>'.PHP_EOL;
			return;
		}

		//	...
		if(!$from = Env::Get(Env::_MAIL_FROM_) ){
			$from = $to;
		}

		//	...
		$file_path = __DIR__.'/../mail/notice.phtml';

		//	...
		if( file_exists($file_path) === false ){
			print "<p class=\"error\">Does not file exists. ($file_path)</p>";
			return;
		}
	}

	//	...
	if(!ob_start()){
		echo '<p>"ob_start" was failed. (Notice::Shutdown)</p>'.PHP_EOL;
		return;
	}

	//	...
	include($file_path);

	//	...
	$content = ob_get_clean();

	//	...
	$subject = Decode($notice['message']);

	//	...
	$mail = new \OP\EMail();
	$mail->From($from);
	$mail->To($to);
	$mail->Subject($subject);
	$mail->Content($content, 'text/html');
	$mail->Send();
}