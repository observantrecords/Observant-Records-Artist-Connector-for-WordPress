<?php
/**
 * Created by PhpStorm.
 * User: gbueno
 * Date: 5/28/14
 * Time: 2:59 PM
 */

class Ecommerce {

	protected $table;
	protected $primaryKey;
	protected $softDelete = true;
	protected $fillable = array(
		'ecommerce_release_id',
		'ecomemrce_track_id',
		'ecommerce_label',
		'ecommerce_url',
		'ecommerce_list_order',
	);
	protected $guarded = array(
		'ecomemrce_id',
		'ecommerce_deleted',
	);

	public function track() {
		return $this->belongsTo( 'Track', 'ecommerce_track_id', 'track_id' );
	}

	public function release() {
		return $this->belongsTo( 'Release', 'ecommerce_release_id', 'release_id' );
	}
}