<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
		$this->load->helper('html');
		$this->load->model('Pinjaman_model','mod_bea');
		$this->load->model('kriteria_model','mod_kriteria');
		$this->load->model('Karyawan_model','mod_karyawan');
    }
    
    function penerimapinjaman()
    {
		$id=$this->input->get('id');
		$nama=$this->mod_bea->pinjaman_info($id,'judul');
		$meta['judul']="Daftar Penerima : ".$nama;
        $this->load->view('tema/cetak/header',$meta);
        $d['data']=$this->mod_bea->pinjaman_data(array('pinjaman_id'=>$id));
        $this->load->view('laporan/penerimapinjamanview',$d);
        $this->load->view('tema/cetak/footer');
	}
    
}