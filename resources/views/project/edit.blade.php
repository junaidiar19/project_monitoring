@extends('layout.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3>Edit Data Project</h3>

                    <form action="{{ route('project.update', ['project' => $project->id]) }}" method="POST">
                        @method('put')
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama', $project->nama) }}" placeholder="Masukkan nama leader tim" required autocomplete="off">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="client" class="form-label">Client</label>
                            <input type="text" name="client" class="form-control @error('client') is-invalid @enderror" id="client" value="{{ old('client', $project->client) }}" placeholder="Masukkan client leader tim" required autocomplete="off">
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
                                    <option {{ $t->id == $project->leader_id ? 'selected' : '' }} value="{{ $t->id }}">{{ $t->nama }}</option>
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
                            <input type="text" class="form-control @error('start') is-invalid @enderror" name="start" id="startDate" value="{{ old('start', $project->tanggal_mulai) }}" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                            <div class="invalid-feedback">
                                Start date must be before end date.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="col-md-4 col-form-label">Tanggal Selesai</label>
                            <input type="text" class="form-control @error('end') is-invalid @enderror" name="end" id="endDate" value="{{ old('end', $project->tanggal_selesai) }}" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                            <div class="invalid-feedback">
                                End date must be before end date.
                            </div>
                        </div>

                        <div class="text-end mt-5">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection