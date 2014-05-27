<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array( 'before' => 'auth', 'uses' => 'ArtistController@browse' ) );

// Artist
Route::model('artist', 'Artist');
Route::get('/artist/browse', array( 'as' => 'artist.browse', 'before' => 'auth', 'uses' => 'ArtistController@browse' ) );
Route::get( '/artist/view/{id}', array( 'as' => 'artist.view', 'before' => 'auth', 'uses' => 'ArtistController@view' ) );
Route::get( '/artist/add', array( 'as' => 'artist.add', 'before' => 'auth', 'uses' => 'ArtistController@edit' ) );
Route::get( '/artist/edit/{id}', array( 'as' => 'artist.edit', 'before' => 'auth', 'uses' => 'ArtistController@edit' ) );
Route::get( '/artist/delete/{id}', array( 'as' => 'artist.delete', 'before' => 'auth', 'uses' => 'ArtistController@delete' ) );
Route::post( '/artist/update/{artist?}', array( 'as' => 'artist.update', 'before' => 'auth', 'uses' => 'ArtistController@update' ) );
Route::post( '/artist/remove/{artist}', array( 'as' => 'artist.remove', 'before' => 'auth', 'uses' => 'ArtistController@remove' ) );

// Album
Route::model('album', 'Album');
Route::get('/album/browse/{id}', array( 'as' => 'album.browse', 'before' => 'auth', 'uses' => 'AlbumController@browse' ) );
Route::get( '/album/view/{id}', array( 'as' => 'album.view', 'before' => 'auth', 'uses' => 'AlbumController@view' ) );
Route::get( '/album/add/{id}', array( 'as' => 'album.add', 'before' => 'auth', 'uses' => 'AlbumController@edit' ) );
Route::get( '/album/edit/{id}', array( 'as' => 'album.edit', 'before' => 'auth', 'uses' => 'AlbumController@edit' ) );
Route::get( '/album/delete/{id}', array( 'as' => 'album.delete', 'before' => 'auth', 'uses' => 'AlbumController@delete' ) );
Route::post( '/album/update/{album?}', array( 'as' => 'album.update', 'before' => 'auth', 'uses' => 'AlbumController@update' ) );
Route::post( '/album/remove/{album}', array( 'as' => 'album.remove', 'before' => 'auth', 'uses' => 'AlbumController@remove' ) );

// Release

// Tracks

// Ecommerce

// Songs

// Recordings

// Authentication
Route::get( '/login', 'AuthController@login' );
Route::get( '/logout', 'AuthController@sign_out' );
Route::post( '/signin', 'AuthController@sign_in' );