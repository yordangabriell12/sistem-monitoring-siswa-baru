import { base_url } from './../config.js';

export class DataTableAlternatif
{
 	static init = () => {
 		return $('#datatable-alternatif').DataTable({
 			serverSide: true,
 			processing: true,
 			ajax: {
 				url: base_url + '/alternatif/getAllJson',
 				type: 'GET'
 			},
 			columns: [
 				{defaultContent: '', searchable: false, orderable: false},
 				{data: 'nama_alternatif'},
 				{
 					data: 'id_alternatif',
 					render: function(data, type) {
 						return `<a class="btn bg-gradient-primary btn-xs" href='#' data-toggle="modal" id="detail-alternatif" data-target="#modal-alternatif" data-id="${data}">Lihat</a>
                            <a href="#" class="btn bg-gradient-success btn-xs" data-toggle="modal" id="btn-edit-alternatif" data-target="#modal-alternatif" data-idalternatif="${data}"><i data-idalternatif="${data}" id="btn-edit-alternatif" class="fas fa-edit"></i></a>
                            <form style="display: inline-block" action="${base_url}/alternatif/delete/id/${data}" method="post">
                                <button type="submit" class="btn bg-gradient-danger btn-xs" data-idkriteria="${data}"><i class="fas fa-trash"></i></button>
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
