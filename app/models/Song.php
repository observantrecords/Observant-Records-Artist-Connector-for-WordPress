<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/26/14
 * Time: 5:58 PM
 */

class Song extends Eloquent {

	protected $table = 'ep4_songs';
	protected $primaryKey = 'song_id';
	protected $softDelete = true;

	public function artist() {
		return $this->belongsTo('Artist', 'artist_id', 'song_primary_artist_id');
	}

} 