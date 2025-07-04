import { base_url } from './../config.js';

export class PersyaratanController 
{
  static add = () => {
   $("#nama_kriteria").change(function(){
    const id_kriteria = $(this).val();

    $.ajax({
      url: base_url + '/persyaratan/subkriteria',
      type: 'post',
      data: {id: id_kriteria},
      success: function(res){
        const data = JSON.parse(res);
        $('#ketentuan').html('');
        data.forEach(d => {
          $('#ketentuan').append(`<option value=${d.id_subkriteria}>${d.nama_subkriteria}</option>`);
        });

      }
    })
   })
  }
}