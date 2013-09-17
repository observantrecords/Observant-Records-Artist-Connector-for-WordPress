<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ecommerce
 *
 * @author gbueno
 */
class Ecommerce extends CI_Controller
{
	public function __construct() {
		parent::__construct();

		$this->load->library('ObservantView');
		$this->load->library('VmSession');
		$this->load->helper('Model');
		$this->load->model('Obr_Ecommerce');
		$this->load->model('Obr_Release');
		$this->load->model('Obr_Track');
		$this->load->model('Obr_Album');
		$this->load->model('Obr_Artist');
	}
	
	public function index() {
		
	}
	
	public function browse() {
		
	}
	
	public function view($ecommerce_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsEcommerce = $this->Obr_Ecommerce->get($ecommerce_id);
			$rsRelease = $this->Obr_Release->with('album')->get($rsEcommerce->ecommerce_release_id);
			$rsArtist = $this->Obr_Artist->get($rsRelease->album->album_artist_id);
			$this->vmview->format_section_head($rsRelease->album->album_title, $rsEcommerce->ecommerce_label);
			$this->mysmarty->assign('rsRelease', $rsRelease);
			$this->mysmarty->assign('rsEcommerce', $rsEcommerce);
			$this->mysmarty->assign('rsArtist', $rsArtist);
			$this->mysmarty->assign('track_id', $ecommerce_id);
		}

		$this->vmview->display('admin/obr_ecommerce_view.tpl');
	}
	
	public function add($release_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			if (empty($this->vmview->section_head)) {
				$rsRelease = $this->Obr_Release->with('album')->get($release_id);
				$this->vmview->format_section_head($rsRelease->album->album_title, 'Create a track');
				$this->mysmarty->assign('rsRelease', $rsRelease);
			}
			
			$rsLabels = $this->Obr_Ecommerce->retrieve_all_labels();
			$labels = array();
			foreach ($rsLabels as $rsLabel) {
				$labels[] = $rsLabel->ecommerce_label;
			}
			
			$this->mysmarty->assign('labels', json_encode($labels));
			
			$this->mysmarty->assign('ecommerce_release_id', $release_id);
		}

		$this->vmview->display('admin/obr_ecommerce_edit.tpl');
	}
	
	public function edit($ecommerce_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsEcommerce = $this->Obr_Ecommerce->get($ecommerce_id);
			$rsRelease = $this->Obr_Release->with('album')->get($rsEcommerce->ecommerce_release_id);
			$this->vmview->format_section_head($rsRelease->album->album_title, $rsEcommerce->ecommerce_label);
			$this->mysmarty->assign('rsEcommerce', $rsEcommerce);
			$this->mysmarty->assign('ecommerce_id', $ecommerce_id);
		}

		$this->add($rsEcommerce->ecommerce_release_id);
	}
	
	public function delete($ecommerce_id) {
		
	}
	
	public function create() {
		
	}
	
	public function update($ecommerce_id) {
		
	}
	
	public function remove($ecommerce_id) {
		
	}
}

?>
