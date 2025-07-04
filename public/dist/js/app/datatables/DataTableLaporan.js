import { base_url } from './../config.js';

export class DataTableLaporan {
  static init = () => {
    return $("#datatable-laporan").DataTable({
      serverSide: true,
      processing: true,
      ajax: {
        url: base_url + '/laporan/getLaporanJson',
        type: 'GET'
      },
      columns: [
        { defaultContent: '', orderable: false, searchable: false },
        { data: 'nama_alternatif' },
        { data: 'jenkel' },
        { data: 'alamat' },
        { data: 'tanggal' },
        { data: 'total' },
        { defaultContent: '' }
      ],
      order: [[6, 'desc']]
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