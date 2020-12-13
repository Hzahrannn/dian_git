@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white p-4">
                <h5>Loker</h5>
            </div>

            <div class="card-body p-4">
                <div class="d-flex justify-content-end mr-3 mb-4">
                    <a href="#" class="btn bg-primary btn-flat text-white" data-toggle="modal" data-target="#lokerModal" onclick="tambah_loker()">+ Add Loker</a>
                </div>
                <table class="table table-striped table-bordered" style="width:100%" id="table_loker">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Gaji</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($loker as $row)
                        <tr id="{{ $row->id }}">
                            <td>{{ $no }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->deskripsi }}</td>
                            <td>{{ $row->gaji }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#lokerModal" onclick="edit_loker('{{ $row->id }}');"><span class="material-icons">edit</span></a>
                                <a class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#deleteModal" onclick="delete_loker('{{ $row->id }}');"><span class="material-icons">delete</span></a>
                                <span class="nama" hidden>{{ $row->nama }}</span>
                                <span class="deskripsi" hidden>{{ $row->deskripsi }}</span>
                                <span class="gaji" hidden>{{ $row->gaji }}</span>
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

<div class="modal fade" id="lokerModal" tabindex="-1" role="dialog" aria-labelledby="lokerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form method="POST" id="form">
                @csrf
                <div class="modal-header p-4">
                    <h5 class="modal-title" id="lokerModalLabel">New Employee</h5>
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
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="input_deskripsi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Gaji</label>
                        <input type="text" class="form-control" name="gaji" id="input_gaji" >
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
                <h5 class="modal-title" id="deleteModalLabel">Delete Loker</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <p>Apakah anda mau mendelete Loker ini?</p>
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
        $('#table_loker').DataTable();
    });

    function tambah_loker() {
        $('#lokerModalLabel').text('New Loker');
        $('#form').attr('action', '{{ url("insert_loker") }}');
        $('#input_id').val('');
        $('#input_nama').val('');
        $('#input_deskripsi').val('');
        $('#input_gaji').val('');
    }

    function edit_loker(id) {
        $('#lokerModalLabel').text('Edit Loker');
        var data = $('tr#' + id);
        $('#password').hide();
        $('#form').attr('action', '{{ url("edit_loker") }}/' + id);
        $('#input_id').val(id);
        $('#input_nama').val(data.find('.nama').text());
        $('#input_deskripsi').val(data.find('.deskripsi').text());
        $('#input_gaji').val(data.find('.gaji').text());
    }

    function delete_loker(id) {
        var data = $('tr#' + id);
        $('#btn_delete').attr('href', '{{ url("delete_loker") }}/' + id);
    }
</script>


@endsection