<!-- Sidebar | Content Wrapper | Main Content | Topbar -->
<?php $this->load->view('layouts/side');?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Tanggapan atas Aduan Masyarakat</h1>
	</div>

	<!-- Content Row -->
	<div class="row">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
				<h6 class="m-0 font-weight-bold text-primary">Tanggapan dari pemeritah</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive text-center">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>ID</th>
								<th>NIK Pengadu</th>
								<th>Waktu</th>
								<th>Aduan</th>
								<th>Tanggapan</th>
								<?php if($this->session->userdata('level') == 'admin') {?>
								<th>Nama Petugas</th>
								<?php } ?>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($tanggapan as $d): ?>
							<tr>
								<td><?= ++$start ?></td>
								<td><?= $d['nik'] ?> </td>
								<td>
                                    <small>Diaduakan: <?= $d['tgl_pengaduan'] ?> <br></small>
                                    <small>Ditanggapi: <?= $d['tgl_pengaduan'] ?></small>
                                </td>
								<td><?= $d['isi_laporan'] ?></td>
								<td><?= $d['isi_tanggapan'] ?></td>
								<?php if($this->session->userdata('level') == 'admin') {?>
									<td><?= $d['nama_lengkap'] ?></td>
								<?php } ?>
								<td>
									<a href="<?= base_url() ?>admin/hapusTanggapan/<?= $d['id_tanggapan'] ?>/<?= $d['id_pengaduan'] ?>" class="badge badge-danger deleteAd">Hapus</a>
									<a type="button" class="badge badge-warning tampiltanggapan" data-toggle="modal"
										data-target="#ubahT" data-id="<?=$d['id_tanggapan'];?>">
										Ubah
									</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Ubah Tanggapan -->
<div class="modal fade" id="ubahT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
							<div class="bukti-foto">

							</div>
						</div>
					</div>
					<form method="post" action="<?= base_url() ?>admin/ubahTanggapan/">
                        <input type="hidden" name="id_tanggapan" value="" id="id_tanggapan">
                        <div class="form-group">
                            <label for="isi_tanggapan">Tanggapan</label>
							<textarea rows="5" cols="8" class="form-control" name="isi_tanggapan" id="isi_tanggapan"></textarea>
						</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<input type="submit" class="btn btn-success" value="Ubah"></input>
				</form>
			</div>
		</div>
	</div>
</div>
