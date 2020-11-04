<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Managemen Pengguna</h1>
        </div>
        <div class="section-body">
            <div class="section-body">
                <h2 class="section-title">Data Pengguna</h2>
            </div>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Simple Table</h4>
                            <div class="card-header-form">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button id="modal-2" class="btn btn-primary" data-toggle="modal" data-target="#tambahpengguna"><i class="fas fa-plus"></i> Tambah Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table1" class="table table-striped table-md">
                                    <thead>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Level</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tampiluser as $ti) : ?>
                                            <tr>
                                                <td><?= array_search($ti, $tampiluser) + 1 ?></td>
                                                <td><?= $ti['nama']; ?></td>
                                                <td><?= $ti['username']; ?></td>
                                                <td><?= $ti['password']; ?></td>
                                                <td><?= $ti['level']; ?></td>
                                                <td>
                                                    <a href="" data-toggle="modal" data-toggle="tooltip" data-target="#editpengguna<?= $ti['id'] ?>" class="btn btn-warning" data-original-title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="<?= base_url('admin/delete_pengguna/') . $ti['id'] ?>" data-toggle="tooltip" class="btn btn-danger tombol-hapus" data-original-title="Hapus">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal tambah -->
    <div class="modal fade" id="tambahpengguna" tabindex="-1" role="dialog" aria-labelledby="tambahpengguna" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahpengguna">Tambah Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                <div class="modal-body">
                    <div class="form-group">
                        <form action="<?= base_url('admin/tambah_pengguna') ?>" method="POST">
                            <label>Nama</label>
                            <div class="input-group">
                                <input type="text" name="nama" id="nama" class="form-control pwstrength" required>
                            </div>
                            <label>Username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <input type="text" name="username" id="username" class="form-control pwstrength" required>
                            </div>
                            <label>Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input type="Password" name="password" id="pass" class="form-control pwstrength" required>
                                <div class="input-group-text">
                                    <input id="mybutton" onclick="change()" type="checkbox" aria-label="Checkbox for following text input"> Lihat Password
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Level</label>
                                <select name="level" id="level" class="form-control">
                                    <option>-- Pilih --</option>
                                    <option>Administrator</option>
                                    <option>Pengurus</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="Submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <script>
            function change() {
                var x = document.getElementById('pass').type;

                if (x == 'password') {
                    document.getElementById('pass').type = 'text';
                    document.getElementById('mybutton').innerHTML;
                } else {
                    document.getElementById('pass').type = 'password';
                    document.getElementById('mybutton').innerHTML;
                }
            }
        </script>
    </div>
    <!-- end modal -->

    <!-- Modal Edit -->
    <?php foreach ($tampiluser as $ti) : ?>
        <div class="modal fade" id="editpengguna<?= $ti['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editpengguna" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editpengguna">Edit Pengguna : <?= $ti['nama'] ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                    <div class="modal-body">
                        <div class="form-group">
                            <form action="<?= base_url('admin/edit_pengguna/') . $ti['id'] ?>" method="POST">
                                <label>Nama</label>
                                <div class="input-group">
                                    <input type="text" name="nama" id="nama" class="form-control pwstrength" value="<?= $ti['nama'] ?>" required>
                                </div>
                                <label>Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="username" id="username" class="form-control pwstrength" value="<?= $ti['username'] ?>" required>
                                </div>
                                <label>Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </div>
                                    <input type="Password" name="password" id="password" class="form-control pwstrength" value="<?= $ti['password'] ?>" required>
                                    <div class="input-group-text">
                                        <input id="myinput" onclick="showpass()" type="checkbox" aria-label="Checkbox for following text input"> Lihat Password
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Level</label>
                                    <select name="level" id="level" class="form-control">
                                        <?php foreach ($level as $l) : ?>
                                            <?php if ($l == $ti['level']) : ?>
                                                <option value="<?= $l; ?>" selected><?= $l; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $l; ?>"><?= $l; ?></option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class=" modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="Submit" class="btn btn-primary">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function showpass() {
                    var x = document.getElementById('password').type;

                    if (x == 'password') {
                        document.getElementById('password').type = 'text';
                        document.getElementById('myinput').innerHTML;
                    } else {
                        document.getElementById('password').type = 'password';
                        document.getElementById('myinput').innerHTML;
                    }
                }
            </script>
        </div><?php endforeach ?>
    <!-- end modal edit -->
</div>