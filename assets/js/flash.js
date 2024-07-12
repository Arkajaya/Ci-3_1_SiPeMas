$(function(){

    const flashdata = $('.flashdata').data('flashdata');

    if(flashdata){
        Swal.fire({
            icon: "success",
            title: "Data Aduan",
            text: 'Berhasil ' + flashdata,
            showConfirmButton: false,
            timer: 1500
        })
    }

    $('.deleteAd').on('click', function(e){
        e.preventDefault();
        const href = $(this).attr('href')

        Swal.fire({
            title: "Apakah anda yakin ?",
            text: "Anda akan menghapus data ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus!"
          }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
          });
    })

    //cek aduan
    const flashaduan = $('.cekForm').data('flashdata')

    if(flashaduan){
        Swal.fire({
            icon: 'warning',
            title: 'Data Aduan',
            text: 'harap mengisi semua kolom, Tidak boleh ada yang '+ flashaduan +', isi kembali Aduan',
            showConfirmButton: true,
        })
    }
})