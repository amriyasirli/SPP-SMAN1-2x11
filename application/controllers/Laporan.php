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
        $pdf->Cell(175,5,'NIP. ',0,0,'L');
        $pdf->Cell(75,5,'NIP. ',0,1,'L');

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
        $pdf->Cell(175,5,'NIP. ',0,0,'L');
        $pdf->Cell(75,5,'NIP. ',0,1,'L');

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
        $pdf->Cell(200,5,'NIP. ',0,0,'L');
        $pdf->Cell(100,5,'NIP. ',0,1,'L');

        $pdf->Output();
    }
	
    
    function cetaksiswa()
	{

        
        // $siswa = $this->Siswa_model->show()->result();

        // $siswa = $this->db->get_where('siswa', ['nis'=>$nis])->row();


        // var_dump(array_sum($total));
        $pdf = new FPDF('L', 'mm','A4');

        $pdf->AddPage();
            
            $pdf->Cell(10,10,'',0,1);
            // $pdf->Image(base_url('assets/logo.png'),50,14,20,0,'PNG');
            // $pdf->Image(base_url('assets/tutwuri.jpg'),230,13,20,0,'JPG');
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(0,5,'DINAS PENDIDIKAN PASAMAN BARAT',0,1,'C');
            // $pdf->Cell(0,5,'',0,1,'C');
            $pdf->Cell(0,5,'SMK NEGERI 1 SUNGAI AUR',0,1,'C');
            // $pdf->Line(10,$this->GetY(),100,$this->GetY());
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0,3,' JL. Pematang Sontang - Sungai Aur 26372',0,1,'C');
            $pdf->Cell(0,3,'Sungai Aur, Pasaman Barat, Sumatera Barat  - Telepon: 0232123456 ',0,1,'C');
            // $pdf->Cell(0,3,'Website: www.iainbukittinggi.ac.id | email: info@iainbukittinggi.ac.id',0,1,'C');
            $pdf->SetFont('Arial','B',15);
            $pdf->Cell(0,1,'______________________________________________________',0,1,'C');
            $pdf->Cell(10,10,'',0,1);

            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,5,'LAPORAN DATA SISWA ',0,1,'C');
            // $pdf->Cell(0,5,'PRAKTEK KERJA INDUSRTI ',0,1,'C');
            $pdf->Cell(10,6,'',0,1);
            $pdf->SetFont('Arial','',12);

            

            $pdf->Cell(10,6,'',0,1);

            $pdf->SetFont('Times','B',12);

            $pdf->Cell(45);
            $pdf->Cell(25,6,'Nis',1,0,'C');
            $pdf->Cell(45,6,'Nama',1,0,'C');
            $pdf->Cell(50,6,'Jenis Kelamin',1,0,'C');
            $pdf->Cell(45,6,'Kelas',1,0,'C');
            $pdf->Cell(25,6,'Terdaftar',1,1,'C');

            $pdf->SetFont('Times','',12);
        //    foreach ($siswa as $row) {
               
        //        $pdf->Cell(45);
        //        $pdf->Cell(25,6,$row->nis,1,0);
        //        $pdf->Cell(45,6,$row->nama_siswa,1,0);
        //        $pdf->Cell(50,6,$row->jk,1,0);
        //        $pdf->Cell(45,6,$row->nama_kelas,1,0);
        //        $pdf->Cell(25,6,$row->data_created,1,1,'C');

        //     }
            
            $pdf->SetFont('Times','',12);


            

            
        // $pdf->Cell(35,6,array_sum($point5),1,1);

        // $barang = $this->Laporan_model->show()->result();
        // // $barang = $this->Laporan_model->get()->result();
        $no=1;
        // foreach ($barang as $data){
            // $pdf->Cell(10);
            // $pdf->Cell(7,6,$no,1,0);
            // $pdf->Cell(28,6,$non_teknis->nis,1,0);
            // $pdf->Cell(25,6,$non_teknis->non_1,1,0);
            // $pdf->Cell(35,6,$non_teknis->non_2,1,0);
            // $pdf->Cell(25,6,$non_teknis->non_3,1,0);
            // $pdf->Cell(25,6,$non_teknis->non_4,1,0);
            

        $pdf->AcceptPageBreak();
        $pdf->SetFont('Times','',12);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        // $pdf->Cell(10,10,'',0,1);
        // $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(200);
        $pdf->Cell(0,5,'Sungai Aur, '. date('d F Y'),0,1,'L');
        $pdf->Cell(200);
        $pdf->Cell(0,5,'Kepala Sekolah',0,1,'L');
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(200);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(0,5,'Hardimentis Marwan,S.Pd,M.Pd.T',0,1,'L');
        $pdf->SetFont('Times','',12);
        $pdf->Cell(200);
        $pdf->Cell(0,5,'NIP. 197803092006041008',0,1,'L');
        $pdf->Output();
    }

    function cetakQuiz()
	{
        $siswa = $this->Quiz_model->show()->result();

        // $siswa = $this->db->get_where('siswa', ['nis'=>$nis])->row();


        // var_dump(array_sum($total));
        $pdf = new FPDF('P', 'mm','A4');

        $pdf->AddPage();
            
            $pdf->Cell(10,10,'',0,1);
            $pdf->Image(base_url('assets/logo.png'),18,14,20,0,'PNG');
            $pdf->Image(base_url('assets/tutwuri.jpg'),173,13,20,0,'JPG');
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(0,5,'DINAS PENDIDIKAN KOTA BUKITTINGGI',0,1,'C');
            // $pdf->Cell(0,5,'',0,1,'C');
            $pdf->Cell(0,5,'SMK GENUS BUKITTINGGI',0,1,'C');
            // $pdf->Line(10,$this->GetY(),100,$this->GetY());
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0,3,' JL. BIRUGO BUNGO NO. 137 A TANGAH JUA BUKITTINGGI',0,1,'C');
            $pdf->Cell(0,3,'Birugo, Kec. Aur Birugo Tigo Baleh, Kota Bukittinggi Prov. Sumatera Barat  - Telepon/Fax:  (0752) 84600 ',0,1,'C');
            // $pdf->Cell(0,3,'Website: www.iainbukittinggi.ac.id | email: info@iainbukittinggi.ac.id',0,1,'C');
            $pdf->SetFont('Arial','B',15);
            $pdf->Cell(0,1,'______________________________________________________',0,1,'C');
            $pdf->Cell(10,10,'',0,1);

            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,5,'LAPORAN NILAI QUIZ SISWA ',0,1,'C');
            // $pdf->Cell(0,5,'PRAKTEK KERJA INDUSRTI ',0,1,'C');
            $pdf->Cell(10,6,'',0,1);
            $pdf->SetFont('Arial','',12);

            

            $pdf->Cell(10,6,'',0,1);

            $pdf->SetFont('Times','B',12);

            $pdf->Cell(15);
            $pdf->Cell(25,6,'Nis',1,0,'C');
            $pdf->Cell(45,6,'Nama',1,0,'C');
            $pdf->Cell(45,6,'Kelas',1,0,'C');
            $pdf->Cell(15,6,'Nilai',1,0,'C');
            $pdf->Cell(25,6,'Tanggal',1,1,'C');

            $pdf->SetFont('Times','',12);
           foreach ($siswa as $row) {
               
               $pdf->Cell(15);
               $pdf->Cell(25,6,$row->nis,1,0);
               $pdf->Cell(45,6,$row->nama_siswa,1,0);
               $pdf->Cell(45,6,$row->nama_kelas,1,0);
               $pdf->Cell(15,6,$row->nilai_quiz,1,0);
               $pdf->Cell(25,6,$row->tanggal_quiz,1,1,'C');

            }
            
            $pdf->SetFont('Times','',12);


            

            
        // $pdf->Cell(35,6,array_sum($point5),1,1);

        // $barang = $this->Laporan_model->show()->result();
        // // $barang = $this->Laporan_model->get()->result();
        $no=1;
        // foreach ($barang as $data){
            // $pdf->Cell(10);
            // $pdf->Cell(7,6,$no,1,0);
            // $pdf->Cell(28,6,$non_teknis->nis,1,0);
            // $pdf->Cell(25,6,$non_teknis->non_1,1,0);
            // $pdf->Cell(35,6,$non_teknis->non_2,1,0);
            // $pdf->Cell(25,6,$non_teknis->non_3,1,0);
            // $pdf->Cell(25,6,$non_teknis->non_4,1,0);
            

        $pdf->AcceptPageBreak();
        $pdf->SetFont('Times','',12);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(120);
        $pdf->Cell(0,5,'Bukittinggi, '. date('d F Y'),0,1,'L');
        $pdf->Cell(120);
        $pdf->Cell(0,5,'Guru Mata Pelajaran',0,1,'L');
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(120);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(0,5,'Huzar Dani, S. Pd',0,1,'L');
        $pdf->SetFont('Times','',12);
        $pdf->Cell(120);
        $pdf->Cell(0,5,'NIP. ',0,1,'L');
        $pdf->Output();
    }

    function cetakTugas()
	{
        $siswa = $this->Tugas_model->show()->result();

        // $siswa = $this->db->get_where('siswa', ['nis'=>$nis])->row();


        // var_dump(array_sum($total));
        $pdf = new FPDF('P', 'mm','A4');

        $pdf->AddPage();
            
            $pdf->Cell(10,10,'',0,1);
            $pdf->Image(base_url('assets/logo.png'),18,14,20,0,'PNG');
            $pdf->Image(base_url('assets/tutwuri.jpg'),173,13,20,0,'JPG');
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(0,5,'DINAS PENDIDIKAN KOTA BUKITTINGGI',0,1,'C');
            // $pdf->Cell(0,5,'',0,1,'C');
            $pdf->Cell(0,5,'SMK GENUS BUKITTINGGI',0,1,'C');
            // $pdf->Line(10,$this->GetY(),100,$this->GetY());
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0,3,' JL. BIRUGO BUNGO NO. 137 A TANGAH JUA BUKITTINGGI',0,1,'C');
            $pdf->Cell(0,3,'Birugo, Kec. Aur Birugo Tigo Baleh, Kota Bukittinggi Prov. Sumatera Barat  - Telepon/Fax:  (0752) 84600 ',0,1,'C');
            // $pdf->Cell(0,3,'Website: www.iainbukittinggi.ac.id | email: info@iainbukittinggi.ac.id',0,1,'C');
            $pdf->SetFont('Arial','B',15);
            $pdf->Cell(0,1,'______________________________________________________',0,1,'C');
            $pdf->Cell(10,10,'',0,1);

            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,5,'LAPORAN NILAI TUGAS SISWA ',0,1,'C');
            // $pdf->Cell(0,5,'PRAKTEK KERJA INDUSRTI ',0,1,'C');
            $pdf->Cell(10,6,'',0,1);
            $pdf->SetFont('Arial','',12);

            

            $pdf->Cell(10,6,'',0,1);

            $pdf->SetFont('Times','B',12);

            $pdf->Cell(15);
            $pdf->Cell(25,6,'Nis',1,0,'C');
            $pdf->Cell(45,6,'Nama',1,0,'C');
            $pdf->Cell(45,6,'Kelas',1,0,'C');
            $pdf->Cell(15,6,'Nilai',1,0,'C');
            $pdf->Cell(25,6,'Tanggal',1,1,'C');

            $pdf->SetFont('Times','',12);
           foreach ($siswa as $row) {
               
               $pdf->Cell(15);
               $pdf->Cell(25,6,$row->nis,1,0);
               $pdf->Cell(45,6,$row->nama_siswa,1,0);
               $pdf->Cell(45,6,$row->nama_kelas,1,0);
               $pdf->Cell(15,6,$row->nilai,1,0);
               $pdf->Cell(25,6,$row->tanggal_quiz,1,1,'C');

            }
            
            $pdf->SetFont('Times','',12);


            

            
        // $pdf->Cell(35,6,array_sum($point5),1,1);

        // $barang = $this->Laporan_model->show()->result();
        // // $barang = $this->Laporan_model->get()->result();
        $no=1;
        // foreach ($barang as $data){
            // $pdf->Cell(10);
            // $pdf->Cell(7,6,$no,1,0);
            // $pdf->Cell(28,6,$non_teknis->nis,1,0);
            // $pdf->Cell(25,6,$non_teknis->non_1,1,0);
            // $pdf->Cell(35,6,$non_teknis->non_2,1,0);
            // $pdf->Cell(25,6,$non_teknis->non_3,1,0);
            // $pdf->Cell(25,6,$non_teknis->non_4,1,0);
            

        $pdf->AcceptPageBreak();
        $pdf->SetFont('Times','',12);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(120);
        $pdf->Cell(0,5,'Bukittinggi, '. date('d F Y'),0,1,'L');
        $pdf->Cell(120);
        $pdf->Cell(0,5,'Guru Mata Pelajaran',0,1,'L');
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(120);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(0,5,'Huzar Dani, S. Pd',0,1,'L');
        $pdf->SetFont('Times','',12);
        $pdf->Cell(120);
        $pdf->Cell(0,5,'NIP. ',0,1,'L');
        $pdf->Output();
    }

    function cetakPersonal($id)
	{
        $siswa = $this->Siswa_model->get_by_id($id)->row();

        $data['siswa'] = $this->Siswa_model->get_by_id($id)->row();
		$jml_tugas = $this->db->get_where('tugas', ['nis'=>$id])->num_rows();
		$tugas = $this->db->get_where('tugas', ['nis'=>$id])->result();
		if($jml_tugas>0){
			foreach ($tugas as $t) {
				$total_tugas[] = $t->nilai;
			}
			$data['nilai_tugas'] = array_sum($total_tugas)/$jml_tugas;
		}else{
			$data['nilai_tugas'] = 0;
		}
		
		$jml_quiz = $this->db->get_where('quiz', ['nis'=>$id])->num_rows();
		$quiz = $this->db->get_where('quiz', ['nis'=>$id])->result();
		if($jml_quiz>0){
			foreach ($quiz as $q) {
				$total_quiz[] = $q->nilai_quiz;
			}
			$data['nilai_quiz'] = array_sum($total_quiz)/$jml_quiz;
			$data['nilai_akhir'] = ($data['nilai_tugas']+$data['nilai_quiz'])/2;
		}else{
			$data['nilai_quiz'] = 0;
			$data['nilai_akhir'] = 0;

		}

        // $siswa = $this->db->get_where('siswa', ['nis'=>$nis])->row();


        // var_dump(array_sum($total));
        $pdf = new FPDF('P', 'mm','A4');

        $pdf->AddPage();
            
            $pdf->Cell(10,10,'',0,1);
            $pdf->Image(base_url('assets/logo.png'),18,14,20,0,'PNG');
            $pdf->Image(base_url('assets/tutwuri.jpg'),173,13,20,0,'JPG');
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(0,5,'DINAS PENDIDIKAN KOTA BUKITTINGGI',0,1,'C');
            // $pdf->Cell(0,5,'',0,1,'C');
            $pdf->Cell(0,5,'SMK GENUS BUKITTINGGI',0,1,'C');
            // $pdf->Line(10,$this->GetY(),100,$this->GetY());
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0,3,' JL. BIRUGO BUNGO NO. 137 A TANGAH JUA BUKITTINGGI',0,1,'C');
            $pdf->Cell(0,3,'Birugo, Kec. Aur Birugo Tigo Baleh, Kota Bukittinggi Prov. Sumatera Barat  - Telepon/Fax:  (0752) 84600 ',0,1,'C');
            // $pdf->Cell(0,3,'Website: www.iainbukittinggi.ac.id | email: info@iainbukittinggi.ac.id',0,1,'C');
            $pdf->SetFont('Arial','B',15);
            $pdf->Cell(0,1,'______________________________________________________',0,1,'C');
            $pdf->Cell(10,10,'',0,1);

            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,5,'LAPORAN NILAI TUGAS SISWA ',0,1,'C');
            // $pdf->Cell(0,5,'PRAKTEK KERJA INDUSRTI ',0,1,'C');
            $pdf->Cell(10,6,'',0,1);
            $pdf->SetFont('Arial','',12);

            

            $pdf->Cell(10,6,'',0,1);

            $pdf->SetFont('Times','B',12);

            $pdf->Cell(15);
            $pdf->Cell(25,6,'Nama',1,0,'C');
            $pdf->Cell(25,6,$siswa->nama_siswa,1,1,'C');
            $pdf->Cell(15);
            $pdf->Cell(45,6,'Nis',1,0,'C');
            $pdf->Cell(45,6,$siswa->nis,1,1,'C');
            $pdf->Cell(15);
            $pdf->Cell(45,6,'Kelas',1,0,'C');
            $pdf->Cell(45,6,$siswa->nama_kelas,1,1,'C');
            $pdf->Cell(15);
            $pdf->Cell(15,6,'J. Kelamin',1,0,'C');
            $pdf->Cell(15,6,$siswa->jk,1,1,'C');
            $pdf->Cell(15);
            $pdf->Cell(25,6,'Terdaftar',1,0,'C');
            $pdf->Cell(25,6,$siswa->data_created,1,1,'C');

            $pdf->Cell(10,6,'',0,1);

            $pdf->Cell(15);
            $pdf->Cell(25,6,'No',1,0,'C');
            $pdf->Cell(45,6,'Modul',1,0,'C');
            $pdf->Cell(15,6,'Nilai Tugas',1,0,'C');
            $pdf->Cell(15,6,'Nilai Quiz',1,0,'C');
            $pdf->Cell(25,6,'Tanggal',1,1,'C');

            $pdf->SetFont('Times','',12);
            $no=1;
           foreach ($siswa as $row) {
               
               $pdf->Cell(15);
               $pdf->Cell(25,6,$no++,1,0);
               $pdf->Cell(45,6,$row->nama_siswa,1,0);
               $pdf->Cell(45,6,$row->nama_kelas,1,0);
               $pdf->Cell(15,6,$row->nilai,1,0);
               $pdf->Cell(25,6,$row->tanggal_quiz,1,1,'C');

            }
            
            $pdf->SetFont('Times','',12);


            $pdf->Cell(15);
            $pdf->Cell(100,6,'Rata-Rata Nilai Tugas',1,0,'C');
            $pdf->Cell(25,6,'',1,0,'C');
            $pdf->Cell(100,6,'Rata-Rata Nilai Quiz',1,0,'C');
            $pdf->Cell(25,6,'',1,0,'C');

            
        // $pdf->Cell(35,6,array_sum($point5),1,1);

        // $barang = $this->Laporan_model->show()->result();
        // // $barang = $this->Laporan_model->get()->result();
        $no=1;
        // foreach ($barang as $data){
            // $pdf->Cell(10);
            // $pdf->Cell(7,6,$no,1,0);
            // $pdf->Cell(28,6,$non_teknis->nis,1,0);
            // $pdf->Cell(25,6,$non_teknis->non_1,1,0);
            // $pdf->Cell(35,6,$non_teknis->non_2,1,0);
            // $pdf->Cell(25,6,$non_teknis->non_3,1,0);
            // $pdf->Cell(25,6,$non_teknis->non_4,1,0);
            

        $pdf->AcceptPageBreak();
        $pdf->SetFont('Times','',12);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(120);
        $pdf->Cell(0,5,'Bukittinggi, '. date('d F Y'),0,1,'L');
        $pdf->Cell(120);
        $pdf->Cell(0,5,'Guru Mata Pelajaran',0,1,'L');
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(120);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(0,5,'Huzar Dani, S. Pd',0,1,'L');
        $pdf->SetFont('Times','',12);
        $pdf->Cell(120);
        $pdf->Cell(0,5,'NIP. ',0,1,'L');
        $pdf->Output();
    }
    
    
    
}