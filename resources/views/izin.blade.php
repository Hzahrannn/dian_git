@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white p-4">
                <h5>Izin</h5>
            </div>

            <div class="card-body p-4">
                @if(Auth::user()->jabatan == 'karyawan')
                <div class="d-flex justify-content-end mr-3 mb-4">
                    <a href="#" class="btn bg-primary btn-flat text-white" data-toggle="modal" data-target="#izinModal" onclick="tambah_izin()">+ Add Cuti</a>
                </div>
                @endif
                <table class="table table-striped table-bordered" style="width:100%" id="table_izin">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Karyawan</th>
                            <th>Tanggal Ijin</th>
                            <th>Alasan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($izin as $row)
                        <tr id="{{ $row->id }}">
                            <td>{{ $no }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->izin }}</td>
                            <td>{{ $row->alasan }}</td>
                            <td>{{ $row->status }}</td>
                            <td>
                                @if($row->status == null)
                                <a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#izinModal" onclick="edit_izin('{{ $row->id }}');"><span class="material-icons">edit</span></a>
                                <a class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#deleteModal" onclick="delete_izin('{{ $row->id }}');"><span class="material-icons">delete</span></a>
                                <span class="id_karyawan" hidden>{{ $row->id_karyawan }}</span>
                                <span class="izin" hidden>{{ $row->izin }}</span>
                                <span class="alasan" hidden>{{ $row->alasan }}</span>
                                @endif
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

<div class="modal fade" id="izinModal" tabindex="-1" role="dialog" aria-labelledby="izinModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form method="POST" id="form">
                @csrf
                <div class="modal-header p-4">
                    <h5 class="modal-title" id="izinModalLabel">New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label>Id Karyawan</label>
                        <input type="text" class="form-control" name="id_karyawan" id="input_id_karyawan" value="{{ Auth::user()->id }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Karyawan</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Izin</label>
                        <input type="date" class="form-control" name="izin" id="input_izin">
                    </div>
                    <div class="form-group">
                        <label>Alasan</label>
                        <textarea class="form-control" name="alasan" id="input_alasan"></textarea>
                    </div>
                    @if(Auth::user()->jabatan != 'karyawan')
                    <a id="setuju">Setuju</a>
                    <a id="tolak">Tolak</a>
                    @endif
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
                <h5 class="modal-title" id="deleteModalLabel">Delete Cuti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <p>Apakah anda mau mendelete Cuti ini?</p>
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
        $('#table_izin').DataTable();
    });

    function tambah_izin() {
        $('#izinModalLabel').text('New Cuti');
        $('#form').attr('action', '{{ url("insert_izin") }}');
        $('#input_id').val('');
        $('#input_izin').val('');
        $('#input_alasan').val('');
    }

    function edit_izin(id) {
        $('#izinModalLabel').text('Edit Cuti');
        var data = $('tr#' + id);
        $('#password').hide();
        $('#form').attr('action', '{{ url("edit_izin") }}/' + id);
        $('#input_id').val(id);
        $('#input_id_karyawan').val(data.find('.id_karyawan').text());
        $('#input_izin').val(data.find('.izin').text());
        $('#input_alasan').val(data.find('.alasan').text());
        $('#setuju').attr('href', "{{ url('/izin/setuju') }}/" + id);
        $('#tolak').attr('href', "{{ url('/izin/tolak') }}/" + id);
    }

    function delete_izin(id) {
        var data = $('tr#' + id);
        $('#btn_delete').attr('href', '{{ url("delete_izin") }}/' + id);
    }
</script>


@endsection