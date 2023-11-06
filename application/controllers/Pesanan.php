<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pesanan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Pesanan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/pesanan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/pesanan/index/';
            $config['first_url'] = base_url() . 'index.php/pesanan/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Pesanan_model->total_rows($q);
        $pesanan = $this->Pesanan_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pesanan_data' => $pesanan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','pesanan/pesanan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Pesanan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'transaksi' => $row->transaksi,
		'alamat' => $row->alamat,
		'user' => $row->user,
		'st' => $row->st,
	    );
            $this->template->load('template','pesanan/pesanan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pesanan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pesanan/create_action'),
	    'id' => set_value('id'),
	    'transaksi' => set_value('transaksi'),
	    'alamat' => set_value('alamat'),
	    'user' => set_value('user'),
	    'st' => set_value('st'),
	);
        $this->template->load('template','pesanan/pesanan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'alamat' => $this->input->post('alamat',TRUE),
		'user' => $this->input->post('user',TRUE),
		'st' => $this->input->post('st',TRUE),
	    );

            $this->Pesanan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('pesanan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pesanan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pesanan/update_action'),
		'id' => set_value('id', $row->id),
		'transaksi' => set_value('transaksi', $row->transaksi),
		'alamat' => set_value('alamat', $row->alamat),
		'user' => set_value('user', $row->user),
		'st' => set_value('st', $row->st),
	    );
            $this->template->load('template','pesanan/pesanan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pesanan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'alamat' => $this->input->post('alamat',TRUE),
		'user' => $this->input->post('user',TRUE),
		'st' => $this->input->post('st',TRUE),
	    );

            $this->Pesanan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pesanan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pesanan_model->get_by_id($id);

        if ($row) {
            $this->Pesanan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pesanan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pesanan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('user', 'user', 'trim|required');
	$this->form_validation->set_rules('st', 'st', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pesanan.xls";
        $judul = "pesanan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "User");
	xlsWriteLabel($tablehead, $kolomhead++, "St");

	foreach ($this->Pesanan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->user);
	    xlsWriteNumber($tablebody, $kolombody++, $data->st);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Pesanan.php */
/* Location: ./application/controllers/Pesanan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-27 21:43:43 */
/* http://harviacode.com */