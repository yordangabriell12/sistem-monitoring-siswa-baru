import { base_url } from './../config.js';

export class DataTablePersyaratan {
 static init = () => {
           return $("#datatable-persyaratan").DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: base_url + '/persyaratan/getAllJson',
                type: 'GET'
            },
            columns: [
                {defaultContent: '', searchable: false, orderable: false},
                {data: 'id_kriteria'},
                {data: 'nama_kriteria'},
                {data: 'ketentuan'},
                {data: 'bobot'},
                {
                    data: 'id',
                    render: function(data, type) {
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


