<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Karyawan_model extends CI_Model
{

    function __construct()
    {
         $this->load->library('m_db');
    }
    
    function karyawan_data($where=array(),$order="nip ASC")
    {
		$d=$this->m_db->get_data('karyawan',$where,$order);
		return $d;
	}
	
	function karyawan_info($karyawanID,$output)
	{
		$s=array(
		'karyawan_id'=>$karyawanID,
		);
		$item=$this->m_db->get_row('karyawan',$s,$output);
		return $item;
	}
	
	function karyawan_add($nip,$nama,$jk,$bagian='')
	{
		$s=array(
		'nip'=>$nip,
		);
		if($this->m_db->is_bof('karyawan',$s)==TRUE)
		{
			
			{
			{
				
				$d=array(
				'nip'=>$nip,
				'nama'=>$nama,			
				'jenkel'=>$jk,		
					
				'bagian'=>$bagian,
				);
				if($this->m_db->add_row('karyawan',$d)==TRUE)
				{
					return true;
				}
			}
			
			{
				return false;
			}
		}{
			return false;
		}
	}}
	function karyawan_edit($karyaID,$nip,$nama,$jk,$bagian)
	{
		$s=array(
		'karyawan_id'=>$karyaID,
		);
		$d=array(
		'nip'=>$nip,
		'nama'=>$nama,
		'jenkel'=>$jk,
		'bagian'=>$bagian,
		);
		if($this->m_db->edit_row('karyawan',$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	
}