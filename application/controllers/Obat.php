<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Obat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Obat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/obat/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/obat/index/';
            $config['first_url'] = base_url() . 'index.php/obat/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Obat_model->total_rows($q);
        $obat = $this->Obat_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'obat_data' => $obat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','obat/obat_list', $data);
    }

   
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('obat/create_action'),
	    'id' => set_value('id'),
	    'keys' => set_value('keys'),
	    'kode' => set_value('kode'),
	    'nama' => set_value('nama'),
	    'kategori' => set_value('kategori'),
	    'keterangan' => set_value('keterangan'),
	    'modal' => set_value('modal'),
	    'jual' => set_value('jual'),
	    'diskon' => set_value('diskon'),
	    'foto' => set_value('foto'),
	);
        $this->template->load('template','obat/obat_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $foto = $this->upload_foto();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode' => $this->input->post('kode',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'kategori' => $this->input->post('kategori',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'modal' => $this->input->post('modal',TRUE),
		'jual' => $this->input->post('jual',TRUE),
		'diskon' => $this->input->post('diskon',TRUE),
		'foto' => $foto['file_name'],
	    );

            $this->Obat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('obat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Obat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('obat/update_action'),
		'id' => set_value('id', $row->id),
		'kode' => set_value('kode', $row->kode),
		'nama' => set_value('nama', $row->nama),
		'kategori' => set_value('kategori', $row->kategori),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'modal' => set_value('modal', $row->modal),
		'jual' => set_value('jual', $row->jual),
		'diskon' => set_value('diskon', $row->diskon),
		'foto' => set_value('foto', $row->foto),
	    );
            $this->template->load('template','obat/obat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('obat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $foto = $this->upload_foto();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
			     if($foto['file_name']==''){
                $data = array(
		'kode' => $this->input->post('kode',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'kategori' => $this->input->post('kategori',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'modal' => $this->input->post('modal',TRUE),
		'jual' => $this->input->post('jual',TRUE),
		'diskon' => $this->input->post('diskon',TRUE),
	    );
		      $this->Obat_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('obat'));
            }
			else {
            $data = array(
		'kode' => $this->input->post('kode',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'kategori' => $this->input->post('kategori',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'modal' => $this->input->post('modal',TRUE),
		'jual' => $this->input->post('jual',TRUE),
		'diskon' => $this->input->post('diskon',TRUE),
		'foto' => $foto['file_name'],
	    );

            $this->Obat_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('obat'));
        }
		}
    }
    
    public function delete($id) 
    {
        $row = $this->Obat_model->get_by_id($id);

        if ($row) {
            $this->Obat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('obat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('obat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode', 'kode', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('modal', 'modal', 'trim|required');
	$this->form_validation->set_rules('jual', 'jual', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "obat.xls";
        $judul = "obat";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Kategori");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Modal");
	xlsWriteLabel($tablehead, $kolomhead++, "Jual");
	xlsWriteLabel($tablehead, $kolomhead++, "Foto");

	foreach ($this->Obat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kategori);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->modal);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jual);
	    xlsWriteLabel($tablebody, $kolombody++, $data->foto);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
	    function upload_foto(){
        $config['upload_path']          = './uploads';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']        = TRUE;
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $this->load->library('upload', $config);
        $this->upload->do_upload('foto');
        return $this->upload->data();
    }

}
