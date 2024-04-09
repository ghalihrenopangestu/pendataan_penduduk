<?php

$files    =glob('uploadfile/file_email/*');
foreach ($files as $file_email) {
    if (is_file($file_email))
    unlink($file_email); // hapus file
}
if ($files) {
    echo "<script>
    Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
    }).then((result) => {
        if (result.value) {
            window.location = 'index.php?page=kirim-email-semua&kode=E001';
        }
    })</script>";
    }else{
    echo "<script>
    Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {
        if (result.value) {
            window.location = 'index.php?page=kirim-email-semua&kode=E001';
        }
    })</script>";
}

?>