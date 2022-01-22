@extends('layout.app')

@section('content')
    @include('includes.alerts')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bd-highlight">
                            <h3 class="mb-0">Daftar Leader Tim</h3>
                        </div>
                        <div class="bd-highlight ms-auto">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tambah-data">
                                <i class="bi bi-plus-square me-2"></i> Tambah
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive my-3">
                        <table class="table table-bordered table-primary table-striped table-hover py-3" id="table-tim">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nomor Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($tim->count())
                                    @foreach ($tim as $t)
                                        <tr>
                                            <td style="width: 20px">{{ $loop->iteration }}</td>
                                            <td>{{ $t->nama }}</td>
                                            <td>{{ $t->email }}</td>
                                            <td>{{ $t->no_telp }}</td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('tim.edit', ['tim' => $t->id]) }}" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></a>
                                                <button class="btn btn-sm btn-danger" onclick="hapusData('{{ route('tim.destroy', ['tim' => $t->id]) }}')" data-bs-toggle="modal" data-bs-target="#modal-delete"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            Data Tidak Ada
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal tambah data --}}
    <div class="modal fade" id="modal-tambah-data" tabindex="-1" aria-labelledby="modal-tambah-data" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('tim.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Leader Tim</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan nama leader tim" required autocomplete="off">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email leader tim" required autocomplete="off">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">Nomor Telepon</label>
                            <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" placeholder="Masukkan nomor telepon leader tim" required autocomplete="off">
                            @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('includes.modal_delete', ['title_delete' => 'Leader'])

    @push('after-scripts')
        <script>
            $(document).ready(function() {
                $('#table-tim').DataTable();
            });
        </script>
    @endpush
@endsection