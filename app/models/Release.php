<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/26/14
 * Time: 5:31 PM
 */

class Release extends Eloquent {

	protected $table = 'ep4_albums_releases';
	protected $primaryKey = 'release_id';

	public function album() {
		return $this->belongsTo('Album', 'album_id', 'release_album_id');
	}

	public function tracks() {
		return $this->hasMany('Track', 'track_release_id', 'release_id');
	}

	public function format() {
		return $this->hasOne('ReleaseFormat', 'format_id', 'release_format_id');
	}

	public function ecommerce() {
		return $this->hasMany('Ecommerce', 'ecommerce_release_id', 'release_id');
	}

} 