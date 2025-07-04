import { base_url } from './../config.js'

export class DataTableKriteria
{
	static init = () => {
		return $('#datatable-kriteria').DataTable({
			serverSide: true,
			processing: true,
			ajax: {
				url: base_url+'/kriteria/getAllJson',
				type: 'GET'
			},
			columns: [
				{defaultContent: '', searchable: false, orderable: false},
				{data: 'id_kriteria'},
				{data: 'nama_kriteria'},
				{data: 'bobot'},
				{data: 'tipe'},
				{
					data: {id: 'id', id_kriteria: 'id_kriteria'},
					render: function(data, type) {
						const {id, id_kriteria} = data;
						return `<a class="btn bg-gradient-primary btn-xs" href='${base_url}/kriteria/subkriteria/id/${id_kriteria}'>Subkriteria</a>
                            <a id="editKriteria" class="btn bg-gradient-success btn-xs" data-toggle="modal" data-target="#modal-kriteria" data-idkriteria="${id_kriteria}"><i id="editKriteria" data-idkriteria="${id_kriteria}" class="fas fa-edit"></i></a>
                            <form style="display: inline-block" action="${base_url}/kriteria/delete/id/${id_kriteria}" method="post">
                                <button type="submit" class="btn bg-gradient-danger btn-xs" data-idkriteria="${id_kriteria}"><i class="fas fa-trash"></i></button>
                        	</form>`
					}
				}
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
