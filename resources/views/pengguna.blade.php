@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white p-4">
                <h5>pengguna</h5>
            </div>

            <div class="card-body p-4">
                <div class="d-flex justify-content-end mr-3 mb-4">
                    <a href="#" class="btn bg-primary btn-flat text-white" data-toggle="modal" data-target="#penggunaModal" onclick="tambah_pengguna()">+ Add New Employee</a>
                </div>
                <table class="table table-striped table-bordered" style="width:100%" id="table_pengguna">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($pengguna as $row)
                        <tr id="{{ $row->id }}">
                            <td>
                                {{ $no }}
                            </td>
                            <td>
                                {{ $row->nama }}
                            </td>
                            <td>
                                {{ $row->username }}
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#penggunaModal" onclick="edit_pengguna('{{ $row->id }}');"><span class="material-icons">edit</span></a>
                                <a class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#deleteModal" onclick="delete_pengguna('{{ $row->id }}');"><span class="material-icons">delete</span></a>
                                <span class="nama" hidden>{{ $row->nama }}</span>
                                <span class="username" hidden>{{ $row->username }}</span>
                                <span class="jabatan" hidden>{{ $row->jabatan }}</span>
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

<div class="modal fade" id="penggunaModal" tabindex="-1" role="dialog" aria-labelledby="penggunaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form method="POST" id="form">
                @csrf
                <div class="modal-header p-4">
                    <h5 class="modal-title" id="penggunaModalLabel">New Employee</h5>
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
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" id="input_username" required>
                    </div>
                    <div class="form-group" id="password">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="input_password" required>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control" name="jabatan" id="input_jabatan" required>
                            <option value="hrd">HRD</option>
                            <option value="supervisor">Supervisor</option>
                            <option value="manager">Manager</option>
                        </select>
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
                <h5 class="modal-title" id="deleteModalLabel">Delete pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <p>Apakah anda mau mendelete pengguna ini?</p>
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
        $('#table_pengguna').DataTable();
    });

    function tambah_pengguna() {
        $('#penggunaModalLabel').text('New Employee');
        $('#form').attr('action', '{{ url("insert_pengguna") }}');
        $('#input_id').val('');
        $('#input_nama').val('');
        $('#input_username').val('');
        $('#password').show();
        $('#input_password').val('');
        $('#input_jabatan').val('');
    }

    function edit_pengguna(id) {
        $('#penggunaModalLabel').text('Edit Employee Details');
        var data = $('tr#' + id);
        $('#password').hide();
        $('#form').attr('action', '{{ url("edit_pengguna") }}/' + id);
        $('#input_id').val(id);
        $('#input_nama').val(data.find('.nama').text());
        $('#input_username').val(data.find('.username').text());
        $('#input_password').attr('required', false);
        $('#input_jabatan').val(data.find('.jabatan').text());
    }

    function delete_pengguna(id) {
        var data = $('tr#' + id);
        $('#btn_delete').attr('href', '{{ url("delete_pengguna") }}/' + id);
    }
</script>


@endsection