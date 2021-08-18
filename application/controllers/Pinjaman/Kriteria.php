<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kriteria extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
		$this->load->model('kriteria_model','mod_kriteria');
		$this->load->model('pinjaman_model','mod_pinjaman');
    }
    
    function index()
    {        
        $meta['judul']="Kriteria Pinjaman";
        $this->load->view('tema/header',$meta);
        $d['pinjaman']=$this->mod_pinjaman->pinjaman_data();
        $this->load->view('/pinjaman/matriks/kriteriacontainer',$d);
        $this->load->view('tema/footer');
    }
    
    function gethtml()
    {
    	$id=$this->input->get('pinjaman');
		$output=array();
        $dKriteria=$this->mod_kriteria->kriteria_data();
		foreach($dKriteria as $rK)
		{
			$output[$rK->kriteria_id]=$rK->nama_kriteria;
		}		
    	$d['arr']=$output;
    	$d['pinjamanid']=$id;
    	$this->load->view('/pinjaman/matriks/matrikutama',$d);
	}
	
	function getsubcontainer()
	{
		$id=$this->input->get('pinjamanid');
		$d['kriteria']=$this->mod_kriteria->kriteria_data();
		$d['pinjamanid']=$id;
		$this->load->view('/pinjaman/matriks/subcontainer',$d);
	}
	
	function getsub()
	{		
		$pinjaman=$this->input->get('pinjaman');
		$id=$this->input->get('kriteria');
    	$namaKriteria=$this->mod_kriteria->kriteria_info($id,'nama_kriteria');
    	$dSub=$this->mod_kriteria->subkriteria_child($id,'nilai_id ASC');
    	$output=array();
    	if(!empty($dSub))
    	{					
		foreach($dSub as $rK)
		{
			$nama=field_value('nilai_kategori','nilai_id',$rK->nilai_id,'nama_nilai');
			$output[$rK->subkriteria_id]=$nama;
		}
		}
    	$d['arr']=$output;
    	$d['kriteriaid']=$id;
    	$d['pinjamanid']=$pinjaman;
    	$d['namakriteria']=$namaKriteria;
    	$this->load->view('/pinjaman/matriks/matriksub',$d);
	}
    
    function add()
    {
		$this->form_validation->set_rules('nama','Nama Kriteria','required');
		if($this->form_validation->run()==TRUE)
		{
			$nama=$this->input->post('nama');
			if($this->mod_kriteria->kriteria_add($nama)==TRUE)
			{
				redirect(base_url().'/ahp/kriteria');
			}else{
				redirect(base_url().'/ahp/kriteria/add');
			}
		}else{
			$meta['judul']="Tambah Kriteria Utama";
        	$this->load->view('tema/header',$meta);
        	$this->load->view('/ahp/kriteria/kriteriaadd');
        	$this->load->view('tema/footer');
		}
	}
    
    function updatedata()
    {
		foreach($_POST as $k=>$v)
		{
			$s=array(
			'kriteria_id'=>$k,
			);
			$d=array(
			'nama_kriteria'=>$v,
			);
			$this->m_db->edit_row('kriteria',$d,$s);
		}
		redirect(base_url('/ahp/kriteria'));
	}
	
	function deletedata()
	{
		$s=array(
		'kriteria_id'=>$this->input->get('id'),
		);		
		$this->m_db->delete_row('kriteria',$s);
		redirect(base_url('/ahp/kriteria'));
	}
    
    function updateutama()
    {
    	$error=FALSE;
    	$pinjamanid=$this->input->post('pinjamanid');
    	if(!empty($pinjamanid))
    	{
    	$msg="";
    	$s=array(
    	'kriteria_nilai_id !='=>''
    	);
    	$this->m_db->delete_row('kriteria_nilai',$s);
    	    	
    	$cr=$this->input->post('crvalue');
    	if($cr > 0.1)
    	{
    		$msg="Gagal diupdate karena nilai CR kurang dari 0.1";
			$error=TRUE;
		}else{
			foreach($_POST as $k=>$v)
			{
				if($k!="crvalue" && $k!="pinjamanid")
				{									
				foreach($v as $x=>$x2)
				{
					$d=array(
					'pinjaman_id'=>$pinjamanid,
					'kriteria_id_dari'=>$k,
					'kriteria_id_tujuan'=>$x,
					'nilai'=>$x2,
					);
					$this->m_db->add_row('kriteria_nilai',$d);
				}
				}
			}
			$msg="Berhasil update nilai kriteria";
			$error=FALSE;
		}
    			
    	
    	if($error==FALSE)
    	{			
			echo json_encode(array('status'=>'ok','msg'=>$msg));
		}else{
			echo json_encode(array('status'=>'no','msg'=>$msg));
		}
		
		}else{
			$msg="Gagal mengubah nilai kriteria";
			echo json_encode(array('status'=>'no','msg'=>$msg));
		}
		
	}
	
	function updatesub()
    {
    	$error=FALSE;
    	$pinjamanid=$this->input->post('pinjamanid');
    	$kriteriaid=$this->input->post('kriteriaid');
    	if(!empty($pinjamanid) && !empty($kriteriaid))
    	{
			
		
    	$msg="";
    	$s=array(
    	'pinjaman_id'=>$pinjamanid,
    	'kriteria_id'=>$kriteriaid,
    	);
    	$this->m_db->delete_row('subkriteria_nilai',$s);
    	    	
    	$cr=$this->input->post('crvalue');
    	if($cr > 0.1)
    	{
    		$msg="Gagal diupdate karena nilai CR kurang dari 0.1";
			$error=TRUE;
		}else{
			foreach($_POST as $k=>$v)
			{
				if($k!="crvalue" && $k!="pinjamanid" && $k!="kriteriaid")
				{									
				foreach($v as $x=>$x2)
				{
					$d=array(
					'pinjaman_id'=>$pinjamanid,
					'kriteria_id'=>$kriteriaid,
					'subkriteria_id_dari'=>$k,
					'subkriteria_id_tujuan'=>$x,
					'nilai'=>$x2,
					);
					$this->m_db->add_row('subkriteria_nilai',$d);
				}
				}
			}
			$msg="Berhasil update nilai subkriteria";
			$error=FALSE;
		}
    			
    	
    	if($error==FALSE)
    	{			
			echo json_encode(array('status'=>'ok','msg'=>$msg));
		}else{
			echo json_encode(array('status'=>'no','msg'=>$msg));
		}
		
		}else{
			$msg="Gagal mengubah nilai subkriteria";
			echo json_encode(array('status'=>'no','msg'=>$msg));
		}
		
	}
	
	function updatesubprioritas()
	{
		$pinjamanid=$this->input->post('pinjamanid');
    	$kriteriaid=$this->input->post('kriteriaid');
    	$prio=$this->input->post('prio');
    	if(!empty($prio))
    	{

			foreach($prio as $rk=>$rv)
			{
				$s=array(
				'pinjaman_id'=>$pinjamanid,
				'subkriteria_id'=>$rk,
				);
				if($this->m_db->is_bof('subkriteria_hasil',$s)==TRUE)
				{
					$d=array(
					'pinjaman_id'=>$pinjamanid,
					'subkriteria_id'=>$rk,
					'prioritas'=>$rv,
					);
					$this->m_db->add_row('subkriteria_hasil',$d);
				}else{
					$d=array(					
					'prioritas'=>$rv,
					);
					$this->m_db->edit_row('subkriteria_hasil',$d,$s);
				}
			}
			echo json_encode('ok');
		}else{
			echo json_encode('no');
		}
	}

}
