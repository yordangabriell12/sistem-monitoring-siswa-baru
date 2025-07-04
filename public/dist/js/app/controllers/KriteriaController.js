import { base_url } from './../config.js';

export class KriteriaController
{
	static add = () => {
		$('.form-kriteria').attr('action', `${base_url}/kriteria/tambahKriteria`);
    	$('h4.modal-title').text('Tambah Kriteria');
    	$('button[name=submit]').text('Kirim');
    	$('#inputNamaKriteria').val('');
    	$('#inputNamaKriteria').attr('placeholder', 'Nama Kriteria');
    	$('#inputBobot').attr('placeholder', 'Bobot');
    	$('#inputBobot').val('');
    	$('#inputTipe').val('benefit');
    	$('#inputIdKriteria').removeAttr('disabled');
    	$('#inputIdKriteria').val('');
	}

	static edit = (id) => {
		$('.form-kriteria').attr('action', 'kriteria/editKriteria');
	    $('.form-kriteria').append(`<input type="hidden" id="id_kriteria" name="id_kriteria" value="${id}">`);
	    $('#inputIdKriteria').attr('disabled', '');

	    $('h4.modal-title').text('Edit Kriteria');

	    $('#inputIdKriteria').val(id)
	    $('button[name=submit]').text('Update');

	    $.ajax({
	        url: `${base_url}/kriteria/id/${id}`,
	        contentType: "application/json; charset=utf-8",
	        dataType: "json",
	        type: "post",
	        success: function (data) {
	            const kriteria = data.kriteria;
	            kriteria.forEach(value => {
	                $('#inputNamaKriteria').val(value.nama_kriteria);
	                $('#inputBobot').val(value.bobot);
	                $('#inputTipe').val(value.tipe);
	            });
	        }
	    });
	}
}
