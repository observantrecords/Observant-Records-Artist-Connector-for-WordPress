<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/26/14
 * Time: 5:26 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model {

	protected $table = 'ep4_albums';
	protected $primaryKey = 'album_id';
	protected $softDelete = true;
	protected $fillable = array(
		'album_artist_id',
		'album_primary_release_id',
		'album_format_id',
		'album_ctype_locale',
		'album_title',
		'album_alias',
		'album_image',
		'album_music_description',
		'album_release_date',
		'album_is_visible',
	);
	protected $guarded = array(
		'artist_id',
	);

	public function artist() {
		return $this->belongsTo('ObservantRecords\WordPress\Plugins\ArtistConnector\Eloquent\Models\Artist', 'album_artist_id', 'artist_id');
	}

	public function releases() {
		return $this->hasMany('ObservantRecords\WordPress\Plugins\ArtistConnector\Eloquent\Models\Release', 'release_album_id', 'album_id');
	}

	public function primary_release() {
		return $this->hasOne('ObservantRecords\WordPress\Plugins\ArtistConnector\Eloquent\Models\Release', 'release_id', 'album_primary_release_id');
	}

	public function format() {
		return $this->hasOne('ObservantRecords\WordPress\Plugins\ArtistConnector\Eloquent\Models\AlbumFormat', 'format_id', 'album_format_id');
	}

	public function scopeEponymous4($query) {
		return $query->where('album_artist_id', '=', 1);
	}

	public function scopeEmptyEnsemble($query) {
		return $query->where('album_artist_id', '=', 2);
	}
}