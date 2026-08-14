@extends('adminlte::page')

@section('title', 'Edit Tenaga Kependidikan')

@section('content_header')
    <h1>Edit Tenaga Kependidikan</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-body">

            <form action="{{ route('tendik.update', $tendik) }}" method="POST">

                @csrf
                @method('PUT')

                @include('tendik.form', [
                    'pegawai' => $tendik,
                ])

            </form>

        </div>

    </div>

@stop

{{-- ========================================================= --}}
{{-- JAVASCRIPT EDIT TENDIK --}}
{{-- ========================================================= --}}
@section('js')

    <script>
        // Menunggu seluruh elemen form selesai dimuat.
        document.addEventListener('DOMContentLoaded', function() {

            // Mengambil dropdown Unit Kerja.
            const unitKerjaSelect = document.querySelector(
                'select[name="unit_kerja_id"]'
            );

            // Mengambil dropdown Program Studi.
            const programStudiSelect = document.querySelector(
                'select[name="program_studi_id"]'
            );

            // Mengambil ID Program Studi yang tersimpan pada Tendik.
            // old() digunakan jika sebelumnya terjadi validation error.
            const selectedProgramStudiId = @json(old('program_studi_id', $tendik->program_studi_id ?? ''));

            // Memastikan kedua dropdown ditemukan sebelum JavaScript dilanjutkan.
            if (!unitKerjaSelect || !programStudiSelect) {
                console.error(
                    'Dropdown Unit Kerja atau Program Studi tidak ditemukan.'
                );

                return;
            }

            // Fungsi untuk mengambil Program Studi berdasarkan Unit Kerja.
            function loadProgramStudi(unitKerjaId) {

                // Mengosongkan Program Studi sebelumnya.
                programStudiSelect.innerHTML =
                    '<option value="">-- Pilih Program Studi --</option>';

                // Menonaktifkan dropdown selama data sedang dimuat.
                programStudiSelect.disabled = true;

                // Jika Unit Kerja belum dipilih, proses tidak perlu dilanjutkan.
                if (!unitKerjaId) {
                    return;
                }

                // Mengambil Program Studi berdasarkan Unit Kerja.
                fetch(`/program-studis/by-unit-kerja/${unitKerjaId}`)

                    // Memastikan response dari server berhasil.
                    .then(response => {

                        if (!response.ok) {
                            throw new Error(
                                'Gagal mengambil data Program Studi.'
                            );
                        }

                        // Mengubah response server menjadi JSON.
                        return response.json();
                    })

                    // Memproses daftar Program Studi.
                    .then(programStudis => {

                        // Memasukkan setiap Program Studi ke dropdown.
                        programStudis.forEach(programStudi => {

                            // Membuat option baru.
                            const option = document.createElement('option');

                            // Menggunakan ID Program Studi sebagai value.
                            option.value = programStudi.id;

                            // Menggunakan nama Program Studi sebagai teks.
                            option.textContent = programStudi.nama;

                            // Jika Program Studi sama dengan data lama,
                            // otomatis menjadikannya pilihan terpilih.
                            if (
                                String(programStudi.id) ===
                                String(selectedProgramStudiId)
                            ) {
                                option.selected = true;
                            }

                            // Memasukkan option ke dropdown.
                            programStudiSelect.appendChild(option);
                        });

                        // Mengaktifkan dropdown setelah data berhasil dimuat.
                        programStudiSelect.disabled = false;
                    })

                    // Menangani error ketika request gagal.
                    .catch(error => {

                        // Menampilkan detail error pada Console browser.
                        console.error(
                            'Gagal mengambil Program Studi:',
                            error
                        );
                    });
            }

            // Menjalankan proses ketika Unit Kerja diganti.
            unitKerjaSelect.addEventListener('change', function() {

                // Memuat Program Studi berdasarkan Unit Kerja baru.
                loadProgramStudi(this.value);
            });

            // Menjalankan load otomatis ketika halaman Edit pertama kali dibuka.
            if (unitKerjaSelect.value) {

                // Mengambil Program Studi berdasarkan Unit Kerja yang tersimpan.
                loadProgramStudi(unitKerjaSelect.value);
            }

        });
    </script>

@stop
