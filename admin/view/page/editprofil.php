<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Edit</h1>
		</div>

	</div>

<?php 
//include('../pemroses/koneksi.php');
if (isset($_GET['id_admin']))
{
	$id_admin = $_GET['id_admin'];
}
 $sql = "SELECT *FROM admin WHERE id_admin=".$_GET['id_admin'];
 $query = mysqli_query($con, $sql);
$a = mysqli_fetch_assoc($query);

 ?>
	
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<form action="pemroses/editprofil.php?id_admin=<?php echo $a['id_admin']; ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama_admin" class="form-control" value="<?php echo $a['nama_admin']; ?>" required>
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" value="<?php echo $a['username']; ?>" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" value="<?php echo $a['password']; ?>" required>
					</div>
						<button type="submit" class="btn btn-success">Simpan</button>
						<button type="reset" class="btn btn-danger">Reset</button>
					
				</form>
			
			</div>
		
		</div>

		
	</div>

</div>