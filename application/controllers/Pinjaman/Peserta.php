<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Peserta extends CI_Controller
{
	
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
		$this->load->model('Pinjaman_model','mod_bea');
		$this->load->model('Karyawan_model','mod_karyawan');
		$this->load->model('kriteria_model','mod_kriteria');
		$s=array(
		'user_id'=>user_info('user_id'),
		);
		
    }
    
    function index()
    {
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
    	
    	$id=$this->input->get('id');
    	$s="";
    	$nama="";
    	if(!empty($id))
    	{
			$s=" Where pinjaman.pinjaman_id='$id'";
			$nama=" ".field_value('pinjaman','pinjaman_id',$id,'judul');
		}
    	$sql="SELECT peserta.peserta_id,karyawan.karyawan_id,karyawan.nip,karyawan.nama,karyawan.bagian,pinjaman.judul,peserta.status FROM (peserta LEFT JOIN karyawan ON peserta.karyawan_id = karyawan.karyawan_id) LEFT JOIN pinjaman ON peserta.pinjaman_id = pinjaman.pinjaman_id".$s;
        $meta['judul']="Daftar Peserta Pinjaman".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_query_data($sql);
        $d['link']=$ref;
       
        $this->load->view('/pinjaman/peserta/pesertaview',$d);
        $this->load->view('tema/footer');
    }
    
    function getpeserta($order="nama ASC")
    {
		$pinjaman=$this->input->get('pinjaman');
		if(!empty($pinjaman))
		{
			$s=array(
			'pinjaman_id'=>$pinjaman,
			);
			$d=$this->m_db->get_data('peserta',$s);
			if(!empty($d))
			{
				$listKaryawan="";
				foreach($d as $r)
				{
					$listKaryawan.=$r->karyawan_id.",";
				}
				$listKaryawan=substr($listKaryawan,0,-1);
				
				$sql="Select * from karyawan Where karyawan_id NOT IN ($listKaryawan)";
				$o=$this->m_db->get_query_data($sql);
				echo json_encode($o);
			}else{
				$d=$this->mod_karyawan->karyawan_data();
				echo json_encode($d);
			}
		}else{
			echo json_encode(array());
		}
	}
	function add()
    {
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
		$this->form_validation->set_rules('karyawanid','ID karyawan','required');
		$this->form_validation->set_rules('pinjamanid','ID Pinjaman','required');
		if($this->form_validation->run()==TRUE)
		{			
			$karyawan=$this->input->post('karyawanid');
			$pinjaman=$this->input->post('pinjamanid');
			$kriteria=$this->input->post('kriteria');
			
			
			
			if($this->mod_bea->peserta_add($karyawan,$pinjaman,$kriteria)==TRUE)
			{
				set_header_message('success','Tambah Peserta','Berhasil menambah peserta pinjaman koperasi');
				redirect(base_url('/pinjaman/peserta'.$ref));
			}else{
				set_header_message('danger','Tambah Peserta','Gagal menambah peserta pinjaman koperasi');
				redirect(base_url('/pinjaman/peserta/add'.$ref));
			}
		}else{
			$meta['judul']="Tambah Peserta";
	        $this->load->view('tema/header',$meta);
	        $d['link']=$ref;
	        $d['pinjaman']=$this->mod_bea->pinjaman_data();
	        $d['pinjamanid']=$bearef;
	        
	        $d['karyawan']=$this->mod_karyawan->karyawan_data();
	        $d['kriteria']=$this->mod_kriteria->kriteria_data();
	        $this->load->view('/pinjaman/peserta/pesertaadd',$d);
	        $this->load->view('tema/footer');
		}
	}
	
	function edit()
	{
		$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
		$this->form_validation->set_rules('pesertaid','ID Siswa','required');
		$this->form_validation->set_rules('karyawanid','ID Karyawan','required');
		$this->form_validation->set_rules('pinjamanid','ID Pinjaman','required');
		if($this->form_validation->run()==TRUE)
		{			
			$pesertaid=$this->input->post('pesertaid');
			$karyawan=$this->input->post('karyawanid');
			$pinjaman=$this->input->post('pinjamanid');
			$kriteria=$this->input->post('kriteria');			
			
			if($this->mod_bea->peserta_edit($pesertaid,$karyawan,$pinjaman,$kriteria)==TRUE)
			{
				set_header_message('success','Ubah Peserta','Berhasil mengubah peserta pinjaman koperasi');
				redirect(base_url('/pinjaman/peserta'.$ref));
			}else{
				set_header_message('danger','Ubah Peserta','Gagal mengubah peserta pinjaman koperasi');
				redirect(base_url('/pinjaman/peserta'.$ref));
			}
			
		}else{
			$id=$this->input->get('peserta');
			$karyawanid=field_value('peserta','peserta_id',$id,'karyawan_id');
			
	        if($this->m_db->is_bof('karyawan')==FALSE)
	        {
				$meta['judul']="Ubah Peserta";
		        $this->load->view('tema/header',$meta);
		        $d['link']=$ref;
		        $d['pinjaman']=$this->mod_bea->pinjaman_data();
		        $d['pinjamanid']=$bearef;
		       
		        $d['karyawan']=$this->mod_karyawan->karyawan_data();
		        $d['kriteria']=$this->mod_kriteria->kriteria_data();
		        $d['data']=$this->m_db->get_data('peserta',array('peserta_id'=>$id));
		        $this->load->view('/pinjaman/peserta/pesertaedit',$d);
		        $this->load->view('tema/footer');
		    }else{
				redirect(base_url('/pinjaman/peserta'));
			}
		}
	}
	
    
	function delete()
	{
		$id=$this->input->get('peserta');
		if($this->mod_bea->peserta_delete_admin($id)==TRUE)
		{
			set_header_message('success','Hapus Peserta','Berhasil menghapus peserta');
			redirect(base_url('/pinjaman/peserta'));
		}else{
			set_header_message('danger','Hapus Peserta','Gagal menghapus peserta');
			redirect(base_url('/pinjaman/peserta'));
		}
	}
    
}
