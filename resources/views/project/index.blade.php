@extends('layout.app')

@section('content')
    @include('includes.alerts')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bd-highlight">
                            <h3 class="mb-0">Daftar Project</h3>
                        </div>
                        <div class="bd-highlight ms-auto">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tambah-data"><i class="bi bi-plus-square me-2"></i> Tambah</button>
                        </div>
                    </div>

                    <div class="table-responsive my-3">
                        <table class="table table-bordered table-primary table-striped table-hover py-3" id="table-project">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Client</th>
                                    <th>Leader</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Proggress</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($project->count())
                                    @foreach ($project as $pro)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pro->nama }}</td>
                                        <td>{{ $pro->client }}</td>
                                        <td class="pt-0">
                                            <div class="d-flex align-items-center">
                                                <div class="bd-highlight me-2">
                                                    <img src="{{ $pro->leader->getFoto }}" height="50px" alt="">
                                                </div>
                                                <div class="bd-highlight lh-1">
                                                    <p class="mb-0">{{ $pro->leader->nama }}</p>
                                                    <p class="mb-0">{{ $pro->leader->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $pro->getTanggalMulai }}</td>
                                        <td>{{ $pro->getTanggalSelesai }}</td>
                                        <td style="width: 300px">
                                            @if ($pro->tugas->count())
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: {{ ( $pro->tugas->where('status', 1)->count() / $pro->tugas->count() ) * 100 }}%">{{ ( $pro->tugas->where('status', 1)->count() / $pro->tugas->count() ) * 100 }}%</div>
                                                </div>
                                            @else
                                                Belum ada tugas
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                            <a href="{{ route('tugas.index', ['project' => $pro->id]) }}" class="btn btn-sm btn-primary"><i class="bi bi-box-arrow-up-right"></i></a>
                                            <a href="{{ route('project.edit', ['project' => $pro->id]) }}" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></a>
                                            <button class="btn btn-sm btn-danger" onclick="hapusData('{{ route('project.destroy', ['project' => $pro->id]) }}')" data-bs-toggle="modal" data-bs-target="#modal-delete"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="7">
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
            <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan nama project" required autocomplete="off">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="client" class="form-label">Client</label>
                            <input type="text" name="client" class="form-control @error('client') is-invalid @enderror" id="client" placeholder="Masukkan client" required autocomplete="off">
                            @error('client')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="leader" class="form-label">Tim Leader</label>
                            <select class="form-select" name="leader" id="leader" aria-label="Default select example">
                                <option selected>-pilih leader-</option>
                                @foreach ($tim as $t)
                                    <option value="{{ $t->id }}">{{ $t->nama }}</option>
                                @endforeach
                            </select>
                            @error('leader')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="startDate" class="col-md-4 col-form-label">Tanggal Mulai</label>
                            <input type="text" class="form-control @error('start') is-invalid @enderror" name="start" id="startDate" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                            <div class="invalid-feedback">
                                Start date must be before end date.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="col-md-4 col-form-label">Tanggal Selesai</label>
                            <input type="text" class="form-control @error('end') is-invalid @enderror" name="end" id="endDate" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                            <div class="invalid-feedback">
                                End date must be before end date.
                            </div>
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

    @include('includes.modal_delete', ['title_delete' => 'Project'])

    @push('after-scripts')
        <script>
            $(document).ready(function() {
                $('#table-project').DataTable();
            });
        </script>
    @endpush
@endsection