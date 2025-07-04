import { base_url } from './../config.js';

export class PendudukController
{
	static add() {

		
		$('.form-penduduk').attr('action', `${base_url}/penduduk/tambahPenduduk`);
	    $('h4.modal-title').text('Tambah Penduduk');
	    $('button[name=submit]').text('Kirim');
	    $('#nik').attr('placeholder', 'Nik');
	    $('#nik').val('');
	    $('#nama').attr('placeholder', 'Nama');
	    $('#nama').val('');
	    $('#jenkel').val('l');
	    $('#dusun').attr('placeholder', 'Dusun');
	    $('#dusun').val('');
	}
	static edit(id){
		$('.form-penduduk').attr('action', `${base_url}/penduduk/editPenduduk`);
            $('.form-penduduk').append(`<input type="hidden" id="id_penduduk" name="id_penduduk" value="${id}">`);
            $('h4.modal-title').text('Edit Penduduk');

            $('button[name=submit]').text('Update');

            $.ajax({
                url: `${base_url}/penduduk/id/${id}`,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                type: "post",
                success: function (data) {
                    const penduduk = data.penduduk;
                    penduduk.forEach(value => {
                        $('#nik').val(value.nik);
                        $('#nama').val(value.nama);
                        $('#jenkel').val(value.jenkel);
                        $('#dusun').val(value.dusun);
                    });
                }
            });
	}
}
