<?php 

class Periode extends CI_Controller {

    function __construct(){
        parent::__construct();

            // ------Authentication-------
            if(!$this->session->userdata('username')){
                redirect ('Auth/');
            }
            // ----------------------------
        
        }


    public function update_view ()
    {
        $data = [
            'title' => 'Periode',
            'periode' => $this->db->where('id_periode', 1)->get('tbl_periode')->row(),
        ];
        $this->load->view('adminTemplate/header');
        $this->load->view('adminTemplate/topbar');
        $this->load->view('adminTemplate/sidebar');
        $this->load->view('admin/periode/update_view', $data);
        $this->load->view('adminTemplate/footer');
    }
    
    public function update ($id)
    {
        $data = [
            'semester' => $this->input->post('semester'),
            'tahun_ajaran' => $this->input->post('tahun_ajaran'),
        ];

        $this->db->where('id_periode', $id);
        $this->db->update('tbl_periode', $data);
        redirect('Periode');
    }
    
}
?>