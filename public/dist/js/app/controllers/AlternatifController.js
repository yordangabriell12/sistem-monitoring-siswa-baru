import { base_url } from './../config.js';

export class AlternatifController
{
	static add = () => {
		$('.form-alternatif').attr('action', `${base_url}/alternatif/tambahAlternatif`);
        $('h4.modal-title').text('Tambah Alternatif');

        $.ajax({
            url: `${base_url}/alternatif/formAlternatif`,
            type: 'post',
            success: function (response) {
                $("#modal-alternatif .modal-body").html(response);
                $(".modal-title").text('Tambah Alternatif');
                $("button[name=submit]").show();
            }
        });
	}

	static detail = (id) => {
        $.ajax({
            url: `${base_url}/alternatif/detail/id/${id}`,
            type: 'post',
            success: function (response) {
                $("#modal-alternatif .modal-body").html(response)
                $(".modal-title").text('Detail Alternatif');
                $("button[name=submit]").hide();
            }
        });
	}

	static edit = (id) => {
		$('.form-alternatif').attr('action', `${base_url}/alternatif/editAlternatif`);
        $('h4.modal-title').text('Edit Alternatif');
        $.ajax({
            url: `${base_url}/alternatif/formEditAlternatif`,
            type: 'post',
            success: function (response) {
                $("#modal-alternatif .modal-body").html(response);
                $("#id_alternatif").val(id);
                $(".modal-title").text('Edit Alternatif');
                $("button[name=submit]").show();
            }
        })
        $.ajax({
            url: `${base_url}/alternatif/id/${id}`,
            type: 'post',
            dataType: 'json',
            success: function (data) {
                const alternatif = data.alternatif[0]
                for (let key in alternatif) {
                    let selector = `#${key}`;
                    $(selector).val(alternatif[key])
                }
            }
        })
	}

	static cekNik = (nik) => {
		$.ajax({
	            url: `${base_url}/penduduk/nik/${nik}`,
	            contentType: "application/json; charset=utf-8",
	            dataType: 'json',
	            type: 'post',
	            success: function (data) {
	                const penduduk = data.penduduk;
	                if (penduduk.length > 0) {
	                    penduduk.forEach(value => {
	                        $("#nama_alternatif").val(value.nama)
	                    })
	                } else {
	                    Toast.fire({
	                        icon: 'warning',
	                        title: 'Penduduk tidak ditemukan!'
	                    });
	                    $("#nama_alternatif").val('')
	                }
	            }
        })
	}

	static simpanAlternatif = () => {
		const formTambah = $(".form-alternatif");
        const formEdit = $(".form-edit-alternatif");

        let data = null
        if (formTambah.length) {
            formTambah.find('input').each(function (i, e) {
                if ($(e).val().length == 0) {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Tidak boleh kosong!'
                    });
                    return false;
                } else {
                    $("button[name=submit]").attr("disabled", true);
                    data = $(".form-alternatif").serialize();
                }
            })
            if (data) {
                $.ajax({
                    url: `${base_url}/alternatif/tambahAlternatif`,
                    type: 'post',
                    async: false,
                    data: data,
                    success: function (res) {                    
                            $("#modal-alternatif").modal('hide');
                            $(location).attr('href', `${base_url}/alternatif`)
                    }
                })

            }
        }

        if (formEdit.length) {
            data = formEdit.serialize();

            $.ajax({
                url: `${base_url}/alternatif/editAlternatif`,
                type: 'post',
                async: false,
                data: data,
                success: function (res) {
                    $("#modal-alternatif").modal('hide');
                    $(location).attr('href', `${base_url}/alternatif`)
                }
            })

        }
	}
}
