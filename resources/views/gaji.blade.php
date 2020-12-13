@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white p-4">
                <h5>Gaji</h5>
            </div>

            <div class="card-body p-4">
                @if(Auth::user()->jabatan == 'hrd')
                <div class="d-flex justify-content-end mr-3 mb-4">
                    <a href="#" class="btn bg-primary btn-flat text-white" data-toggle="modal" data-target="#gajiModal" onclick="tambah_gaji()">+ Add Gaji</a>
                </div>
                @endif
                <table class="table table-striped table-bordered" style="width:100%" id="table_gaji">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Karyawan</th>
                            <th>Tanggal</th>
                            @if(Auth::user()->jabatan == 'hrd')

                            <th>Gaji</th>
                            @endif
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($gaji as $row)
                        <tr id="{{ $row->id }}">
                            <td>{{ $no }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->tanggal }}</td>
                            <td>{{ $row->gaji }}</td>
                            @if(Auth::user()->jabatan == 'hrd')
                            <td>
                                <a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#gajiModal" onclick="edit_gaji('{{ $row->id }}');"><span class="material-icons">edit</span></a>
                                <a class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#deleteModal" onclick="delete_gaji('{{ $row->id }}');"><span class="material-icons">delete</span></a>
                                <span class="id_karyawan" hidden>{{ $row->id_karyawan }}</span>
                                <span class="tanggal" hidden>{{ $row->tanggal }}</span>
                                <span class="gaji" hidden>{{ $row->gaji }}</span>
                            </td>
                            @endif
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

<div class="modal fade" id="gajiModal" tabindex="-1" role="dialog" aria-labelledby="gajiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form method="POST" id="form">
                @csrf
                <div class="modal-header p-4">
                    <h5 class="modal-title" id="gajiModalLabel">New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label>Karyawan</label>
                        <select class="form-control" name="id_karyawan" id="input_id_karyawan" require>
                            @foreach($user as $v)
                            <option value="{{ $v->id}}">{{ $v->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <textarea class="form-control" name="tanggal" id="input_tanggal" required></textarea>
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
                <h5 class="modal-title" id="deleteModalLabel">Delete Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <p>Apakah anda mau mendelete Gaji ini?</p>
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
        $('#table_gaji').DataTable();
    });

    function tambah_gaji() {
        $('#gajiModalLabel').text('New Gaji');
        $('#form').attr('action', '{{ url("insert_gaji") }}');
        $('#input_id').val('');
        $('#input_id_karyawan').val('');
        $('#input_tanggal').val('');
        $('#input_gaji').val('');
    }

    function edit_gaji(id) {
        $('#gajiModalLabel').text('Edit Gaji');
        var data = $('tr#' + id);
        $('#password').hide();
        $('#form').attr('action', '{{ url("edit_gaji") }}/' + id);
        $('#input_id').val(id);
        $('#input_id_karyawan').val(data.find('.id_karyawan').text());
        $('#input_tanggal').val(data.find('.tanggal').text());
        $('#input_gaji').val(data.find('.gaji').text());
    }

    function delete_gaji(id) {
        var data = $('tr#' + id);
        $('#btn_delete').attr('href', '{{ url("delete_gaji") }}/' + id);
    }
</script>


@endsection