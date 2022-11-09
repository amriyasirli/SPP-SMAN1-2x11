<?php 

class Guru extends CI_Controller {

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
            'title' => 'Guru',
            'guru' => $this->db->order_by('nama_guru', 'ASC')
                                ->get('tbl_guru')
                                ->result(),
        ];
        $this->load->view('adminTemplate/header');
        $this->load->view('adminTemplate/topbar');
        $this->load->view('adminTemplate/sidebar');
        $this->load->view('admin/guru/index', $data);
        $this->load->view('adminTemplate/footer');
    }

    public function add ()
    {
        $data = [
            'title' => 'Guru',
        ];
        $this->load->view('adminTemplate/header');
        $this->load->view('adminTemplate/topbar');
        $this->load->view('adminTemplate/sidebar');
        $this->load->view('admin/guru/add', $data);
        $this->load->view('adminTemplate/footer');
    }

    public function add_action ()
    {

        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tbl_auth.username]',
        array(
            'required'      => 'Wajib diisi !',
            'is_unique'     => 'Username sudah digunakan !'
        ));
        $this->form_validation->set_rules('password1', 'Password1', 'required|trim',
        array(
            'required'      => 'Wajib diisi !',
        ));
        $this->form_validation->set_rules('password2', 'Password2', 'trim|required|matches[password1]',
        array(
            'required'      => 'Wajib diisi !',
            'matches'     => 'Password tidak cocok !'
        ));

        if ($this->form_validation->run() == false) {

            $data = [
                'title' => 'Guru',
            ];
            $this->load->view('adminTemplate/header');
            $this->load->view('adminTemplate/topbar');
            $this->load->view('adminTemplate/sidebar');
            $this->load->view('admin/guru/add', $data);
            $this->load->view('adminTemplate/footer');

        } else {
            //pengaturan upload foto
            $config['encrypt_name']        = TRUE;
            $config['allowed_types'] = 'svg|jpg|png|jpeg';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/img/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data('file_name');   
                $data = [
                    'nama_guru' => $this->input->post('nama_guru'),
                    'nip' => $this->input->post('nip'),
                ];
        
                $auth = [
                    'nama' => $this->input->post('nama_guru'),
                    'nip' => $this->input->post('nip'),
                    'username' => $this->input->post('username'),
                    'password' => password_hash($this->input->post('password2'), PASSWORD_DEFAULT),
                    'foto' => $foto,
                    'role' => 2,
                ];
        
                $this->db->insert('tbl_guru', $data);
                $this->db->insert('tbl_auth', $auth);
                redirect('Guru');
            } else {
                echo $this->upload->display_errors();
            }
            
        }

    }

    public function update_view ($id)
    {
        $data = [
            'title' => 'Guru',
            'guru' => $this->db->where('id_guru', $id)->get('tbl_guru')->row(),
        ];
        $this->load->view('adminTemplate/header');
        $this->load->view('adminTemplate/topbar');
        $this->load->view('adminTemplate/sidebar');
        $this->load->view('admin/guru/update_view', $data);
        $this->load->view('adminTemplate/footer');
    }
    
    public function update ($id)
    {
        $data = [
            'nama_guru' => $this->input->post('nama_guru'),
            'nip' => $this->input->post('nip'),
        ];

        $this->db->where('id_guru', $id);
        $this->db->update('tbl_guru', $data);
        redirect('Guru');
    }
    
    
    public function delete ($id)
    {
        $this->db->where('id_guru', $id);
        $this->db->delete('tbl_guru');
        redirect('Guru');
    }
    
}
?>