@extends('adminlte::page')

@section('title', 'Tambah Dosen')

@section('content_header')
    <h1>Tambah Dosen</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-body">

            <form action="{{ route('dosen.store') }}" method="POST">

                @csrf

                @include('dosen.form')

            </form>

        </div>

    </div>

@stop


{{-- ========================================================= --}}
{{-- JAVASCRIPT PROGRAM STUDI --}}
{{-- ========================================================= --}}
@section('js')

    <script>
        // Menunggu seluruh elemen HTML selesai dimuat.
        document.addEventListener('DOMContentLoaded', function() {

            // Mengambil dropdown Unit Kerja.
            const unitKerjaSelect = document.querySelector(
                'select[name="unit_kerja_id"]'
            );

            // Mengambil dropdown Program Studi.
            const programStudiSelect = document.querySelector(
                'select[name="program_studi_id"]'
            );

            // Memastikan kedua dropdown ditemukan sebelum JavaScript dilanjutkan.
            if (!unitKerjaSelect || !programStudiSelect) {
                console.error(
                    'Dropdown Unit Kerja atau Program Studi tidak ditemukan.'
                );

                return;
            }

            // Menjalankan proses ketika Unit Kerja berubah.
            unitKerjaSelect.addEventListener('change', function() {

                // Mengambil ID Unit Kerja yang dipilih user.
                const unitKerjaId = this.value;

                // Mengosongkan pilihan Program Studi sebelumnya.
                programStudiSelect.innerHTML =
                    '<option value="">-- Pilih Program Studi --</option>';

                // Menonaktifkan dropdown selama data sedang diambil.
                programStudiSelect.disabled = true;

                // Jika Unit Kerja belum dipilih, proses tidak perlu dilanjutkan.
                if (!unitKerjaId) {
                    return;
                }

                // Mengambil data Program Studi berdasarkan Unit Kerja yang dipilih.
                fetch(`/program-studis/by-unit-kerja/${unitKerjaId}`)

                    // Mengubah response dari server menjadi JSON.
                    .then(response => {

                        // Memastikan response HTTP berhasil.
                        if (!response.ok) {
                            throw new Error(
                                'Gagal mengambil data Program Studi.'
                            );
                        }

                        return response.json();
                    })

                    // Memproses data Program Studi dari Controller.
                    .then(programStudis => {

                        // Memasukkan setiap Program Studi ke dropdown.
                        programStudis.forEach(programStudi => {

                            // Membuat elemen option baru.
                            const option = document.createElement('option');

                            // Menggunakan ID Program Studi sebagai value.
                            option.value = programStudi.id;

                            // Menggunakan nama Program Studi sebagai teks pilihan.
                            option.textContent = programStudi.nama;

                            // Memasukkan option ke dropdown Program Studi.
                            programStudiSelect.appendChild(option);
                        });

                        // Mengaktifkan dropdown setelah data berhasil dimuat.
                        programStudiSelect.disabled = false;
                    })

                    // Menangani error apabila request gagal.
                    .catch(error => {

                        // Menampilkan detail error di Console browser.
                        console.error(
                            'Gagal mengambil Program Studi:',
                            error
                        );
                    });
            });
        });
    </script>

@stop
