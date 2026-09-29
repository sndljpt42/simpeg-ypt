@extends('adminlte::page')

@section('title', 'Riwayat Kenaikan Gaji Berkala')

@section('content_header')
    <h1>Riwayat Kenaikan Gaji Berkala</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-history mr-1"></i>
                Pilih Pegawai
            </h3>
        </div>

        <div class="card-body">

            <p class="text-muted">
                Pilih pegawai untuk melihat riwayat kenaikan gaji berkalanya.
            </p>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="filter-jenis-pegawai">Jenis Pegawai</label>
                    <select id="filter-jenis-pegawai" class="form-control">
                        <option value="">Semua Pegawai</option>
                        <option value="Dosen">Dosen</option>
                        <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
                    </select>
                </div>

                <div class="col-md-8">
                    <label for="filter-unit-kerja">Unit Kerja</label>
                    <select id="filter-unit-kerja" class="form-control">
                        <option value="">Semua Unit Kerja</option>

                        @foreach ($unitKerjas as $unitKerja)
                            <option value="{{ $unitKerja->nama }}" data-id="{{ $unitKerja->id }}"
                                data-parent-id="{{ $unitKerja->parent_id }}">
                                {{ $unitKerja->nama }}
                            </option>

                            @foreach ($unitKerja->children->sortBy('nama') as $child)
                                <option value="{{ $child->nama }}" data-id="{{ $child->id }}"
                                    data-parent-id="{{ $child->parent_id }}">
                                    &nbsp;&nbsp;└─ {{ $child->nama }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>

            <table id="table-riwayat-kgb" class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>NIPY</th>
                        <th>Nama</th>
                        <th>Jenis Pegawai</th>
                        <th>Unit Kerja</th>
                        <th width="100" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($pegawais as $pegawai)
                        <tr>

                            <td></td>

                            <td>{{ $pegawai->nipy }}</td>

                            <td>{{ $pegawai->nama }}</td>

                            <td>{{ $pegawai->jenisPegawai?->nama }}</td>

                            <td>{{ $pegawai->unitKerja?->nama }}</td>


                            <td class="text-center">

                                <a href="{{ route('pegawais.riwayat-kgb.index', $pegawai) }}"
                                    class="btn btn-info btn-sm" title="Lihat Riwayat Gaji Berkala">
                                    <i class="fas fa-eye"></i>
                                    Lihat
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center">
                                Belum ada data pegawai.
                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@stop

@section('plugins.Datatables', true)

@push('js')
    <script>
        $(function() {

            let table = $('#table-riwayat-kgb').DataTable({

                responsive: true,

                autoWidth: false,

                pageLength: 10,

                lengthChange: true,

                searching: true,

                ordering: true,

                info: true,

                dom: 'Bfrtip',

                buttons: [

                    {
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i> Copy',
                        className: 'btn btn-secondary btn-sm',
                        title: 'Daftar Pegawai - Riwayat Gaji Berkala',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },

                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: 'btn btn-success btn-sm',
                        title: 'Daftar Pegawai - Riwayat Gaji Berkala',
                        filename: 'Daftar_Pegawai_Riwayat_Gaji Berkala',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },

                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        className: 'btn btn-danger btn-sm',
                        title: 'Daftar Pegawai - Riwayat Gaji Berkala',
                        filename: 'Daftar_Pegawai_Riwayat_Gaji Berkala',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },

                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        className: 'btn btn-info btn-sm',
                        title: 'Daftar Pegawai - Riwayat Gaji Berkala',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }

                ],

                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
                },

                search: {
                    smart: false
                }

            });

            // Nomor urut selalu diperbarui setelah search/sort/pagination.
            table.on('order.dt search.dt draw.dt', function() {

                let i = 1;

                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell) {

                    cell.innerHTML = i++;

                });

            }).draw();

            // Filter berdasarkan jenis pegawai.
            $('#filter-jenis-pegawai').on('change', function() {

                table
                    .column(3)
                    .search(this.value)
                    .draw();

            });

            // $('#filter-unit-kerja').on('change', function() {
            //     table
            //         .column(4)
            //         .search(this.value)
            //         .draw();
            // });

            $('#filter-unit-kerja').on('change', function() {
                let selectedOption = $(this).find('option:selected');
                let unitKerjaId = selectedOption.data('id');

                // Jika "Semua Unit Kerja" dipilih, hapus filter.
                if (!unitKerjaId) {
                    table.column(4).search('').draw();
                    return;
                }

                // Cari nama Unit Kerja yang dipilih.
                let namaUnitKerja = selectedOption.val();

                // Jika yang dipilih adalah Unit Kerja induk,
                // ikutkan seluruh Unit Kerja anaknya.
                let namaUnitKerjaFilter = [namaUnitKerja];

                $('#filter-unit-kerja option').each(function() {
                    let parentId = $(this).data('parent-id');

                    if (String(parentId) === String(unitKerjaId)) {
                        namaUnitKerjaFilter.push($(this).val());
                    }
                });

                // DataTables menggunakan regex OR untuk beberapa Unit Kerja.
                let searchValue = namaUnitKerjaFilter
                    .map(function(nama) {
                        return $.fn.dataTable.util.escapeRegex(nama);
                    })
                    .join('|');

                table
                    .column(4)
                    .search(searchValue, true, false)
                    .draw();
            });

        });
    </script>
@endpush
