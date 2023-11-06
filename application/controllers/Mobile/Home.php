<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


    public function index() {
		
		if($this->session->userdata('idtransaksi')=='')
		{
$newdata = array(
        'idtransaksi'  => time()
);

$this->session->set_userdata($newdata);
		}
		else
			
			{
				
			}
		$d['view'] ='produk';
		$this->load->view('mobile/home',$d);

    }  
	
 public function registrasi() {

		$d['view'] ='registrasi';
		$this->load->view('mobile/home',$d);
    } 
	public function prosesDaftar() {

	$username =$this->input->post('username',TRUE);
	$email =$this->input->post('email',TRUE);
	$nama =$this->input->post('nama',TRUE);
	$alamat =$this->input->post('alamat',TRUE);
	$password =md5($this->input->post('password'));
	$this->db->where('username',$username);
	$q= $this->db->get('pelanggan');
			$this->db->where('email',$email);
	$qq= $this->db->get('pelanggan');
	if($q->num_rows()>0){
		echo '<script type="text/javascript">alert("Maaf Username Sudah Digunakan");window.location.href="'.site_url('mobile/Home/registrasi').'"; </script>';
	}

	elseif($qq->num_rows()>0){
				echo '<script type="text/javascript">alert("Maaf Email Sudah Digunakan");window.location.href="'.site_url('mobile/Home/registrasi').'"; </script>';
	}
	else
	{
	$in['username'] =$username;	
	$in['email'] = $email;	
	$in['nama'] = $nama;
	$in['alamat'] =$alamat;	
	$in['password'] = $password;
	$this->db->insert('pelanggan',$in);
			echo '<script type="text/javascript">alert("Selamat anda berhasil melakukan pendaftaran");window.location.href="'.site_url('mobile/Home/login').'"; </script>';
	}
    } 
	 public function login() {

		$d['view'] ='login';
		$this->load->view('mobile/home',$d);
    } 	
	public function prosesLogin() {

	$username =$this->input->post('username',TRUE);
	$password =md5($this->input->post('password'));
	$this->db->where('username',$username);
	$this->db->or_where('email',$username);
	$this->db->where('password',$password);
	$q= $this->db->get('pelanggan');
	if($q->num_rows()>0)
	{
		foreach($q->result() as $t){
			
			$newdata = array(
        'id_pelanggan'  => $t->id,
		'logged_in' => TRUE
);

$this->session->set_userdata($newdata);
		}
			echo '<script type="text/javascript">alert("Anda berhasil login");window.location.href="'.site_url('mobile/Home').'"; </script>';	
		
	}
	else
	{
		echo '<script type="text/javascript">alert("Maaf. Username atau password anda salah, SIlahkan coba lagi");window.location.href="'.site_url('mobile/Home/login').'"; </script>';	
		
	}
	
    } 
	    function logout(){
        $this->session->sess_destroy();
      //  $this->session->set_flashdata('status_login','Anda sudah berhasil keluar dari aplikasi');
        redirect('mobile/home');
    }
	 public function shoping() {

		$d['view'] ='shoping';
		$this->load->view('mobile/home',$d);
    } 	
	public function beli($id) {

		$in['keys'] = $this->session->userdata('idtransaksi');
		$in['obat'] = $id;
		$in['modal'] = $this->Db_model->get_data($id,'modal','obat');
		$in['jual'] = $this->Db_model->get_data($id,'jual','obat');
		$in['diskon'] = $this->Db_model->get_data($id,'diskon','obat');
		$this->db->insert('transaksi_temp',$in);
		echo '<script type="text/javascript">alert("Proses beli berhasil");window.location.href="'.site_url('mobile/Home').'"; </script>';
		} 	
			public function hapus($id) {

		$inx['id'] = $id;
		$this->db->delete('transaksi_temp',$inx);
		echo '<script type="text/javascript">alert("Item berhasil dihapus");window.location.href="'.site_url('mobile/Home/shoping').'"; </script>';
		}
			public function checkout($id) {
				
			$this->db->where('keys',$this->session->userdata('idtransaksi'));
			$q=$this->db->get('transaksi_temp');
			foreach($q->result_array() as $t){
				$in['keys'] = $t['keys'];	
				$in['obat'] = $t['obat'];	
				$in['modal'] = $t['modal'];	
				$in['jual'] = $t['jual'];	
				$in['diskon'] = $t['diskon'];	
				$this->db->insert('transaksi_detail',$in);
			}			

		$inx['keys'] = $this->session->userdata('idtransaksi');
		$inx['total'] = $id;
		$inx['st'] = '1';
		$inx['user'] = $this->session->userdata('id_pelanggan');
		$this->db->insert('transaksi',$inx);	
		echo '<script type="text/javascript">alert("Silahkan Lakukan Pembayaran secara COD");window.location.href="'.site_url('mobile/Home').'"; </script>';
		$newdata = array(
        'idtransaksi'  => time()
);

$this->session->set_userdata($newdata);
		} 
			 public function transaksi() {

		$d['view'] ='transaksi';
		$this->load->view('mobile/home',$d);
    } 
}

