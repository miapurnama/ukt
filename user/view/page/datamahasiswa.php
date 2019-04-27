<?php 
$data = $con->query("SELECT * FROM lampiran_mahasiswa WHERE id_mahasiswa = {$_SESSION['id_mahasiswa']} ORDER BY kode_kriteria");
?>
<style>
.zoom {
  background-color: transparent;
  transition: transform .2s; /* Animation */
  width: 250px;
  height: 200;
  margin: 0 auto;
}

.zoom:hover {
  transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Data</h4>
        </div>
        <form action="pemroses/datamahasiswa.php" method="POST" enctype="multipart/form-data" id="form_edit">
            <div class="modal-body">
                <input type="hidden" name="id">
                <input type="hidden" name="id_mahasiswa">
                <div class="form-group">
                    <label>Kode Kriteria</label>
                    <input type="text" name="kode_kriteria" id="kriteria-kode" class="form-control">
                </div>
                <div class="form-group">
                    <label>Parameter</label>
                    <select name="skor" id="select-skor-pekerjaan" class="form-control interval_parameter">
                        
                    </select>
                    <input type="text" name="gaji" class="form-control" id="select-skor-gaji">
                    <input type="hidden" name="nama_parameter" value="">
                </div>
                <div class="form-group">
                    <label>Lampiran</label>
                    <input type="file" name="file_img" id="imgInp">
                    <small>Format: jpg,png</small>
                </div>
                <div class="form-group">
                    <label>Preview</label>
                    <img class="img-responsive" id="tampilkan" src="#" alt="your image" style="width: 40%; height: 30%"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_edit">Edit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>

  </div>
</div>
<div id="myModalImg" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Data</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <img src="" id="myImage">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>

  </div>
</div>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Data Mahasiswa</h3>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div padding left = "12px">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Data Persyaratan UKT
                            </div>
                            <div class="panel-heading" style="background-color:white;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Kriteria</th>
                                            <th>Lampiran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no = 0;
                                        while($row = $data->fetch_assoc()){
                                            $no++
                                        ?>
                                            <tr data-nama-file="<?php echo $row['nama_file'] ?>" data-id="<?php echo $row['id'] ?>" data-id-mahasiswa="<?php echo $row['id_mahasiswa']; ?>" data-kode-kriteria="<?php echo $row['kode_kriteria']; ?>" data-skor="<?php echo $row['interval_parameter']; ?>" data-nama-parameter="<?php echo $row['nama_parameter'] ?>">
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $row['kode_kriteria']; ?></td>
                                                <td><?php echo ($row['nama_file'] == '') ? 'Tidak ada lampiran' : '<a href="javascript:;" class="myFile">lihat lampiran</a>' ?></td>
                                                <td><a href="javascript:;" class="editdata"><i class="fa fa-edit"></i>Edit</a></td>
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
        </div>
    </div>
</div>
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>

    $('.myFile').click(function(){
        let nama_file = $(this).closest('tr').data('nama-file');
        $('#myImage').attr('src', '../upload/' + nama_file);
        $('#myModalImg').modal('show');   
    })

    $('.editdata').click(function(){
        $('#form_edit')[0].reset();
        $('[name="id"]').val($(this).closest('tr').data('id'));
        $('[name="id_mahasiswa"]').val($(this).closest('tr').data('id-mahasiswa'));
        $('[name="kode_kriteria"]').val($(this).closest('tr').data('kode-kriteria'));

        $('[name="skor"]').html('');
        var kriteria = $('#kriteria-kode').val();

        if ((kriteria == 'K01') || (kriteria == 'K02')) {
            $('#select-skor-gaji').removeClass('hidden');
            $('#select-skor-pekerjaan').addClass('hidden');
            var nama_parameter = $(this).closest('tr').data('nama-parameter');
            $('#select-skor-gaji').val(nama_parameter);
            $('input[name="nama_parameter"]').val(nama_parameter);
        } else {
            $('#select-skor-gaji').addClass('hidden');
            $('#select-skor-pekerjaan').removeClass('hidden');

            $('[name="skor"]').append(`
                <option val="">---Pilih Parameter---</option>
            `);
            var nama_parameter = $(this).closest('tr').data('nama-parameter');
            $.get('pemroses/editdata.php', {kode_kriteria : $(this).closest('tr').data('kode-kriteria')})
            .done(function(data){
                $.each($.parseJSON(data), function(i,val){
                    $('[name="skor"]').append(`
                        <option value="${val.skor}" ${val.interval_parameter == nama_parameter ? 'selected' : ''} data-nama-parameter="${val.interval_parameter}">${val.interval_parameter}</option>
                    `); 
                });
            })
        }
        $('#tampilkan').attr('src', '../upload/' + $(this).closest('tr').data('nama-file'));
        $('#myModal').modal('show');
        
    })

    $('#select-skor-gaji').keyup(function(){
        var nama_parameter = $('#select-skor-gaji').val();
        $('input[name="nama_parameter"]').val(nama_parameter);
    });

    $('.interval_parameter').change(function(){
        $('input[name="nama_parameter"]').val($(this).find(':selected').data('nama-parameter'));
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#tampilkan').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });

    $('#btn_edit').click(function(e){
        swal({
            title : 'Perhatian',
            text : 'Pastikan data yang kamu isi telah benar',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Submit'
        }).then((result) => {
            if(result.value){
                $('form#form_edit').submit();
            }
        })
    })
</script>