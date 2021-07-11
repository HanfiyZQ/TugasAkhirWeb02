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

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMitraModal">Add New Mitra</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">kontak</th>
                        <th scope="col">Telpon</th>
                        <th scope="col">Email</th>
                        <th scope="col">Web</th>
                        <th scope="col">Bidang usaha</th>
                        <th scope="col">Sektor usaha</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($mitra as $mk) : ?>
                        <tr>
                            <th scope="row"><?= $i;  ?></th>
                            <td><?= $mk['nama'];  ?></td>
                            <td><?= $mk['alamat'];  ?></td>
                            <td><?= $mk['kontak'];  ?></td>
                            <td><?= $mk['telpon'];  ?></td>
                            <td><?= $mk['email'];  ?></td>
                            <td><?= $mk['web'];  ?></td>
                            <td><?= $mk['bidang_usaha_id'];  ?></td>
                            <td><?= $mk['sektor_usaha_id'];  ?></td>
                            <td>
                                <a href="<?= base_url(); ?>admin/editmitrakerja/<?= $mk['id'] ?>" class="badge badge-success" data-toggle="modal" data-target="#editMitraModal<?= $mk['id']; ?>">edit</a>
                                <a href="<?= base_url(); ?>admin/deletemitrakerja/<?= $mk['id']; ?>" onclick="return confirm('Are you sure?');" class="badge badge-danger">delete</a>
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

<div class="modal fade" id="newMitraModal" tabindex="-1" aria-labelledby="newMitraModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMitraModalLabel">Add New Mitra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/mitrakerja'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Perusahaan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Perusahaan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kontak" name="kontak" placeholder="Kontak Perusahaan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="telpon" name="telpon" placeholder="Telpon Perusahaan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email Perusahaan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="web" name="web" placeholder="Web Perusahaan">
                    </div>
                    <div class=" form-group">
                        <select name="bidang_usaha_id" id="bidang_usaha_id" class="form-control">
                            <option value="">Select bidang usaha</option>
                            <?php foreach ($bidangusaha as $bi) : ?>
                                <option value="<?= $bi['id']; ?>"><?= $bi['nama']; ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class=" form-group">
                        <select name="sektor_usaha_id" id="sektor_usaha_id" class="form-control">
                            <option value="">Select sektor usaha</option>
                            <?php foreach ($sektorusaha as $su) : ?>
                                <option value="<?= $su['id']; ?>"><?= $su['nama']; ?></option>
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

<!-- modal edit -->
<?php $i = 0;
foreach ($mitra as $mk) : $i++; ?>
    <div class="modal fade" id="editMitraModal<?= $mk['id']; ?>" tabindex="-1" aria-labelledby="editMitraModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMitraModalLabel">Edit Mitra Kerja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="<?php echo base_url('admin/editmitrakerja/') . $mk['id'] ?>" method="POST">


                        <input type="hidden" name="id" value="<?= $mk['id']; ?>">

                        <div class="form-group">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Perusahaan" value="<?= $mk['nama']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Perusahaan" value="<?= $mk['alamat']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="kontak" name="kontak" placeholder="Kontak Perusahaan" value="<?= $mk['kontak']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="telpon" name="telpon" placeholder="Telpon Perusahaan" value="<?= $mk['telpon']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Perusahaan" value="<?= $mk['email']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="web" name="web" placeholder="Web Perusahaan" value="<?= $mk['web']; ?>">
                        </div>
                        <div class=" form-group">
                            <select name="bidang_usaha_id" id="bidang_usaha_id" class="form-control">
                                <option value="">Select bidang usaha</option>
                                <?php foreach ($bidangusaha as $bi) : ?>
                                    <option value="<?= $bi['id']; ?>"><?= $bi['nama']; ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                        <div class=" form-group">
                            <select name="sektor_usaha_id" id="sektor_usaha_id" class="form-control">
                                <option value="">Select sektor usaha</option>
                                <?php foreach ($sektorusaha as $su) : ?>
                                    <option value="<?= $su['id']; ?>"><?= $su['nama']; ?></option>
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