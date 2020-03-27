<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah extends MY_Controller
{

	public function __construct()
	{
		if (!$this->session->userdata('role')) {
			redirect('auth');
		}
		if ($this->session->userdata('role')) {
			$this->db->select('*');
			$this->db->from('user_access');
			$this->db->join('user_submenu', 'user_access.id_menu=user_submenu.id_menu', 'inner');
			$this->db->where('user_access.id_role', $this->session->userdata('role'));
			$this->db->where('user_submenu.url', 'sekolah');
			$access = $this->db->get()->result();
			if (!$access) {
				redirect('page');
			}
		}
		parent::__construct();
		$this->load->model('sekolah_model', 'model');
	}
	public function index()
	{
		$data = [
			'judul' => 'Profil Sekolah',
			'jurusan' => $this->db->get('jurusan')->result()
		];
		$this->load->view('index', $data);
	}
	public function getProfile()
	{
		$data = $this->model->getProfile();
		echo json_encode($data);
	}
	public function getMedsos()
	{
		$data = $this->model->getMedsos();
		echo json_encode($data);
	}
}
