import { DataTablePenduduk } from './datatables/DataTablePenduduk.js';
import { DataTableKriteria } from './datatables/DataTableKriteria.js';
import { DataTableAlternatif } from './datatables/DataTableAlternatif.js';
import { DataTableMatriks } from './datatables/DataTableMatriks.js';
import { DataTableMatriksr } from './datatables/DataTableMatriksr.js';
import { DataTableMatriksp } from './datatables/DataTableMatriksp.js';
import { DataTableLaporan } from './datatables/DataTableLaporan.js';
import { DataTablePersyaratan } from './datatables/DataTablePersyaratan.js';




import { Handler } from './handler.js';
import { PendudukController } from './controllers/PendudukController.js';
import { KriteriaController } from './controllers/KriteriaController.js';
import { AlternatifController } from './controllers/AlternatifController.js';
import { PenggunaController } from './controllers/PenggunaController.js';
import { PersyaratanController } from './controllers/PersyaratanController.js';



$(document).ready(function () {

	

	var url = window.location;
     // Will only work if string in href matches with location
    $('.nav-item a[href="' + url + '"]').addClass('active');

    // datatable penduduk
	const t_penduduk = DataTablePenduduk.init();
	DataTablePenduduk.setIndex(t_penduduk);	

	// datatable kriteria
	const t_kriteria = DataTableKriteria.init();
	DataTableKriteria.setIndex(t_kriteria);

  // datatable kriteria
	const t_persyaratan = DataTablePersyaratan.init();
	DataTablePersyaratan.setIndex(t_persyaratan);

	// datattable alternatif
	const t_alternatif= DataTableAlternatif.init();
	DataTableAlternatif.setIndex(t_alternatif);	

  // datatable penilaian
  const t_matriks = DataTableMatriks.init();
  DataTableMatriks.setIndex(t_matriks);

  const t_matriksr = DataTableMatriksr.init();
  DataTableMatriksr.setIndex(t_matriksr);

  const t_matriksp = DataTableMatriksp.init();
  DataTableMatriksp.setIndex(t_matriksp);

  // datatable laporan
  const t_laporan = DataTableLaporan.init();
  DataTableLaporan.setIndex(t_laporan);
  

	$(document).click(function (e) {
			const el = Handler.elemClick(e.target);
			console.log(el.id)

      if(el.id == 'custom-tabs-three-matrikr-tab') {}
			// Penduduk 
			if(el.id == 'btn-add-penduduk') {
				PendudukController.add();
			}
			if(el.id == 'editPenduduk') {
				const id = $(el.el).data('idpenduduk');
				PendudukController.edit(id);
			}

			// Kriteria
			if(el.id == 'btn-add-kriteria') {
				KriteriaController.add();
			}
			if(el.id == 'editKriteria') {
				const id = $(el.el).data('idkriteria');
				KriteriaController.edit(id);
			}

      // Persyaratan
      if(el.id == 'btn-add-persyaratan'){
        PersyaratanController.add();
      }

			// Alternatif
			if(el.id == 'btn-add-alternatif') {
				AlternatifController.add();
			} 

			if(el.id == 'detail-alternatif') {
				const id = $(el.el).data('id');
				AlternatifController.detail(id);
			}

			if(el.id == 'btn-edit-alternatif') {
				const id = $(el.el).data('idalternatif');
				AlternatifController.edit(id);
			}

			if(el.id == 'simpan-alternatif') {
				AlternatifController.simpanAlternatif();
			}

			if(el.id == 'cek_nik') {
				const nik = $('#nik').val();
				AlternatifController.cekNik(nik);
			}

      // Pengguna
      if(el.id == 'form-tambah-pengguna') {
        PenggunaController.add();
      }
      if(el.id == 'btn-edit-pengguna') {
        const id = $(el.el).data('idpengguna');
        PenggunaController.edit(id);
      }
      if(el.id == 'btn-hapus-pengguna') {
        const id = $(el.el).data('idpengguna');
        PenggunaController.delete(id);
      }
      if(el.id == 'ubah-password') {
        e.preventDefault();
        const user = $(el.el).data('username');
        console.log(user);
        PenggunaController.ubahPass(user);
      }
	});
});



