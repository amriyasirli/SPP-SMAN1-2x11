<?php 

class Pembayaran extends CI_Controller {

    function __construct(){
        parent::__construct();

            // ------Authentication-------
            if(!$this->session->userdata('username')){
                redirect ('Auth/');
            }
            // ----------------------------
            $this->load->model('Model_pembayaran');
            $this->load->model('Model_siswa');
            $this->load->library('form_validation');

        
        }

    public function index ()
    {
        $data = [
            'title' => 'Pembayaran',
            'arrayBulan' => [
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
            ],
            'record' =>$this->db->get('tbl_siswa'),
        ];
        $this->load->view('adminTemplate/header');
        $this->load->view('adminTemplate/topbar');
        $this->load->view('adminTemplate/sidebar');
        $this->load->view('admin/pembayaran/index', $data);
        $this->load->view('adminTemplate/footer');
    }

    public function add ()
    {
        $data = [
            'title' => 'Transaksi',
            'barang' => $this->db->get('tbl_barang')->result(),
            'customer' => $this->db->get('tbl_customer')->result(),
        ];
        $this->load->view('adminTemplate/header');
        $this->load->view('adminTemplate/topbar');
        $this->load->view('adminTemplate/sidebar');
        $this->load->view('admin/pembayaran/add', $data);
        $this->load->view('adminTemplate/footer');
    }

    public function add_action ()
    {
        $data = [
            'id_barang' => $this->input->post('id_barang'),
            'jumlah' => $this->input->post('jumlah'),
            'debit' => $this->input->post('debit'),
            'kredit' => $this->input->post('kredit'),
            'total' => $this->input->post('total'),
            'tanggal' => $this->input->post('tanggal'),
            'id_customer' => $this->input->post('id_customer'),
            'keterangan' => $this->input->post('keterangan'),
        ];

        $this->db->insert('tbl_transaksi', $data);
            redirect('Transaksi');
    }

    public function update_view ($id)
    {
        $data = [
            'title' => 'Transaksi',
            'transaksi' => $this->db->select('*')
                                    ->where('tbl_transaksi.id_transaksi', $id)
                                    ->join('tbl_barang', 'tbl_barang.id_barang=tbl_transaksi.id_barang')
                                    ->join('tbl_customer', 'tbl_customer.id_customer=tbl_transaksi.id_customer')
                                    ->get('tbl_transaksi')
                                    ->row(),
            'barang' => $this->db->get('tbl_barang')->result(),
            'customer' => $this->db->get('tbl_customer')->result(),

        ];
        $this->load->view('adminTemplate/header');
        $this->load->view('adminTemplate/topbar');
        $this->load->view('adminTemplate/sidebar');
        $this->load->view('admin/pembayaran/update_view', $data);
        $this->load->view('adminTemplate/footer');
    }
    
