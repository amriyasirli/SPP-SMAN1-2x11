<?php 

class Kelas extends CI_Controller {

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
            'title' => 'Kelas',
            'kelas' => $this->db->order_by('nama_kelas', 'ASC')->get('tbl_kelas')->result(),
        ];
        $this->load->view('adminTemplate/header');
        $this->load->view('adminTemplate/topbar');
        $this->load->view('adminTemplate/sidebar');
        $this->load->view('admin/kelas/index', $data);
        $this->load->view('adminTemplate/footer');
    }

    public function add ()
    {
        $data = [
            'title' => 'Kelas',
        ];
        $this->load->view('adminTemplate/header');
        $this->load->view('adminTemplate/topbar');
        $this->load->view('adminTemplate/sidebar');
        $this->load->view('admin/kelas/add', $data);
        $this->load->view('adminTemplate/footer');
    }

    public function add_action ()
    {
        $data = [
            'nama_kelas' => $this->input->post('nama_kelas'),
        ];

        $this->db->insert('tbl_kelas', $data);
        redirect('Kelas');
    }

    public function update_view ($id)
    {
        $data = [
            'title' => 'Kelas',
            'kelas' => $this->db->where('id_kelas', $id)->get('tbl_kelas')->row(),
        ];
        $this->load->view('adminTemplate/header');
        $this->load->view('adminTemplate/topbar');
        $this->load->view('adminTemplate/sidebar');
        $this->load->view('admin/kelas/update_view', $data);
        $this->load->view('adminTemplate/footer');
    }
    
    public function update ($id)
    {
        $data = [
            'nama_kelas' => $this->input->post('nama_kelas'),
        ];

        $this->db->where('id_kelas', $id);
        $this->db->update('tbl_kelas', $data);
        redirect('Kelas');
    }
    
    
    public function delete ($id)
    {
        $this->db->where('id_kelas', $id);
        $this->db->delete('tbl_kelas');
        redirect('Kelas');
    }
    
}
?>