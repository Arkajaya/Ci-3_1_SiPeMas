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
				<h6 class="m-0 font-weight-bold text-primary">Data User Aktif</h6>				
				<a class="btn btn-primary" href="<?= base_url() ?>admin/tampilUserm">Masyarakat</a>					
				<?php if($this->session->userdata('level') == 'admin') {?>
				<a class="btn btn-primary" href="<?= base_url() ?>admin/tampilUserp">Petugas</a>					
				<?php } ?>
			</div>
			<div class="card-body">
				<div class="table-responsive text-center">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>ID</th>
								<th>NIK</th>
								<th>Nama Lengkap</th>
								<th>Username</th>
								<th>No. Hp/Telepon</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($datauser as $d): ?>
							<tr>
								<td>Id</td>
								<td><?= $d['kode_akun']; ?></td>
								<td><?= $d['nama_lengkap']; ?></td>
								<td><?= $d['username']; ?></td>
								<td><?= $d['telp']; ?></td>
								<td>
									<a href="<?= base_url() ?>admin/hapusUser/<?= $d['level'] ?>/<?= $d['kode_akun'] ?>" class="badge badge-danger deleteAd">Hapus</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?= $this->pagination->create_links(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

