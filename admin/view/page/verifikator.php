<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Verifikator</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					Input verifikator
				</div>
				<div class="panel-body">
					<form action="pemroses/verifikator.php" method="get" enctype="multipart/form-data">
										<div class="form-group">
											<label>Nama</label>
											<input type="text" name="nama" class="form-control" placeholder="masukkan nama verifikator">
										</div>
										<div class="form-group">
											<label>NIP</label>
											<input type="text" name="nip" class="form-control" placeholder="masukkan NIP verifikator">
										</div>
										<div class="form-group">
											<label>Password</label>
											<input type="password" name="password" class="form-control" placeholder="masukkan password verifikator">
										</div>
										<button type="submit" class="btn btn-success">Simpan</button>
										<button type="reset" class="btn btn-danger">Reset</button>
									</form>
					
				</div>
				
			</div>
			
		</div>

		<div class="col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Verifikator
				</div>
				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th>Nama</th>
							<th>NIP</th>
							<th>Password</th>
							<th colspan="2" style="text-align: center;">Aksi</th>
						</tr>
						</thead>
						<tbody>
							<?php 
								$sql = "SELECT * FROM verifikator ORDER BY id_verifikator ASC";
								$query = mysqli_query($con,$sql);
								while ($row = mysqli_fetch_assoc($query)) {
							
							 ?>
						<tr>
							<td><?php echo $row['nama']; ?></td>
							<td><?php echo $row['nip']; ?></td>
							<td><?php echo $row['password']; ?></td>
							<td><a href="pemroses/hapusverifikator.php?id_verifikator=<?php echo $row['id_verifikator']; ?>"onclick="return confirm('Hapus Data?')">Hapus</a></td>
						</tr>
							<?php 
							}
							 ?>
						</tbody>

					</table>
					
				</div>
				
			</div>
			
		</div>
		
	</div>

</div>