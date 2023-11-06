<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cek extends CI_Controller {


    public function index() {

		$this->load->view('cek');

    }  
	public function proses() {
		$email = $this->input->post('emailiaii',TRUE);
		
		$this->db->where('email',$email);
		$q = $this->db->get('data');
		if($q->num_rows()>0){
			$in['email'] = $email;
			$in['st'] = '1';
				$this->db->insert('log', $in);
			foreach($q->result() as $h){
			 $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
		$pdf->Image(''.base_url('logo').'/iaii.png',8,5,-150);
		$pdf->Image(''.base_url('logo').'/logobkt.png',185,5,-150);

        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',32);
        // mencetak string 
        $pdf->Cell(200,3,'KARTU PESERTA UJIAN',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(200,15,'Rekrutmen Tenaga Programer Dinas Kominfo Kota Bukittinggi',0,1,'C');
		$pdf->SetLineWidth(1);
		$pdf->Line(10, 28, 200, 28);
        $pdf->Cell(10,2,'',0,1);
        $pdf->SetFont('Arial','B',14);
				 $pdf->Cell(200,4,'No. Registrasi',0,1,'C');
		 $pdf->Cell(200,8,''.$h->id.'/IAII/01/2020',0,1,'C');
		 $pdf->Cell(45,10,'Email ',0,0,'L');
		 $pdf->Cell(5,10,':',0,0,'L');
		 $pdf->Cell(5,10,$h->email,0,1,'L');
		 $pdf->Cell(45,10,'Nama Lengkap',0,0,'L');
		 $pdf->Cell(5,10,':',0,0,'L');
		 $pdf->Cell(5,10,$h->nama,0,1,'L');
		 $pdf->Cell(45,15,'Jenis Kelamin',0,0,'L');
		 $pdf->Cell(5,15,':',0,0,'L');
		 $pdf->Cell(5,15,$h->jk,0,1,'L');
		 $pdf->Cell(45,14,'Tempat/Tgl Lahir',0,0,'A');
		 $pdf->Cell(5,14,':',0,0,'A');
		 $pdf->Cell(20,14,$h->tempat.' / '.tgl_indo($h->tgl).'',0,1,'A');		 
		 $pdf->Cell(20,13,'Alamat',0,0,'L');
		 $pdf->Cell(5,13,':',0,0,'L');
		  $pdf->SetFont('Arial','',12);

		 $pdf->Cell(5,13,$h->alamat,0,0,'A');	
		 		  $pdf->SetFont('Arial','B',16);
        $pdf->Cell(10,10,'',0,1);

			$pdf->Cell(190,10,status($h->status),0,0,'C');
	        $pdf->Cell(10,10,'',0,1);
		 		  $pdf->SetFont('Arial','',10);

			$pdf->Cell(190,4,'"Demikian data pribadi ini saya buat dengan sebenarnya dan',0,0,'C');
				        $pdf->Cell(10,3,'',0,1);

			$pdf->Cell(190,4,'bila ternyata isian yang dibuat tidak benar, saya bersedia',0,0,'C');
				        $pdf->Cell(10,3,'',0,1);

			$pdf->Cell(190,4,'menanggung akibat hukum yang ditimbulkannya"',0,0,'C');
							        $pdf->Cell(10,5,'',0,1);
		 		  $pdf->SetFont('Arial','',8);

		$pdf->Image(''.base_url('logo').'/kominfo.png',100,121,-1900);


        $pdf->SetFont('Arial','',10);
  
        $pdf->Output('I','filename.pdf');
			}
		}
		
		else
			
			{
				$in['email'] = $email;
							$in['st'] = '0';

				$this->db->insert('log', $in);
		echo '<script type="text/javascript">alert("Maaf data tidak ditemukan");window.location.href="'.base_url().'"; </script>';
				
			}
			
			
			$this->load->view('cek');

    }

   
}
