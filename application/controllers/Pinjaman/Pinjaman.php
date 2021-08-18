<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pinjaman extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
		$this->load->model('Pinjaman_model','mod_bea');
		$this->load->model('kriteria_model','mod_kriteria');
    }
    
    function index()
    {
        $meta['judul']="Semua Daftar Pinjaman";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->mod_bea->pinjaman_data();
        $this->load->view('/pinjaman/pinjaman/pinjamanview',$d);
        $this->load->view('tema/footer');
    }
    
    function add()
    {
		$this->form_validation->set_rules('judul','Judul Pinjaman','required');
		$this->form_validation->set_rules('kuota','Kuota Pinjaman','required');
		if($this->form_validation->run()==TRUE)
		{
			$judul=$this->input->post('judul');
			$kuota=$this->input->post('kuota');
			
			if($this->mod_bea->pinjaman_add($judul,$kuota)==TRUE)
			{
				set_header_message('success','Tambah Pinjaman','Berhasil menambah pinjaman');
				redirect(base_url().'/pinjaman/Pinjaman');
			}else{
				set_header_message('danger','Tambah Pinjaman','Gagal menambah pinjaman');
				redirect(base_url().'/pinjaman/pinjaman/add');
			}
		}else{
			$meta['judul']="Tambah Pinjaman";
	        $this->load->view('tema/header',$meta);
	        $this->load->view('/pinjaman/pinjaman/pinjamanadd');
	        $this->load->view('tema/footer');
		}
	}
        
	function edit()
    {
		$this->form_validation->set_rules('pinjamanid','ID pinjaman','required');
		$this->form_validation->set_rules('judul','Judul pinjaman','required');
		$this->form_validation->set_rules('kuota','Kuota pinjamana','required');
		if($this->form_validation->run()==TRUE)
		{
			$pinjamanid=$this->input->post('pinjamanid');
			$judul=$this->input->post('judul');
			$kuota=$this->input->post('kuota');
			
			if($this->mod_bea->pinjaman_edit($pinjamanid,$judul,$kuota)==TRUE)
			{
				set_header_message('success','Ubah Pinjaman','Berhasil mengubah pinjaman');
				redirect(base_url().'/pinjaman/pinjaman');
			}else{
				set_header_message('danger','Ubah Pinjaman','Gagal mengubah pinjaman');
				redirect(base_url().'/pinjaman/pinjaman');
			}
		}else{
			$id=$this->input->get('id');
			$meta['judul']="Ubah Pinjaman";
	        $this->load->view('tema/header',$meta);
	        $d['data']=$this->mod_bea->pinjaman_data(array('pinjaman_id'=>$id));
	        $this->load->view('/pinjaman/pinjaman/pinjamanedit',$d);
	        $this->load->view('tema/footer');
		}
	}
	
	function delete()
	{
		$id=$this->input->get('id');
		if($this->mod_bea->pinjaman_delete($id)==TRUE)
		{
			set_header_message('success','Hapus Pinjaman','Berhasil menghapus Pinjaman');
			redirect(base_url().'/pinjaman/pinjaman');
		}else{
			set_header_message('danger','Hapus Pinjaman','Gagal menghapus Pinjaman');
			redirect(base_url().'/pinjaman/pinjaman');
		}
	}
	
	function proses()
	{
		$id=$this->input->get('id');
		$nama=$this->mod_bea->pinjaman_info($id,'judul');
		$meta['judul']="Daftar Penerima: ".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->mod_bea->pinjaman_data(array('pinjaman_id'=>$id));
        $this->load->view('/pinjaman/pinjaman/prosesview',$d);
        $this->load->view('tema/footer');
	}
	
	function proseshitung()
	{
		$id=$this->input->get('id');
		$this->mod_bea->proseshitung($id);		
		if($this->mod_bea->proseshitung($id)==TRUE)
		{
			
			echo json_encode(array('status'=>'ok'));
		}else{
		
			echo json_encode(array('status'=>'no'));
		}		
	}
    
}
