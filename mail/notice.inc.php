<?php
/**
 * unit-notice:/mail/notice.inc.php
 *
 * @created   2016-11-30
 * @version   1.0
 * @package   unit-notice
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright 2016 (C) Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2019-03-17
 */
namespace OP;

/** Print table of backtrace.
 *
 * @param array $backtraces
 */
function _backtrace($backtraces){
	print '<table>';
	foreach( $backtraces as $backtrace ){
		//	...
		$file = $backtrace['file']     ?? null;
		$line = $backtrace['line']     ?? null;
		$func = $backtrace['function'] ?? null;
		$class= $backtrace['class']    ?? null;
		$type = $backtrace['type']     ?? null;
		$args = $backtrace['args']     ?? null;

		/*
		//	...
		$file = CompressPath($file);
		*/

		//	...
		if( isset($type) ){
			$func = "{$class}{$type}{$func}";
		}

		//	...
		$args = _args($args);

		//	...
		print "<tr><td> {$file} </td><td> {$line} </td><td> {$func}($args) </td></tr>\n";
	}
	print '</table>';
}

/** Serialize arguments.
 *
 * @param  array  $args
 * @return string
 */
function _args($args){
	$join = [];
	if( $args ){
		foreach($args as $arg){
			$join[] = _arg($arg);
		}
	}
	return join(', ', $join);
}

/** Adjust argument value from type.
 *
 * @param  mixed  $arg
 * @return string
 */
function _arg($arg){
	switch( $type = gettype($arg) ){
		case 'boolean':
			$result = $arg ? 'true': 'false';
			break;

		case 'double':
			$result = $arg;
			break;

		case 'string':
			$result = '"'.Encode($arg).'"';
			break;

		case 'array':
		//	$result = '['._args($arg).']';
			$result = 'array';
			break;

		case 'object':
			$result = 'object';

			/*
			$name = get_class($arg);
			$prop  = [];
			foreach( $arg as $key => $val ){
				$prop[] = $key.'->'._arg($val);
			}
			$result = "{$name}{".join(', ',$prop)."}";
			*/

			break;

		default:
			$result = $type;
	}
	return $result;
}
