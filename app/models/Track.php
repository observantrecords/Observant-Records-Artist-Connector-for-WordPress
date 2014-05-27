<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/26/14
 * Time: 5:38 PM
 */

class Track extends Eloquent {

	protected $table = 'ep4_tracks';
	protected $primaryKey = 'track_id';

	public function release() {
		return $this->belongsTo('Release', 'release_id', 'track_release_id');
	}

	public function song() {
		return $this->hasOne('Song', 'song_id', 'track_song_id');
	}


} 