<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class St extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('St_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/st/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/st/index/';
            $config['first_url'] = base_url() . 'index.php/st/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->St_model->total_rows($q);
        $st = $this->St_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'st_data' => $st,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','st/st_list', $data);
    }

    public function read($id) 
    {
        $row = $this->St_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'ket' => $row->ket,
	    );
            $this->template->load('template','st/st_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('st'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('st/create_action'),
	    'id' => set_value('id'),
	    'ket' => set_value('ket'),
	);
        $this->template->load('template','st/st_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'ket' => $this->input->post('ket',TRUE),
	    );

            $this->St_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('st'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->St_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('st/update_action'),
		'id' => set_value('id', $row->id),
		'ket' => set_value('ket', $row->ket),
	    );
            $this->template->load('template','st/st_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('st'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'ket' => $this->input->post('ket',TRUE),
	    );

            $this->St_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('st'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->St_model->get_by_id($id);

        if ($row) {
            $this->St_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('st'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('st'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "st.xls";
        $judul = "st";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Ket");

	foreach ($this->St_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ket);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file St.php */
/* Location: ./application/controllers/St.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-26 14:59:31 */
/* http://harviacode.com */