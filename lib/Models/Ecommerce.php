<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 6:24 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models;


class Ecommerce extends Base {

	public $_table = 'ep4_ecommerce';
	public $_primary_key = 'ecommerce_id';

	public function __construct() {
		parent::__construct();
	}

} 