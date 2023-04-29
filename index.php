<?php
/**
 * Plugin Name:       음악캠프 플레이리스트
 * Plugin URI:        https://github.com/chwnam/music-camp-playlist
 * Description:       배철수의 음악캠프 일일 선곡표 수집기 플러그인
 * Version:           0.0.0
 * Requires at least: 5.0.0
 * Requires PHP:      8.0
 * Author:            changwoo
 * Author URI:        https://blog.changwoo.pe.kr/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:
 * Text Domain:       mcpl
 * Domain Path:       /languages
 * CPBN Version:      1.6.1
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

const MCPL_MAIN_FILE = __FILE__;
const MCPL_VERSION   = '0.0.0';
const MCPL_PRIORITY  = 9000;

mcpl();
