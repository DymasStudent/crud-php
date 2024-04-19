<?php

// membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
  echo "<script>
          document.location.href = 'login.php';
        </script>";
  exit;
}

$title = 'Daftar Akun';

include 'layout/header.php';

$data_akun = select("SELECT * FROM akun");

// tombol tambah ditekan
if (isset($_POST['tambah'])) {
  if (create_akun($_POST) > 0) {
    echo "<script>
          alert('Data Akun Berhasil Ditambahkan');
          document.location.href = 'crud-modal.php';
          </script>";
  } else {
    echo "<script>
            alert('Data Akun Gagal Ditambahkan');
            document.location.href = 'crud-modal.php';
          </script>";
  }
}

// tombol ubah ditekan
if (isset($_POST['ubah'])) {
  if (update_akun($_POST) > 0) {
    echo "<script>
            alert('Data Akun Berhasil Diubah');
            document.location.href = 'crud-modal.php';
          </script>";
  } else {
    echo "<script>
            alert('Data Akun Gagal Diubah');
            document.location.href = 'crud-modal.php';
          </script>";
  }
}

?>

<div class="container mt-5">
  <h1>Data Akun</h1>
  <hr>

  <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal"
    data-bs-target="#modalTambah">Tambah</button>

  <table class="table table-bordered table-striped mt-3" id="table">
    <thead>
      <th>No</th>
      <th>Nama</th>
      <th>Username</th>
      <th>Email</th>
      <th>Password</th>
      <th>Aksi</th>
    </thead>

    <tbody>
      <?php $no = 1; ?>
      <?php foreach ($data_akun as $akun): ?>
        <tr>
          <td>
            <?= $no++; ?>
          </td>
          <td>
            <?= $akun['nama']; ?>
          </td>
          <td>
            <?= $akun['username']; ?>
          </td>
          <td>
            <?= $akun['email']; ?>
          </td>
          <td>
            Encrypted Password
          </td>
          <td class="text-center">
            <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal"
              data-bs-target="#modalUbah<?= $akun['id_akun']; ?>">Ubah</button>
            <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal"
              data-bs-target="#modalHapus<?= $akun['id_akun']; ?>">Hapus</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Modal Tambah-->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="mb-3">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required minlength="6">
          </div>

          <div class="mb-3">
            <label for="level">level</label>
            <select name="level" id="level" class="form-control" required>
              <option value="">-- pilih level</option>
              <option value="1">Administrator Utama</option>
              <option value="2">Administrator</option>
              <option value="3">User</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Ubah-->
<?php foreach ($data_akun as $akun): ?>
  <div class="modal fade" id="modalUbah<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Akun</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">
            <div class="mb-3">
              <label for="nama">Nama</label>
              <input type="text" name="nama" id="nama" class="form-control" value="<?= $akun['nama']; ?>" required>
            </div>

            <div class="mb-3">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control" value="<?= $akun['username']; ?>"
                required>
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" value="<?= $akun['email']; ?>" required>
            </div>

            <div class="mb-3">
              <label for="password">Password <small>(Masukan password baru/lama)</small></label>
              <input type="password" name="password" id="password" class="form-control" required minlength="6">
            </div>

            <div class="mb-3">
              <label for="level">level</label>
              <select name="level" id="level" class="form-control" required>
                <?php $level = $akun['level']; ?>
                <option value="1" <?= $level == '1' ? 'selected' : null ?>>Administrator Utama</option>
                <option value="2" <?= $level == '2' ? 'selected' : null ?>>Administrator</option>
                <option value="3" <?= $level == '3' ? 'selected' : null ?>>User</option>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
          <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- Modal Hapus-->
<?php foreach ($data_akun as $akun): ?>
  <div class="modal fade" id="modalHapus<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Akun</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus Data Akun :
            <?= $akun['nama']; ?> .?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <a href="hapus-akun.php?id_akun=<?= $akun['id_akun']; ?>" class="btn btn-primary">Hapus</a>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<?php include 'layout/footer.php'; ?>