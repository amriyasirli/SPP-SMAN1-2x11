<?php 

class Admin extends CI_Controller {

    function __construct(){
        parent::__construct();
        
            // ------Authentication-------
            if(!$this->session->userdata('username')){
                redirect ('Auth/');
            }
            // ----------------------------
        
        }

    public function index ()
    {

        $bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];

        $hari = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];

        $namaBulan = $bulan[date('n')-1];
        $tahun = date('Y');

        $jumlahTot = [0,0];
        $queryTot = $this->db->where('bulan', $namaBulan)->get('tbl_pembayaran')->result();
        foreach ($queryTot as $row ) {
            $jumlahTot [] = preg_replace("/[^0-9]/", "", $row->jumlah);
        }

        // $c = [];
        // // $queryTot = $this->db->get('tbl_pembayaran')->result();
        // for ($i=0; $i < count($bulan); $i++) { 
        //     $queryChart = $this->db->where('bulan', $bulan[$i])->get('tbl_pembayaran');
        //     if($queryChart->num_rows() > 0){
        //         foreach ($queryChart->result() as $r ) {
        //             $a[] = preg_replace("/[^0-9]/", "", $r->jumlah);
        //         }
        //         $b[] = $a;
        //         // $b = array_sum($a);
        //         // array_push($c, $b); 
        //         print_r(json_encode($a));
        //     }
        // }
        // print_r($c);
        // foreach ($c as $row => $value) {    
        //     # code...
        //     array_push($d, $value);
        // }
        // die();

            

        $data = [
            'title' => 'Dashboard',
            'siswa' => $this->db->get('tbl_siswa')->num_rows(),
            'guru' => $this->db->get('tbl_guru')->num_rows(),
            'kelas' => $this->db->get('tbl_kelas')->num_rows(),
            'periode' => $this->db->where('id_periode', 1)->get('tbl_periode')->row(),
            'bulan' => $namaBulan,
            // 'dataChart' => json_encode($d),
            'jumlahTot' => array_sum($jumlahTot),
            'totalBulan' => $this->db->where('bulan', $namaBulan)->join('tbl_siswa', 'tbl_siswa.id_siswa=tbl_pembayaran.id_siswa')->order_by('tanggal_pembayaran', 'DESC')->limit(3)->get('tbl_pembayaran'),
        ];
        $this->load->view('adminTemplate/header');
        $this->load->view('adminTemplate/topbar');
        $this->load->view('adminTemplate/sidebar');
        $this->load->view('admin/index', $data);
        $this->load->view('adminTemplate/footer');
    }
    
    
}
?>