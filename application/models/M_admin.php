<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_admin extends CI_Model
{
	public function pembelian()
	{
		$this->db->select('*');
		$this->db->from('tb_pembelian');
		$this->db->join('jenis_beras', 'tb_pembelian.jenis_gabah = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_pembelian.grade = grade.id_grade');
		$this->db->join('tb_user', 'tb_pembelian.id_user = tb_user.id_user');
		$this->db->order_by('tb_pembelian.kode_pembelian', 'DESC');
		$this->db->group_by('tb_pembelian.kode_pembelian');
		$result = $this->db->get();
		return $result->result_array();

		// return $this->db->get('tb_pembelian', 9, 2)->result_array();
	}
	public function edit_user($id)
	{
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('tb_user.id_user', $id);
		$result = $this->db->get();
		return $result->result_array();

		// return $this->db->get('tb_pembelian', 9, 2)->result_array();
	}
	public function delete_jenis($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function get_jenis($id)
	{
		$this->db->select('*');
		$this->db->from('jenis_beras');
		$this->db->where('jenis_beras.id_jenis', $id);
		$result = $this->db->get();
		return $result->result_array();

		// return $this->db->get('tb_pembelian', 9, 2)->result_array();
	}
	public function update_jenis($where, $data, $table)
	{
		return $this->db->update('jenis_beras', $data, $where);
	}
	public function update_profil($where, $data, $table)
	{
		return $this->db->update('tb_user', $data, $where);
	}
    public function delete_merk($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function jual_beras_kebi($where, $data, $table)
	{
		return $this->db->update('tb_beras_kebi', $data, $where);
	}
    public function get_merk($id)
	{
		$this->db->select('*');
		$this->db->from('merk_beras');
		$this->db->where('merk_beras.id_merk', $id);
		$result = $this->db->get();
		return $result->result_array();

		// return $this->db->get('tb_pembelian', 9, 2)->result_array();
	}
	public function join_merk()
	{
		$this->db->select('*');
		$this->db->from('tb_beras_kebi');
		$this->db->join('merk_beras', 'merk_beras.id_merk = tb_beras_kebi.merk');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function get_jual_beras_kebi()
	{
		$this->db->select('*');
		$this->db->from('tb_jual_beras_kebi');
		$this->db->join('merk_beras', 'merk_beras.id_merk = tb_jual_beras_kebi.merk');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function update_merk($where, $data, $table)
	{
		return $this->db->update('merk_beras', $data, $where);
	}

	public function get_pembelian($limit, $start)
	{
		$this->db->select('*');
		$this->db->from('tb_pembelian');
		$this->db->join('jenis_beras', 'tb_pembelian.jenis_gabah = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_pembelian.grade = grade.id_grade');
		$this->db->join('tb_user', 'tb_pembelian.id_user = tb_user.id_user');
		$this->db->order_by('tb_pembelian.kode_pembelian', 'DESC');
		$this->db->group_by('tb_pembelian.kode_pembelian');
		$this->db->limit($limit, $start);
		$result = $this->db->get();
		return $result->result_array();

		// return $this->db->get('tb_pembelian', 9, 2)->result_array();
	}

	public function get_jual_beras($kode)
	{
		$this->db->select('*');
		$this->db->from('jual_beras');
		$this->db->join('tb_user', 'jual_beras.id_user = tb_user.id_user');
		$this->db->where('jual_beras.kode_penjualan', $kode);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function get_beli_beras($kode)
	{
		$this->db->select('*');
		$this->db->from('tb_beli_beras');
		$this->db->join('tb_user', 'tb_beli_beras.id_user = tb_user.id_user');
		$this->db->join('jenis_beras', 'tb_beli_beras.jenis = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_beli_beras.grade = grade.id_grade');
		$this->db->where('tb_beli_beras.kode_pembelian', $kode);
		$result = $this->db->get();
		return $result->result_array();
	}

	public function jumlah_pembelian()
	{
		$this->db->select('*');
		$this->db->from('tb_pembelian');
		$this->db->join('jenis_beras', 'tb_pembelian.jenis_gabah = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_pembelian.grade = grade.id_grade');
		$this->db->join('tb_user', 'tb_pembelian.id_user = tb_user.id_user');
		$this->db->group_by('tb_pembelian.kode_pembelian');
		$result = $this->db->get();
		return $result->num_rows();
	}


	public function get_kebi($limit, $start)
	{
		$this->db->select('*');
		$this->db->from('tb_kebi');
		// $this->db->join('merk_beras', 'tb_kebi.merk = merk_beras.id_merk');
		$this->db->join('tb_user', 'tb_kebi.id_user = tb_user.id_user');
		$this->db->join('jenis_beras', 'tb_kebi.jenis = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_kebi.grade = grade.id_grade');
		$this->db->group_by('tb_kebi.kode_kebi');
		$this->db->order_by('tb_kebi.tanggal', 'DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function update_beras_kebi($where, $data, $table)
	{
		return $this->db->update('tb_beras_kebi', $data, $where);
	}
	public function jumlah_kebi()
	{
		$this->db->select('*');
		$this->db->from('tb_kebi');
		// $this->db->join('merk_beras', 'tb_kebi.merk = merk_beras.id_merk');
		$this->db->join('tb_user', 'tb_kebi.id_user = tb_user.id_user');
		$this->db->join('jenis_beras', 'tb_kebi.jenis = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_kebi.grade = grade.id_grade');
		$this->db->group_by('tb_kebi.kode_kebi');
		$this->db->order_by('tb_kebi.tanggal', 'DESC');
		$result = $this->db->get();
		return $result->num_rows();
	}

	public function detail_kebi($id)
	{
		$this->db->select('*');
		$this->db->from('tb_kebi');
		$this->db->join('tb_user', 'tb_kebi.id_user = tb_user.id_user');
		$this->db->join('jenis_beras', 'tb_kebi.jenis = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_kebi.grade = grade.id_grade');
		$this->db->where('tb_kebi.kode_kebi', $id);
		$this->db->group_by('tb_kebi.kode_kebi');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function data_kebi($id)
	{
		$this->db->select('*');
		$this->db->from('tb_kebi');
		$this->db->join('tb_user', 'tb_kebi.id_user = tb_user.id_user');
		$this->db->join('jenis_beras', 'tb_kebi.jenis = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_kebi.grade = grade.id_grade');
		$this->db->where('tb_kebi.kode_kebi', $id);
// 		$this->db->group_by('tb_kebi.kode_kebi');
		$result = $this->db->get();
		return $result->result_array();
	}

	public function penjualan_kg()
	{
		$this->db->select('*');
		$this->db->from('tb_jual_kg');
		$this->db->join('jenis_beras', 'tb_jual_kg.jenis = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_jual_kg.grade = grade.id_grade');
		$this->db->order_by('tb_jual_kg.tanggal', 'DESC');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function cetak_jual_kg($kode_pembelian)
	{
		$this->db->select('*');
		$this->db->from('tb_jual_kg');
		$this->db->join('jenis_beras', 'tb_jual_kg.jenis = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_jual_kg.grade = grade.id_grade');
		$this->db->order_by('tb_jual_kg.tanggal', 'DESC');
		$this->db->where('tb_jual_kg.nota_penjualan', $kode_pembelian);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function pembelian_kg()
	{
		$this->db->select('*');
		$this->db->from('tb_beli_kg');
		$this->db->join('jenis_beras', 'tb_beli_kg.jenis_gabah = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_beli_kg.grade = grade.id_grade');
		$this->db->order_by('tb_beli_kg.tanggal', 'DESC');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function cetak_beli_kg($kode_pembelian)
	{
		$this->db->select('*');
		$this->db->from('tb_beli_kg');
		$this->db->join('jenis_beras', 'tb_beli_kg.jenis_gabah = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_beli_kg.grade = grade.id_grade');
		$this->db->order_by('tb_beli_kg.tanggal', 'DESC');
		$this->db->where('tb_beli_kg.kode_pembelian', $kode_pembelian);
		$result = $this->db->get();
		return $result->result_array();
	}

	public function jual_beras()
	{
		$this->db->select('*');
		$this->db->from('jual_beras');
		$this->db->join('tb_user', 'jual_beras.id_user = tb_user.id_user');
		$this->db->order_by('jual_beras.tanggal', 'DESC');
		$result = $this->db->get();
		return $result->result_array();
	}

	public function beli_beras()
	{
		$this->db->select('*');
		$this->db->from('tb_beli_beras');
		$this->db->join('tb_user', 'tb_beli_beras.id_user = tb_user.id_user');
		$this->db->join('grade', 'tb_beli_beras.grade = grade.id_grade');
		$this->db->join('jenis_beras', 'tb_beli_beras.jenis = jenis_beras.id_jenis');
		$this->db->order_by('tb_beli_beras.tanggal', 'DESC');
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function stok_proses_giling()
	{
		$this->db->select('*');
		$this->db->from('tb_stok_proses_giling');
		$this->db->join('grade', 'tb_stok_proses_giling.grade = grade.id_grade');
		$this->db->join('jenis_beras', 'tb_stok_proses_giling.jenis = jenis_beras.id_jenis');
		$this->db->order_by('tb_stok_proses_giling.tanggal', 'DESC');
		$result = $this->db->get();
		return $result->result_array();
	}

	public function update_pengeringan($where, $data, $table)
	{
		return $this->db->update('tb_pengeringan', $data, $where);
	}

	public function update_status($where, $data, $table)
	{
		return $this->db->update('tb_pengeringan', $data, $where);
	}

	public function update_beras($where, $data, $table)
	{
		return $this->db->update('tb_stok_beras', $data, $where);
	}

	public function update_tb_beras($whe, $dat, $table)
	{
		return $this->db->update('tb_stok_beras', $dat, $whe);
	}

	public function update_stok_kg($wheren, $datan, $table)
	{
		return $this->db->update('tb_stok_kg', $datan, $wheren);
	}
	public function update_stok_ks($wheren, $datan, $table)
	{
		return $this->db->update('tb_stok_ks', $datan, $wheren);
	}

	public function update_jemur_stok($wherej, $dataj, $table)
	{
		return $this->db->update('tb_stok_jemur_kg', $dataj, $wherej);
	}
	public function update_beli_stok($wherej, $dataj, $table)
	{
		return $this->db->update('tb_beli_stok_kg', $dataj, $wherej);
	}

	public function update_giling($wheren, $datan, $table)
	{
		return $this->db->update('tb_giling', $datan, $wheren);
	}
	public function update_menir_katul($where, $data, $table)
	{
		return $this->db->update('tb_hasil_giling', $data, $where);
	}
	public function update_hasil_stok($where, $data, $table)
	{
		return $this->db->update('tb_hasil_giling', $data, $where);
	}
	public function update_beras_giling($where, $data, $table)
	{
		return $this->db->update('tb_giling', $data, $where);
	}
	public function update_kebi($where, $data, $table)
	{
		return $this->db->update('tb_kebi', $data, $where);
	}

	public function pengeringan()
	{
		$this->db->select('*');
		$this->db->from('tb_pengeringan');
		$this->db->join('tb_pembelian', 'tb_pengeringan.kode_pembelian = tb_pembelian.kode_pembelian');
		$this->db->group_by('tb_pengeringan.kode_pembelian');
		$this->db->order_by('tb_pengeringan.kode_pembelian', 'DESC');
		$result = $this->db->get();
		return $result->result_array();
	}

	public function jumlah_pengeringan()
	{
		$this->db->select('*');
		$this->db->from('tb_pengeringan');
		$this->db->join('tb_pembelian', 'tb_pengeringan.kode_pembelian = tb_pembelian.kode_pembelian');
		$this->db->group_by('tb_pengeringan.kode_pembelian');
		$this->db->order_by('tb_pengeringan.kode_pembelian', 'DESC');
		$result = $this->db->get();
		return $result->num_rows();
	}

	public function get_pengeringan_done($limit, $start)
	{
		$this->db->select('*');
		$this->db->from('tb_pengeringan');
		$this->db->join('tb_pembelian', 'tb_pengeringan.kode_pembelian = tb_pembelian.kode_pembelian');
		$this->db->join('jenis_beras', 'tb_pengeringan.jenis_gabah = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_pengeringan.grade = grade.id_grade');
		$this->db->group_by('tb_pengeringan.kode_pembelian');
		$this->db->order_by('tb_pengeringan.kode_pembelian', 'DESC');
		$this->db->where('tb_pengeringan.tonase != 0');
		$this->db->limit($limit, $start);
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function print_pengeringan()
	{
		$this->db->select('*');
		$this->db->from('tb_pengeringan');
		$this->db->join('tb_pembelian', 'tb_pengeringan.kode_pembelian = tb_pembelian.kode_pembelian');
		$this->db->join('jenis_beras', 'tb_pengeringan.jenis_gabah = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_pengeringan.grade = grade.id_grade');
		$this->db->group_by('tb_pengeringan.kode_pembelian');
		$this->db->order_by('tb_pengeringan.kode_pembelian', 'DESC');
		$this->db->where('tb_pengeringan.tonase != 0');
		$result = $this->db->get();
		return $result->result_array();
	}

	public function giling()
	{
		$this->db->select('*');
		$this->db->from('tb_giling');
		$this->db->join('jenis_beras', 'tb_giling.jenis = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_giling.grade = grade.id_grade');
		$this->db->join('tb_user', 'tb_giling.id_user = tb_user.id_user');
		// $this->db->group_by('tb_stok_kg.grade');
		$this->db->order_by('tb_giling.tanggal', 'DESC');
		$result = $this->db->get();
		return $result->result_array();
	}

	public function jumlah_giling()
	{
		$this->db->select('*');
		$this->db->from('tb_giling');
		$this->db->join('jenis_beras', 'tb_giling.jenis = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_giling.grade = grade.id_grade');
		$this->db->join('tb_user', 'tb_giling.id_user = tb_user.id_user');
		// $this->db->group_by('tb_stok_kg.grade');
		$this->db->order_by('tb_giling.tanggal', 'DESC');
		$result = $this->db->get();
		return $result->num_rows();
	}

	// public function get_tonase($grade)
	// {
 //        $hsl = $this->db->query("SELECT * FROM tb_stok_kg WHERE musim='rojoan', jenis=1, grade='$grade' ");
 //            foreach ($hsl->result_array() as $data) {
 //                $hasil = [
 //                	'tonase' => $data['tonase']
 //                ];
 //            }
 //        return $hasil;
	// }

	public function get_giling($limit, $start)
	{
		$this->db->select('*');
		$this->db->from('tb_giling');
		$this->db->join('jenis_beras', 'tb_giling.jenis = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_giling.grade = grade.id_grade');
		$this->db->join('tb_user', 'tb_giling.id_user = tb_user.id_user');
		// $this->db->group_by('tb_stok_kg.grade');
		$this->db->where('tb_giling.tonase != 0');
		$this->db->order_by('tb_giling.tanggal', 'DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function get_giling_print()
	{
		$this->db->select('*');
		$this->db->from('tb_giling');
		$this->db->join('jenis_beras', 'tb_giling.jenis = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_giling.grade = grade.id_grade');
		$this->db->join('tb_user', 'tb_giling.id_user = tb_user.id_user');
		// $this->db->group_by('tb_stok_kg.grade');
		$this->db->where('tb_giling.tonase != 0');
		$this->db->order_by('tb_giling.tanggal', 'DESC');
// 		$this->db->limit($limit, $start);
		$result = $this->db->get();
		return $result->result_array();
	}

	public function detail_giling($id)
	{
		$this->db->select('*');
		$this->db->from('tb_giling');
		$this->db->join('jenis_beras', 'tb_giling.jenis = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_giling.grade = grade.id_grade');
		$this->db->join('tb_user', 'tb_giling.id_user = tb_user.id_user');
		$this->db->where('tb_giling.id_giling', $id);
		$this->db->order_by('tb_giling.tanggal', 'DESC');
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function detail_proses_giling($id)
	{
		$this->db->select('*');
		$this->db->from('tb_proses_giling');
		$this->db->where('tb_proses_giling.id_giling', $id);
		$this->db->order_by('tb_proses_giling.tanggal', 'DESC');
		$result = $this->db->get();
		return $result->result_array();
	}

	public function detail_pengeringan($kode)
	{
		$this->db->select('*');
		$this->db->from('tb_pengeringan');
		$this->db->join('jenis_beras', 'tb_pengeringan.jenis_gabah = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_pengeringan.grade = grade.id_grade');
		$this->db->join('tb_pembelian', 'tb_pengeringan.kode_pembelian = tb_pembelian.kode_pembelian');
		// $this->db->join('tb_user', 'tb_pe.id_user = tb_user.id_user');
		$this->db->group_by('tb_pengeringan.kode_pembelian');
		$this->db->order_by('tb_pengeringan.tanggal', 'DESC');
		$this->db->where('tb_pengeringan.kode_pembelian', $kode);
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function detail_proses_pengeringan($kode)
	{
		$this->db->select('*');
		$this->db->from('tb_proses_pengeringan');
		$this->db->join('jenis_beras', 'tb_proses_pengeringan.jenis = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_proses_pengeringan.grade = grade.id_grade');
// 		$this->db->join('tb_pembelian', 'tb_proses_pengeringan.kode_ = tb_pembelian.kode_pembelian');
// 		$this->db->order_by('tb_proses_pengeringan.tanggal', 'DESC');
		$this->db->where('tb_proses_pengeringan.nota', $kode);
		$result = $this->db->get();
		return $result->result_array();
	}

	public function detail_pembelian($kode)
	{
		$this->db->select('*');
		$this->db->from('tb_pembelian');
		$this->db->join('jenis_beras', 'tb_pembelian.jenis_gabah = jenis_beras.id_jenis');
		$this->db->join('grade', 'tb_pembelian.grade = grade.id_grade');
		$this->db->join('tb_user', 'tb_pembelian.id_user = tb_user.id_user');
		$this->db->group_by('tb_pembelian.kode_pembelian');
		$this->db->order_by('tb_pembelian.tanggal', 'DESC');
		$this->db->where('tb_pembelian.kode_pembelian', $kode);
		$result = $this->db->get();
		return $result->result_array();
	}

	public function delete_pembelian($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function delete_user($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function stock()
	{
		$this->db->select('*');
		$this->db->from('tb_stok_kg');
		$this->db->join('tb_pembelian', 'tb_pembelian.kode_pembelian = tb_stok_kg.kode_pembelian');
		$this->db->join('tb_user', 'tb_pembelian.id_user = tb_stok_kg.id_user');
		$this->db->group_by('tb_pembelian.kode_pembelian');
		$this->db->order_by('tb_stok_kg.tanggal', 'DESC');
		$result = $this->db->get();
		return $result->result_array();
	}

	public function jumlah_user(){
		return $this->db->get('tb_user')->num_rows();
	}
	public function data_user($number,$offset){
		return $query = $this->db->get('tb_user',$number,$offset)->result_array();		
	}
	
	public function add_grade(){
	    $data = [
	        'nama_grade' => $this->input->post('grade')
	   ];
	   $this->db->insert('grade', $data);
	   redirect('admin/grade');
	}
	
	public function edit_grade($id){
	   $this->db->set('nama_grade', $this->input->post('grade'));
	   $this->db->where('id_grade', $id);
	   $this->db->update('grade');
	   redirect('admin/grade');
	}
	
	public function delete_grade($id){
	    $this->db->delete('grade',['id_grade' => $id]);
	    redirect('admin/grade');
	}
	
	

}