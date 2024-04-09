<head>
    <!-- ... tag-tag lainnya ... -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-BGBNtK5WofDk6F2WpNJKvHXsdhF/J1BlyW3U/1rgCBvL/eIbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</head>

<?php $this->load->view('template/header'); ?>

<?= $this->session->flashdata('pesan') ?>

<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Informasi</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $informasi): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $informasi['informasi'] ?></td>
                <td>
                    <?php
                    $fileExt = pathinfo($informasi['berkas'], PATHINFO_EXTENSION);
                    $iconClass = '';
                    if (in_array($fileExt, ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'])) {
                        $iconClass = 'far fa-file';
                    } elseif (in_array($fileExt, ['jpg', 'jpeg', 'png'])) {
                        $iconClass = 'far fa-image';
                    }
                    ?>
                    <?php if ($iconClass): ?>
                        <a href="<?= base_url('themes/file_informasi/'.$informasi['berkas']) ?>" target="_blank">
                            <i class="<?= $iconClass ?>"></i>
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('themes/file_informasi/'.$informasi['berkas']) ?>" target="_blank">
                            <i class="fas fa-question"></i>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>
</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/akses'); ?>
