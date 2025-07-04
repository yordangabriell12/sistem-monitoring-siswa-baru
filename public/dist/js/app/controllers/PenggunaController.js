import { base_url } from './../config.js';

export class PenggunaController
{
  static add = () => {
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
  }

  static edit = (id) => {
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
    $("#changePass").click(function(){
        if($(this).prop('checked')){
            $("#password").prop("disabled", false);
            $("#repassword").prop("disabled", false);
        } else {
            $("#password").prop("disabled", true);
            $("#repassword").prop("disabled", true);
        }
    });
    
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
  }

  static delete = (id) => {
  
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
  }

  static ubahPass = (user) => {
    
   
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
  }
}