import { base_url } from './../config.js';

export class DataTableMatriksr
{
  static init = () => {
    let dataObject = [];
   
    const th = $('#datatable-matriksr').find('th');
    $.each(th, function(key, value){
      const th = $(value).html();
      if(key > 1) {
        dataObject.push({"data": th, "searchable": true, "orderable": true})
      }
    });
   
    return $("#datatable-matriksr").DataTable({
      serverSide: true,
      processing: true,
      ajax: {
        url: base_url + '/penilaian/getAllNormalisasiPenilaianJson',
        type: 'GET'
      },
      columns: [
        {defaultContent: '', searchable: false, orderable: false},
        {data: "nama_alternatif"},
        ...dataObject,
      ],
      order: [],
      "autoWidth": false
    });
  }

  static setIndex = (t) => {
    t.on('draw.dt', function () {
        const page = t.page.info();
        let i = page.start + 1;
        t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
 }
}