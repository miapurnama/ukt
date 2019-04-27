<?php 
$sql = mysqli_query($con, "SELECT * FROM admin ORDER BY id_admin");
$row = mysqli_fetch_assoc($sql);

 ?>

 <div id="page-wrapper">
 	<div class="row">
 		<div class="col-lg-12">
 			<h1>Profil Admin</h1>
 		</div>
 	</div>

 	<div class="row">
 		<div class="col-lg-6">
 			<div class="panel panel-default">
 				<div class="panel panel-body">
 					<div class="row">
 						<div class="col-lg-12">
 							
 							<form action="?p=editprofil&id_admin=<?php echo $row['id_admin']; ?>" method="get" enctype="multipart/form-data">
 								<button type="submit" class="btn btn-success">Edit</button>
 								<input type="hidden" name="id_admin" value="<?php echo $row['id_admin']; ?>">
 								<div class="form-group"></div>
 								<label>Nama Admin</label>
 								<input type="text" name="nama_admin" class="form-control" value="<?php echo $row['nama_admin']; ?>">
 								<div class="form-group"></div>
 								<label>Username</label>
 								<input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" >
 								<div class="form-group"></div>
 								<label>Password</label>
 								<input type="text" name="password" class="form-control" value="<?php echo $row['password']; ?>" >
 							</form>
 							
 						</div>

 					</div>

 				</div>

 			</div>

 		</div>

 	</div>

 </div>