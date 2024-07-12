$(function(){

    $('.tampiladuan').on('click', function(){
        
        $('#formLabel').html('Ubah Aduan');
        $('.modal-footer input[type=submit]').val('Ubah Aduan');
        $('.modal-body form').attr('action', 'http://localhost:8080/pengaduan/pengaduan/ubahAduan')
        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost:8080/pengaduan/admin/tampilAduanbyId',
            data: {id : id},
            method: 'post',
            dataType: 'json',

            success: function(data){
                console.log(data);
                $('#isi_aduan').html(data.isi_laporan);
                $('#bukti_foto').before(' <br><img src="" alt="" width="100px" hight="100px" id="tampilfoto">');
                $('#id_pengaduan').val(data.id_pengaduan);
                $('#tampilfoto').attr('src', 'http://localhost:8080/pengaduan/assets/img/' + data.foto);
                $('#old_foto').val(data.foto);
            }
        })
    });

    $('.tambahAduan').on('click',function(){
        $('#formLabel').html('Form Aduan');
        $('.modal-footer input[type=submit]').val('Adukan');

        $('#id_pengaduan').val('');
        $('#tampilfoto').remove();
        $('br').remove();
        $('#bukti_foto').val('')
        $('#isi_aduan').html('');
    })


    $('.tampiltgp').on('click', function(){

        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost:8080/pengaduan/admin/tampilAduanbyId',
            data: {id : id},
            method: 'post',
            dataType: 'json',

            success: function(data){
                $('#isi_aduan').html(data.isi_laporan);
                $('#foto').attr('src', 'http://localhost:8080/pengaduan/assets/img/' + data.foto);
                $('#id_pengaduan').val(data.id_pengaduan);
                // $('#foto').src(+data.foto)
            }
        })
    })

    $('.tampiltanggapan').on('click', function(){

        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost:8080/pengaduan/admin/tampiltgpbyId',
            data: {id : id},
            method: 'post',
            dataType: 'json',

            success: function(data){
                console.log(data);
                $('#isi_aduan').html(data.isi_laporan);
                $('.bukti-foto').after('<br> <img src="" alt="" width="100px" hight="100px" id="tampilfotoT">');
                $('#id_tanggapan').val(data.id_tanggapan);
                $('#tampilfotoT').attr('src', 'http://localhost:8080/pengaduan/assets/img/'+ data.foto);
                $('#isi_tanggapan').html(data.isi_tanggapan);
                
            }
        })
    });

});



