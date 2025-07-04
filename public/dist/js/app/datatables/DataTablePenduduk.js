import { base_url } from './../config.js';

class DataTablePenduduk {
 static init = () => {
           return $("#datatable-penduduk").DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: base_url + '/penduduk/getAllJson',
                type: 'GET'
            },
            columns: [
                {defaultContent: '', searchable: false, orderable: false},
                {data: 'nik'},
                {data: 'nama'},
                {data: 'jenkel'},
                {data: 'dusun'},
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

export { DataTablePenduduk };
