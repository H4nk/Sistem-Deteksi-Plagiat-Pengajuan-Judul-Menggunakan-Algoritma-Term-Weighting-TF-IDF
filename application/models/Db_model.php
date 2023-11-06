<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Db_model extends CI_Model
{

       function get_data($id,$ket,$db)
    {
        $this->db->where('id', $id);
		
         $q= $this->db->get($db);
		 foreach($q->result() as $t){
			 $d= $t->$ket;
		 }
		 return $d;
    } 
       function get_pelanggan($ket)
    {
        $this->db->where('id',$this->session->userdata('id_pelanggan'));
		
         $q= $this->db->get('pelanggan');
		 foreach($q->result() as $t){
			 $d= $t->$ket;
		 }
		 return $d;
    } 
	function total()
    {
		$this->db->select_sum('jual','totalx');
        $this->db->where('keys',$this->session->userdata('idtransaksi'));
		$q= $this->db->get('transaksi_temp');
		 foreach($q->result() as $t){
			 $d= $t->totalx;
		 }
		 return $d;
    } 	
	function total_diskon()
    {
		$this->db->select_sum('diskon','totalx');
        $this->db->where('keys',$this->session->userdata('idtransaksi'));
		$q= $this->db->get('transaksi_temp');
		 foreach($q->result() as $t){
			 $d= $t->totalx;
		 }
		 return $d;
    } 	
	function get_st($id)
    {
        $this->db->where('id', $id);
		
         $q= $this->db->get('st');
		 foreach($q->result() as $t){
			 $d= $t->ket;
		 }
		 return $d;
    }
}

