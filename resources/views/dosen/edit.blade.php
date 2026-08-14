@extends('adminlte::page')

@section('title', 'Edit Dosen')

@section('content_header')
    <h1>Edit Dosen</h1>
@stop

@section('content')

    <form action="{{ route('dosen.update', $dosen) }}" method="POST">

        @csrf
        @method('PUT')

        @include('dosen.form', [
            'pegawai' => $dosen,
        ])

    </form>

@stop

{{-- ========================================================= --}}
{{-- JAVASCRIPT EDIT DOSEN --}}
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

            // Mengambil ID Program Studi yang tersimpan pada pegawai.
            // old() digunakan jika sebelumnya terjadi validation error.
            const selectedProgramStudiId = @json(old('program_studi_id', $dosen->program_studi_id ?? ''));

            // Memastikan dropdown yang dibutuhkan benar-benar ditemukan.
            if (!unitKerjaSelect || !programStudiSelect) {
                console.error(
                    'Dropdown Unit Kerja atau Program Studi tidak ditemukan.'
                );

                return;
            }

            // Fungsi untuk mengambil Program Studi berdasarkan Unit Kerja.
            function loadProgramStudi(unitKerjaId) {

                // Mengosongkan pilihan Program Studi sebelumnya.
                programStudiSelect.innerHTML =
                    '<option value="">-- Pilih Program Studi --</option>';

                // Menonaktifkan dropdown selama data sedang dimuat.
                programStudiSelect.disabled = true;

                // Jika Unit Kerja kosong, tidak perlu mengambil data.
                if (!unitKerjaId) {
                    return;
                }

                // Meminta daftar Program Studi berdasarkan Unit Kerja.
                fetch(`/program-studis/by-unit-kerja/${unitKerjaId}`)

                    // Memastikan response dari server berhasil.
                    .then(response => {

                        if (!response.ok) {
                            throw new Error(
                                'Gagal mengambil data Program Studi.'
                            );
                        }

                        // Mengubah response menjadi JSON.
                        return response.json();
                    })

                    // Memproses daftar Program Studi.
                    .then(programStudis => {

                        // Memasukkan setiap Program Studi ke dropdown.
                        programStudis.forEach(programStudi => {

                            // Membuat option baru.
                            const option = document.createElement('option');

                            // ID Program Studi menjadi value option.
                            option.value = programStudi.id;

                            // Nama Program Studi menjadi teks option.
                            option.textContent = programStudi.nama;

                            // Jika ini Program Studi lama, otomatis pilih.
                            if (
                                String(programStudi.id) ===
                                String(selectedProgramStudiId)
                            ) {
                                option.selected = true;
                            }

                            // Memasukkan option ke dropdown.
                            programStudiSelect.appendChild(option);
                        });

                        // Mengaktifkan dropdown setelah data selesai dimuat.
                        programStudiSelect.disabled = false;
                    })

                    // Menangani error jika request gagal.
                    .catch(error => {

                        // Menampilkan error pada Console browser.
                        console.error(
                            'Gagal mengambil Program Studi:',
                            error
                        );
                    });
            }

            // Ketika Unit Kerja diganti, Program Studi ikut dimuat ulang.
            unitKerjaSelect.addEventListener('change', function() {

                // Mengambil Program Studi sesuai Unit Kerja baru.
                loadProgramStudi(this.value);
            });

            // Saat halaman Edit pertama kali dibuka,
            // Unit Kerja sudah memiliki nilai dari database.
            if (unitKerjaSelect.value) {

                // Memuat Program Studi sesuai Unit Kerja yang tersimpan.
                loadProgramStudi(unitKerjaSelect.value);
            }

        });
    </script>

@stop
