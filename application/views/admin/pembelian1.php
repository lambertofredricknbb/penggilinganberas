<?php 
    function tgl_indo($tanggal){
    $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
?>
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>Data Pembelian
                                        <div class="page-title-subheading">Data Pembelian Beras Yang Sudah Diterima
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>            
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="card-title">Tabel Pembelian</h5>
                                            </div>
                                            <div class="col-md-6" align="right">
                                                <!-- <a href="<?= base_url('admin/tambah_pembelian') ?>" class="btn btn-success"><i class="fas fa fa-plus"></i> Tambah Pembelian</a> -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                  <i class="fas fa fa-plus"></i> Tambah Pembelian
                                                </button>
                                                <a href="<?= base_url('admin/download') ?>"><i class="fas fa fa-print"></i></a>
                                            </div>
                                        </div>

                                        <table class="mb-0 table my-3 table-striped table-hovered">
                                            <thead>
                                            <tr class="text-center">
                                                <th>Kode Nota</th>
                                                <th>Nama Supplier</th>
                                                <th>Plat / Nama Supir</th>
                                                <th>Tonase</th>
                                                <th>Jenis Kering</th>
                                                <th>Total Harga</th>
                                                <th>No Penjemuran</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($pembelian as $p): ?>
                                                <?php 
                                                $this->db->select('SUM(tonase) as total_tonase');
                                                $this->db->from('tb_pembelian');
                                                $this->db->where('tb_pembelian.kode_pembelian', $p['kode_pembelian']);
                                                $tonase = $this->db->get()->row()->total_tonase;

                                                $this->db->select('SUM(total) as total_harga');
                                                $this->db->from('tb_pembelian');
                                                $this->db->where('tb_pembelian.kode_pembelian', $p['kode_pembelian']);
                                                $total_harga = $this->db->get()->row()->total_harga;
                                                 ?>
                                            <tr>
                                                <th scope="row"><?= $p['kode_pembelian'] ?></th>
                                                <td><?= $p['nama_supplier'] ?></td>
                                                <td><?= $p['plat'] ?> / <?= $p['nama_supir'] ?></td>
                                                <td class="text-center"><?= $tonase ?> KG</td>
                                                <td class="text-center"><?= $p['jenis_kering'] ?></td>
                                                <td class="text-center">Rp. <?= number_format($total_harga, 0,'.','.') ?></td>
                                                <td class="text-center"> No. <?= $p['no_penjemuran'] ?></td>
                                                <td>
                                                    <a href="<?= base_url('admin/detail_pembelian/').$p['kode_pembelian'] ?>" class="btn btn-success"><i class="fas fa-search"></i></a>
                                                    <a href="" class="btn btn-danger"><i class="fas fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <!-- modal -->
                    <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            ...
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>