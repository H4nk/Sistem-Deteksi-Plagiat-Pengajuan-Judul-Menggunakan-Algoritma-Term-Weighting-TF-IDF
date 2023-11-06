<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stok extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Stok_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/stok/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/stok/index/';
            $config['first_url'] = base_url() . 'index.php/stok/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Stok_model->total_rows($q);
        $stok = $this->Stok_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'stok_data' => $stok,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','stok/stok_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Stok_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_obat' => $row->id_obat,
		'stok' => $row->stok,
	    );
            $this->template->load('template','stok/stok_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stok'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('stok/create_action'),
	    'id' => set_value('id'),
	    'id_obat' => set_value('id_obat'),
	    'stok' => set_value('stok'),
	);
        $this->template->load('template','stok/stok_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'stok' => $this->input->post('stok',TRUE),
	    );

            $this->Stok_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('stok'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Stok_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('stok/update_action'),
		'id' => set_value('id', $row->id),
		'id_obat' => set_value('id_obat', $row->id_obat),
		'stok' => set_value('stok', $row->stok),
	    );
            $this->template->load('template','stok/stok_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stok'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'stok' => $this->input->post('stok',TRUE),
	    );

            $this->Stok_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('stok'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Stok_model->get_by_id($id);

        if ($row) {
            $this->Stok_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('stok'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stok'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('stok', 'stok', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "stok.xls";
        $judul = "stok";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Stok");

	foreach ($this->Stok_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->stok);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Stok.php */
/* Location: ./application/controllers/Stok.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-27 21:43:56 */
/* http://harviacode.com */