@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white p-4">
                <h5>Demosi</h5>
            </div>

            <div class="card-body p-4">
                @if(Auth::user()->jabatan == 'hrd')
                <div class="d-flex justify-content-end mr-3 mb-4">
                    <a href="#" class="btn bg-primary btn-flat text-white" data-toggle="modal" data-target="#demosiModal" onclick="tambah_demosi()">+ Add Demosi</a>
                </div>
                @endif
                <table class="table table-striped table-bordered" style="width:100%" id="table_demosi">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Karyawan</th>
                            <th>Surat Demosi</th>
                            <th>Keputusan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($demosi as $row)
                        <tr id="{{ $row->id }}">
                            <td>{{ $no }}</td>
                            <td>{{ $row->nama }}</td>
                            <td><a href="{{ url('image_surat_demosi').'/'.$row->surat_demosi }}" target="_blank">Lihat</a></td>
                            <td>{{ $row->keputusan }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#demosiModal" onclick="edit_demosi('{{ $row->id }}');"><span class="material-icons">edit</span></a>
                                <a class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#deleteModal" onclick="delete_demosi('{{ $row->id }}');"><span class="material-icons">delete</span></a>
                                <span class="id_karyawan" hidden>{{ $row->id_karyawan }}</span>
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

<div class="modal fade" id="demosiModal"  role="dialog" aria-labelledby="demosiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form method="POST" id="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header p-4">
                    <h5 class="modal-title" id="demosiModalLabel">New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label>Nama Karyawan</label>
                        <select class="form-control" name="id_karyawan" id="input_id_karyawan">
                            @foreach($user as $v)
                            <option value="{{$v->id}}">{{ $v->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Surat</label>
                        <input type="file" class="form-control" name="foto_surat_demosi">
                    </div>
                    <div class="form-group">
                        <label>Keputusan</label>
                        <textarea class="form-control" name="keputusan" id="input_keputusan" required></textarea>
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
                <h5 class="modal-title" id="deleteModalLabel">Delete Demosi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <p>Apakah anda mau mendelete Demosi ini?</p>
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
        $('#table_demosi').DataTable();
        $('#input_id_karyawan').select2({
            width: '100%',
            placeholder: "Select an Option",
            allowClear: true
        });
    });

    function tambah_demosi() {
        $('#demosiModalLabel').text('New Demosi');
        $('#form').attr('action', '{{ url("insert_demosi") }}');
        $('#input_id').val('');
        $('#input_jabatan').val('');
    }

    function edit_demosi(id) {
        $('#demosiModalLabel').text('Edit Demosi');
        var data = $('tr#' + id);
        $('#password').hide();
        $('#form').attr('action', '{{ url("edit_demosi") }}/' + id);
        $('#input_id').val(id);
        $('#input_jabatan').val(data.find('.jabatan').text());
    }

    function delete_demosi(id) {
        var data = $('tr#' + id);
        $('#btn_delete').attr('href', '{{ url("delete_demosi") }}/' + id);
    }
</script>


@endsection