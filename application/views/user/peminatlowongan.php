<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert"><?= validation_errors();  ?></div>
            <?php endif; ?>

            <?= $this->session->flashdata('message');  ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newPeminatLowonganModal">Add New Peminat Lowongan</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alasan</th>
                        <th scope="col">Prodi</th>
                        <th scope="col">Lowongan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($peminatlowongan as $pl) : ?>
                        <tr>
                            <th scope="row"><?= $i;  ?></th>
                            <td><?= $pl['nim'];  ?></td>
                            <td><?= $pl['nama'];  ?></td>
                            <td><?= $pl['alasan'];  ?></td>
                            <td><?= $pl['prodi_id'];  ?></td>
                            <td><?= $pl['lowongan_id'];  ?></td>
                            <td>
                                <a href="<?= base_url(); ?>admin/editpeminatlowongan/<?= $pl['id'] ?>" class="badge badge-success" data-toggle="modal" data-target="#editPeminatLowonganModal<?= $pl['id']; ?>">edit</a>
                                <a href="<?= base_url(); ?>user/deletepeminatlowongan/<?= $pl['id']; ?>" onclick="return confirm('Are you sure?');" class="badge badge-danger">delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- modal -->

<!-- Modal -->
<div class="modal fade" id="newPeminatLowonganModal" tabindex="-1" aria-labelledby="newPeminatLowonganModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPeminatLowonganModalLabel">Add New Peminat Lowongan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/peminatlowongan'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="alasan" name="alasan" placeholder="Alasan">
                    </div>
                    <div class=" form-group">
                        <select name="prodi_id" id="prodi_id" class="form-control">
                            <option value="">Select Prodi</option>
                            <?php foreach ($prodi as $p) : ?>
                                <option value="<?= $p['id']; ?>"><?= $p['nama']; ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class=" form-group">
                        <select name="lowongan_id" id="lowongan_id" class="form-control">
                            <option value="">Select lowongan</option>
                            <?php foreach ($lowongan as $l) : ?>
                                <option value="<?= $l['id']; ?>"><?= $l['deskripsi_pekerjaan']; ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end of modal -->


<!-- Modal edit -->
<?php $i = 0;
foreach ($peminatlowongan as $pl) : $i++; ?>
    <div class="modal fade" id="editPeminatLowonganModal<?= $pl['id']; ?>" tabindex="-1" aria-labelledby="editPeminatLowonganModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPeminatLowonganModalLabel">Edit Peminat Lowongan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/editpeminatlowongan/') . $pl['id']; ?>" method="post">
                    <input type="hidden" name="id" value="<?= $pl['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" value="<?= $pl['nim']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap" value="<?= $pl['nama']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="alasan" name="alasan" placeholder="Alasan" value="<?= $pl['alasan']; ?>">
                        </div>
                        <div class=" form-group">
                            <select name="prodi_id" id="prodi_id" class="form-control">
                                <option value="">Select Prodi</option>
                                <?php foreach ($prodi as $p) : ?>
                                    <option value="<?= $p['id']; ?>"><?= $p['nama']; ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                        <div class=" form-group">
                            <select name="lowongan_id" id="lowongan_id" class="form-control">
                                <option value="">Select lowongan</option>
                                <?php foreach ($lowongan as $l) : ?>
                                    <option value="<?= $l['id']; ?>"><?= $l['deskripsi_pekerjaan']; ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- end of modal edit -->