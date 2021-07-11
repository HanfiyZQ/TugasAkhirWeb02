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

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newLowonganModal">Add New Lowongan</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Deskripsi pekerjaan</th>
                        <th scope="col">Tanggal akhir</th>
                        <th scope="col">Mitra</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($lowongan as $l) : ?>
                        <tr>
                            <th scope="row"><?= $i;  ?></th>
                            <td><?= $l['deskripsi_pekerjaan'];  ?></td>
                            <td><?= $l['tanggal_akhir'];  ?></td>
                            <td><?= $l['mitra_id'];  ?></td>
                            <td><?= $l['email'];  ?></td>
                            <td>
                                <a href="<?= base_url(); ?>admin/editlowongan/<?= $l['id'] ?>" class="badge badge-success" data-toggle="modal" data-target="#editLowonganModal<?= $l['id']; ?>">edit</a>
                                <a href="<?= base_url(); ?>admin/deletelowongan/<?= $l['id']; ?>" onclick="return confirm('Are you sure?');" class="badge badge-danger">delete</a>
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
<div class="modal fade" id="newLowonganModal" tabindex="-1" aria-labelledby="newLowonganModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newLowonganModalLabel">Add New lowongan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/editlowongan'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="deskripsi_pekerjaan" name="deskripsi_pekerjaan" placeholder="Deskripsi pekerjaan">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" placeholder="Tanggal akhir">
                    </div>
                    <div class=" form-group">
                        <select name="mitra_id" id="mitra_id" class="form-control">
                            <option value="">Select Mitra</option>
                            <?php foreach ($mitra as $mi) : ?>
                                <option value="<?= $mi['id']; ?>"><?= $mi['nama']; ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Mitra email">
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

<!-- end modal -->

<!-- Modal Edit -->
<?php $i = 0;
foreach ($lowongan as $l) : $i++; ?>
    <div class="modal fade" id="editLowonganModal<?= $l['id']; ?>" tabindex="-1" aria-labelledby="editLowonganModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLowonganModalLabel">Add edit lowongan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('admin/editlowongan/') . $l['id'] ?>" method="post">
                    <input type="hidden" name="id" value="<?= $l['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="deskripsi_pekerjaan" name="deskripsi_pekerjaan" placeholder="Deskripsi pekerjaan" value="<?= $l['deskripsi_pekerjaan']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" placeholder="Tanggal akhir" value="<?= $l['tanggal_akhir']; ?>">
                        </div>
                        <div class=" form-group">
                            <select name="mitra_id" id="mitra_id" class="form-control">
                                <option value="">Select Mitra</option>
                                <?php foreach ($mitra as $mi) : ?>
                                    <option value="<?= $mi['id']; ?>"><?= $mi['nama']; ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Mitra email" value="<?= $l['email']; ?>">
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