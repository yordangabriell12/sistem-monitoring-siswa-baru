const base_url = 'http://localhost/spk-saw/public';


$('button[data-target="#modal-kriteria"]').click(function () {
  $('.form-kriteria').attr('action', `${base_url}/kriteria/tambahKriteria`);
  $('h4.modal-title').text('Tambah Kriteria');
  $('button[name=submit]').text('Kirim');
  $('#inputNamaKriteria').attr('placeholder', 'Nama Kriteria');
  $('#inputBobot').attr('placeholder', 'Bobot');
  $('#inputTipe').val('benefit');
  $('#inputIdKriteria').removeAttr('disabled');
})

$('.editkriteria').click(function () {
  const id = $(this).data('idkriteria');
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

})

$('.hapuskriteria').click(function () {
  const id = $(this).data('idkriteria');
  $.ajax({
    url: `${base_url}/kriteria/delete/id/${id}`,
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    type: 'post',
    success: function (data) {

    }
  });
});


$('button[data-target="#modal-subkriteria"]').click(function () {
  $('.form-subkriteria').attr('action', `${base_url}/subkriteria/tambahSubkriteria`);
  $('h4.modal-title').text('Tambah Subkriteria');
  $('button[name=submit]').text('Kirim');
  $('#nama_subkriteria').attr('placeholder', 'Nama Subkriteria');
  $('#bobot_subkriteria').attr('placeholder', 'Bobot');
})

$('.editsubkriteria').click(function () {
  const id = $(this).data('idsubkriteria');

  $('.form-subkriteria').attr('action', `${base_url}/subkriteria/editSubkriteria`);
  $('.form-subkriteria').append(`<input type="hidden" id="id_subkriteria" name="id_subkriteria" value="${id}">`);
  $('h4.modal-title').text('Edit Subkriteria');

  $('button[name=submit]').text('Update');

  $.ajax({
    url: `${base_url}/subkriteria/id/${id}`,
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    type: "post",
    success: function (data) {

      const subkriteria = data.subkriteria;
      subkriteria.forEach(value => {
        $('#nama_subkriteria').val(value.nama_subkriteria);
        $('#bobot_subkriteria').val(value.bobot);
      });
    }
  });

})

$('button[data-target="#modal-penduduk"]').click(function () {
  $('.form-penduduk').attr('action', `${base_url}/penduduk/tambahPenduduk`);
  $('h4.modal-title').text('Tambah Penduduk');
  $('button[name=submit]').text('Kirim');
  $('#nik').attr('placeholder', 'Nik');
  $('#nama').attr('placeholder', 'Nama');
  $('#jenkel').val('l');
  $('#alamat').attr('placeholder', 'Alamat');
})




