<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// require('./application/third_party/phpoffice/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Admin extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_admin');
		$this->load->library('pagination');
		if ($this->session->userdata('username') === NULL) {
			redirect('auth/logout');
		}

	}

	public function index()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer', $data);
	}
	
	public function profil()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/profil', $data);
		$this->load->view('templates/footer', $data);
	}
	public function edit_user()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$id = $this->uri->segment(3);
		$data['edit'] = $this->M_admin->edit_user($id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/edit_user', $data);
		$this->load->view('templates/footer', $data);
	}
	public function update_profil()
	{
	    $id_user = $this->input->post('id_user');
	    $where = ['id_user' => $id_user];
	    $data = [
	        'username' => $this->input->post('username'),
	        'email' => $this->input->post('email'),
	        ];
	   $this->M_admin->update_profil($where, $data, 'tb_user');
	   redirect('admin/profil');
	}
	
	public function update_user()
	{
	    $id_user = $this->input->post('id_user');
	    $where = ['id_user' => $id_user];
	    $data = [
	        'username' => $this->input->post('username'),
	        'email' => $this->input->post('email'),
	        ];
	   $this->M_admin->update_profil($where, $data, 'tb_user');
	   redirect('admin/data_user');
	}

	public function stok_ks()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['jenis'] = $this->db->get('jenis_beras')->result_array();
		$data['grade'] = $this->db->get('grade')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/stok_ks', $data);
		$this->load->view('templates/footer', $data);
	}
	public function stok_merk()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['jenis'] = $this->db->get('jenis_beras')->result_array();
		$data['grade'] = $this->db->get('grade')->result_array();
		$data['stok_merk'] = $this->M_admin->join_merk();
		$data['jual_beras_kebi'] = $this->M_admin->get_jual_beras_kebi();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/stok_merk', $data);
		$this->load->view('templates/footer', $data);
	}

	public function print_excel()
    {
    		date_default_timezone_set('Asia/Jakarta');
	        $pembelian = $this->M_admin->pembelian();

	        require(APPPATH . 'PHPExcel/Classes/PHPExcel.php');
	        require(APPPATH . 'PHPExcel/Classes/PHPExcel/Writer/Excel2007.php');

	        $object = new PHPExcel();

	        $object->getProperties()->setCreator('Admin Sumber Rejeki Sejati');
	        $object->getProperties()->setLastModifiedBy('Sumber Rejeki Sejati');
	        $object->getProperties()->setTitle('Data Pembelian Gabah KS');

	        // style col
	        $style_col = array(
		      'font' => array('bold' => true),
		      'alignment' => array(
		        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		      ),
		      'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
		      )
		    );

		    $style_row = array(
		      'alignment' => array(
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		      ),
		      'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
		      )
		    );

	        // $object->setActiveSheetIndex(0);


	        $object->setActiveSheetIndex(0)->setCellValue('A1', "DATA PEMBELIAN GABAH KS");
	        $object->getActiveSheet()->mergeCells('A1:J1');
	        $object->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
    		$object->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
    		$object->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	        $object->getActiveSheet(0)->SetCellValue('A3', 'No');
	        $object->getActiveSheet(0)->SetCellValue('B3', 'Nota');
	        $object->getActiveSheet(0)->SetCellValue('C3', 'Nama Supplier');
	        $object->getActiveSheet(0)->SetCellValue('D3', 'Kendaraan');
	        $object->getActiveSheet(0)->SetCellValue('E3', 'Uraian');
	        $object->getActiveSheet(0)->SetCellValue('F3', 'Total Tonase');
	        $object->getActiveSheet(0)->SetCellValue('G3', 'Harga');
	        $object->getActiveSheet(0)->SetCellValue('H3', 'Keterangan');
	        $object->getActiveSheet(0)->SetCellValue('I3', 'User');
	        $object->getActiveSheet(0)->SetCellValue('J3', 'Tanggal');

	        $object->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);

	        $baris = 4;
	        $no = 1;

	        foreach ($pembelian as $list) {
	        	$this->db->select('SUM(tonase) as total_tonase');
              	$this->db->from('tb_pembelian');
              	$this->db->where('tb_pembelian.kode_pembelian', $list['kode_pembelian']);
              	$tonase = $this->db->get()->row()->total_tonase;

              	$this->db->select('SUM(total) as total_harga');
              	$this->db->from('tb_pembelian');
              	$this->db->where('tb_pembelian.kode_pembelian', $list['kode_pembelian']);
              	$total_harga = $this->db->get()->row()->total_harga;

	            $object->getActiveSheet(0)->SetCellValue('A' . $baris, $no++);
	            $object->getActiveSheet(0)->SetCellValue('B' . $baris, $list['kode_pembelian']);
	            $object->getActiveSheet(0)->SetCellValue('C' . $baris, $list['nama_supplier']);
	            $object->getActiveSheet(0)->SetCellValue('D' . $baris, $list['plat']);
	            $object->getActiveSheet(0)->SetCellValue('E' . $baris, $list['musim']);
	            $object->getActiveSheet(0)->SetCellValue('F' . $baris, $tonase.' Kg');
	            $object->getActiveSheet(0)->SetCellValue('G' . $baris, $total_harga);
	            $object->getActiveSheet(0)->SetCellValue('H' . $baris, $list['keterangan']);
	            $object->getActiveSheet(0)->SetCellValue('I' . $baris, $list['username']);
	            $object->getActiveSheet(0)->SetCellValue('J' . $baris, date('Y-m-d', strtotime($list['tanggal'])));

	            $object->getActiveSheet()->getStyle('A'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('B'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('C'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('D'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('E'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('F'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('G'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('H'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('I'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('J'.$baris)->applyFromArray($style_row);

	            $baris++;
	        }

	        // Set width kolom
		    $object->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		    $object->getActiveSheet()->getColumnDimension('B')->setWidth(10); // Set width kolom B
		    $object->getActiveSheet()->getColumnDimension('C')->setWidth(20); // Set width kolom C
		    $object->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
		    $object->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		    $object->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		    $object->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		    $object->getActiveSheet()->getColumnDimension('H')->setWidth(25);
		    $object->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		    $object->getActiveSheet()->getColumnDimension('J')->setWidth(20);

		    $object->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		    $object->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		    $date = date('Y-m-d H-i');
	        $filename = "Data Pembelian KS ". $date . '.xlsx';

	        $object->getActiveSheet(0)->setTitle('Data Pembelian Gabah KS');
	        $object->setActiveSheetIndex(0);

	        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	        header('Content-Disposition: attachment; filename="' . $filename . '"');
	        header('Cache-Control: max-age=0');

	        $writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
	        $writer->save('php://output');

	        exit;
	}

	public function print_excel_giling()
    {
    		date_default_timezone_set('Asia/Jakarta');
	        $giling = $this->M_admin->get_giling_print();

	        require(APPPATH . 'PHPExcel/Classes/PHPExcel.php');
	        require(APPPATH . 'PHPExcel/Classes/PHPExcel/Writer/Excel2007.php');

	        $object = new PHPExcel();

	        $object->getProperties()->setCreator('Admin Sumber Rejeki Sejati');
	        $object->getProperties()->setLastModifiedBy('Sumber Rejeki Sejati');
	        $object->getProperties()->setTitle('Data Proses Penggilingan');

	        // style col
	        $style_col = array(
		      'font' => array('bold' => true),
		      'alignment' => array(
		        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		      ),
		      'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
		      )
		    );

		    $style_row = array(
		      'alignment' => array(
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		      ),
		      'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
		      )
		    );

	        // $object->setActiveSheetIndex(0);


	        $object->setActiveSheetIndex(0)->setCellValue('A1', "DATA PENGGILINGAN GABAH");
	        $object->getActiveSheet()->mergeCells('A1:E1');
	        $object->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
    		$object->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
    		$object->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	        $object->getActiveSheet(0)->SetCellValue('A3', 'No');
	        $object->getActiveSheet(0)->SetCellValue('B3', 'Beras');
	        $object->getActiveSheet(0)->SetCellValue('C3', 'Tonase');
	        $object->getActiveSheet(0)->SetCellValue('D3', 'Hasil Penggilingan');
	        $object->getActiveSheet(0)->SetCellValue('E3', 'Status');

	        $object->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);

	        $baris = 4;
	        $no = 1;

	        foreach ($giling as $list) {

	            $object->getActiveSheet(0)->SetCellValue('A' . $baris, $no++);
	            $object->getActiveSheet(0)->SetCellValue('B' . $baris, $list['musim'].'=>'.$list['nama_jenis'].'('.$list['nama_grade'].')');
	            $object->getActiveSheet(0)->SetCellValue('C' . $baris, $list['tonase'].' Kg');
	            $object->getActiveSheet(0)->SetCellValue('D' . $baris, 'Beras = '.$list['hasil_beras'].', Menir = '. $list['hasil_menir'].', Katul = '.$list['hasil_katul']);
	            if ($list['status'] == 1) {
	            	$object->getActiveSheet(0)->SetCellValue('E' . $baris, 'Belum Selesai');
	            }
	            if ($list['status'] == 2) {
	            	$object->getActiveSheet(0)->SetCellValue('E' . $baris, 'Selesai');
	            }

	            $object->getActiveSheet()->getStyle('A'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('B'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('C'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('D'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('E'.$baris)->applyFromArray($style_row);

	            $baris++;
	        }

	        // Set width kolom
		    $object->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		    $object->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
		    $object->getActiveSheet()->getColumnDimension('C')->setWidth(10); // Set width kolom C
		    $object->getActiveSheet()->getColumnDimension('D')->setWidth(40); // Set width kolom D
		    $object->getActiveSheet()->getColumnDimension('E')->setWidth(15);

		    $object->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		    $object->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		    $date = date('Y-m-d H-i');
	        $filename = "Data Penggilingan Gabah ". $date . '.xlsx';

	        $object->getActiveSheet(0)->setTitle('Data Penggilingan Gabah KS');
	        $object->setActiveSheetIndex(0);

	        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	        header('Content-Disposition: attachment; filename="' . $filename . '"');
	        header('Cache-Control: max-age=0');

	        $writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
	        $writer->save('php://output');

	        exit;
	}

	// pembelian
	public function pembelian()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$jumlah = $this->M_admin->jumlah_pembelian();
		// pagination
		$config['base_url'] = 'http://penggilinganberas.kreatindo.com/admin/pembelian';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 10;
		$config['num_links'] = 2;
		// style
		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '<li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '<li>';

		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '<li>';

		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '<li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a><li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '<li>';

		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);
		// pagination
		$data['start'] = $this->uri->segment(3);
		$data['pembelian'] = $this->M_admin->pembelian($config['per_page'], $data['start']);
		$data['jumlah'] = $this->M_admin->jumlah_pembelian();

		$data['jenis'] = $this->db->get('jenis_beras')->result_array();
		$data['grade'] = $this->db->get('grade')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/pembelian', $data);
		$this->load->view('templates/footer', $data);
	}
	
	
	public function edit_pembelian($kode){
	    $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
	    
	    $data['pelanggan'] = $this->db->get_where('tb_pembelian',['kode_pembelian' => $kode])->row();
	    $data['jenis'] = $this->db->get('jenis_beras')->result();
	    $data['G_grade'] = $this->db->get('grade')->result_array();
	    
	    $this->form_validation->set_rules('id_user', 'User', 'trim|required');
		$this->form_validation->set_rules('kode_pembelian', 'Kode', 'trim|required');
		$this->form_validation->set_rules('nama_supplier', 'Suplier', 'trim|required');
		$this->form_validation->set_rules('nama_supir', 'Supir', 'trim|required');
		$this->form_validation->set_rules('plat', 'Plat', 'trim|required');
	    
	    if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/edit_pembelian', $data);
		$this->load->view('templates/footer', $data);
	    } else {
	       
	        $id_user = $this->input->post('id_user');
            $kode_pembelian = $this->input->post('kode_pembelian');
            $nama_supplier = $this->input->post('nama_supplier');
            $nama_supir = $this->input->post('nama_supir');
            $plat = $this->input->post('plat');

            $jenis_gabah = $this->input->post('jenis_gabah');
            $grade = $this->input->post('grade[]');
            $tonase = $this->input->post('tonase[]');
            $harga_kg = $this->input->post('harga_kg[]');
            $total = $this->input->post('total[]');
            $musim = $this->input->post('musim');
            $no_penjemuran = $this->input->post('no_penjemuran');
            $keterangan = $this->input->post('keterangan');
            $tanggal = $this->input->post('tanggal');
            $id_pembelian = $this->input->post('id[]');
            // 
            $result = [];
            $no = 0;
            $i=0;
            $grade = $this->input->post('grade[]');
            foreach ($grade as $key => $value) {
                $result[$no] = [
                    'id_pembelian' => $_POST['id'][$no],
                	'id_user' => $id_user,
                	'kode_pembelian' => $kode_pembelian,
                    'nama_supplier' => $nama_supplier,
                    'nama_supir' => $nama_supir,
                    'plat' => $plat,
                    'jenis_gabah' => $jenis_gabah,
                    'ka' => $_POST['ka'][$no],
                    'grade' => $_POST['grade'][$no],
                    'tonase' => $_POST['tonase'][$no],
                    'harga_kg' => $_POST['harga_kg'][$no],
                    'total' => $_POST['total'][$no],
                    'musim' => $musim,
                    'keterangan' => $keterangan,
                    'tanggal' => $tanggal
                ];
                $no++;
            }

            //
            $resultes = [];
            $nom = 0;
            $jenis_gabah = $this->input->post('jenis_gabah');
            $grade = $this->input->post('grade[]');
            foreach ($grade as $key => $value) {
                $resultes[$nom] = [
                    'kode_pembelian' => $kode_pembelian,
                    'jenis_gabah' => $jenis_gabah,
                    'grade' => $_POST['grade'][$nom],
                    'tonase' => $_POST['tonase'][$nom],
                    'musim' => $musim,
                    'status' => 'Belum Selesai',
                    'tanggal' => $tanggal
                ];
                $nom++;
        	}
        	$i=0;
        	foreach ($grade as $key => $value) {
        		$stok[$i] = [
                	'kode_pembelian' => $kode_pembelian,
                    'jenis' => $jenis_gabah,
                    'grade' => $_POST['grade'][$i],
                    'tonase' => $_POST['tonase'][$i],
                    'musim' => $musim,
                    'tanggal' => $tanggal
                ];
              $i++;
        	}
        // 	var_dump($result);
        // 	die;
            
        	$this->db->update_batch('tb_pembelian', $result, 'id_pembelian');
        	$this->db->update_batch('tb_stok_ks', $stok, 'kode_pembelian');
        	$this->db->update_batch('tb_pengeringan', $resultes, 'kode_pembelian');
        	redirect('admin/pembelian'); 
	       
	       
	    }
	}
	
	
	public function cetakPembelian()
	{
		$this->load->library('M_pdf');
		$kode_pembelian = $this->security->xss_clean($this->uri->segment(3));
		$data['detail'] = $this->M_admin->detail_pembelian($kode_pembelian);
		$html = $this->load->view('admin/cetak_pembelian', $data);
		$output = $this->output->get_output($html);
		$filename = 'Nota Pembelian-'.$kode_pembelian.uniqid().'.pdf';
		$this->m_pdf->pdf->setTitle('Nota Pembelian Gabah KS' , 'UTF-8');
		$this->m_pdf->pdf->WriteHTML($output);
		$this->m_pdf->pdf->Output('pdf/'.$filename, "F");
		header('Location: '.base_url().'pdf/'.$filename);

	}
	public function cetak_jual_beras()
	{
		$this->load->library('M_pdf');
		$kode = $this->security->xss_clean($this->uri->segment(3));
		$data['detail'] = $this->M_admin->get_jual_beras($kode);
		$html = $this->load->view('admin/cetak_jual_beras', $data);
		$output = $this->output->get_output($html);
		$filename = 'Nota Penjualan-'.$kode.uniqid().'.pdf';
		$this->m_pdf->pdf->setTitle('Nota Penjualan Beras' , 'UTF-8');
		$this->m_pdf->pdf->WriteHTML($output);
		$this->m_pdf->pdf->Output('pdf/'.$filename, "F");
		header('Location: '.base_url().'pdf/'.$filename);

	}
	public function cetak_beli_beras()
	{
		$this->load->library('M_pdf');
		$kode = $this->security->xss_clean($this->uri->segment(3));
		$data['detail'] = $this->M_admin->get_beli_beras($kode);
		$html = $this->load->view('admin/cetak_beli_beras', $data);
		$output = $this->output->get_output($html);
		$filename = 'Nota Pembelian Beras-'.$kode.uniqid().'.pdf';
		$this->m_pdf->pdf->setTitle('Nota Pembelian Beras' , 'UTF-8');
		$this->m_pdf->pdf->WriteHTML($output);
		$this->m_pdf->pdf->Output('pdf/'.$filename, "F");
		header('Location: '.base_url().'pdf/'.$filename);

	}
	public function cetak_jual_kg()
	{
		$this->load->library('M_pdf');
		$kode_pembelian = $this->security->xss_clean($this->uri->segment(3));
		$data['detail'] = $this->M_admin->cetak_jual_kg($kode_pembelian);
		$html = $this->load->view('admin/cetak_jual_kg', $data);
		$output = $this->output->get_output($html);
		$filename = 'Nota Penjualan KG-'.$kode_pembelian.uniqid().'.pdf';
		$this->m_pdf->pdf->setTitle('Nota Penjuakan Gabah KG' , 'UTF-8');
		$this->m_pdf->pdf->WriteHTML($output);
		$this->m_pdf->pdf->Output('pdf/'.$filename, "F");
		header('Location: '.base_url().'pdf/'.$filename);

	}
	public function cetak_beli_kg()
	{
		$this->load->library('M_pdf');
		$kode_pembelian = $this->security->xss_clean($this->uri->segment(3));
		$data['detail'] = $this->M_admin->cetak_beli_kg($kode_pembelian);
		$html = $this->load->view('admin/cetak_beli_kg', $data);
		$output = $this->output->get_output($html);
		$filename = 'Nota Pembelian KG-'.$kode_pembelian.uniqid().'.pdf';
		$this->m_pdf->pdf->setTitle('Nota Pembelian Gabah KG' , 'UTF-8');
		$this->m_pdf->pdf->WriteHTML($output);
		$this->m_pdf->pdf->Output('pdf/'.$filename, "F");
		header('Location: '.base_url().'pdf/'.$filename);

	}
	public function jual_stok(){
	    $data = [
	        'jenis_hasil' => $this->input->post('jenis_hasil'),
	        'jumlah' => $this->input->post('jumlah'),
	        'total_harga' => $this->input->post('total_harga'),
	        ];
	   $this->db->insert('tb_jual_stok', $data);
	        $this->db->select('*');
			$this->db->from('tb_hasil_giling');
			$this->db->where('id_hasil', $this->input->post('jenis_hasil'));
			$stok = $this->db->get()->result_array();
			foreach ($stok as $s) {
    			$awal = $s['jumlah'];
			}
			$akhir = $awal - $this->input->post('jumlah');
			$data = [
			    'jumlah' => $akhir,
			    ];

				$where = [
				    'id_hasil' => $this->input->post('jenis_hasil')
				    ];
				$this->M_admin->update_hasil_stok($where, $data, 'tb_hasil_giling');
				redirect('admin/stok_katul'); 
     }
	public function getKode()
    {
        // $this->load->model('model_data');
        $hasil = $this->db->query("select kode_pembelian from tb_pembelian ORDER BY kode_pembelian DESC LIMIT 1");
        if ($hasil->num_rows() > 0) {
            $nmr = explode('_', $hasil->row()->kode_pembelian);
            $data = sprintf("%04d", $nmr[1] + 1);
        } else {
            $data = '0001';
        }
        echo json_encode($data);
    }
    public function getKodeBeliBeras()
    {
        // $this->load->model('model_data');
        $hasil = $this->db->query("select kode_pembelian from tb_beli_beras ORDER BY kode_pembelian DESC LIMIT 1");
        if ($hasil->num_rows() > 0) {
            $nmr = explode('_', $hasil->row()->kode_pembelian);
            $data = sprintf("%04d", $nmr[1] + 1);
        } else {
            $data = '0001';
        }
        echo json_encode($data);
    }
    public function getNotaJual()
    {
        // $this->load->model('model_data');
        $hasil = $this->db->query("select nota_penjualan from tb_jual_kg ORDER BY nota_penjualan DESC LIMIT 1");
        if ($hasil->num_rows() > 0) {
            $nmr = explode('_', $hasil->row()->nota_penjualan);
            $data = sprintf("%04d", $nmr[1] + 1);
        } else {
            $data = '0001';
        }
        echo json_encode($data);
    }
    public function getNotaJualks()
    {
        // $this->load->model('model_data');
        $hasil = $this->db->query("select kode_jual from tb_jual_ks ORDER BY kode_jual DESC LIMIT 1");
        if ($hasil->num_rows() > 0) {
            $nmr = explode('_', $hasil->row()->kode_jual);
            $data = sprintf("%04d", $nmr[1] + 1);
        } else {
            $data = '0001';
        }
        echo json_encode($data);
    }
    public function getNotaBeli()
    {
        // $this->load->model('model_data');
        $hasil = $this->db->query("select kode_pembelian from tb_beli_kg ORDER BY kode_pembelian DESC LIMIT 1");
        if ($hasil->num_rows() > 0) {
            $nmr = explode('_', $hasil->row()->kode_pembelian);
            $data = sprintf("%04d", $nmr[1] + 1);
        } else {
            $data = '0001';
        }
        echo json_encode($data);
    }
    public function getKodeKebi()
    {
        // $this->load->model('model_data');
        $hasil = $this->db->query("select kode_kebi from tb_kebi ORDER BY kode_kebi DESC LIMIT 1");
        if ($hasil->num_rows() > 0) {
            $nmr = explode('_', $hasil->row()->kode_kebi);
            $data = sprintf("%04d", $nmr[1] + 1);
        } else {
            $data = '0001';
        }
        echo json_encode($data);
    }
    public function jual_beras_kebi()
	{
	    $merk = $this->input->post('merk');
	    $ukuran = $this->input->post('ukuran');
	    
	   // update
	        $this->db->select('*');
			$this->db->from('tb_beras_kebi');
			$this->db->where('tb_beras_kebi.merk', $merk);
			$this->db->limit(1);
			$result = $this->db->get()->result_array();
	   
	   foreach($result as $b){
	       $lima = $b['5kg'] - $this->input->post('jumlah');
	       $sepuluh = $b['10kg'] - $this->input->post('jumlah');
	       $dualima = $b['25kg'] - $this->input->post('jumlah');
	       $limapuluh = $b['50kg'] - $this->input->post('jumlah');
	   }
	       if($ukuran == '5kg'){
	           $where = [
	            'merk' => $merk
	           ];
	           $data = [
	            '5kg' => $lima
	           ];
	           $this->M_admin->jual_beras_kebi($where, $data, 'tb_beras_kebi');
	       }elseif($ukuran == '10kg'){
	           $where = [
	            'merk' => $merk
	           ];
	           $data = [
	            '10kg' => $sepuluh
	           ];
	           $this->M_admin->jual_beras_kebi($where, $data, 'tb_beras_kebi');
	       }elseif($ukuran == '25kg'){
	           $where = [
	            'merk' => $merk
	           ];
	           $data = [
	            '25kg' => $dualima
	           ];
	           $this->M_admin->jual_beras_kebi($where, $data, 'tb_beras_kebi');
	       }else{
	           $where = [
	            'merk' => $merk
	           ];
	           $data = [
	            '50kg' => $limapuluhpuluh
	           ];
	           $this->M_admin->jual_beras_kebi($where, $data, 'tb_beras_kebi');
	       }
	   // insert
	   $data = [
	        'merk' => $this->input->post('merk'),
	        'ukuran' => $this->input->post('ukuran'),
	        'jumlah' => $this->input->post('jumlah'),
	        'total_harga' => $this->input->post('total_harga')
	        ];
	   $this->db->insert('tb_jual_beras_kebi', $data);
	   redirect('admin/stok_merk');
	   
	}
    public function tambah_pembelian()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['jenis'] = $this->db->get('jenis_beras')->result_array();
		$data['grade'] = $this->db->get('grade')->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/tambah_pembelian', $data);
		$this->load->view('template/footer');
	}
	public function proses_add_pembelian()
	{
		$this->form_validation->set_rules('id_user', 'User', 'trim|required');
		$this->form_validation->set_rules('kode_pembelian', 'Kode', 'trim|required');
		$this->form_validation->set_rules('nama_supplier', 'Suplier', 'trim|required');
		$this->form_validation->set_rules('nama_supir', 'Supir', 'trim|required');
		$this->form_validation->set_rules('plat', 'Plat', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
			$this->load->view('template/header', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('admin/tambah_pembelian', $data);
			$this->load->view('template/footer', $data);
		}else{
			$id_user = $this->input->post('id_user');
            $kode_pembelian = $this->input->post('kode_pembelian');
            $nama_supplier = $this->input->post('nama_supplier');
            $nama_supir = $this->input->post('nama_supir');
            $plat = $this->input->post('plat');

            $jenis_gabah = $this->input->post('jenis_gabah');
            $grade = $this->input->post('grade[]');
            $tonase = $this->input->post('tonase[]');
            $harga_kg = $this->input->post('harga_kg[]');
            $total = $this->input->post('total[]');
            $musim = $this->input->post('musim');
            $no_penjemuran = $this->input->post('no_penjemuran');
            $keterangan = $this->input->post('keterangan');
            $tanggal = $this->input->post('tanggal');

            // 
            $result = [];
            $no = 0;
            $i=0;
            $grade = $this->input->post('grade[]');
            foreach ($grade as $key => $value) {
                $result[$no] = [
                	'id_user' => $id_user,
                    'kode_pembelian' => $kode_pembelian,
                    'nama_supplier' => $nama_supplier,
                    'nama_supir' => $nama_supir,
                    'plat' => $plat,
                    'jenis_gabah' => $jenis_gabah,
                    'ka' => $_POST['ka'][$no],
                    'grade' => $_POST['grade'][$no],
                    'tonase' => $_POST['tonase'][$no],
                    'harga_kg' => $_POST['harga_kg'][$no],
                    'total' => $_POST['total'][$no],
                    'musim' => $musim,
                    'keterangan' => $keterangan,
                    'tanggal' => $tanggal
                ];
                $no++;
            }

            //
            $resultes = [];
            $nom = 0;
            $jenis_gabah = $this->input->post('jenis_gabah');
            $grade = $this->input->post('grade[]');
            foreach ($grade as $key => $value) {
                $resultes[$nom] = [
                    'kode_pembelian' => $kode_pembelian,
                    'jenis_gabah' => $jenis_gabah,
                    'grade' => $_POST['grade'][$nom],
                    'tonase' => $_POST['tonase'][$nom],
                    // 'ka' => $_POST['ka'],
                    'musim' => $musim,
                    'status' => 'Belum Selesai',
                    'tanggal' => $tanggal
                ];
                $nom++;
        	}
        	$i=0;
        	foreach ($grade as $key => $value) {
        		$stok[$i] = [
                	'kode_pembelian' => $kode_pembelian,
                    'jenis' => $jenis_gabah,
                    'grade' => $_POST['grade'][$i],
                    'tonase' => $_POST['tonase'][$i],
                    'musim' => $musim,
                    'tanggal' => $tanggal
                ];
              $i++;
        	}
        	$this->db->insert_batch('tb_pembelian', $result);
        	$this->db->insert_batch('tb_stok_ks', $stok);
        	$this->db->insert_batch('tb_pengeringan', $resultes);
        	redirect('admin/pembelian'); 

		}
	}
	public function detail_pembelian()
	{
		$kode = $this->uri->segment(3);
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['detail'] = $this->M_admin->detail_pembelian($kode);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/detail_pembelian', $data);
		$this->load->view('templates/footer', $data);
	}
	public function hapus_pembelian()
	{
		$kode = $this->uri->segment(3);
		$where = array(
            'kode_pembelian' => $kode,
        );

        $this->M_admin->delete_pembelian($where, 'tb_pembelian');
        redirect('admin/pembelian');
	}

	// proses pengeringan
	public function proses_pengeringan()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$jumlah = $this->M_admin->jumlah_pengeringan();
		// pagination
		$config['base_url'] = 'http://penggilinganberas.kreatindo.com/admin/proses_pengeringan';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 20;
		$config['num_links'] = 2;
		// style
		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '<li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '<li>';

		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '<li>';

		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '<li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a><li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '<li>';

		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);
		// pagination
		$data['start'] = $this->uri->segment(3);
		$data['pengeringan_done'] = $this->M_admin->get_pengeringan_done($config['per_page'], $data['start']);
		$data['pembelian'] = $this->M_admin->pembelian();
		$data['jenis'] = $this->db->get('jenis_beras')->result_array();
		$data['grade'] = $this->db->get('grade')->result_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/proses_pengeringan', $data);
		$this->load->view('templates/footer', $data);
	}
	public function selesai_proses_pengeringan()
	{
	    $data = [
	        'status' => 'Selesai'
	        ];
	    $where = [
	        'kode_pembelian' => $this->input->post('kode_pembelian')
	        ];
	   $this->db->update('tb_pengeringan', $data, $where);
	   
	   $dataa = [
	        'status' => 1
	       ];
	   $where = [
	        'nota' => $this->input->post('kode_pembelian')
	       ];
	   $this->db->update('tb_proses_pengeringan', $dataa, $wheree);
	   
	   redirect('admin/detail_pengeringan/'.$this->input->post('kode_pembelian'));
	   
	}
	public function detail_pengeringan()
	{
		$kode = $this->uri->segment(3);
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['detail'] = $this->M_admin->detail_pengeringan($kode);
		$data['proses_pengeringan'] = $this->M_admin->detail_proses_pengeringan($kode);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/detail_pengeringan', $data);
		$this->load->view('templates/footer', $data);
	}
	public function add_proses_pengeringan()
	{
	    $id_pengeringan = $this->input->post('id_pengeringan');
		$kode_pembelian = $this->input->post('kode_pembelian');
		$jenis = $this->input->post('jenis');
		$grade = $this->input->post('grade');
		$musim = $this->input->post('musim');
		$tonase = $this->input->post('tonase');
		$berat = $this->input->post('berat');
		$teknik = $this->input->post('teknik');
		$penyusutan = $this->input->post('penyusutan');
		
		$data = [
		        'nota' => $kode_pembelian,
		        'musim' => $musim,
		        'grade' => $grade,
		        'jenis' => $jenis,
		        'teknik' => $teknik,
		        'hasil' =>  $penyusutan,
		        'tanggal' => date('Y-m-d')
		    ];
		 $this->db->insert('tb_proses_pengeringan', $data);
		 
		 $this->db->select('*');
		 $this->db->from('tb_pengeringan');
		 $this->db->where('jenis_gabah', $jenis);
		 $this->db->where('grade', $grade);
		 $this->db->where('musim', $musim);
		 $this->db->where('kode_pembelian', $kode_pembelian);
		 $get = $this->db->get()->result_array();
		 foreach($get as $g){
		     $hasil = $g['penyusutan'];
		 }
		 $data = [
		     'penyusutan' => $hasil + $penyusutan,
		     'teknik' => $teknik
		     ];
		 $where = [
		     'jenis_gabah' => $jenis,
		     'grade' => $grade,
		     'musim' => $musim,
		     'kode_pembelian' => $kode_pembelian
		     ];
		 $this->db->update('tb_pengeringan', $data, $where);
		 
		 $this->db->select('*');
		 $this->db->from('tb_stok_kg');
		 $this->db->where('jenis', $jenis);
		 $this->db->where('grade', $grade);
		 $this->db->where('musim', $musim);
		 $kering = $this->db->get();
		 
		 if($kering->num_rows() > 0){
		     foreach($kering->result_array() as $k){
		         $tonase = $k['tonase'];
		     }
		     $dataa = [
		            'tonase' => $tonase + $penyusutan,
		         ];
		    $wheree = [
		             'jenis' => $jenis,
        		     'grade' => $grade,
        		     'musim' => $musim,
		        ];
		    $this->db->update('tb_stok_kg', $dataa, $wheree);
		    redirect('admin/detail_pengeringan/'.$kode_pembelian);
		 }else{
		     $data = [
		             'jenis' => $jenis,
        		     'grade' => $grade,
        		     'musim' => $musim,
        		     'tonase' => $penyusutan
		         ];
		      $this->db->insert('tb_stok_kg', $data);
		      redirect('admin/detail_pengeringan/'.$kode_pembelian);
		 }
		 
		 
		
	}
	public function proses_add_pengeringan()
	{
		$id_pengeringan = $this->input->post('id_pengeringan');
		$kode_pembelian = $this->input->post('kode_pembelian');
		$jenis = $this->input->post('jenis');
		$grade = $this->input->post('grade');
		$musim = $this->input->post('musim');
		$tonase = $this->input->post('tonase');
		$berat = $this->input->post('berat');
		$teknik = $this->input->post('teknik');
		$penyusutan = $this->input->post('penyusutan');

		// select
		$this->db->select('*');
		$this->db->from('tb_stok_kg');
		$this->db->where('tb_stok_kg.musim', $musim);
		$this->db->where('tb_stok_kg.grade', $grade);
		$this->db->where('tb_stok_kg.jenis', $jenis);
		$result = $this->db->get()->num_rows();

		if($result != 0){
			$berat = $this->input->post('berat');
			$tonase = $this->input->post('tonase');
			$this->db->select('*');
			$this->db->from('tb_stok_kg');
			$this->db->where('tb_stok_kg.musim', $musim);
			$this->db->where('tb_stok_kg.grade', $grade);
			$this->db->where('tb_stok_kg.jenis', $jenis);
			$this->db->limit(1);
			$result = $this->db->get()->result_array();

			foreach ($result as $r) {
				$berat = $this->input->post('berat');
				$total = $berat + $r['tonase'] - 0.01;

				$datan = array(
					'tonase' => $total,
					'tanggal' => date('Y-m-d')
				);

				$wheren = array(
					'musim' => $musim,
					'jenis' => $jenis,
					'grade' => $grade
				);
				$this->M_admin->update_stok_kg($wheren, $datan, 'tb_stok_kg');

				// jemur kering giling
				$this->db->select('*');
				$this->db->from('tb_stok_jemur_kg');
				$this->db->where('tb_stok_jemur_kg.musim_j', $musim);
				$this->db->where('tb_stok_jemur_kg.grade_j', $grade);
				$this->db->where('tb_stok_jemur_kg.jenis_j', $jenis);
				$result = $this->db->get()->num_rows();
				if ($result != 0) {
					$this->db->select('*');
					$this->db->from('tb_stok_jemur_kg');
					$this->db->where('tb_stok_jemur_kg.musim_j', $musim);
					$this->db->where('tb_stok_jemur_kg.grade_j', $grade);
					$this->db->where('tb_stok_jemur_kg.jenis_j', $jenis);
					$this->db->limit(1);
					$jemur = $this->db->get()->result_array();

					foreach ($jemur as $r) {
						$berat = $this->input->post('berat');
						$total = $berat + $r['tonase_j'];

						$dataj = array(
							'tonase_j' => $total,
							'tanggal_j' => date('Y-m-d')
						);

						$wherej = array(
							'musim_j' => $musim,
							'jenis_j' => $jenis,
							'grade_j' => $grade
						);
						$this->M_admin->update_jemur_stok($wherej, $dataj, 'tb_stok_jemur_kg');
					}
				}else{
					$berat = $this->input->post('berat');
					$datas = [
						'musim_j' => $musim,
						'jenis_j' => $jenis,
						'grade_j' => $grade,
						'tonase_j' => $berat,
						'tanggal_j' => date('Y-m-d')
					];
					$this->db->insert('tb_stok_jemur_kg', $datas);
				}

				$this->db->select('*');
				$this->db->from('tb_pengeringan');
				$this->db->where('tb_pengeringan.musim', $musim);
				$this->db->where('tb_pengeringan.grade', $grade);
				$this->db->where('tb_pengeringan.jenis_gabah', $jenis);
				$this->db->limit(1);
				$pengeringan = $this->db->get()->result_array();
				foreach ($pengeringan as $p) {
					// pengeringan
					$id_pengeringan = $this->input->post('id_pengeringan');
					$tonase = $this->input->post('tonase');
					$data = array(
						'tonase' => 0,
						'penyusutan' => $this->input->post('penyusutan'),
						'teknik' => $this->input->post('teknik')
					);

					$where = array(
						'id_pengeringan' => $id_pengeringan,
						'kode_pembelian' => $kode_pembelian
					);
					$this->M_admin->update_pengeringan($where, $data, 'tb_pengeringan');
					
				}
				redirect('admin/detail_pengeringan/'.$kode_pembelian);
			}

			}else{
			$berat = $this->input->post('berat');
			$datas = [
				'musim' => $musim,
				'jenis' => $jenis,
				'grade' => $grade,
				'tonase' => $berat,
				'tanggal' => date('Y-m-d')
			];
			$this->db->insert('tb_stok_kg', $datas);

			// jemur
			$this->db->select('*');
			$this->db->from('tb_stok_jemur_kg');
			$this->db->where('tb_stok_jemur_kg.musim_j', $musim);
			$this->db->where('tb_stok_jemur_kg.grade_j', $grade);
			$this->db->where('tb_stok_jemur_kg.jenis_j', $jenis);
			$result = $this->db->get()->num_rows();
			if ($result != 0) {
				$this->db->select('*');
				$this->db->from('tb_stok_jemur_kg');
				$this->db->where('tb_stok_jemur_kg.musim_j', $musim);
				$this->db->where('tb_stok_jemur_kg.grade_j', $grade);
				$this->db->where('tb_stok_jemur_kg.jenis_j', $jenis);
				$this->db->limit(1);
				$jemur = $this->db->get()->result_array();

				foreach ($jemur as $r) {
					$berat = $this->input->post('berat');
					$total = $berat + $r['tonase_j'];

					$dataj = array(
						'tonase_j' => $total,
						'tanggal_j' => date('Y-m-d')
					);

					$wherej = array(
						'musim_j' => $musim,
						'jenis_j' => $jenis,
						'grade_j' => $grade
					);
					$this->M_admin->update_jemur_stok($wherej, $dataj, 'tb_stok_jemur_kg');
				}
			}else{
				$berat = $this->input->post('berat');
				$datas = [
					'musim_j' => $musim,
					'jenis_j' => $jenis,
					'grade_j' => $grade,
					'tonase_j' => $berat,
					'tanggal_j' => date('Y-m-d')
				];
				$this->db->insert('tb_stok_jemur_kg', $datas);
			}

			//  update pengeringan
			$id_pengeringan = $this->input->post('id_pengeringan');
			$tonase = $this->input->post('tonase');
			$datad = array(
				'tonase' => $tonase,
				'penyusutan' => $this->input->post('penyusutan'),
				'teknik' => $this->input->post('teknik')
			);

			$whered = array(
				'id_pengeringan' => $id_pengeringan,
				'kode_pembelian' => $kode_pembelian
			);

			$this->M_admin->update_pengeringan($whered, $datad, 'tb_pengeringan');
			redirect('admin/detail_pengeringan/'.$kode_pembelian);
		}
		
	}
	public function print_pengeringan()
    {
    		date_default_timezone_set('Asia/Jakarta');
	        $pengeringan = $this->M_admin->print_pengeringan();
	        $grade = $this->db->get('grade')->result_array();

	        require(APPPATH . 'PHPExcel/Classes/PHPExcel.php');
	        require(APPPATH . 'PHPExcel/Classes/PHPExcel/Writer/Excel2007.php');

	        $object = new PHPExcel();

	        $object->getProperties()->setCreator('Admin Sumber Rejeki Sejati');
	        $object->getProperties()->setLastModifiedBy('Sumber Rejeki Sejati');
	        $object->getProperties()->setTitle('Data Proses Pengeringan');

	        // style col
	        $style_col = array(
		      'font' => array('bold' => true),
		      'alignment' => array(
		        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		      ),
		      'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
		      )
		    );

		    $style_row = array(
		      'alignment' => array(
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		      ),
		      'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
		      )
		    );

	        // $object->setActiveSheetIndex(0);


	        $object->setActiveSheetIndex(0)->setCellValue('A1', "DATA PENGERINGAN GABAH");
	        $object->getActiveSheet()->mergeCells('A1:F1');
	        $object->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
    		$object->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
    		$object->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	        $object->getActiveSheet(0)->SetCellValue('A3', 'No');
	        $object->getActiveSheet(0)->SetCellValue('B3', 'No Nota');
	        $object->getActiveSheet(0)->SetCellValue('C3', 'Supplier');
	        $object->getActiveSheet(0)->SetCellValue('D3', 'Uraian');
	        $object->getActiveSheet(0)->SetCellValue('E3', 'Total Tonase');
	        $object->getActiveSheet(0)->SetCellValue('F3', 'Belum Kering');

	        $object->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		    $object->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);

	        $baris = 4;
	        $no = 1;

	        foreach ($pengeringan as $list) {
              $this->db->select('SUM(tonase) as total_tonase');
              $this->db->from('tb_pengeringan');
              $this->db->where('tb_pengeringan.kode_pembelian', $list['kode_pembelian']);
              $tonase = $this->db->get()->row()->total_tonase;

              $this->db->select('SUM(tonase) as total_tonase');
              $this->db->from('tb_pembelian');
              $this->db->where('tb_pembelian.kode_pembelian', $list['kode_pembelian']);
              $berat_awal = $this->db->get()->row()->total_tonase;

              $akhir = $berat_awal - $tonase;
              $persen = (($berat_awal - $akhir) / $berat_awal) * 100;

	            $object->getActiveSheet(0)->SetCellValue('A' . $baris, $no++);
	            $object->getActiveSheet(0)->SetCellValue('B' . $baris, $list['kode_pembelian']);
	            $object->getActiveSheet(0)->SetCellValue('C' . $baris, $list['nama_supplier']);
	            $object->getActiveSheet(0)->SetCellValue('D' . $baris, $list['musim'].' ( '. $list['nama_jenis'].' )');
	            
	            $object->getActiveSheet(0)->SetCellValue('E' . $baris, $berat_awal.' Kg');
	            $object->getActiveSheet(0)->SetCellValue('F' . $baris, $tonase. ' Kg');

	            $object->getActiveSheet()->getStyle('A'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('B'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('C'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('D'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('E'.$baris)->applyFromArray($style_row);
			    $object->getActiveSheet()->getStyle('F'.$baris)->applyFromArray($style_row);

	            $baris++;
	        }

	        // Set width kolom
		    $object->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		    $object->getActiveSheet()->getColumnDimension('B')->setWidth(10); // Set width kolom B
		    $object->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		    $object->getActiveSheet()->getColumnDimension('D')->setWidth(40); // Set width kolom D
		    $object->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		    $object->getActiveSheet()->getColumnDimension('F')->setWidth(20);

		    $object->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		    $object->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		    $date = date('Y-m-d H-i');
	        $filename = "Data Pengeringan Gabah ". $date . '.xlsx';

	        $object->getActiveSheet(0)->setTitle('Data Pengeringan Gabah KS');
	        $object->setActiveSheetIndex(0);

	        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	        header('Content-Disposition: attachment; filename="' . $filename . '"');
	        header('Cache-Control: max-age=0');

	        $writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
	        $writer->save('php://output');

	        exit;
	}

	public function beli_kg()
	{
		$jenis = $this->input->post('jenis_gabah');
	    $grade = $this->input->post('grade');
	    $musim = $this->input->post('musim');
		$this->db->select('*');
		$this->db->from('tb_stok_kg');
		$this->db->where('tb_stok_kg.musim', $musim);
		$this->db->where('tb_stok_kg.grade', $grade);
		$this->db->where('tb_stok_kg.jenis', $jenis);
		$result = $this->db->get()->num_rows();

		if($result > 0){
			$tonase = $this->input->post('tonase');
			$jenis = $this->input->post('jenis_gabah');
		    $grade = $this->input->post('grade');
		    $musim = $this->input->post('musim');
			$this->db->select('*');
			$this->db->from('tb_stok_kg');
			$this->db->where('tb_stok_kg.musim', $musim);
			$this->db->where('tb_stok_kg.grade', $grade);
			$this->db->where('tb_stok_kg.jenis', $jenis);
			$get = $this->db->get()->result_array();

			foreach ($get as $r) {
				$tonase = $this->input->post('tonase');
				$total = $tonase + $r['tonase'];
				$jenis = $this->input->post('jenis_gabah');
			    $grade = $this->input->post('grade');
			    $musim = $this->input->post('musim');

				$datan = array(
					'tonase' => $total,
					'tanggal' => date('Y-m-d')
				);

				$wheren = array(
					'musim' => $musim,
					'jenis' => $jenis,
					'grade' => $grade
				);
				$this->M_admin->update_stok_kg($wheren, $datan, 'tb_stok_kg');

				// jemur kg
				$this->db->from('tb_stok_beli_kg');
				$this->db->where('tb_stok_beli_kg.musim_b', $musim);
				$this->db->where('tb_stok_beli_kg.grade_b', $grade);
				$this->db->where('tb_stok_beli_kg.jenis_b', $jenis);
				$result = $this->db->get()->num_rows();
				if ($result != 0) {
					$this->db->select('*');
					$this->db->from('tb_stok_beli_kg');
					$this->db->where('tb_stok_beli_kg.musim_b', $musim);
					$this->db->where('tb_stok_beli_kg.grade_b', $grade);
					$this->db->where('tb_stok_beli_kg.jenis_b', $jenis);
					$this->db->limit(1);
					$jemur = $this->db->get()->result_array();

					foreach ($jemur as $r) {
						$berat = $this->input->post('berat');
						$total = $berat + $r['tonase_b'];

						$dataj = array(
							'tonase_b' => $total,
							'tanggal_b' => date('Y-m-d')
						);

						$whereb = array(
							'musim_b' => $musim,
							'jenis_b' => $jenis,
							'grade_b' => $grade
						);
						$this->M_admin->update_jemur_stok($whereb, $datab, 'tb_stok_beli_kg');
					}
				}else{
					$berat = $this->input->post('tonase');
					$datas = [
						'musim_b' => $musim,
						'jenis_b' => $jenis,
						'grade_b' => $grade,
						'tonase_b' => $berat,
						'tanggal_b' => date('Y-m-d')
					];
					$this->db->insert('tb_stok_beli_kg', $datas);
				}

				// add beli kg
				$id_user = $this->input->post('id_user');
				if (empty($this->input->post('kode_nota'))) {
	            	$kode_pembelian = $this->input->post('kode_pembelian');
	            }else{
	            	$kode_pembelian = $this->input->post('kode_nota');
	            }
	            $nama_supplier = $this->input->post('nama_supplier');
	            $nama_supir = $this->input->post('nama_supir');
	            $plat = $this->input->post('plat');

	            $jenis_gabah = $this->input->post('jenis_gabah');
	            $grade = $this->input->post('grade');
	            $tonase = $this->input->post('tonase');
	            $harga_kg = $this->input->post('harga_kg');
	            $total = $this->input->post('total');
	            $musim = $this->input->post('musim');
	            $no_penjemuran = $this->input->post('no_penjemuran');
	            $keterangan = $this->input->post('keterangan');
	            $tanggal = $this->input->post('tanggal');
	            $data = [
	            	'id_user' => $id_user,
	            	'kode_pembelian' => $kode_pembelian,
	            	'nama_supplier' => $nama_supplier,
	            	'nama_supir' => $nama_supir,
	            	'plat' => $plat,
	            	'musim' => $musim,
	            	'jenis_gabah' => $jenis_gabah,
	            	'grade' => $grade,
	            	'tonase' => $tonase,
	            	'harga_kg' => $harga_kg,
	            	'total' => $total,
	            	'keterangan' => $keterangan,
	            	'tanggal' => $tanggal
	            ];
	            $this->db->insert('tb_beli_kg', $data);
	            // $this->db->insert('tb_pembelian', $data);
	            redirect('admin/stock_siap_giling');
			}

		}else{
			$tonase = $this->input->post('tonase');
			$datas = [
				'musim' => $musim,
				'jenis' => $jenis,
				'grade' => $grade,
				'tonase' => $tonase,
				'tanggal' => date('Y-m-d')
			];
			$this->db->insert('tb_stok_kg', $datas);

			// pengeringan
			$this->db->from('tb_stok_beli_kg');
			$this->db->where('tb_stok_beli_kg.musim_b', $musim);
			$this->db->where('tb_stok_beli_kg.grade_b', $grade);
			$this->db->where('tb_stok_beli_kg.jenis_b', $jenis);
			$result = $this->db->get()->num_rows();
			if ($result != 0) {
				$this->db->select('*');
				$this->db->from('tb_stok_beli_kg');
				$this->db->where('tb_stok_beli_kg.musim_b', $musim);
				$this->db->where('tb_stok_beli_kg.grade_b', $grade);
				$this->db->where('tb_stok_beli_kg.jenis_b', $jenis);
				$this->db->limit(1);
				$jemur = $this->db->get()->result_array();

				foreach ($jemur as $r) {
					$berat = $this->input->post('berat');
					$total = $berat + $r['tonase_b'];

					$datab = array(
						'tonase_b' => $total,
						'tanggal_b' => date('Y-m-d')
					);

					$whereb = array(
						'musim_b' => $musim,
						'jenis_b' => $jenis,
						'grade_b' => $grade
					);
					$this->M_admin->update_beli_stok($whereb, $datab, 'tb_stok_beli_kg');
				}
			}else{
				$berat = $this->input->post('berat');
				$datas = [
					'musim_b' => $musim,
					'jenis_b' => $jenis,
					'grade_b' => $grade,
					'tonase_b' => $berat,
					'tanggal_b' => date('Y-m-d')
				];
				$this->db->insert('tb_beli_stok_kg', $datas);
			}
			// add beli kg
				$id_user = $this->input->post('id_user');
	            if (empty($this->input->post('kode_nota'))) {
	            	$kode_pembelian = $this->input->post('kode_pembelian');
	            }else{
	            	$kode_pembelian = $this->input->post('kode_nota');
	            }
	            $nama_supplier = $this->input->post('nama_supplier');
	            $nama_supir = $this->input->post('nama_supir');
	            $plat = $this->input->post('plat');

	            $jenis_gabah = $this->input->post('jenis_gabah');
	            $grade = $this->input->post('grade');
	            $tonase = $this->input->post('tonase');
	            $harga_kg = $this->input->post('harga_kg');
	            $total = $this->input->post('total');
	            $musim = $this->input->post('musim');
	            $no_penjemuran = $this->input->post('no_penjemuran');
	            $keterangan = $this->input->post('keterangan');
	            $tanggal = $this->input->post('tanggal');
	            $data = [
	            	'id_user' => $id_user,
	            	'kode_pembelian' => $kode_pembelian,
	            	'nama_supplier' => $nama_supplier,
	            	'nama_supir' => $nama_supir,
	            	'plat' => $plat,
	            	'musim' => $musim,
	            	'jenis_gabah' => $jenis_gabah,
	            	'grade' => $grade,
	            	'tonase' => $tonase,
	            	'harga_kg' => $harga_kg,
	            	'total' => $total,
	            	'keterangan' => $keterangan,
	            	'tanggal' => $tanggal
	            ];
	            $this->db->insert('tb_beli_kg', $data);
	            $this->db->insert('tb_pembelian', $data);
	            redirect('admin/stock_siap_giling');
		}
	}

	public function jual_kg()
	{
		$this->form_validation->set_rules('nota_penjualan', 'Nota', 'trim|required');
		$this->form_validation->set_rules('pembeli', 'Pembeli', 'trim|required');
		$this->form_validation->set_rules('musim', 'Musim', 'trim|required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'trim|required');
		$this->form_validation->set_rules('grade', 'Grade', 'trim|required');
		$this->form_validation->set_rules('tonase', 'Tonase', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['jenis'] = $this->db->get('jenis_beras')->result_array();
			$data['grade'] = $this->db->get('grade')->result_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/stock_siap_giling', $data);
			$this->load->view('templates/footer', $data);
		}else{
			$data = [
	            	'nota_penjualan' => $this->input->post('nota_penjualan'),
	            	'pembeli' => $this->input->post('pembeli'),
	            	'id_user' => $this->input->post('id_user'),
	            	'musim' => $this->input->post('musim'),
	            	'jenis' => $this->input->post('jenis'),
	            	'grade' => $this->input->post('grade'),
	            	'tonase' => $this->input->post('tonase'),
	            	'harga' => $this->input->post('harga'),
	            	'tanggal' => date('Y-m-d'),
	            ];
	            $this->db->insert('tb_jual_kg', $data);

	            // update
	            $this->db->select('*');
				$this->db->from('tb_stok_kg');
				$this->db->where('tb_stok_kg.musim', $this->input->post('musim'));
				$this->db->where('tb_stok_kg.grade', $this->input->post('grade'));
				$this->db->where('tb_stok_kg.jenis', $this->input->post('jenis'));
				$this->db->limit(1);
				$stok = $this->db->get()->result_array();
				foreach ($stok as $k) {
					$tonase = $k['tonase'] - $this->input->post('tonase');

					$datan = [
						'tonase' => $tonase
					];

					$wheren = [
						'musim' => $this->input->post('musim'),
						'jenis' => $this->input->post('jenis'),
						'grade' => $this->input->post('grade'),
						'tanggal' => date('Y-m-d')
					];
					$this->M_admin->update_stok_kg($wheren, $datan, 'tb_stok_kg');

				}
				redirect('admin/stock_siap_giling');
		}
	}
	
	public function jual_ks()
	{
		$this->form_validation->set_rules('kode_jual', 'Nota', 'trim|required');
		$this->form_validation->set_rules('nama_pembeli', 'Pembeli', 'trim|required');
		$this->form_validation->set_rules('musim', 'Musim', 'trim|required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'trim|required');
		$this->form_validation->set_rules('grade', 'Grade', 'trim|required');
		$this->form_validation->set_rules('tonase', 'Tonase', 'trim|required');
		$this->form_validation->set_rules('total_harga', 'Harga', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
    		$data['jenis'] = $this->db->get('jenis_beras')->result_array();
    		$data['grade'] = $this->db->get('grade')->result_array();
    		$this->load->view('templates/header', $data);
    		$this->load->view('templates/sidebar', $data);
    		$this->load->view('templates/topbar', $data);
    		$this->load->view('admin/stok_ks', $data);
    		$this->load->view('templates/footer', $data);
		}else{
			$data = [
	            	'kode_jual' => $this->input->post('kode_jual'),
	            	'nama_pembeli' => $this->input->post('nama_pembeli'),
	            	'id_user' => $this->input->post('id_user'),
	            	'musim' => $this->input->post('musim'),
	            	'jenis' => $this->input->post('jenis'),
	            	'grade' => $this->input->post('grade'),
	            	'tonase' => $this->input->post('tonase'),
	            	'total_harga' => $this->input->post('total_harga'),
	            	'tanggal' => date('Y-m-d H:i:s'),
	            ];
	            $this->db->insert('tb_jual_ks', $data);

	            // update
	            $this->db->select('*');
				$this->db->from('tb_stok_ks');
				$this->db->where('tb_stok_ks.musim', $this->input->post('musim'));
				$this->db->where('tb_stok_ks.grade', $this->input->post('grade'));
				$this->db->where('tb_stok_ks.jenis', $this->input->post('jenis'));
				$this->db->limit(1);
				$stok = $this->db->get()->result_array();
				foreach ($stok as $k) {
					$tonase = $k['tonase'] - $this->input->post('tonase');
					echo $tonase;


				// 	$datan = [
				// 		'tonase' => $tonase
				// 	];

				// 	$wheren = [
				// 		'musim' => $this->input->post('musim'),
				// 		'jenis' => $this->input->post('jenis'),
				// 		'grade' => $this->input->post('grade'),
				// 		'tanggal' => date('Y-m-d')
				// 	];
				// 	$this->M_admin->update_stok_ks($wheren, $datan, 'tb_stok_ks');
				// 	redirect('admin/stok_ks');

				}
				
		}
	}
	
    // stock siap giling

	public function proses_add_stock()
	{
		$this->form_validation->set_rules('musim', 'Musim', 'trim|required');
		$this->form_validation->set_rules('jenis[]', 'Jenis', 'trim|required');
		$this->form_validation->set_rules('grade[]', 'Grade', 'trim|required');
		$this->form_validation->set_rules('tonase[]', 'Tonase', 'trim|required');
		if ($this->form_validation->run() == false) {
			$kode = $this->input->post('kode_pembelian');
			$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['detail'] = $this->M_admin->detail_pengeringan($kode);
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/detail_pengeringan', $data);
			$this->load->view('templates/footer', $data);
		}else{
			// insert stock
			$kode = $this->input->post('kode_pembelian');
			$resultes = [];
            $nom = 0;
            $jenis = $this->input->post('jenis[]');
            $musim = $this->input->post('musim');
            foreach ($jenis as $key => $value) {
                $resultes[$nom] = [
                    'musim' => $this->input->post('musim'),
                    'jenis' => $_POST['jenis'][$nom],
                    'grade' => $_POST['grade'][$nom],
                    'tonase' => $_POST['tonase'][$nom],
                    'tanggal' => $this->input->post('tanggal')
                ];
                $nom++;
            }

			$this->db->insert_batch('tb_stok_kg', $resultes);
			// update status
			$data = array(
				'status' => 'Selesai'
			);

			$where = array(
				'kode_pembelian' => $kode
			);

			$this->M_admin->update_status($where, $data, 'tb_pengeringan');
            redirect('admin/detail_pengeringan/'.$kode);
		}
	}

	public function stock_siap_giling()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['jenis'] = $this->db->get('jenis_beras')->result_array();
		$data['grade'] = $this->db->get('grade')->result_array();
		$data['jual'] = $this->M_admin->penjualan_kg();
		$data['beli'] = $this->M_admin->pembelian_kg();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/stock_siap_giling', $data);
		$this->load->view('templates/footer', $data);
	}

	// giling
	public function proses_giling()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['jenis'] = $this->db->get('jenis_beras')->result_array();
		$data['grade'] = $this->db->get('grade')->result_array();

		$jumlah = $this->M_admin->jumlah_giling();
		// pagination
		$config['base_url'] = 'http://penggilinganberas.kreatindo.com/admin/proses_giling';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 10;
		$config['num_links'] = 2;
		// style
		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '<li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '<li>';

		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '<li>';

		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '<li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a><li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '<li>';

		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);
		// pagination
		$data['start'] = $this->uri->segment(3);

		$data['giling'] = $this->M_admin->get_giling($config['per_page'], $data['start']);
		$data['hasil'] = $this->db->get('tb_beras_giling')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/proses_giling', $data);
		$this->load->view('templates/footer', $data);
	}
	public function add_giling()
	{
		$this->form_validation->set_rules('musim', 'Musim', 'trim|required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'trim|required');
		$this->form_validation->set_rules('grade', 'Grade', 'trim|required');
		$this->form_validation->set_rules('tonase', 'Tonase', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['giling'] = $this->M_admin->get_giling();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/proses_giling', $data);
			$this->load->view('templates/footer', $data);
		}else{
			$kode = $this->input->post('kode_pembelian');
			$data = [
				'id_user' => $this->input->post('id_user'),
				'musim' => $this->input->post('musim'),
				'jenis' => $this->input->post('jenis'),
				'grade' => $this->input->post('grade'),
				'tonase' => $this->input->post('tonase'),
				'status' => 1,
				// 'tonase_b' => $this->input->post('tonase_b'),
				'tanggal' => $this->input->post('tanggal'),
			];
			$this->db->insert('tb_giling', $data);

			$musim = $this->input->post('musim');
			$jenis = $this->input->post('jenis');
			$grade = $this->input->post('grade');

			$this->db->select('*');
			$this->db->from('tb_stok_kg');
			$this->db->where('tb_stok_kg.musim', $musim);
			$this->db->where('tb_stok_kg.grade', $grade);
			$this->db->where('tb_stok_kg.jenis', $jenis);
			$get = $this->db->get()->result_array();


			foreach ($get as $g) {
				$grade = $this->input->post('grade');
				$tonase = $this->input->post('tonase');
				$total = $g['tonase'] - $tonase;
				$datan = array(
					'tonase' => $total,
					'tanggal' => date('Y-m-d')
				);

				$wheren = array(
					'musim' => $this->input->post('musim'),
					'jenis' => $this->input->post('jenis'),
					'grade' => $this->input->post('grade')
				);
				$this->M_admin->update_stok_kg($wheren, $datan, 'tb_stok_kg');
				redirect('admin/proses_giling');
			}
		}
	}

	public function detail_giling()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$id = $this->uri->segment(3);
		$data['detail'] = $this->M_admin->detail_giling($id);
		$data['detail_proses'] = $this->M_admin->detail_proses_giling($id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/detail_giling', $data);
		$this->load->view('templates/footer', $data);
	}
	
	public function update_proses_giling()
	{
		$data = [
		    'hasil_beras' => $this->input->post('hasil_beras'),
			'hasil_menir' => $this->input->post('hasil_menir'),
			'hasil_katul' => $this->input->post('hasil_katul'),
			'tanggal' => $this->input->post('tanggal'),
			'id_giling' => $this->input->post('id_giling'),
		    'status' => 1
		    ];
		$this->db->insert('tb_proses_giling', $data);
		redirect('admin/detail_giling/'.$this->input->post('id_giling'));
	}
	public function proses_update_giling()
	{   
	    $giling = $this->input->post('id_giling');
	    
	    $this->db->select('SUM(hasil_beras) as total_beras');
        $this->db->from('tb_proses_giling');
        $this->db->where('tb_proses_giling.id_giling', $giling);
        $beras = $this->db->get()->row()->total_beras;
        
        $this->db->select('SUM(hasil_menir) as total_menir');
        $this->db->from('tb_proses_giling');
        $this->db->where('tb_proses_giling.id_giling', $giling);
        $menir = $this->db->get()->row()->total_menir;
        
        $this->db->select('SUM(hasil_katul) as total_katul');
        $this->db->from('tb_proses_giling');
        $this->db->where('tb_proses_giling.id_giling', $giling);
        $katul = $this->db->get()->row()->total_katul;
        
		$this->db->select('*');
		$this->db->from('tb_stok_proses_giling');
		$this->db->where('tb_stok_proses_giling.musim', $this->input->post('musim'));
		$this->db->where('tb_stok_proses_giling.grade', $this->input->post('grade'));
		$this->db->where('tb_stok_proses_giling.jenis', $this->input->post('jenis'));
		$jumlah = $this->db->get()->num_rows();
		
// 		var_dump($beras);die();
		
		if($jumlah > 0){
		    $this->db->select('*');
		    $this->db->from('tb_stok_proses_giling');
		    $this->db->where('tb_stok_proses_giling.musim', $this->input->post('musim'));
		    $this->db->where('tb_stok_proses_giling.grade', $this->input->post('grade'));
		    $this->db->where('tb_stok_proses_giling.jenis', $this->input->post('jenis'));
		    $result = $this->db->get()->result_array();
		    foreach($result as $r){
		        $data = [
		            'hasil_beras' => $r['hasil_beras'] + $beras,
		            'hasil_menir' => $r['hasil_menir'] + $menir,
		            'hasil_katul' => $r['hasil_katul'] + $katul,
		        ];
		        $where = [
		            'musim' => $this->input->post('musim'),
		            'grade' => $this->input->post('grade'),
		            'jenis' => $this->input->post('jenis')
		        ];
		        $this->db->update('tb_stok_proses_giling', $data, $where);
		      //  
		        $dataa = [
		            'status' => 2
		        ];
		        $datab = [
		            'status' => 2,
		            'hasil_beras' => $r['hasil_beras'] + $beras,
		            'hasil_menir' => $r['hasil_menir'] + $menir,
		            'hasil_katul' => $r['hasil_katul'] + $katul,
		        ];
		        $whera = [
		            'id_giling' => $this->input->post('id_giling')
		        ];
		        $this->db->update('tb_proses_giling', $dataa, $wherea);
		        $this->db->update('tb_giling', $datab, $wherea);
		        
		        $this->db->select('*');
    			$this->db->from('tb_hasil_giling');
    			$this->db->where('id_hasil', 1);
    			$hmenir = $this->db->get()->result_array();
    			foreach ($hmenir as $m) {
        			$datam = [
        				'jumlah' => $m['jumlah'] + $menir,
        			];
        			$wherem = [
        				'id_hasil' => 1
        			];
        			$this->db->update('tb_hasil_giling', $datam, $wherem);
    			}
    			$this->db->select('*');
    			$this->db->from('tb_hasil_giling');
    			$this->db->where('id_hasil', 2);
    			$hkatul = $this->db->get()->result_array();
    			foreach ($hkatul as $k) {
        			$datak = [
        				'jumlah' => $k['jumlah'] + $katul,
        			];
        			$wherek = [
        				'id_hasil' => 2
        			];
        			$this->db->update('tb_hasil_giling', $datak, $wherek);
    			}
		        
		        redirect('admin/detail_giling/'.$this->input->post('id_giling'));
		    }
		    
		}else{
		    $this->db->select('SUM(hasil_beras) as total_beras');
            $this->db->from('tb_proses_giling');
            $this->db->where('tb_proses_giling.id_giling', $giling);
            $beras = $this->db->get()->row()->total_beras;
            
            $this->db->select('SUM(hasil_menir) as total_menir');
            $this->db->from('tb_proses_giling');
            $this->db->where('tb_proses_giling.id_giling', $giling);
            $menir = $this->db->get()->row()->total_menir;
            
            $this->db->select('SUM(hasil_katul) as total_katul');
            $this->db->from('tb_proses_giling');
            $this->db->where('tb_proses_giling.id_giling', $giling);
            $katul = $this->db->get()->row()->total_katul;
        // 
		        $data = [
		            'hasil_beras' => $beras,
		            'hasil_menir' => $menir,
		            'hasil_katul' => $katul,
		            'musim' => $this->input->post('musim'),
		            'grade' => $this->input->post('grade'),
		            'jenis' => $this->input->post('jenis'),
		        ];
		        $this->db->insert('tb_stok_proses_giling', $data);
		        
		        $dataa = [
		            'status' => 2
		        ];
		        $datab = [
		            'status' => 2,
		            'hasil_beras' => $beras,
		            'hasil_menir' => $menir,
		            'hasil_katul' => $katul,
		        ];
		        $whera = [
		            'id_giling' => $this->input->post('id_giling')
		        ];
		        $this->db->update('tb_proses_giling', $dataa, $wherea);
		        $this->db->update('tb_giling', $datab, $wherea);
		        
		        $this->db->select('*');
    			$this->db->from('tb_hasil_giling');
    			$this->db->where('id_hasil', 1);
    			$hmenir = $this->db->get()->result_array();
    			foreach ($hmenir as $m) {
        			$datam = [
        				'jumlah' => $m['jumlah'] + $menir,
        			];
        			$wherem = [
        				'id_hasil' => 1
        			];
        			$this->db->update('tb_hasil_giling', $datam, $wherem);
    			}
    			$this->db->select('*');
    			$this->db->from('tb_hasil_giling');
    			$this->db->where('id_hasil', 2);
    			$hkatul = $this->db->get()->result_array();
    			foreach ($hkatul as $k) {
        			$datak = [
        				'jumlah' => $k['jumlah'] + $katul,
        			];
        			$wherek = [
        				'id_hasil' => 2
        			];
        			$this->db->update('tb_hasil_giling', $datak, $wherek);
    			}
		        
		        redirect('admin/detail_giling/'.$this->input->post('id_giling'));
		}
		
	}

	public function update_giling()
	{
		$datan = array(
			'hasil_beras' => $this->input->post('hasil_beras'),
			'hasil_menir' => $this->input->post('hasil_menir'),
			'hasil_katul' => $this->input->post('hasil_katul'),
			'tanggal_selesai' => $this->input->post('tanggal_selesai'),
			'status' => 2
		);

		$wheren = array(
			'id_giling' => $this->input->post('id_giling')
		);
		$this->M_admin->update_giling($wheren, $datan, 'tb_giling');

		$this->db->select('*');
		$this->db->from('tb_beras_giling');
		$this->db->where('tb_beras_giling.id_beras', 2);
		$get = $this->db->get()->result_array();
		foreach ($get as $g) {
			$beras = $g['hasil_beras'];
			$menir = $g['hasil_menir'];
			$katul = $g['hasil_katul'];
			$total_b = $beras + $this->input->post('hasil_beras');
			$total_m = $menir + $this->input->post('hasil_menir');
			$total_k = $katul + $this->input->post('hasil_katul');
			$data = [
				'hasil_beras' => $total_b,
				'hasil_menir' => $total_m,
				'hasil_katul' => $total_k,
				'tanggal' => date('Y-m-d H:i:s')
			];
			$where = [
				'id_beras' => 2
			];
			$this->M_admin->update_beras($where, $data, 'tb_beras_giling');

			// panggil musim jenis grade
			$musim = $this->input->post('musim');
			$jenis = $this->input->post('jenis');
			$grade = $this->input->post('grade');
			$hasil_beras = $this->input->post('hasil_beras');
			// select from tb_stok_beras where musim jenis grade
			$this->db->select('*');
			$this->db->from('tb_stok_beras');
			$this->db->where('tb_stok_beras.musim', $musim);
			$this->db->where('tb_stok_beras.jenis', $jenis);
			$this->db->where('tb_stok_beras.grade', $grade);
			$this->db->limit(1);
			$beras = $this->db->get()->result_array();

			foreach ($beras as $b) {
				$tonase_beras = $b['tonase'] + $hasil_beras;
				$dat = [
					'tonase' => $tonase_beras,
					'tanggal' => date('Y-m-d H:i:s')
				];
				$whe = [
					'musim' => $musim,
					'jenis' => $jenis,
					'grade' => $grade
				];
				$this->M_admin->update_tb_beras('tb_stok_beras', $dat, $whe);
			}
			
		}
		// edit +tambah
			$this->db->select('*');
			$this->db->from('tb_hasil_giling');
			$this->db->where('id_hasil', 1);
			$menir = $this->db->get()->result_array();
			foreach ($menir as $m) {
    			$jumlah_menir = $m['jumlah'] + $this->input->post('hasil_menir');
    			$data = [
        				'jumlah' => $jumlah_menir
        			];
    			$where = [
        				'id_hasil' => 1
        			];
        		$this->M_admin->update_menir_katul($where, $data, 'tb_hasil_giling');
			}
			
			
			$this->db->select('*');
			$this->db->from('tb_hasil_giling');
			$this->db->where('id_hasil', 2);
			$katul = $this->db->get()->result_array();
			foreach ($katul as $k) {
    			$jumlah_katul = $k['jumlah'] + $this->input->post('hasil_katul');
    			$data = [
        				'jumlah' => $jumlah_katul
        			];
    			$where = [
        				'id_hasil' => 2
        			];
        		$this->M_admin->update_menir_katul($where, $data, 'tb_hasil_giling');
			}

		redirect('admin/detail_giling/'.$this->input->post('id_giling'));
	}

	public function jual_beras()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['jual_beras'] = $this->M_admin->jual_beras();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/jual_beras', $data);
		$this->load->view('templates/footer', $data);
	}

	public function beli_beras()
	{
	    $musim = $this->input->post('musim');
		$jenis = $this->input->post('jenis');
		$grade = $this->input->post('grade');

	    $this->db->select('*');
        $this->db->from('tb_stok_proses_giling');
        $this->db->where('tb_stok_proses_giling.musim', $musim);
	    $this->db->where('tb_stok_proses_giling.jenis', $jenis);
	    $this->db->where('tb_stok_proses_giling.grade', $grade);
        $rowne = $this->db->get()->num_rows();
        
        
        
        if($rowne > 0){
            
        $this->db->select('SUM(hasil_beras) as beras');
        $this->db->from('tb_stok_proses_giling');
        $this->db->where('tb_stok_proses_giling.musim', $musim);
	    $this->db->where('tb_stok_proses_giling.jenis', $jenis);
	    $this->db->where('tb_stok_proses_giling.grade', $grade);
        $hasilberas = $this->db->get()->row()->beras;
        
		$beli = $this->input->post('tonase_beras');
		$total = $hasilberas + $beli;
		
		$data = [
    		'hasil_beras' => $total,
    		'tanggal' => date('Y-m-d H:i:s')
		];
		$where = [
			'musim' => $musim,
			'jenis' => $jenis,
			'grade' => $grade
		];
		$this->this->db->update('tb_stok_proses_giling', $where, $data);
        }else{
            $tambah = [
    			'musim' => $this->input->post('musim'),
    			'jenis' => $this->input->post('jenis'),
    			'grade' => $this->input->post('grade'),
    			'hasil_beras' => $this->input->post('tonase_beras'),
    			'hasil_menir' => 0,
    			'hasil_katul' => 0,
    			'tanggal' => date('Y-m-d')
    		];
    		$this->db->insert('tb_stok_proses_giling', $tambah);
        }	
		$dataku = [
			'kode_pembelian' => $this->input->post('nota_pembelian'),
			'nama_supplier' => $this->input->post('nama_supplier'),
			'musim' => $this->input->post('musim'),
			'jenis' => $this->input->post('jenis'),
			'grade' => $this->input->post('grade'),
			'tonase_beras' => $this->input->post('tonase_beras'),
			'harga' => $this->input->post('harga'),
			'id_user' => $this->input->post('id_user'),
			'tanggal' => $this->input->post('tanggal')
		];
		$this->db->insert('tb_beli_beras', $dataku);

		redirect('admin/stok_beras_giling');
			
	}

	public function add_jual_beras()
	{
		$this->form_validation->set_rules('tonase_beras', 'Ton', 'trim|required');
		$this->form_validation->set_rules('nama_pembeli', 'Pem', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['jual_beras'] = $this->M_admin->jual_beras();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/jual_beras', $data);
			$this->load->view('templates/footer', $data);
		}else{
			$data = [
				'kode_penjualan' => $this->input->post('kode_penjualan'),
				'id_user' => $this->input->post('id_user'),
				'nama_pembeli' => $this->input->post('nama_pembeli'),
				'tonase_beras' => $this->input->post('tonase_beras'),
				'total' => $this->input->post('total'),
				'tanggal' => $this->input->post('tanggal')
			];
			$this->db->insert('jual_beras', $data);
			// 
			// 
			$musim = $this->input->post('musim');
			$jenis = $this->input->post('jenis');
			$grade = $this->input->post('grade');
			
			    
			    $this->db->select('SUM(hasil_beras) as beras');
                $this->db->from('tb_stok_proses_giling');
                $this->db->where('tb_stok_proses_giling.musim', $musim);
			    $this->db->where('tb_stok_proses_giling.jenis', $jenis);
			    $this->db->where('tb_stok_proses_giling.grade', $grade);
                $hberas = $this->db->get()->row()->beras;
                
				$jual = $this->input->post('tonase_beras');
				$total = $hberas - $jual;
				// echo $;
				$data = [
				'hasil_beras' => $total,
				];
				$where = [
					'musim' => $musim,
					'jenis' => $jenis,
					'grade' => $grade
				];
				$this->db->update('tb_stok_proses_giling', $data, $where);

// 			$this->db->select('*');
// 			$this->db->from('tb_stok_beras');
// 			$this->db->where('tb_stok_beras.musim', $musim);
// 			$this->db->where('tb_stok_beras.jenis', $jenis);
// 			$this->db->where('tb_stok_beras.grade', $grade);
// 			$result = $this->db->get()->result_array();
// 			foreach ($result as $r) {
// 				$awal = $r['hasil_beras'];
// 				$jual = $this->input->post('tonase_beras');
// 				$total = $awal - $jual;
// 				// echo $;
// 				$data = [
// 				'tonase' => $total,
// 				'tanggal' => date('Y-m-d H:i:s')
// 				];
// 				$where = [
// 					'musim' => $musim,
// 					'jenis' => $jenis,
// 					'grade' => $grade
// 				];
// 				$this->M_admin->update_beras($where, $data, 'tb_stok_beras');
// 			}
			redirect('admin/jual_beras');
		}
	}

	public function getKodeJual()
    {
        // $this->load->model('model_data');
        $hasil = $this->db->query("select kode_penjualan from jual_beras ORDER BY kode_penjualan DESC LIMIT 1");
        if ($hasil->num_rows() > 0) {
            $nmr = explode('_', $hasil->row()->kode_penjualan);
            $data = sprintf("%04d", $nmr[1] + 1);
        } else {
            $data = '0001';
        }
        echo json_encode($data);
    }

    public function stok_beras_giling()
    {
    	$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
    	$data['jual_beras'] = $this->M_admin->jual_beras();
    	$data['beli_beras'] = $this->M_admin->beli_beras();
    	$data['stok_proses_giling'] = $this->M_admin->stok_proses_giling();
    	$data['jenis'] = $this->db->get('jenis_beras')->result_array();
		$data['grade'] = $this->db->get('grade')->result_array();
    	$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/stok_beras_giling', $data);
		$this->load->view('templates/footer', $data);
    }

	public function proses_kebi()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['merk'] = $this->db->get('merk_beras')->result_array();
		$jumlah = $this->db->get('tb_kebi')->num_rows();
		
		$config['base_url'] = 'http://penggilinganberas.kreatindo.com/admin/proses_kebi';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 10;
		$config['num_links'] = 2;
		
		// style
		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '<li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '<li>';

		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '<li>';

		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '<li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a><li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '<li>';

		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);
		// pagination
		$data['start'] = $this->uri->segment(3);
		$data['kebi'] = $this->M_admin->get_kebi($config['per_page'], $data['start']);
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/proses_kebi', $data);
		$this->load->view('templates/footer', $data);
	}

	public function detail_kebi()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$id = $this->uri->segment(3);
		$data['merk'] = $this->db->get('merk_beras')->result_array();
		$data['detail'] = $this->M_admin->detail_kebi($id);
		$data['data_kebi'] = $this->M_admin->data_kebi($id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/detail_kebi', $data);
		$this->load->view('templates/footer', $data);
	}

	public function data_user()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['data_user'] = $this->db->get('tb_user')->result_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/data_user', $data);
		$this->load->view('templates/footer', $data);
	}
	public function add_user()
	{
		$this->form_validation->set_rules('username', 'User', 'trim|required');
		$this->form_validation->set_rules('password', 'Pass', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['data_user'] = $this->db->get('tb_user')->result_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/data_user', $data);
			$this->load->view('templates/footer', $data);
		}else{
			$data = [
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'email' => $this->input->post('email'),
				'level' => $this->input->post('level')
			];
			$this->db->insert('tb_user', $data);
			redirect('admin/data_user');
		}
	}

	public function add_kebi()
	{
		$this->form_validation->set_rules('kode_kebi', 'Kode', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['merk'] = $this->db->get('merk_beras')->result_array();
			$data['kebi'] = $this->M_admin->get_kebi();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/proses_kebi', $data);
			$this->load->view('templates/footer', $data);
		}else{
			$resultes = [];
            $nom = 0;
            $musim = $this->input->post('musim[]');
            foreach ($musim as $key => $value) {
                $resultes[$nom] = [
                	'id_user' => $this->input->post('id_user'),
					'kode_kebi' => $this->input->post('kode_kebi'),
					'musim' => $_POST['musim'][$nom],
					'jenis' => $_POST['jenis'][$nom],
					'grade' => $_POST['grade'][$nom],
					'tonase' => $_POST['tonase'][$nom],
					'status' => 1,
					'tanggal' => date('Y-m-d H:i:s'),
                ];
                $nom++;
            }
			$this->db->insert_batch('tb_kebi', $resultes);
// 			PENGURANgan stok
            $this->db->select('*');
			$this->db->from('tb_kebi');
			$this->db->where('tb_kebi.kode_kebi', $this->input->post('kode_kebi'));
			$kebinya = $this->db->get()->result_array();
			foreach($kebinya as $k){
			    $this->db->select('SUM(hasil_beras) as beras');
                $this->db->from('tb_stok_proses_giling');
                $this->db->where('tb_stok_proses_giling.musim', $k['musim']);
                $this->db->where('tb_stok_proses_giling.jenis', $k['jenis']);
                $this->db->where('tb_stok_proses_giling.grade', $k['grade']);
                $hberas = $this->db->get()->row()->beras;
                
                $this->db->select('SUM(tonase) as tonase');
                $this->db->from('tb_kebi');
                $this->db->where('tb_kebi.musim', $k['musim']);
                $this->db->where('tb_kebi.jenis', $k['jenis']);
                $this->db->where('tb_kebi.grade', $k['grade']);
                $htonase = $this->db->get()->row()->tonase;
                
                // update
                $data = [
                    'hasil_beras' => $hberas - $htonase
                    ];
                $where = [
                    'musim' => $k['musim'],
                    'jenis' => $k['jenis'],
                    'grade' => $k['grade'],
                    ];
        	    $this->db->update('tb_stok_proses_giling', $data, $where);
    			
			}
			
			redirect('admin/proses_kebi');
		}
	}

	public function add_hasil_kebi()
	{
		$this->form_validation->set_rules('kode_kebi', 'Kode', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
			$id = $this->uri->segment(3);
			$data['merk'] = $this->db->get('merk_beras')->result_array();
			$data['detail'] = $this->M_admin->detail_kebi($id);
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/detail_kebi', $data);
			$this->load->view('templates/footer', $data);
		}else{
			$resultes = [];
            $nom = 0;
            $merk = $this->input->post('merk[]');
            foreach ($merk as $key => $value) {
                $resultes[$nom] = [
					'kode_kebi' => $this->input->post('kode_kebi'),
					'merk' => $_POST['merk'][$nom],
					'5kg' => $_POST['5kg'][$nom],
					'10kg' => $_POST['10kg'][$nom],
					'25kg' => $_POST['25kg'][$nom],
					'50kg' => $_POST['50kg'][$nom],
					'menir_kebi' => $this->input->post('menir_kebi'),
					'tanggal' => date('Y-m-d H:i:s'),
					'tanggal_selesai' => date('Y-m-d H:i:s'),
                ];
                $nom++;
            }
			$this->db->insert_batch('tb_hasil_kebi', $resultes);
// 			$data = [
// 			    'status' => 2
// 			    ];
// 			$where = ['kode_kebi' => $this->input->post('kode_kebi')];
// 			$this->M_admin->update_kebi($where, $data, 'tb_kebi');
			
			$this->db->select('*');
			$this->db->from('tb_hasil_giling');
			$this->db->where('id_hasil', 3);
			$menir_kebi = $this->db->get()->result_array();
			foreach ($menir_kebi as $m) {
    			$data = [
    				'jumlah' => $m['jumlah'] + $this->input->post('menir_kebi'),
    			];
    			$where = [
    				'id_hasil' => 3
    			];
    			$this->M_admin->update_menir_katul($where, $data, 'tb_hasil_giling');
			}
			$this->db->select('*');
// 
            foreach ($this->db->get('merk_beras')->result_array() as $m){
                $where = ['merk' => $m['id_merk']];
            
                  $this->db->select('*');
                  $this->db->from('tb_beras_kebi');
                  $this->db->where('tb_beras_kebi.merk', $m['id_merk']);
                  $jum = $this->db->get()->num_rows();
                //  5kg
                  $this->db->select('SUM(5kg) as total');
                  $this->db->from('tb_hasil_kebi');
                  $this->db->where('tb_hasil_kebi.merk', $m['id_merk']);
                  $limakg = $this->db->get()->row()->total;
                  $data5 = ['5kg' => $limakg];
                  $this->M_admin->update_beras_kebi($where, $data5, 'tb_beras_kebi');
                // 10kg
                  $this->db->select('SUM(10kg) as total');
                  $this->db->from('tb_hasil_kebi');
                  $this->db->where('tb_hasil_kebi.merk', $m['id_merk']);
                  $sepuluhkg = $this->db->get()->row()->total;
                  $data10 = ['10kg' => $sepuluhkg];
                  $this->M_admin->update_beras_kebi($where, $data10, 'tb_beras_kebi');
                //  25kg
                  $this->db->select('SUM(25kg) as total');
                  $this->db->from('tb_hasil_kebi');
                  $this->db->where('tb_hasil_kebi.merk', $m['id_merk']);
                  $dualimakg = $this->db->get()->row()->total;
                  $data25 = ['25kg' => $dualimakg];
                  $this->M_admin->update_beras_kebi($where, $data25, 'tb_beras_kebi');
                // 50kg
                  $this->db->select('SUM(50kg) as total');
                  $this->db->from('tb_hasil_kebi');
                  $this->db->where('tb_hasil_kebi.merk', $m['id_merk']);
                  $limapuluhkg = $this->db->get()->row()->total;
                  $data50 = ['50kg' => $limapuluhkg];
                  $this->M_admin->update_beras_kebi($where, $data50, 'tb_beras_kebi');
            }
// 
			redirect('admin/detail_kebi/'. $this->input->post('kode_kebi'));
		}
	}
	public function selesai_kebi(){
	    $kode = $this->input->post('kode_kebi');
	    $where = [
	            'kode_kebi' => $kode
	        ];
	   $data = [
	            'status' => 2
	       ];
	   $dataa = [
	            'tanggal_selesai' => date('Y-m-d')
	       ];
	   $this->db->update('tb_kebi', $data, $where);
	   $this->db->update('tb_hasil_kebi', $dataa, $where);
	   redirect('admin/proses_kebi');
	}
	
	
	public function jenis_beras()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['jenis'] = $this->db->get('jenis_beras')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/jenis_beras', $data);
		$this->load->view('templates/footer', $data);
	}
	public function edit_jenis()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['jenis'] = $this->db->get('jenis_beras')->result_array();
		$id = $this->uri->segment(3);
		$data['edit'] = $this->M_admin->get_jenis($id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/edit_jenis', $data);
		$this->load->view('templates/footer', $data);
	}
	public function update_jenis()
	{
	    $id = $this->input->post('id_jenis');
	    $where = ['id_jenis' => $id];
	    $data = [
	        'nama_jenis' => $this->input->post('nama_jenis'),
	        ];
	   $this->M_admin->update_jenis($where, $data, 'jenis_beras');
	   redirect('admin/jenis_beras');
	}
	public function merk_beras()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['merk'] = $this->db->get('merk_beras')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/merk_beras', $data);
		$this->load->view('templates/footer', $data);
	}
	
	
	
	public function edit_merk()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['merk'] = $this->db->get('merk_beras')->result_array();
		$id = $this->uri->segment(3);
		$data['edit'] = $this->M_admin->get_merk($id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/edit_merk', $data);
		$this->load->view('templates/footer', $data);
	}
	public function update_merk()
	{
	    $id = $this->input->post('id_merk');
	    $where = ['id_merk' => $id];
	    $data = [
	        'nama_merk' => $this->input->post('nama_merk'),
	        ];
	   $this->M_admin->update_merk($where, $data, 'merk_beras');
	   redirect('admin/merk_beras');
	}
	public function add_merk()
	{
		$data = [
			'nama_merk' => $this->input->post('nama_merk')
		];
		$this->db->insert('merk_beras', $data);
		
		$this->db->select('*');
		$this->db->from('merk_beras');
		$this->db->order_by('id_merk', 'DESC');
		$this->db->limit(1);
		$merk = $this->db->get()->result_array();
		foreach($merk as $m){
		    $id_merk = $m['id_merk'];
		    $data = ['merk' => $merk];
		    $this->db->insert('tb_beras_kebi', $data);    
		}
		redirect('admin/merk_beras');
	}
	public function add_jenis()
	{
		$data = [
			'nama_jenis' => $this->input->post('nama_jenis')
		];
		$this->db->insert('jenis_beras', $data);
		redirect('admin/jenis_beras');
	}
	public function hapus_merk()
	{
		$id = $this->uri->segment(3);
		$where = [
			'id_merk' => $id,
		];
		$this->M_admin->delete_merk($where, 'merk_beras');
		redirect('admin/merk_beras');
	}
	public function hapus_jenis()
	{
		$id = $this->uri->segment(3);
		$where = [
			'id_jenis' => $id,
		];
		$this->M_admin->delete_jenis($where, 'jenis_beras');
		redirect('admin/jenis_beras');
	}
	public function hapus_user()
	{
		$id = $this->uri->segment(3);
		$where = [
			'id_user' => $id,
		];
		$this->M_admin->delete_user($where, 'tb_user');
		redirect('admin/data_user');
	}
	public function stok_katul()
	{
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['jual_stok'] = $this->db->get('tb_jual_stok')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/stok_katul', $data);
		$this->load->view('templates/footer', $data);
	}
	
	public function grade(){
	    $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['grade'] = $this->db->get('grade')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/grade', $data);
		$this->load->view('templates/footer', $data);
	}
	
	public function add_grade(){
	    
	    $this->form_validation->set_rules('grade','grade','required|trim|is_unique[grade.nama_grade]',[
	        'required' => 'Nama grade harap di isi',
	        'is_unique' => 'Nama grade sudah tersedia'
	   ]);
	    if($this->form_validation->run() == false){
	       $this->session->set_flashdata('err_msg', form_error('grade'));
	       redirect('admin/grade');
	    } else {
	        return $this->M_admin->add_grade();
	    }
	}
	
	public function edit_grade($id = null){
	    $data['grade'] = $this->db->get_where('grade',['id_grade' => $id])->row();
	   if($id == null){
	       redirect('admin/grade');
	   }
	 
	    $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$this->form_validation->set_rules('grade','grade','required|trim',['required' => 'Nama grade harap di isi']);
		if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/edit_grade', $data);
		$this->load->view('templates/footer', $data);
		} else {
		    $this->M_admin->edit_grade($id);
		}
	}
	
	
	public function delete_grade($id){
	
	 return $this->M_admin->delete_grade($id);
	}
	
	public function broken(){
	    $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
	    $data['broken'] = $this->db->get('tbl_broken_beras')->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/stok_beras_broken', $data);
		$this->load->view('templates/footer', $data);
	}
	
	public function add_beras_broken(){
	    $data = [
	        'kode_nota' => $this->input->post('kode_pembelian'),
	        'nama_supplier' => $this->input->post('nama_supplier'),
	        'nama_supir' => $this->input->post('nama_supir'),
	        'plat_kendaraan' => $this->input->post('plat'),
	        'jenis_gabah' => $this->input->post('jenis_gabah'),
	        'tonase' => $this->input->post('tonase'),
	        'harga' => $this->input->post('harga_kg'),
	        'total' => $this->input->post('total'),
	        'keterangan' => $this->input->post('keterangan'),
	        'tanggal' => date('Y-m-d')
	   ];
	   $this->db->insert('tbl_broken_beras', $data);
	   redirect('admin/broken');
	}
	
	public function del_broken($id){
	    $this->db->delete('tbl_broken_beras',['id' => $id]);
	    redirect('admin/broken');
	}
	
	public function detail_broken($id){
	    $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
	    $data['broken'] = $this->db->query("SELECT * FROM tbl_broken_beras, jenis_beras WHERE tbl_broken_beras.jenis_gabah = jenis_beras.id_jenis AND tbl_broken_beras.id = $id")->row();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/detail_beras_broken', $data);
		$this->load->view('templates/footer', $data);
	}
	
	public function edit_broken($id){
	    $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
	    $data['broken'] = $this->db->query("SELECT * FROM tbl_broken_beras, jenis_beras WHERE tbl_broken_beras.jenis_gabah = jenis_beras.id_jenis AND tbl_broken_beras.id = $id")->row();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/edit_beras_broken', $data);
		$this->load->view('templates/footer', $data);
	}
	
	public function edit_beras_broken(){
	    $id = $this->input->post('id');
	    $data = [
	        'nama_supplier' => $this->input->post('nama_supplier'),
	        'nama_supir' => $this->input->post('nama_supir'),
	        'plat_kendaraan' => $this->input->post('plat'),
	        'jenis_gabah' => $this->input->post('jenis_gabah'),
	        'tonase' => $this->input->post('tonase'),
	        'harga' => $this->input->post('harga_kg'),
	        'total' => $this->input->post('total'),
	        'keterangan' => $this->input->post('keterangan'),
	        'tanggal' => date('Y-m-d')
	   ];
	  
	    $this->db->where('id', $id)->update('tbl_broken_beras', $data);
	    redirect('admin/broken');
	  
	}
	
	
	
}
