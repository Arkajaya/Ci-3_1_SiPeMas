<!-- Sidebar | Content Wrapper | Main Content | Topbar -->
<?php $this->load->view('layouts/side');?>

<!-- Begin Page Content -->
<div class="container-fluid">


	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Pengaduan Anda</h1>
		<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
				class="fas fa-download fa-sm text-white-50"></i>Cetak</a>
	</div>

	<!-- Content Row -->
	<div class="row">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
				<h6 class="m-0 font-weight-bold text-primary">Riwayat Pengaduan</h6>
				<button type="button" class="btn btn-primary tambahAduan" data-toggle="modal" data-target="#tmbhadn">
					Buat Aduan
				</button>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>ID</th>
								<th>Tanggal Aduan</th>
								<th>Tanggal Ditanggapi</th>
								<th>Isi aduan</th>
								<th>Bukti foto</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($aduan as $d): ?>
							<tr>
								<td><?= ++$start ?></td>
								<td><?= $d['tgl_pengaduan']; ?></td>
								<td><?= empty($d['tgl_tanggapan']) ? 'Belum Ditangggapi' : $d['tgl_tanggapan'] ?></td>
								<td><?= $d['isi_laporan']; ?></td>
								<td><img src="<?= base_url() ?>assets/img/<?= $d['foto']; ?>" alt="" width="100px"
										hight="100px"></td>
								<td>
									<?php if ($d['status'] == 'selesai') { ?>
									<a type="button" class="badge badge-primary tampiltanggapan" id="tampilTanggapan"
										data-toggle="modal" data-target="#tmpltgp" data-id="<?= $d['id_tanggapan'];?>">
										Tanggapan
									</a>
									<?php } else {
									 	echo $d['status']; 
										}?>
								</td>
								<td>
									<a type="button" class="badge badge-warning tampiladuan" id="ubahAduan"
										data-toggle="modal" data-target="#tmbhadn" data-id="<?= $d['id_pengaduan'];?>">
										Ubah
									</a>
									<a href="<?= base_url() ?>/pengaduan/hapusAduan/<?= $d['id_pengaduan'] ?>"
										class="badge badge-danger deleteAd">Hapus</a>
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
<div class="modal fade" id="tmbhadn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formLabel">Form Aduan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?= base_url() ?>pengaduan/tambahAduan" enctype="multipart/form-data">
					<input type="hidden" name="id_pengaduan" value="" id="id_pengaduan">
					<div class="form-group">
						<label for="isi_aduan">Isi Aduan</label>
						<textarea rows="10" cols="30" class="form-control" name="isi_aduan" id="isi_aduan"
							placeholder="Masukan Aduan anda..."></textarea>
					</div>
					<div class="form-group">
						<label for="bukti_foto">Bukti foto (Opsional sebagai pendukung)</label>
						<input type="hidden" name="old_foto" value="" id="old_foto">
						<input type="file" name="bukti_foto" value="" id="bukti_foto" class="form-control mt-2">
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<input type="submit" class="btn btn-success" value="Adukan"></input>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- Modal Tampil Tanggapan -->
<div class="modal fade" id="tmpltgp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
							<div class="bukti-foto">

							</div>
						</div>
					</div>
					<input type="hidden" name="id_tanggapan" value="" id="id_tanggapan">
					<div class="form-group">
						<label for="isi_tanggapan">Tanggapan</label>
						<textarea rows="5" cols="8" class="form-control" name="isi_tanggapan"
							id="isi_tanggapan" readonly></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Oke</button>
			</div>
		</div>
	</div>
</div>
