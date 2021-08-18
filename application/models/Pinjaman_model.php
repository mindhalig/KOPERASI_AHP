<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pinjaman_model extends CI_Model
{	
    function __construct()
    {
         $this->load->library('m_db');
    }
    
    function pinjaman_data($where=array(),$order="judul ASC")
    {
		$d=$this->m_db->get_data('pinjaman',$where,$order);
		return $d;
	}
	
	function pinjaman_info($beaID,$output)
	{
		$s=array(
		'pinjaman_id'=>$beaID,
		);
		$item=$this->m_db->get_row('pinjaman',$s,$output);
		return $item;
	}
	
	function pinjaman_add($judul,$kuota)
	{
		$d=array(
		'judul'=>$judul,
		'kuota'=>$kuota,
		);
		if($this->m_db->add_row('pinjaman',$d)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function pinjaman_edit($beaID,$judul,$kuota)
	{
		$s=array(
		'pinjaman_id'=>$beaID,
		);
		$d=array(
		'judul'=>$judul,
		'kuota'=>$kuota,
		);
		if($this->m_db->edit_row('pinjaman',$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function pinjaman_delete($beaID)
	{
		$s=array(
		'pinjaman_id'=>$beaID,
		);		
		if($this->m_db->delete_row('pinjaman',$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function pinjaman_open($beaID)
	{
		$s=array(
		'pinjaman_id'=>$beaID,
		);
		$d=array(		
		'status'=>'buka',
		);
		if($this->m_db->edit_row('pinjaman',$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	function pinjaman_close($beaID)
	{
		$s=array(
		'pinjaman_id'=>$beaID,
		);
		$d=array(		
		'status'=>'tutup',
		);
		if($this->m_db->edit_row('pinjaman',$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function peserta_add($karyawanID,$pinjamanID,$kriteriaData=array())
	{
		
        if($this->m_db->is_bof('karyawan')==FALSE)
        {
        	if(!empty($kriteriaData))
        	{
				$d=array(
				'pinjaman_id'=>$pinjamanID,
				'karyawan_id'=>$karyawanID,
				);
				if($this->m_db->add_row('peserta',$d)==TRUE)
				{
					$pesertaID=$this->m_db->last_insert_id();
					foreach($kriteriaData as $rK=>$rV)
					{
						$d2=array(
						'peserta_id'=>$pesertaID,
						'kriteria_id'=>$rK,
						'nilai_id'=>$rV,
						);
						$this->m_db->add_row('peserta_nilai',$d2);
					}
					return true;
				}else{
					//echo "GAGAL TAMBAH PESERTA";
					return false;
				}
			}else{
				//echo "DATA KRITERIA TAK ADA";
				return false;
			}		
		}else{
			//echo "SISWA TIDAK ADA";
			return false;
		}
	}
	
	function peserta_edit($pesertaID,$karyawanID,$pinjamanID,$kriteriaData=array())
	{
		
        if($this->m_db->is_bof('karyawan')==FALSE)
        {
        	$speserta=array(
        	'peserta_id'=>$pesertaID,
        	);
        	
        	if($this->m_db->is_bof('peserta',$speserta)==FALSE)
        	{
							
        	if(!empty($kriteriaData))
        	{
				$d=array(
				'pinjaman_id'=>$pinjamanID,
				'karyawan_id'=>$karyawanID,
				);
				if($this->m_db->edit_row('peserta',$d,$speserta)==TRUE)
				{
					//$pesertaID=$this->m_db->last_insert_id();
					foreach($kriteriaData as $rK=>$rV)
					{
						$s2=array(
						'peserta_id'=>$pesertaID,
						'kriteria_id'=>$rK,
						);
						if($this->m_db->is_bof('peserta_nilai',$s2)==TRUE)
						{
							$d2=array(
							'peserta_id'=>$pesertaID,
							'kriteria_id'=>$rK,
							'nilai_id'=>$rV,
							);
							$this->m_db->add_row('peserta_nilai',$d2);
						}else{
							$d2=array(												
							'nilai_id'=>$rV,
							);
							$this->m_db->edit_row('peserta_nilai',$d2,$s2);
						}						
					}
					return true;
				}else{
					//echo "GAGAL UBAH PESERTA";
					return false;
				}
			}else{
				//echo "DATA KRITERIA TAK ADA";
				return false;
			}	
			
			}else{
				return false;
			}	
		}else{
			//echo "SISWA TIDAK ADA";
			return false;
		}
	}
	
	function peserta_delete($pesertaID,$kelas,$jurusan,$wali)
	{
		$siswaID=field_value('peserta','peserta_id',$pesertaID,'karyawan_id');
		
        if($this->m_db->is_bof('karyawan')==FALSE)
        {
        	$speserta=array(
        	'peserta_id'=>$pesertaID,
        	);
        	
        	if($this->m_db->is_bof('peserta',$speserta)==FALSE)
        	{
        		if($this->m_db->delete_row('peserta',$speserta)==TRUE)
        		{
        			$this->m_db->delete_row('peserta_nilai',$speserta);
					return true;
				}else{
					return false;
				}
        		
        	}else{
				return false;
			}
        }else{
			return false;
		}
	}
	
	function peserta_delete_admin($pesertaID)
	{
		$siswaID=field_value('peserta','peserta_id',$pesertaID,'karyawan_id');		
    	$speserta=array(
    	'peserta_id'=>$pesertaID,
    	);
    	
    	if($this->m_db->is_bof('peserta',$speserta)==FALSE)
    	{
    		if($this->m_db->delete_row('peserta',$speserta)==TRUE)
    		{
    			$this->m_db->delete_row('peserta_nilai',$speserta);
				return true;
			}else{
				return false;
			}
    		
    	}else{
			return false;
		}
	}
	
	function proseshitung($pinjamanID)
	{
		$s=array(
		'pinjaman_id'=>$pinjamanID,
		);
		$dKriteria=$this->mod_kriteria->kriteria_data();
		if($this->m_db->is_bof('pinjaman',$s)==FALSE)
		{
			$dPeserta=$this->m_db->get_data('peserta',$s);
			if(!empty($dPeserta))
			{
				
				foreach($dPeserta as $rPeserta)
				{
					$pesertaID=$rPeserta->peserta_id;
					$karyawanID=$rPeserta->karyawan_id;
					$NIP=field_value('karyawan','karyawan_id',$karyawanID,'nip');
					$nama=field_value('karyawan','karyawan_id',$karyawanID,'nama');			
					if(!empty($dKriteria))
					{
						$total=0;
						foreach($dKriteria as $rKriteria)
						{						
							$kriteriaid=$rKriteria->kriteria_id;
							$subkriteria=peserta_nilai($pesertaID,$kriteriaid);
							$nilaiID=field_value('subkriteria','subkriteria_id',$subkriteria,'nilai_id');
							$nilai=field_value('nilai_kategori','nilai_id',$nilaiID,'nama_nilai');
							$prioritas=ambil_prioritas($pinjamanID,$subkriteria);
							$total+=$prioritas;							
						}						
					}
					
					$shasil=array(
					'peserta_id'=>$pesertaID,
					'pinjaman_id'=>$pinjamanID,
					);
					$dhasil=array(
					'total'=>$total,
					);
					$this->m_db->edit_row('peserta',$dhasil,$shasil);
					$kuota=$this->pinjaman_info($pinjamanID,'kuota');
			
					$dPH=$this->m_db->get_data('peserta',$s,'total DESC');
					$rank=0;
					foreach($dPH as $rPH)
					{
						$rank+=1;
						$d=array();
						if($rank <= $kuota)
						{
							$d=array(
							'status'=>'lolos',
							);
						}else{
							$d=array(
							'status'=>'tidak lolos',
							);
						}
						$this->m_db->edit_row('peserta',$d,array('peserta_id'=>$rPH->peserta_id));
					}
					
					return true;
				}								
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	}
}