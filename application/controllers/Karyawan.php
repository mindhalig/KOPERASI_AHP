<?php

class Karyawan extends CI_Controller
{
	
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
		$this->load->model('Karyawan_model','mod_karyawan');
			
    }
    
    function index()
    {
        $meta['judul']="Semua karyawan";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->mod_karyawan->karyawan_data();
        $this->load->view('/karyawan/karyawanview',$d);
        $this->load->view('tema/footer');
    }
	
    
    function add()
    {
		$this->form_validation->set_rules('nip','NIP','required');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('jk','jk','required');
		$this->form_validation->set_rules('bagian','Bagian','required');
		if($this->form_validation->run()==TRUE)
		{
			$nip=$this->input->post('nip');
			$nama=$this->input->post('nama');	
			$jk=$this->input->post('jk');
			$bagian=$this->input->post('bagian');
			if($this->mod_karyawan->karyawan_add($nip,$nama,$jk,$bagian)==TRUE)
			{
				set_header_message('success','Tambah Karyawan','Berhasil menambah karyawan');
				redirect(base_url('/karyawan'));
			}else{
				set_header_message('danger','Tambah Karyawan','Gagal menambah karyawan');
				redirect(base_url('/karyawan/add'));
			}
			
		}else{
			$meta['judul']="Tambah Karyawan";
	        $this->load->view('tema/header',$meta);	        
	        $this->load->view('/karyawan/karyawanadd');
	        $this->load->view('tema/footer');
		}
	}
   
	
       function edit()
    {
		$this->form_validation->set_rules('karyawanid','Karyawan ID','required');
		$this->form_validation->set_rules('nip','NIP Karyawan','required');
		$this->form_validation->set_rules('nama','Nama Karyawan','required');
	    $this->form_validation->set_rules('bagian','Bagian');
	
		if($this->form_validation->run()==TRUE)
		{
			$karyawanid=$this->input->post('karyawanid');
			$nip=$this->input->post('nip');
			$nama=$this->input->post('nama');
			$jk=$this->input->post('jk');
			$bagian=$this->input->post('bagian');
		
			if($this->mod_karyawan->karyawan_edit($karyawanid,$nip,$nama,$jk,$bagian)==TRUE)
			{
				set_header_message('success','Ubah Karyawan','Berhasil mengubah data karyawan');
				redirect(base_url('/karyawan'));
			}else{
				set_header_message('danger','Ubah Karyawan','Gagal mengubah data karyawan');
				redirect(base_url('/karyawan'));
			}
			
		}else{
			$meta['judul']="Ubah Karyawan";
	        $this->load->view('tema/header',$meta);
	        $id=$this->input->get('id');
	        $s=array(
	        'karyawan_id'=>$id,
	        );
	        $d['data']=$this->mod_karyawan->karyawan_data($s);
	        $this->load->view('/karyawan/karyawanedit',$d);
	        $this->load->view('tema/footer');
		}
	}
	
	function delete()
	{
		$s=array(
		'karyawan_id'=>$this->input->get('id'),
		);		
		$this->m_db->delete_row('karyawan',$s);
		redirect(base_url('/karyawan'));
	}
 
	
    
}
?>