//alternatif
$(document).click(function (e) {
  const target = e.target;
  const attrId = target.getAttribute('id');

  if (attrId == 'editPenduduk') {
    const id = $(target).data('idpenduduk');
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

  if (attrId == 'form-tambah-alternatif') {

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
    })

  }

  if (attrId == 'form-edit-alternatif') {
    const id = $(target).data('idalternatif');
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


  if (attrId == 'simpan-alternatif') {

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


  if (attrId == 'detail-alternatif') {

    const id = target.dataset.id;
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

  if (attrId == 'detail-alternatif-validasi') {

    const id = $(target).data('id');

    $.ajax({
      url: `${base_url}/validasi/formEditAlternatif`,
      type: 'post',
      success: function (response) {
        $("#modal-alternatif-validasi .modal-body").html(response);
        $("#id_alternatif").val(id);

        $("button[name=submit]").show();
      }
    })
    $.ajax({
      url: `${base_url}/validasi/id/${id}`,
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

  if (attrId == 'simpan-alternatif-validasi') {


    const formEdit = $(".form-edit-alternatif");

    let data = null

    if (formEdit.length) {
      data = formEdit.serialize();

      const konfirmasi = confirm('Apakah data sudah sesuai?');

      if (konfirmasi) {

        $.ajax({
          url: `${base_url}/validasi/editAlternatif`,
          type: 'post',
          async: false,
          data: data,
          success: function (res) {
            $("#modal-alternatif").modal('hide');
            $(location).attr('href', `${base_url}/validasi`)
          }
        })
      }

      return false;
    }
  }




  if (attrId == "cek_nik") {
    const nik = $("#nik").val();

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
})


//pengguna
$("#form-tambah-pengguna").click(function () {
  //$("#form-pengguna").attr("action", `${base_url}/pengguna/tambahPengguna`);
  $(".modal-title").text("Tambah Pengguna");
  $("button[name=submit]").text('Kirim');
  $("button[name=submit]").attr('id', 'simpan-pengguna');
  $("label[for=password]").text("Password");
  $("#username").val("");
  $("#level").val("admin");
  $(".passwordme").remove();
  $("#password").prop("disabled", false);
  $("#repassword").prop("disabled", false);
  $(".form-check").remove();



  $("#simpan-pengguna").click(function () {
    const formTambah = $(".form-pengguna");
    let data = null
    if (formTambah.length) {
      formTambah.find('.form-control').each(function (i, e) {
        if ($(e).val().length == 0) {
          Toast.fire({
            icon: 'warning',
            title: 'Tidak boleh kosong!'
          });
          return false;
        }
        if (formTambah.find('.form-control[name=password]').val() != formTambah.find('.form-control[name=repassword]').val()) {
          Toast.fire({
            icon: 'warning',
            title: 'Password tidak sama!'
          });
          return false;
        } else {
          $("button[name=submit]").attr("disabled", true);
          data = $(".form-pengguna").serialize();
        }
      })
      if (data != null) {
        $.ajax({
          url: `${base_url}/pengguna/tambahPengguna`,
          type: 'post',
          data: data,
          success: function () {

            $(location).attr('href', `${base_url}/pengguna`)

          }
        })
      }

    }

  })
})

$(".edit-pengguna").click(function () {
  $(".modal-title").text("Edit Pengguna");
  $("button[name=submit]").text('Update');
  $("button[name=submit]").attr('id', 'update-pengguna');
  $("label[for=password]").text("Password Baru");
  $("#password").prop("disabled", true);
  $("#repassword").prop("disabled", true);
  if ($(".form-pengguna").find(".passwordme").length == 0) {
    $(".form-pengguna").append(`<div class="form-check">
                    <input type="checkbox" class="form-check-input" name="changePass" id="changePass">
                    <label class="form-check-label">Ubah Password</label>
                  </div><div class="form-group passwordme mt-2">
    <label for="passwordme">Password Admin</label>
    <input type="password" class="form-control" id="passwordme" name="passwordme" placeholder="Password Admin" required>
</div>`);
  }
  $("#changePass").click(function () {
    if ($(this).prop('checked')) {
      $("#password").prop("disabled", false);
      $("#repassword").prop("disabled", false);
    } else {
      $("#password").prop("disabled", true);
      $("#repassword").prop("disabled", true);
    }
  });
  const id = $(this).data("idpengguna");
  $.ajax({
    url: `${base_url}/pengguna/formEditPengguna`,
    method: 'post',
    data: {
      id: id
    },
    dataType: "json",
    success: function (data) {
      data.forEach(value => {
        $("#username").val(value.username);
        $("#level").val(value.level);
      })
    }
  });



  $("#update-pengguna").click(function () {
    const valuePengguna = $(".form-pengguna").find(".form-control").serializeArray();
    let i = 0;

    function cekPass(pass) {
      let result;
      $.ajax({
        url: `${base_url}/pengguna/authPassPengguna`,
        type: 'post',
        data: {
          'password': pass
        },
        async: false,
        success: function (res) {
          if (res != 1) {
            result = false
            return
          } else {
            result = true
            return
          }
        }
      })
      return result;
    }
    for (let p of valuePengguna) {
      if (p.value.length == 0) {
        Toast.fire({
          icon: 'warning',
          title: 'Tidak boleh kosong!'
        });
        return false;
      } else if (p.name == "password") {
        if (p.value != valuePengguna[i + 1].value) {
          Toast.fire({
            icon: 'warning',
            title: 'Password tidak sama!'
          });
          return false;
        }
      } else if (p.name == "passwordme") {

        if (!cekPass(p.value)) {
          Toast.fire({
            icon: 'warning',
            title: 'Password salah!'
          });
          return false;
        };
      }
      i++
    }


    let value = {};
    for (let p of valuePengguna) {
      value.id = id
      value[p.name] = p.value
    }
    delete value.passwordme
    delete value.repassword

    $.ajax({
      url: `${base_url}/pengguna/updatePengguna`,
      type: 'post',
      async: false,
      data: value,
      success: function (response) {

        $(location).attr('href', `${base_url}/pengguna`)

      }
    })
  })
})

$(".hapus-pengguna").click(function () {
  const id = $(this).data('idpengguna');
  $.ajax({
    url: `${base_url}/pengguna/hapusPengguna`,
    type: 'post',
    async: false,
    data: {
      'id': id
    },
    success: function (data) {
      if (data == 1) {
        $(location).attr('href', `${base_url}/pengguna`)

      } else {
        Toast.fire({
          icon: 'warning',
          title: 'tidak dapat menghapus, pengguna sedang digunakan!'
        });
        return false;
      }

    }
  })
})
$("#ubah-password").click(function (e) {
  e.preventDefault()
  const user = $(this).data('username');
  $.ajax({
    type: 'post',
    url: `${base_url}/pengguna/formUbahPass`,
    async: false,
    success(res) {
      if ($('.form-ubahpass').length == 0) {

        $('body').append($(res));
        $(".form-ubahpass").find("#username").val(user)
        $(".form-ubahpass").find("#username").attr('readonly', true)
      }

      $('#modal-ubahpass').modal('show');
    }
  })

  $("#update-password").click(function () {

    const $passlama = $(".form-ubahpass").find('#password').val();
    const $passbaru = $(".form-ubahpass").find('#passbaru').val();
    const $repass = $(".form-ubahpass").find('#repassword').val();

    if ($passbaru.length == 0 || $passlama.length == '' || $repass.length == '') {
      Toast.fire({
        icon: 'warning',
        title: 'tidak boleh kosong!'
      });
      return false;
    } else if ($passbaru == $repass) {
      $.ajax({
        url: `${base_url}/pengguna/updatePass`,
        type: 'post',
        async: false,
        //dataType: 'json',
        data: {
          username: user,
          password: $passlama,
          passbaru: $passbaru
        },
        success: function (data) {


          data = JSON.parse(data);

          if (data.success) {
            $(this).prop('disabled', 'true');
            $('#modal-ubahpass').modal('hide');
            $(location).attr('href', window.location.href)
            return false;

          } else {
            Toast.fire({
              icon: 'warning',
              title: data.message
            });
            return false;
          }
        }
      })
    } else {
      Toast.fire({
        icon: 'warning',
        title: 'password tidak sama!'
      });
    }
  })

})

function form_submit() {
  $('form').submit();
}

//reset value form
$('#modal-penduduk button[data-dismiss="modal"').click(() => {
  $(".form-penduduk").find(".form-control").each((i, e) => {
    $(e).val("")
  })
})

$('#modal-penduduk button[data-dismiss="modal"').click(() => {
  $(".form-penduduk").find(".form-control").each((i, e) => {
    $(e).val("")
  })
})

//subkriteria
$('#modal-subkriteria button[data-dismiss="modal"').click(() => {
  $(".form-subkriteria").find(".form-control").each((i, e) => {
    $(e).val("")
  })
})
$('#modal-pengguna button[data-dismiss="modal"').click(() => {
  $(".form-pengguna").find(".form-control").each((i, e) => {
    $(e).val("")
  })
})


var Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

$(function () {
  $(document).ready(function () {
    var url = window.location;
    // Will only work if string in href matches with location
    $('.nav-item a[href="' + url + '"]').addClass('active');

    // Will also work for relative and absolute href

  });
});
$(document).ready(function () {
  const t_penduduk = $("#datatable-penduduk").DataTable({
    serverSide: true,
    processing: true,
    ajax: {
      url: base_url + '/penduduk/getAllJson',
      type: 'GET'
    },
    columns: [
      { defaultContent: '', searchable: false, orderable: false },
      { data: 'nik' },
      { data: 'nama' },
      { data: 'jenkel' },
      { data: 'dusun' },
      {
        data: 'id',
        render: function (data, type) {
          return `<a class="editpenduduk btn bg-gradient-success btn-xs" id="editPenduduk" data-toggle="modal" data-target="#modal-penduduk" data-idpenduduk=${data}><i id="editPenduduk" data-idpenduduk=${data} class="fas fa-edit"></i></a>
                    <form style="display: inline-block" action="${base_url}/penduduk/delete" method="post">
                        <input type="hidden" name="id" value="${data}">
                        <button type="submit" class="btn bg-gradient-danger btn-xs"><i class="fas fa-trash"></i></button>
                    </form>`;
        }
      },
    ],
    order: []
  });

  t_penduduk.on('draw.dt', function () {
    const page = t_penduduk.page.info();
    let i = page.start + 1;
    t_penduduk.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
      this.data(i++);
    });
  }).draw();



  $("#default-datatable").DataTable({
    "dom": 'Bfrtip',
    "paging": true,
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,

    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

  });
})
//.buttons().container().appendTo('#default-datatable_wrapper .col-md-6:eq(0)');
$('#simple-datatable').DataTable({

  "paging": true,
  "lengthChange": false,
  "searching": false,
  "ordering": true,
  "info": true,
  "autoWidth": false,
  //"responsive": true,
  "bDestroy": true,
  //"scrollY": true,
  //"scrollX": true,
});

$('#simple-datatable2').DataTable({
  "paging": true,
  "lengthChange": false,
  "searching": false,
  "ordering": true,
  "info": true,
  "autoWidth": false,
  //"responsive": true,
  "bDestroy": true,

});

$('#simple-datatable3').DataTable({
  "paging": true,

  "lengthChange": false,
  "searching": false,
  "ordering": true,
  "info": true,
  "autoWidth": false,
  //"responsive": true,
  "bDestroy": true
});
