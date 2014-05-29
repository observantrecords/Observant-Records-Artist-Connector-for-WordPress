<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/28/14
 * Time: 4:43 PM
 */

class Audio extends Eloquent {

	protected $table;
	protected $primaryKey;
	protected $softDelete = true;
	protected $fillable;
	protected $guarded;

}