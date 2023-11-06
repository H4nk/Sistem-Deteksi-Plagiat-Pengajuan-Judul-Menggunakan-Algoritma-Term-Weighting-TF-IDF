<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_detail extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Transaksi_detail_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/transaksi_detail/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/transaksi_detail/index/';
            $config['first_url'] = base_url() . 'index.php/transaksi_detail/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Transaksi_detail_model->total_rows($q);
        $transaksi_detail = $this->Transaksi_detail_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'transaksi_detail_data' => $transaksi_detail,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','transaksi_detail/transaksi_detail_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Transaksi_detail_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'keys' => $row->keys,
		'obat' => $row->obat,
		'modal' => $row->modal,
		'jual' => $row->jual,
		'diskon' => $row->diskon,
	    );
            $this->template->load('template','transaksi_detail/transaksi_detail_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi_detail'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('transaksi_detail/create_action'),
	    'id' => set_value('id'),
	    'keys' => set_value('keys'),
	    'obat' => set_value('obat'),
	    'modal' => set_value('modal'),
	    'jual' => set_value('jual'),
	    'diskon' => set_value('diskon'),
	);
        $this->template->load('template','transaksi_detail/transaksi_detail_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'keys' => $this->input->post('keys',TRUE),
		'obat' => $this->input->post('obat',TRUE),
		'modal' => $this->input->post('modal',TRUE),
		'jual' => $this->input->post('jual',TRUE),
		'diskon' => $this->input->post('diskon',TRUE),
	    );

            $this->Transaksi_detail_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('transaksi_detail'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Transaksi_detail_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi_detail/update_action'),
		'id' => set_value('id', $row->id),
		'keys' => set_value('keys', $row->keys),
		'obat' => set_value('obat', $row->obat),
		'modal' => set_value('modal', $row->modal),
		'jual' => set_value('jual', $row->jual),
		'diskon' => set_value('diskon', $row->diskon),
	    );
            $this->template->load('template','transaksi_detail/transaksi_detail_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi_detail'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'keys' => $this->input->post('keys',TRUE),
		'obat' => $this->input->post('obat',TRUE),
		'modal' => $this->input->post('modal',TRUE),
		'jual' => $this->input->post('jual',TRUE),
		'diskon' => $this->input->post('diskon',TRUE),
	    );

            $this->Transaksi_detail_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi_detail'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Transaksi_detail_model->get_by_id($id);

        if ($row) {
            $this->Transaksi_detail_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaksi_detail'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi_detail'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('keys', 'keys', 'trim|required');
	$this->form_validation->set_rules('obat', 'obat', 'trim|required');
	$this->form_validation->set_rules('modal', 'modal', 'trim|required');
	$this->form_validation->set_rules('jual', 'jual', 'trim|required');
	$this->form_validation->set_rules('diskon', 'diskon', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "transaksi_detail.xls";
        $judul = "transaksi_detail";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Keys");
	xlsWriteLabel($tablehead, $kolomhead++, "Obat");
	xlsWriteLabel($tablehead, $kolomhead++, "Modal");
	xlsWriteLabel($tablehead, $kolomhead++, "Jual");
	xlsWriteLabel($tablehead, $kolomhead++, "Diskon");

	foreach ($this->Transaksi_detail_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keys);
	    xlsWriteNumber($tablebody, $kolombody++, $data->obat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->modal);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jual);
	    xlsWriteNumber($tablebody, $kolombody++, $data->diskon);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Transaksi_detail.php */
/* Location: ./application/controllers/Transaksi_detail.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-27 21:44:08 */
/* http://harviacode.com */