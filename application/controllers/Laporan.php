<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('Cetak_pdf');
        $this->load->model('Model_pembayaran');

        // ------Authentication-------
        if(!$this->session->userdata('username')){
            redirect ('Auth/blocked');
        }
        
        // ----------------------------
		
    }

    public function index()
    {
        $data = [
            'title' => 'Download File PDF',
            'kelas' => $this->db->order_by('nama_kelas', 'asc')->get('tbl_kelas')->result(),
            'bulan' => [
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
            ]
        ];



        $this->load->view('adminTemplate/header');
        $this->load->view('adminTemplate/topbar');
        $this->load->view('adminTemplate/sidebar');
        $this->load->view('admin/laporan/index', $data);
        $this->load->view('adminTemplate/footer');
    }

    public function filterBulanSudah()
    {
        $bulan = $this->input->post('bulan');
        // printf($bulan);
        // die();
        // $kelas = $this->db->where('id_kelas', $id)->get('tbl_kelas')->row();
        
        $siswa = $this->db->select('*')
                          ->join('tbl_kelas', 'tbl_kelas.id_kelas=tbl_siswa.id_kelas')
                          ->order_by('tbl_kelas.nama_kelas', 'ASC')
                          ->get('tbl_siswa')
                          ->result();
        $periode = $this->db->where('id_periode', 1)->get('tbl_periode')->row();

        // var_dump($pembayaran);
        // var_dump($siswa);
        
        // foreach ($siswa as $row) {
        //     $pembayaran = $this->db->where('bulan', $bulan)
        //                     ->get('tbl_pembayaran')
        //                     ->row();
        //     if($row->id_siswa == $pembayaran->id_siswa){
        //         echo 'Sudah Bayar';
        //         echo '<br>';
        //         echo $row->id_siswa;
        //         echo '<br>';
        //     }else{
        //         echo 'Belum Bayar';
        //         echo '<br>';
        //         echo $row->id_siswa;
        //         echo '<br>';
        //     }
        // }


        // die();
        $pdf = new FPDF('L', 'mm','Legal');

        $pdf->AddPage();
            
        $pdf->Cell(10,10,'',0,1);
        $pdf->Image(base_url('assets/img/logo.png'),55,8,30,0,'PNG');
        $pdf->Image(base_url('assets/img/tutwuri.png'),268,8,29,0,'PNG');
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(0,8,'DINAS PENDIDIKAN PADANG PARIAMAN',0,1,'C');
        $pdf->SetFont('Arial','B',18);
        // $pdf->Cell(0,5,'',0,1,'C');
        $pdf->Cell(0,8,'SMA NEGERI 1 2x11 ENAM LINGKUNG',0,1,'C');
        // $pdf->Line(10,$this->GetY(),100,$this->GetY());
        $pdf->SetFont('Arial','',8);
        // $pdf->Cell(0,3,' JL. Bari Sicincin',0,1,'C');
        $pdf->Cell(0,5,'JL. Bari, Sicincin, Padang Pariaman, Sumatera Barat 25584 ',0,1,'C');
        // $pdf->Cell(0,3,'Website: www.iainbukittinggi.ac.id | email: info@iainbukittinggi.ac.id',0,1,'C');
        $pdf->SetFont('Arial','',15);
        $pdf->Cell(0,0.7,'_____________________________________________________________________________________',0,1,'C');
        $pdf->Cell(0,0.7,'_____________________________________________________________________________________',0,1,'C');
        $pdf->Cell(10,10,'',0,1);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,5,'DATA SISWA BELUM BAYAR SPP ',0,1,'C');
        $pdf->Cell(0,5,'BULAN '.strtoupper($bulan).' TP. '.$periode->tahun_ajaran,0,1,'C');
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('Arial','',12);
            

            $pdf->Cell(10,6,'',0,1);

            $pdf->SetFont('Times','B',12);

            $pdf->Cell(100);
            $pdf->Cell(10,6,'No',1,0,'C');
            $pdf->Cell(20,6,'NISN',1,0,'C');
            $pdf->Cell(50,6,'Nama',1,0,'C');
            $pdf->Cell(20,6,'Kelas',1,0,'C');
            $pdf->Cell(35,6,'Keterangan',1,1,'C');

            $pdf->SetFont('Times','',12);
            $no=1;

            foreach ($siswa as $row) {
                $pembayaran = $this->db->where('bulan', $bulan)
                                ->get('tbl_pembayaran')
                                ->row();
                
                if($pembayaran){
                    if($row->id_siswa == $pembayaran->id_siswa){
                        $pdf->Cell(100);
                        $pdf->Cell(10,6,$no++,1,0,'C');
                        $pdf->Cell(20,6,$row->id_siswa,1,0,'C');
                        $pdf->Cell(50,6,$row->nama_siswa,1,0,'L');
                        $pdf->Cell(20,6,$row->nama_kelas,1,0,'C');
                        $pdf->Cell(35,6,'Sudah bayar',1,1,'C');
                        
                    }else{
                        
                    }
                }else{
                    $pdf->Cell(100);
                    $pdf->Cell(10,6,'No',1,0,'C');
                    $pdf->Cell(20,6,'No Data',1,0,'C');
                    $pdf->Cell(50,6,'No Data',1,0,'C');
                    $pdf->Cell(20,6,'No Data',1,0,'C');
                    $pdf->Cell(35,6,'No Data',1,1,'C');
                    break;
                }
            }
            
            // foreach ($siswa as $row) {

        $pdf->AcceptPageBreak();
        $pdf->SetFont('Times','',12);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(70);
        $pdf->Cell(175,5,'Mengetahui,',0,0,'L');
        $pdf->Cell(75,5,'Bendahara,',0,1,'L');
        $pdf->Cell(70);
        $pdf->Cell(175,5,'Kepala Sekolah,',0,0,'L');
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(70);
        $pdf->Cell(175,10,'',0,0);
        $pdf->Cell(75,10,'',0,1);
        $pdf->Cell(70);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(175,5,'Sri Astuti',0,0,'L');
        $pdf->Cell(75,5,$this->session->userdata('nama'),0,1,'L');
        $pdf->SetFont('Times','',12);
        $pdf->Cell(70);
        $pdf->Cell(175,5,'NIP. 196312241989032006',0,0,'L');
        $pdf->Cell(75,5,'NIP. '.$this->session->userdata('nip'),0,1,'L');

        $pdf->Output();
    }

    public function filterBulanBelum()
    {
        $bulan = $this->input->post('bulan');
        // printf($bulan);
        // die();
        // $kelas = $this->db->where('id_kelas', $id)->get('tbl_kelas')->row();
        
        $siswa = $this->db->select('*')
                          ->join('tbl_kelas', 'tbl_kelas.id_kelas=tbl_siswa.id_kelas')
                          ->order_by('tbl_kelas.nama_kelas', 'ASC')
                          ->get('tbl_siswa')
                          ->result();
        $periode = $this->db->where('id_periode', 1)->get('tbl_periode')->row();

        // var_dump($pembayaran);
        // var_dump($siswa);
        
        // foreach ($siswa as $row) {
        //     $pembayaran = $this->db->where('bulan', $bulan)
        //                     ->get('tbl_pembayaran')
        //                     ->row();
        //     if($row->id_siswa == $pembayaran->id_siswa){
        //         echo 'Sudah Bayar';
        //         echo '<br>';
        //         echo $row->id_siswa;
        //         echo '<br>';
        //     }else{
        //         echo 'Belum Bayar';
        //         echo '<br>';
        //         echo $row->id_siswa;
        //         echo '<br>';
        //     }
        // }


        // die();
        $pdf = new FPDF('L', 'mm','Legal');

        $pdf->AddPage();
            
        $pdf->Cell(10,10,'',0,1);
        $pdf->Image(base_url('assets/img/logo.png'),55,8,30,0,'PNG');
        $pdf->Image(base_url('assets/img/tutwuri.png'),268,8,29,0,'PNG');
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(0,8,'DINAS PENDIDIKAN PADANG PARIAMAN',0,1,'C');
        $pdf->SetFont('Arial','B',18);
        // $pdf->Cell(0,5,'',0,1,'C');
        $pdf->Cell(0,8,'SMA NEGERI 1 2x11 ENAM LINGKUNG',0,1,'C');
        // $pdf->Line(10,$this->GetY(),100,$this->GetY());
        $pdf->SetFont('Arial','',8);
        // $pdf->Cell(0,3,' JL. Bari Sicincin',0,1,'C');
        $pdf->Cell(0,5,'JL. Bari, Sicincin, Padang Pariaman, Sumatera Barat 25584 ',0,1,'C');
        // $pdf->Cell(0,3,'Website: www.iainbukittinggi.ac.id | email: info@iainbukittinggi.ac.id',0,1,'C');
        $pdf->SetFont('Arial','',15);
        $pdf->Cell(0,0.7,'_____________________________________________________________________________________',0,1,'C');
        $pdf->Cell(0,0.7,'_____________________________________________________________________________________',0,1,'C');
        $pdf->Cell(10,10,'',0,1);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,5,'DATA SISWA BELUM BAYAR SPP ',0,1,'C');
        $pdf->Cell(0,5,'BULAN '.strtoupper($bulan).' TP. '.$periode->tahun_ajaran,0,1,'C');
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('Arial','',12);
            

            $pdf->Cell(10,6,'',0,1);

            $pdf->SetFont('Times','B',12);

            $pdf->Cell(100);
            $pdf->Cell(10,6,'No',1,0,'C');
            $pdf->Cell(20,6,'NISN',1,0,'C');
            $pdf->Cell(50,6,'Nama',1,0,'C');
            $pdf->Cell(20,6,'Kelas',1,0,'C');
            $pdf->Cell(35,6,'Keterangan',1,1,'C');

            $pdf->SetFont('Times','',12);
            $no=1;

            foreach ($siswa as $row) {
                $pembayaran = $this->db->where('bulan', $bulan)
                                ->get('tbl_pembayaran')
                                ->row();
                
                if($pembayaran){
                    if($row->id_siswa == $pembayaran->id_siswa){
                        
                    }else{
                        $pdf->Cell(100);
                        $pdf->Cell(10,6,$no++,1,0,'C');
                        $pdf->Cell(20,6,$row->id_siswa,1,0,'C');
                        $pdf->Cell(50,6,$row->nama_siswa,1,0,'L');
                        $pdf->Cell(20,6,$row->nama_kelas,1,0,'C');
                        $pdf->Cell(35,6,'Belum bayar',1,1,'C');
                    }
                }else{
                    $pdf->Cell(100);
                    $pdf->Cell(10,6,'No',1,0,'C');
                    $pdf->Cell(20,6,'No Data',1,0,'C');
                    $pdf->Cell(50,6,'No Data',1,0,'C');
                    $pdf->Cell(20,6,'No Data',1,0,'C');
                    $pdf->Cell(35,6,'No Data',1,1,'C');
                    break;
                }
            }
            
            // foreach ($siswa as $row) {

        $pdf->AcceptPageBreak();
        $pdf->SetFont('Times','',12);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(70);
        $pdf->Cell(175,5,'Mengetahui,',0,0,'L');
        $pdf->Cell(75,5,'Bendahara,',0,1,'L');
        $pdf->Cell(70);
        $pdf->Cell(175,5,'Kepala Sekolah,',0,0,'L');
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(70);
        $pdf->Cell(175,10,'',0,0);
        $pdf->Cell(75,10,'',0,1);
        $pdf->Cell(70);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(175,5,'Sri Astuti',0,0,'L');
        $pdf->Cell(75,5,$this->session->userdata('nama'),0,1,'L');
        $pdf->SetFont('Times','',12);
        $pdf->Cell(70);
        $pdf->Cell(175,5,'NIP. 196312241989032006',0,0,'L');
        $pdf->Cell(75,5,'NIP. '.$this->session->userdata('nip'),0,1,'L');

        $pdf->Output();
    }

    public function filterKelas()
    {
        $id = $this->input->post('kelas');
        $kelas = $this->db->where('id_kelas', $id)->get('tbl_kelas')->row();
        $siswa = $this->db->where('id_kelas', $id)->get('tbl_siswa')->result();
        $periode = $this->db->where('id_periode', 1)->get('tbl_periode')->row();
        $pdf = new FPDF('L', 'mm','Legal');

        $pdf->AddPage();
            
            $pdf->Cell(10,10,'',0,1);
            $pdf->Image(base_url('assets/img/logo.png'),55,8,30,0,'PNG');
            $pdf->Image(base_url('assets/img/tutwuri.png'),268,8,29,0,'PNG');
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(0,8,'DINAS PENDIDIKAN PADANG PARIAMAN',0,1,'C');
            $pdf->SetFont('Arial','B',18);
            // $pdf->Cell(0,5,'',0,1,'C');
            $pdf->Cell(0,8,'SMA NEGERI 1 2x11 ENAM LINGKUNG',0,1,'C');
            // $pdf->Line(10,$this->GetY(),100,$this->GetY());
            $pdf->SetFont('Arial','',8);
            // $pdf->Cell(0,3,' JL. Bari Sicincin',0,1,'C');
            $pdf->Cell(0,5,'JL. Bari, Sicincin, Padang Pariaman, Sumatera Barat 25584 ',0,1,'C');
            // $pdf->Cell(0,3,'Website: www.iainbukittinggi.ac.id | email: info@iainbukittinggi.ac.id',0,1,'C');
            $pdf->SetFont('Arial','',15);
            $pdf->Cell(0,0.7,'_____________________________________________________________________________________',0,1,'C');
            $pdf->Cell(0,0.7,'_____________________________________________________________________________________',0,1,'C');
            $pdf->Cell(10,10,'',0,1);

            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,5,'LAPORAN PEMBAYARAN SPP ',0,1,'C');
            $pdf->Cell(0,5,'KELAS '.$kelas->nama_kelas.' TP. '.$periode->tahun_ajaran,0,1,'C');
            $pdf->Cell(10,6,'',0,1);
            $pdf->SetFont('Arial','',12);

            

            $pdf->Cell(10,6,'',0,1);

            $pdf->SetFont('Times','B',12);

            $pdf->Cell(5);
            $pdf->Cell(10,6,'No',1,0,'C');
            $pdf->Cell(20,6,'NIS',1,0,'C');
            $pdf->Cell(45,6,'Nama',1,0,'C');
            $pdf->Cell(19,6,'Jan',1,0,'C');
            $pdf->Cell(19,6,'Feb',1,0,'C');
            $pdf->Cell(19,6,'Mar',1,0,'C');
            $pdf->Cell(19,6,'Apr',1,0,'C');
            $pdf->Cell(19,6,'Mei',1,0,'C');
            $pdf->Cell(19,6,'Jun',1,0,'C');
            $pdf->Cell(19,6,'Jul',1,0,'C');
            $pdf->Cell(19,6,'Agus',1,0,'C');
            $pdf->Cell(19,6,'Sept',1,0,'C');
            $pdf->Cell(19,6,'Okt',1,0,'C');
            $pdf->Cell(19,6,'Nov',1,0,'C');
            $pdf->Cell(19,6,'Des',1,0,'C');
            $pdf->Cell(25,6,'Keterangan',1,1,'C');

            $arrayBulan = [
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
            $no=1;

            
            foreach ($siswa as $row) {
               $pdf->SetFont('Times','',11);
               $pdf->Cell(5);
               $pdf->Cell(10,6,$no++,1,0,'C');
               $pdf->Cell(20,6,$row->id_siswa,1,0,'C');
               $pdf->SetFont('Times','',11);
               $pdf->Cell(45,6,$row->nama_siswa,1,0);
               $pdf->SetFont('Times','',9);

            //    $spp = $this->db->where('id_siswa', $row->id_siswa)->get('tbl_pembayaran')->result();
            //    foreach ($spp as $r) { 
            //        $pdf->Cell(19,6,$r->bulan == $arrayBulan[$i] ? $r->jumlah : '',1,0);
            //    }
               for ($i=0; $i < count($arrayBulan); $i++) { 
                    // Query
                    $data=$this->db->where('id_siswa', $row->id_siswa)->where('bulan', $arrayBulan[$i])->get('tbl_pembayaran')->row();
                    // printf($arrayBulan[$i]);

                    $pdf->Cell(19,6,$data ? $data->jumlah : '',1,0);
                    // $pdf->Cell(19,6,'',1,0);

                }
                $pdf->Cell(25,6,'',1,1,'C');
            //    $pdf->Cell(19,6,$spp->bulan == 'Februari' ? $spp->jumlah : '',1,0);
            //    $pdf->Cell(19,6,$spp->bulan == 'Maret' ? $spp->jumlah : '',1,0);
            //    $pdf->Cell(19,6,$spp->bulan == 'April' ? $spp->jumlah : '',1,0);
            //    $pdf->Cell(19,6,$spp->bulan == 'Mei' ? $spp->jumlah : '',1,0);
            //    $pdf->Cell(19,6,$spp->bulan == 'Juni' ? $spp->jumlah : '',1,0);
            //    $pdf->Cell(19,6,$spp->bulan == 'Juli' ? $spp->jumlah : '',1,0);
            //    $pdf->Cell(19,6,$spp->bulan == 'Agustus' ? $spp->jumlah : '',1,0);
            //    $pdf->Cell(19,6,$spp->bulan == 'September' ? $spp->jumlah : '',1,0);
            //    $pdf->Cell(19,6,$spp->bulan == 'Oktober' ? $spp->jumlah : '',1,0);
            //    $pdf->Cell(19,6,$spp->bulan == 'November' ? $spp->jumlah : '',1,0);
            //    $pdf->Cell(19,6,$spp->bulan == 'Desember' ? $spp->jumlah : '',1,0);

            }
            


            

            
        // $pdf->Cell(35,6,array_sum($point5),1,1);

        // $barang = $this->Laporan_model->show()->result();
        // // $barang = $this->Laporan_model->get()->result();
        // foreach ($barang as $data){
            // $pdf->Cell(7,6,$no,1,0);
            // $pdf->Cell(28,6,$non_teknis->nis,1,0);
            // $pdf->Cell(25,6,$non_teknis->non_1,1,0);
            // $pdf->Cell(35,6,$non_teknis->non_2,1,0);
            // $pdf->Cell(0,5,'Sicincin, '.date('d').' '. $arrayBulan[date('n')-1].' '.date('Y'),0,1,'L');

        $pdf->AcceptPageBreak();
        $pdf->SetFont('Times','',12);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(30);
        $pdf->Cell(200,5,'Mengetahui,',0,0,'L');
        $pdf->Cell(100,5,'Bendahara,',0,1,'L');
        $pdf->Cell(30);
        $pdf->Cell(200,5,'Kepala Sekolah,',0,0,'L');
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(30);
        $pdf->Cell(200,10,'',0,0);
        $pdf->Cell(100,10,'',0,1);
        $pdf->Cell(30);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(200,5,'Sri Astuti',0,0,'L');
        $pdf->Cell(100,5,$this->session->userdata('nama'),0,1,'L');
        $pdf->SetFont('Times','',12);
        $pdf->Cell(30);
        $pdf->Cell(200,5,'NIP. 196312241989032006',0,0,'L');
        $pdf->Cell(100,5,'NIP. '.$this->session->userdata('nip'),0,1,'L');

        $pdf->Output();
    }
	
    
    public function CetakBuktiPembayaran()
    {
        $id_siswa = $this->input->post('bukti_id_siswa');
        $periode = $this->input->post('bukti_periode');
        $siswa = $this->db->where('id_siswa', $id_siswa)->get('tbl_siswa')->row();
        

        $pdf = new FPDF('P', 'mm','Legal');

        $pdf->AddPage();
            
            $pdf->Cell(10,10,'',0,1);
            $pdf->Image(base_url('assets/img/logo.png'),15,8,30,0,'PNG');
            $pdf->Image(base_url('assets/img/tutwuri.png'),170,8,29,0,'PNG');
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(0,8,'DINAS PENDIDIKAN PADANG PARIAMAN',0,1,'C');
            $pdf->SetFont('Arial','B',18);
            // $pdf->Cell(0,5,'',0,1,'C');
            $pdf->Cell(0,8,'SMA NEGERI 1 2x11 ENAM LINGKUNG',0,1,'C');
            // $pdf->Line(10,$this->GetY(),100,$this->GetY());
            $pdf->SetFont('Arial','',8);
            // $pdf->Cell(0,3,' JL. Bari Sicincin',0,1,'C');
            $pdf->Cell(0,5,'JL. Bari, Sicincin, Padang Pariaman, Sumatera Barat 25584 ',0,1,'C');
            // $pdf->Cell(0,3,'Website: www.iainbukittinggi.ac.id | email: info@iainbukittinggi.ac.id',0,1,'C');
            $pdf->SetFont('Arial','',15);
            $pdf->Cell(0,0.7,'_______________________________________________________________',0,1,'C');
            $pdf->Cell(0,0.7,'_______________________________________________________________',0,1,'C');
            $pdf->Cell(10,10,'',0,1);

            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,5,'BUKTI PEMBAYARAN SISWA ',0,1,'C');
            $pdf->Cell(0,5,'TAHUN AJARAN '.substr($periode, 0, 9).' SEMESTER '.strtoupper(substr($periode, 10)),0,1,'C');
            $pdf->Cell(10,6,'',0,1);
            $pdf->SetFont('Arial','',12);

            

            $pdf->Cell(10,6,'',0,1);

            $pdf->SetFont('Times','B',12);

            $pdf->Cell(45);
            $pdf->Cell(20,8,'NIS',0,0,'L');
            $pdf->Cell(5,8,':',0,0,'C');
            $pdf->Cell(50,8,$siswa->id_siswa,0,1,'L');
            $pdf->Cell(45);
            $pdf->Cell(20,8,'Nama',0,0,'L');
            $pdf->Cell(5,8,':',0,0,'C');
            $pdf->Cell(50,8,$siswa->nama_siswa,0,1,'L');

            $pdf->Cell(10,8,'',0,1); 
            
            $pdf->Cell(45);
            $pdf->Cell(10,8,'No',1,0,'C');
            $pdf->Cell(20,8,'Bulan',1,0,'L');
            $pdf->Cell(30,8,'Nominal',1,0,'C');
            $pdf->Cell(45,8,'Keterangan',1,1,'C');

            if (substr($periode, 10) == "Ganjil") {
                $arrayBulan = [
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                ];
            }else if(substr($periode, 10) == "Genap"){
                $arrayBulan = [
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember',
                ];
            }

            $pdf->SetFont('Times','',12);
            
            $no=1;
            foreach ($arrayBulan as $key => $value) {

                $query = $this->db->select('*')
                          ->join('tbl_siswa', 'tbl_siswa.id_siswa=tbl_pembayaran.id_siswa')
                          ->where('tbl_pembayaran.id_siswa', $id_siswa)
                          ->where('tbl_pembayaran.periode', $periode)
                          ->where('tbl_pembayaran.bulan', $value)
                          ->get('tbl_pembayaran')
                          ->row();

                if($query){
                    $pdf->Cell(45);
                    $pdf->Cell(10,8,$no++,1,0,'C');
                    $pdf->Cell(20,8,$value,1,0,'L');
                    $pdf->Cell(30,8,$query->jumlah,1,0,'C');
                    $pdf->Cell(45,8,'Lunas',1,1,'C');
                }else{
                    $pdf->Cell(45);
                    $pdf->Cell(10,8,$no++,1,0,'C');
                    $pdf->Cell(20,8,$value,1,0,'L');
                    $pdf->Cell(30,8,'',1,0,'C');
                    $pdf->Cell(45,8,'Belum Lunas',1,1,'C');

                }

            }


            


        $pdf->AcceptPageBreak();
        $pdf->SetFont('Times','',12);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(45);
        $pdf->Cell(80,5,'Mengetahui,',0,0,'L');
        $pdf->Cell(40,5,'Bendahara,',0,1,'L');
        $pdf->Cell(45);
        $pdf->Cell(80,5,'Kepala Sekolah,',0,0,'L');
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(45);
        $pdf->Cell(80,10,'',0,0);
        $pdf->Cell(40,10,'',0,1);
        $pdf->Cell(45);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(80,5,'Sri Astuti',0,0,'L');
        $pdf->Cell(40,5,$this->session->userdata('nama'),0,1,'L');
        $pdf->SetFont('Times','',12);
        $pdf->Cell(45);
        $pdf->Cell(80,5,'NIP. 196312241989032006 ',0,0,'L');
        $pdf->Cell(40,5,'NIP. '.$this->session->userdata('nip'),0,1,'L');

        $pdf->Output();

        
    }
    
    
    
}