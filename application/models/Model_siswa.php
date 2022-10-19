<?php class Model_siswa extends CI_Model{ 
     
    //  function autofill($id){
    //      $query= $this->db->select('*')
    //                       ->join('tbl_kelas', 'tbl_kelas.id_kelas=tbl_siswa.id_kelas')
    //                       ->where('tbl_siswa.id_siswa', $id)
    //                       ->get('tbl_siswa');
    //      return $query;
        // return $query->num_rows() == 1
        // ? $query->row()
        // : NULL;
    //  }

     function autofill($id_siswa){
        // $hsl=$this->db->query("SELECT * FROM barang WHERE kode='$kode'");
        $query= $this->db->join('tbl_kelas', 'tbl_kelas.id_kelas=tbl_siswa.id_kelas')
                          ->where('id_siswa', $id_siswa)
                          ->get('tbl_siswa');
        if($query->num_rows()>0){
            foreach ($query->result() as $data) {
                $hasil=array(
                    'id_siswa' => $data->id_siswa,
                    'nama_siswa' => $data->nama_siswa,
                    'nama_kelas' => $data->nama_kelas,
                    );
            }
        }
        return $hasil;
    }
        
 }
 ?>