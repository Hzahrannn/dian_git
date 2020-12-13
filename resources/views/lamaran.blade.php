@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white p-4">
                <h5>Lamaran</h5>
            </div>

            <div class="card-body p-4">
                @if(Auth::user()->jabatan == 'Pelamar')
                <div class="d-flex justify-content-end mr-3 mb-4">
                    <a href="#" class="btn bg-primary btn-flat text-white" data-toggle="modal" data-target="#lamaranModal" onclick="tambah_lamaran()">+ Add Lamaran</a>
                </div>
                @endif
                <table class="table table-striped table-bordered" style="width:100%" id="table_lamaran">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Asal</th>
                            <th>Posisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($lamaran as $row)
                        <tr id="{{ $row->id }}">
                            <td>{{ $no }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->asal }}</td>
                            <td>{{ $row->posisi }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#lamaranModal" onclick="edit_lamaran('{{ $row->id }}');"><span class="material-icons">edit</span></a>
                                <a class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#deleteModal" onclick="delete_lamaran('{{ $row->id }}');"><span class="material-icons">delete</span></a>
                                <span class="nama" hidden>{{ $row->nama }}</span>
                                <span class="asal" hidden>{{ $row->asal }}</span>
                                <span class="posisi" hidden>{{ $row->posisi }}</span>
                            </td>
                        </tr>
                        <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->

<div class="modal fade" id="lamaranModal" tabindex="-1" role="dialog" aria-labelledby="lamaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form method="POST" id="form">
                @csrf
                <div class="modal-header p-4">
                    <h5 class="modal-title" id="lamaranModalLabel">New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" id="input_nama" required>
                    </div>
                    <div class="form-group">
                        <label>Asal</label>
                        <textarea class="form-control" name="asal" id="input_asal" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Posisi</label>
                        <input type="text" class="form-control" name="posisi" id="input_posisi" >
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="text" class="form-control" name="id" id="input_id" hidden>
                    <button type="button" class="btn btn-white text-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h5 class="modal-title" id="deleteModalLabel">Delete Lamaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <p>Apakah anda mau mendelete Lamaran ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white text-danger" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger" id="btn_delete">Delete</a>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#table_lamaran').DataTable();
    });

    function tambah_lamaran() {
        $('#lamaranModalLabel').text('New Lamaran');
        $('#form').attr('action', '{{ url("insert_lamaran") }}');
        $('#input_id').val('');
        $('#input_nama').val('');
        $('#input_asal').val('');
        $('#input_posisi').val('');
    }

    function edit_lamaran(id) {
        $('#lamaranModalLabel').text('Edit Lamaran');
        var data = $('tr#' + id);
        $('#password').hide();
        $('#form').attr('action', '{{ url("edit_lamaran") }}/' + id);
        $('#input_id').val(id);
        $('#input_nama').val(data.find('.nama').text());
        $('#input_asal').val(data.find('.asal').text());
        $('#input_posisi').val(data.find('.posisi').text());
    }

    function delete_lamaran(id) {
        var data = $('tr#' + id);
        $('#btn_delete').attr('href', '{{ url("delete_lamaran") }}/' + id);
    }
</script>


@endsection