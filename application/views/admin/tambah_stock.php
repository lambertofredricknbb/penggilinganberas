    
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>Stok Siap Giling
                                        <div class="page-title-subheading">Data Stock Gabah Siap Giling
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
                                            <div class="col-md-12">
                                                <form action="<?= base_url('admin/proses_add_stock') ?>" method="post">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="">Kode Pembelian :</label>
                                                                <select required="" class="form-control" id="kode">
                                                                    <option value="">-- Pilih ---</option>
                                                                    <?php foreach ($pembelian as $p): ?>
                                                                        <option value="<?= $p['kode_pembelian'] ?>-<?= $p['nama_supplier'] ?>-<?= $p['tonase'] ?>-<?= $p['jenis_kering'] ?>"><?= $p['kode_pembelian'] ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                                <input type="hidden" id="kode_pembelian" name="kode_pembelian">
                                                                <input type="hidden" id="jenis_kering" name="jenis_kering">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="">Supplier :</label>
                                                                <input type="text" id="supplier" required="" class="form-control" readonly="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="">Tonase Awal : <span style="color: red;">(Kg)</span></label>
                                                                <input type="text" id="tonase" required="" class="form-control" readonly="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Tonase Akhir : <span style="color: red;">(Kg)</span></label>
                                                                <input type="text" name="tonase_akhir" class="form-control" id="tonase_akhir">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Penyusutan : <span style="color: red;">(%)</span></label>
                                                                <input type="text" readonly="" required="" name="penyusutan" id="penyusutan" class="form-control">
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                                    <input type="hidden" name="tanggal" value="<?= date('Y-m-d') ?>">
                                                    <input type="submit" class="btn btn-primary" value="Simpan">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script type="text/javascript">
            $('#tonase_akhir').keyup(function(){
                var awal = $('#tonase').val();
                var akhir = $(this).val();
                var persen = Number(awal) - Number(akhir);
                var total = (Number(persen) / Number(awal)) * 100; 
                $('#penyusutan').val(total);
            });
            $(document).on("change", "#kode", function () {
                var select = $(this).val();
                var data = select.split('-');
                var kode = data[0]
                var supplier = data[1]
                var tonase = data[2]
                var jenis = data[3]
                $('#kode_pembelian').val(kode)
                $('#supplier').val(supplier)
                $('#tonase').val(tonase)
                $('#jenis_kering').val(jenis)
            });
        </script>
                    