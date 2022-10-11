<?php
// memanggil file koneksi dan file proses 
require 'koneksi.php';
include 'proses_siswa.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <!-- link style menggunakan bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- mengatur ukuran halaman website -->
    <div class="container-sm">
        <br>
        <h1 class="text-center">
            Daftar Mahasiswa
        </h1>

        <!-- membuat tombol untuk mengarahkan ke halaman input data siswa -->
        <div class="col text-start">
            <a class="btn btn-primary" href="tambah_siswa.php">Tambah Data Mahasiswa</a>
        </div>


        <!-- membuat tampilan card -->
        <div class="card">
            <!-- card header: -->
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Data siswa</h4>
            </div>
            <!-- card body -->
            <div class="card-body">
                <!-- membuat alert untuk menampilkan pesan (berhasil atau gagal)-->
                <?php
                    if (isset($_GET['hapus'])) {
                                            
                        if ($_GET['hapus']=='berhasil'){
                            echo"<div class='alert alert-success'><strong>Berhasil!</strong> Berhasil Menghapus Data Siswa!</div>";
                        }else if ($_GET['hapus']=='gagal'){
                            echo"<div class='alert alert-danger'><strong>Gagal!</strong> Gagal Menghapus Data Siswa!</div>";
                        }    
                    }  
                    if (isset($_GET['update'])) {
                                            
                        if ($_GET['update']=='berhasil'){
                            echo"<div class='alert alert-success'><strong>Berhasil!</strong> Berhasil Mengubah Data Siswa!</div>";
                        }else if ($_GET['update']=='gagal'){
                            echo"<div class='alert alert-danger'><strong>Gagal!</strong> Gagal Mengubah Data Siswa!</div>";
                        }    
                    }  
                ?>
                
                <!-- membuat tabel untuk menampilkan data dari database -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <!-- membuat tabel header unuk nama kolom -->
                            <th scope="col">No</th>
                            
                            <th scope="col">Nama</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Fakultas</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <!-- tbody untuk menampilkan data dari database -->
                    <tbody>
                        <?php 
                        // membuat query untuk menampilkan data
                        $query = mysqli_query($koneksi,"SELECT * FROM mahasiswa");
                        // membuat variabel $no untuk membuat nomor urut data
                        $no = 1;
                        // membuat variabel $count untuk menghitung jumlah data
                        $count = mysqli_num_rows($query);
                        // perulangan while, digunakan untuk menampilkan data dengan mysqli_fetch_assoc
                        while ($data = mysqli_fetch_assoc($query)) 
                        {
                            // menyimpan data dalam bentuk variabel agar mudah saat pemanggilan
                            $nim = $data['nim'];
                            $nama = $data['nama'];
                            $email = $data['email'];
                            $jurusan = $data['jurusan'];
                            $fakultas = $data['fakultas'];
                            $gambar = $data['gambar'];
                        }
                        ?>
                        <tr>
                            <!-- menampilkan data pada tabel dengan memanggil variabel -->
                            <td><?= $no++ ?></td>                            
                            
                            <td><?= $nama ?></td>
                            <td><?= $email ?></td>
                            <td><?= $jurusan ?></td>
                            <td><?= $fakultas ?></td>
                            <td>
                            <?php 
							if ($data['gambar'] == "") { ?>
								<img src="https://via.placeholder.com/500x500.png?text=PAS+FOTO+SISWA" style="width:80px;height:100px;">
							<?php }else{ ?>
								<img src="gambar/<?php echo $data['gambar']; ?>" style="width:80px;height:100px;">
							<?php } ?>
                            </td>
                            <td>
                                <!-- Membuat form untuk mengirim nis, yang digunakan untuk proses update dan delete -->
                                <form method="Post">
                                    <input type="hidden" name="nim" value="<?= $nim ?>">
                                    <a class="btn btn-primary" href="update_siswa.php?nim=<?= $nim ?>">Ubah</a>
                                    <button name="delete-siswa" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>

                        </tr>
                        <?php
                        
                        ?>
                    </tbody>
                </table>

                <h6>Jumlah Data Siswa : <?php echo $count; ?></h6>
            </div>
        </div>
    </div>
    </div>


    </div>

</body>

</html>