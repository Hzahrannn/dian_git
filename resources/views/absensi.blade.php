@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white p-4">
                <h5>Absensi</h5>
            </div>

            <div class="card-body p-4">
                <div class="d-flex justify-content-end mr-3 mb-4">
                    <a href="#" class="btn bg-primary btn-flat text-white" data-toggle="modal" data-target="#absensiModal" onclick="tambah_absensi()">+ Absensi Masuk</a>
                </div>
                <table class="table table-striped table-bordered" style="width:100%" id="table_absensi">
                    <thead>
                        <tr>
                        
                            <th>No</th>
                            <th>Karyawan</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Hari</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($absensi as $row)
                        <tr id="{{ $row->id }}">
                            <td>{{ $no }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->jam_masuk }}</td>
                            <td>{{ $row->jam_pulang }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>
                                @if(Auth::user()->jabatan == 'hrd')
                                <a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#absensiModal" onclick="edit_absensi('{{ $row->id }}');"><span class="material-icons">edit</span></a>
                                <a class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#deleteModal" onclick="delete_absensi('{{ $row->id }}');"><span class="material-icons">delete</span></a>
                                @endif
                                @if($row->jam_pulang == null)
                                <a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#absensiPulangModal" onclick="absensi_pulang('{{ $row->id }}');">Absen Pulang</a>
                                @endif
                                <span class="id_karyawan" hidden>{{ $row->id_karyawan }}</span>
                                <span class="jam_masuk" hidden>{{ $row->jam_masuk }}</span>
                                <span class="jam_pulang" hidden>{{ $row->jam_pulang }}</span>
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

<div class="modal fade" id="absensiModal" tabindex="-1" role="dialog" aria-labelledby="absensiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form method="POST" id="form">
                @csrf
                <div class="modal-header p-4">
                    <h5 class="modal-title" id="absensiModalLabel">New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label>Jam</label>
                        <input type="time" class="form-control" name="jam" id="input_jam" required>
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
<div class="modal fade" id="absensiPulangModal" tabindex="-1" role="dialog" aria-labelledby="absensiPulangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form method="POST" id="form_pulang">
                @csrf
                <div class="modal-header p-4">
                    <h5 class="modal-title" id="absensiPulangModalLabel">New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label>Jam</label>
                        <input type="time" class="form-control" name="jam_pulang" id="input_jam_pulang" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="text" class="form-control" name="id" id="input_id_pulang" hidden>
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
                <h5 class="modal-title" id="deleteModalLabel">Delete Absensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <p>Apakah anda mau mendelete Absensi ini?</p>
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
        $('#table_absensi').DataTable();
    });

    function tambah_absensi() {
        $('#absensiModalLabel').text('New Absensi');
        $('#form').attr('action', '{{ url("insert_absensi") }}');
        $('#input_id').val('');
        $('#input_id_karyawan').val('');
        $('#input_jam').val('');
    }

    function edit_absensi(id) {
        $('#absensiModalLabel').text('Edit Absensi');
        var data = $('tr#' + id);
        $('#password').hide();
        $('#form').attr('action', '{{ url("edit_absensi") }}/' + id);
        $('#input_id').val(id);
        $('#input_id_karyawan').val(data.find('.id_karyawan').text());
        $('#input_jam').val(data.find('.jam').text());
    }

    function absensi_pulang(id) {
        $('#absensiPulangModalLabel').text('Absensi Pulang');
        var data = $('tr#' + id);
        $('#form_pulang').attr('action', '{{ url("absen_pulang") }}/' + id);
        $('#input_id_pulang').val(id);
    }

    function delete_absensi(id) {
        var data = $('tr#' + id);
        $('#btn_delete').attr('href', '{{ url("delete_absensi") }}/' + id);
    }
</script>


@endsection