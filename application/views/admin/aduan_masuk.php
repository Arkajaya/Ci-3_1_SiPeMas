<!-- Sidebar | Content Wrapper | Main Content | Topbar -->
<?php $this->load->view('layouts/side');?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Pengaduan Anda</h1>
	</div>

	<!-- Content Row -->
	<div class="row">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
				<h6 class="m-0 font-weight-bold text-primary">Aduan yang Masuk</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive text-center">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nama Pengadu</th>
								<th>Tanggal Diadukan</th>
								<th>Isi Aduan</th>
								<th>Foto Pendukung</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($dataaduan as $d): ?>
							<tr>
								<td><?= ++$start ?></td>
								<td><?= $d['nama_lengkap']; ?></td>
								<td><?= $d['tgl_pengaduan']; ?></td>
								<td><?= $d['isi_laporan']; ?></td>
								<td><img src="<?= base_url() ?>/assets/img/<?= $d['foto']; ?>" alt="" width="100px"
										hight="100px"></td>
								<td><?= $d['status']; ?></td>
								<td>
									<a href="<?= base_url() ?>admin/hapusAduan/<?= $d['id_pengaduan'] ?>"
										class="badge badge-danger deleteAd">Hapus</a>
									<?php if($d['status'] == 'proses') {?>
									<a href="<?= base_url() ?>admin/verifAduan/<?= $d['id_pengaduan'] ?>"
										class="badge badge-success">Verifikasi</a>
									<?php } else {?>
										<a type="button" class="badge badge-primary tampiltgp" data-toggle="modal"
											data-target="#tanggapi" data-id="<?=$d['id_pengaduan'];?>">
											Tanggapi
										</a>
									<?php } ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?= $this->pagination->create_links() ?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="tanggapi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formLabel">Form Tanggapan atas Aduan Masyarakat</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group ">
					<div class="form-group row text-center">
						<div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="isi_aduan">Isi Aduan</label>
							<textarea rows="4" cols="8" class="form-control" name="isi_aduan" id="isi_aduan"
                            placeholder="Masukan Aduan anda..." readonly></textarea>
						</div>
						<div class="col-sm-6">
							<label for="isi_aduan">Bukti Foto *(Opsi Pendukung)</label>
							<br>
							<img src="<?= base_url() ?>assets/img/" alt="" width="100px"
                            hight="100px" id="foto">
						</div>
					</div>
					<form method="post" action="<?= base_url() ?>admin/tambahTanggapan/">
                        <input type="hidden" name="id_pengaduan" value="" id="id_pengaduan">
                        <div class="form-group">
                            <label for="isi_tanggapan">Tanggapan</label>
							<textarea rows="5" cols="8" class="form-control" name="isi_tanggapan" id="isi_tanggapan"></textarea>
						</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<input type="submit" class="btn btn-success" value="Tanggapi"></input>
				</form>
			</div>
		</div>
	</div>
</div>
