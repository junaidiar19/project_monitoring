@extends('layout.app')

@push('after-style')
    <style>
        /* toggle switch */
        .switch label{
            font-weight: normal;
            font-size: 13px;
            cursor: pointer;
        }

        .switch label input[type=checkbox]{
            opacity: 0;
            width: 0;
            height: 0;
        }

        .switch-col-blue{
            background-color: rgba(11, 32, 49, 0.5);
        }

        .switch label input[type=checkbox]:checked + .lever.switch-col-blue{
            background-color: rgba(33, 150, 243, 0.5);
        }

        .switch label .lever{
            margin: 0 14px;
            content: '';
            display: inline-block;
            position: relative;
            width: 40px;
            height: 15px;
            border-radius: 15px;
            transition: ease;
            vertical-align: middle;
        }

        .switch label input[type=checkbox]:checked + .lever.switch-col-blue:after {
            background-color: #2196F3;
            left: 24px;
        }

        .switch label .lever:after {
            content: "";
            position: absolute;
            display: inline-block;
            width: 21px;
            height: 21px;
            background-color: #F1F1F1;
            border-radius: 21px;
            box-shadow: 0 1px 3px 1px rgb(0 0 0 / 40%);
            left: -5px;
            top: -3px;
            transition: left 0.3s ease, box-shadow 0.1s ease;
        }
    </style>
@endpush

@section('content')
    @include('includes.alerts')

    <div class="row">
        <div class="col">
            <div class="alert alert-success alert-dismissible fade show" id="alert-verify" role="alert">
                <span id="alert-verify-text"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bd-highlight">
                            <h3 class="mb-0">Daftar Tugas project {{ $project->nama }}</h3>
                        </div>
                        <div class="bd-highlight ms-auto">
                            <form id="form-tugas" action="{{ route('tugas.store', ['project_id' => $project->id]) }}" method="POST">
                                <input type="hidden" name="_method" id="_method" value="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-7 px-0">
                                        <input type="text" class="form-control" name="nama" id="nama-tugas" placeholder="Masukkan nama tugas" required autocomplete="off">
                                    </div>
                                    <div class="col-5 ps-0 text-end">
                                        <button class="btn btn-primary" id="btn-tugas"><i class="bi bi-plus-square me-2"></i> Tambah</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive my-3">
                        <table class="table table-bordered table-primary table-striped table-hover py-3" id="table-tugas">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($project->tugas->count())
                                    @foreach ($project->tugas as $tgs)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $tgs->nama }}</td>
                                            <td>
                                                <div class="switch">
                                                    <label>
                                                        <input type="checkbox" name="status" id="checkbox{{ $tgs->id }}" {{ $tgs->status == 1 ? 'checked' : '' }} onclick="verify({{ $tgs->id }})">
                                                        <span class="lever switch-col-blue"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-nowrap">
                                                <button class="btn btn-success"onclick="editTugas('{{ $tgs->id }}', '{{ $tgs->nama }}')"><i class="bi bi-pencil-square"></i></button>
                                                <button class="btn btn-danger" onclick="hapusData('{{ route('tugas.destroy', ['tuga' => $tgs->id]) }}')" data-bs-toggle="modal" data-bs-target="#modal-delete"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="4">
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

    @include('includes.modal_delete', ['title_delete' => 'Project'])
@endsection

@push('after-scripts')
    <script>
        $(document).ready(function() {
            $('#table-tugas').DataTable();
        });

        $(document).ready(function (){
            $('#alert-verify').hide();
        });

        function editTugas(tugas_id, nama){
            $('#nama-tugas').val(nama);
            $('#nama-tugas').attr('placeholder', 'Edit Tugas');
            $('#_method').val('put');
            $('#form-tugas').attr('action', '/tugas/'+ tugas_id);
            $('#btn-tugas').html('<i class="bi bi-pencil-square me-2"></i> Ubah');
        }

        function verify(id){
            let check = $('#checkbox'+ id);
            let val = check.is(':checked') ? true : false;
            console.log(check);
            console.log(val);
            $.ajax({
                type: 'GET',
                url: '{{ route('verify') }}',
                data: {
                    "id" : id,
                    "val" : val,
                }, success: function(res) {
                    $('#alert-verify-text').html(res.message);
                    $('#alert-verify').show();
                }, error: function(err) {
                    console.log(err);
                    // peek your error code
                }
            })
        }
    </script>
@endpush