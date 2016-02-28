<?php
/**
 * Created by PhpStorm.
 * User: gbueno
 * Date: 5/28/14
 * Time: 2:59 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Driver;

Driver::init();

/**
 * Class Ecommerce
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Ecommerce
 * @author Greg Bueno
 * @copyright Observant Records
 */
class Ecommerce extends Model {

	/**
	 * @var string The ecommerce table
	 */
	protected $table = 'ep4_ecommerce';
	/**
	 * @var string The ecommerce table primary key
	 */
	protected $primaryKey = 'ecommerce_id';
	/**
	 * @var bool Use soft deletes.
	 */
	protected $softDelete = true;
	/**
	 * @var array Write only to the fields specified.
	 */
	protected $fillable = array(
		'ecommerce_release_id',
		'ecommerce_track_id',
		'ecommerce_label',
		'ecommerce_url',
		'ecommerce_list_order',
	);
	/**
	 * @var array Exclude specified fields from being written.
	 */
	protected $guarded = array(
		'ecomemrce_id',
		'ecommerce_deleted',
	);

	/**
	 * track
	 *
	 * track() establishes a relationship with the Track model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function track() {
		return $this->belongsTo( 'ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Track', 'ecommerce_track_id', 'track_id' );
	}

	/**
	 * release
	 *
	 * release() establishes a relationship with the Release model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function release() {
		return $this->belongsTo( 'ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Release', 'ecommerce_release_id', 'release_id' );
	}
}