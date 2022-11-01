<?php
class Model_pembayaran extends CI_Model 
{
	function display_records($id_siswa, $bulan, $periodeTitle)
	{
		$query=$this->db->select('*')
                        ->join('tbl_siswa', 'tbl_siswa.id_siswa=tbl_pembayaran.id_siswa')
                        // ->join('tbl_guru', 'tbl_guru.id_guru=tbl_pembayaran.id_guru')
                        ->where('tbl_pembayaran.id_siswa', $id_siswa)
                        ->where('tbl_pembayaran.bulan', $bulan)
                        ->where('tbl_pembayaran.periode', $periodeTitle)
                        ->get('tbl_pembayaran');
		return $query->row();
	}

    function saverecords($id_siswa,$id_guru,$jumlah,$tanggal_pembayaran,$bulan)
	{
		$query="INSERT INTO `tbl_pembayaran`( `id_siswa`, `id_guru`, `jumlah`, `bulan`) 
		VALUES ('$id_siswa','$id_guru','$jumlah','$bulan')";
		$this->db->query($query);
	}
}