    public function update ($id)
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'hp' => $this->input->post('hp'),
            'status' => $this->input->post('status'),
        ];

        $this->db->where('id_transaksi', $id);
        $this->db->update('tbl_transaksi', $data);
        redirect('Transaksi');
    }
    
    
    public function delete ()
    {
        // printf($this->input->post('type'));
        // die();
        if($this->input->post('type')==2)
		{
			$id=$this->input->post('id');
			$this->db->where('id_pembayaran', $id);	
			$this->db->delete('tbl_pembayaran');	
			echo json_encode(array(
				"statusCode"=>200
			));
		} 
    }

    public function cari(){
        $id_siswa = $this->input->post('id_siswa');
        $cari =$this->Model_siswa->autofill($id_siswa);
        echo json_encode($cari);
    }

    public function loadTabelAjax()
	{
                $id_siswa = $this->input->post('id_siswa');
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
				// $i=1;

                for ($i=0; $i < count($bulan); $i++) { 
                    // Query
                    $data=$this->Model_pembayaran->display_records($id_siswa, $bulan[$i]);

                    
                    echo "<tr>";
                    echo "<th>".$bulan[$i]."</th>";

                    // Cocokkan SPP dengan Bulan Pembayaran
                        if($data->bulan == $bulan[$i]){
                            echo "<td>
                                    <b class='text-success'>".$data->jumlah.",- </b> <small>(".date("d/m/Y", strtotime($data->tanggal_pembayaran)).")</small>"."
                                    <div class='table-links'>
                                        <button type='button' class='btn btn-danger btn-sm mb-1 delete' data-id='$data->id_pembayaran'>
                                         <i class='fas fa-times'></i>
                                     </button>
                                    </div>
                                  </td>";
                            // echo '<td class="text-left">
                            //         <button type="button" class="btn btn-danger btn-sm delete" data-id="'.$data->id_pembayaran.'">
                            //             <i class="fas fa-trash"></i>
                            //         </button>
                            //     </td>';
                        }else{
                            echo "<td></td>";
                        }
                    echo "</tr>";
                }

                // var_dump($value);
                // die();
				// foreach($bulan as $row =>$value)
				// {
				// 	  echo "<tr>";
				// 	  echo "<td>".$row->bulan."</td>";
				// 	  echo "<td>".$row->jumlah."</td>";
				// 	  echo '<td class="text-center">
                //                 <a name="" id="" class="btn btn-danger ml-4" href="#" role="button">
                //                     <i class="fas fa-trash"></i>
                //                 </a>
                //             </td>';
				// 	  echo "</tr>";
				// 	  $i++;
				// }
	}

    

    public function loadDataAjax()
	{
                $id_siswa = $this->input->post('id_siswa');
                // var_dump($id_siswa);
                // die();
				$siswa=$this->db->where('id_siswa', $id_siswa)->get('tbl_siswa')->row();
				echo "<b class='text-orange'>$siswa->nama_siswa</b>";
	}

    public function loadProfil()
	{
                $id_siswa = $this->input->post('id_siswa');
				$siswa=$this->db->join('tbl_kelas', 'tbl_kelas.id_kelas=tbl_siswa.id_kelas')
                                ->where('id_siswa', $id_siswa)
                                ->get('tbl_siswa')
                                ->row();
                $periode = $this->db->get('tbl_periode')->row();

                echo '<img alt="image" src="'.base_url('./assets/img/').$siswa->foto.'" class="rounded-circle profile-widget-picture" height="80">';
                echo '<div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">NISN/NIS</div>
                            <div class="profile-widget-item-value">'.$siswa->id_siswa.'</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Kelas</div>
                            <div class="profile-widget-item-value">'.$siswa->nama_kelas.'</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Jenis Kelamin</div>
                            <div class="profile-widget-item-value">'.$siswa->jenis_kelamin.'</div>
                        </div>
                        </div>';
	}

    public function savedata()
	{
		if($this->input->post('type')==1)
		{
            $id_siswa = $this->input->post('id_siswa');
            $bulan = $this->input->post('bulan');
            $cek = $this->db->where('id_siswa', $id_siswa)->where('bulan', $bulan)->get('tbl_pembayaran')->row();

            if ($cek) {
                echo json_encode(array(
                    "statusCode"=>201
                ));
            }else{
                $data = [
                    'id_siswa' => $id_siswa,
                    'id_guru' => $this->input->post('id_guru'),
                    'jumlah' => $this->input->post('jumlah'),
                    'bulan' => $bulan,
                    'keterangan' => $this->input->post('keterangan'),
                ];
        
                $this->db->insert('tbl_pembayaran', $data);
                echo json_encode(array(
                    "statusCode"=>200
                ));
            }

			// $id_siswa=$this->input->post('id_siswa');
            // $id_guru = 2;
			// $jumlah=$this->input->post('jumlah');
			// $bulan=$this->input->post('bulan');
			// $keterangan=$this->input->post('keterangan');
			// $this->Model_pembayaran->saverecords($id_siswa,$id_guru,$jumlah,$bulan);	
			
		} 
	}
    
}
?>