<?php 

class Siswa extends CI_Controller {

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
        $data = [
            'title' => 'Siswa',
            'siswa' => $this->db->select('*')
                                ->join('tbl_kelas', 'tbl_kelas.id_kelas=tbl_siswa.id_kelas')
                                ->order_by('nama_kelas', 'ASC')
                                ->order_by('nama_siswa', 'ASC')
                                ->get('tbl_siswa')
                                ->result(),
        ];
        $this->load->view('adminTemplate/header');
        $this->load->view('adminTemplate/topbar');
        $this->load->view('adminTemplate/sidebar');
        $this->load->view('admin/siswa/index', $data);
        $this->load->view('adminTemplate/footer');
    }

    public function add ()
    {
        $data = [
            'title' => 'Siswa',
        ];
        $this->load->view('adminTemplate/header');
        $this->load->view('adminTemplate/topbar');
        $this->load->view('adminTemplate/sidebar');
        $this->load->view('admin/siswa/add', $data);
        $this->load->view('adminTemplate/footer');
    }

    public function add_action ()
    {
        //pengaturan upload foto
        $config['encrypt_name']        = TRUE;
        $config['allowed_types'] = 'svg|jpg|png|jpeg';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/img/';

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('foto')) {
            $foto = $this->upload->data('file_name'); 
            $data = [
                'id_siswa' => $this->input->post('id_siswa'),
                'nama_siswa' => $this->input->post('nama_siswa'),
                'id_kelas' => $this->input->post('id_kelas'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'foto' => $foto
            ];

        $this->db->insert('tbl_siswa', $data);
        redirect('Siswa');
        } else {
            echo $this->upload->display_errors();
        }
    }

    public function update_view ($id)
    {
        $data = [
            'title' => 'Siswa',
            'siswa' => $this->db->join('tbl_kelas', 'tbl_kelas.id_kelas=tbl_siswa.id_kelas')
                                ->where('id_siswa', $id)->get('tbl_siswa')->row(),
        ];
        $this->load->view('adminTemplate/header');
        $this->load->view('adminTemplate/topbar');
        $this->load->view('adminTemplate/sidebar');
        $this->load->view('admin/siswa/update_view', $data);
        $this->load->view('adminTemplate/footer');
    }
    
    public function update ($id)
    {
        $data = [
            'id_siswa' => $this->input->post('id_siswa'),
            'nama_siswa' => $this->input->post('nama_siswa'),
            'id_kelas' => $this->input->post('id_kelas'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
        ];

        $this->db->where('id_siswa', $id);
        $this->db->update('tbl_siswa', $data);
        redirect('Siswa');
    }
    
    
    public function delete ($id)
    {
        $this->db->where('id_siswa', $id);
        $this->db->delete('tbl_siswa');
        redirect('Siswa');
    }
    
}
?>