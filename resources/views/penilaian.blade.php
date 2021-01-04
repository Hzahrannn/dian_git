@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white p-4">
                <h5>Penilaian</h5>
            </div>

            <div class="card-body p-4">
                @if(Auth::user()->jabatan != 'direktur')
                <div class="d-flex justify-content-end mr-3 mb-4">
                    <a href="#" class="btn bg-primary btn-flat text-white" data-toggle="modal" data-target="#penilaianModal" onclick="tambah_penilaian()">+ Add Penilaian</a>
                </div>
                @endif
                <table class="table table-striped table-bordered" style="width:100%" id="table_penilaian">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Karyawan</th>
                            <th>Nilai KaBag</th>
                            <th>Nilai Manajer</th>
                            <th>Nilai HRD</th>
                            <th>Total</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($penilaian as $row)
                        <tr id="{{ $row->id }}">
                            <td>{{ $no }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->nilai_kabag }}</td>
                            <td>{{ $row->nilai_manajer }}</td>
                            <td>{{ $row->nilai_hrd }}</td>
                            <td>{{ ($row->nilai_kabag + $row->nilai_manajer + $row->nilai_hrd)/3 }}</td>
                            <td>{{ $row->deskripsi }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#penilaianModal" onclick="edit_penilaian('{{ $row->id }}');"><span class="material-icons">edit</span></a>
                                <!-- <a class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#deleteModal" onclick="delete_penilaian('id');"><span class="material-icons">delete</span></a> -->
                                <span class="id_karyawan" hidden>{{ $row->id_karyawan }}</span>
                                @if(Auth::user()->jabatan == 'hrd')
                                    <span class="nilai_hrd" hidden>{{ $row->nilai_hrd }}</span>
                                @elseif(Auth::user()->jabatan == 'manajer')
                                    <span class="nilai_manajer" hidden>{{ $row->nilai_manajer }}</span>
                                @elseif(Auth::user()->jabatan == 'kabag')
                                    <span class="nilai_kabag" hidden>{{ $row->nilai_kabag }}</span>
                                @endif
                                <span class="deskripsi" hidden>{{ $row->deskripsi }}</span>
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

<div class="modal fade" id="penilaianModal" tabindex="-1" role="dialog" aria-labelledby="penilaianModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form method="POST" id="form">
                @csrf
                <div class="modal-header p-4">
                    <h5 class="modal-title" id="penilaianModalLabel">New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group" id="karyawan">
                        <label>Karyawan</label>
                        <select class="form-control" name="id_karyawan" id="input_id_karyawan" >
                            @foreach($user as $v)
                            <option value="{{ $v->id}}">{{ $v->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="input_deskripsi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nilai</label>
                        <input type="number" class="form-control" name="nilai" id="input_nilai" >
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
                <h5 class="modal-title" id="deleteModalLabel">Delete Penilaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <p>Apakah anda mau mendelete Penilaian ini?</p>
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
        $('#table_penilaian').DataTable();
    });

    function tambah_penilaian() {
        $('#penilaianModalLabel').text('New Penilaian');
        $('#form').attr('action', '{{ url("insert_penilaian") }}');
        $('#input_id').val('');
        $('#input_id_karyawan').val('');
        $('#input_nilai').val('');
        $('#input_deskripsi').val('');
        $('#karyawan').show();
    }

    function edit_penilaian(id) {
        $('#penilaianModalLabel').text('Edit Penilaian');
        var data = $('tr#' + id);
        $('#password').hide();
        $('#form').attr('action', '{{ url("edit_penilaian") }}/' + id);
        $('#input_id').val(id);
        $('#input_id_karyawan').val(data.find('.id_karyawan').text());
        @if( Auth::user()->jabatan == 'hrd')
            $('#input_nilai').val(data.find('.nilai_hrd').text());
        @elseif ( Auth::user()->jabatan == 'manajer')
            $('#input_nilai').val(data.find('.nilai_manajer').text());
        @elseif ( Auth::user()->jabatan == 'kabag')
            $('#input_nilai').val(data.find('.nilai_kabag').text());
        @endif
        $('#input_deskripsi').val(data.find('.deskripsi').text());
        $('#karyawan').hide();
    }

    function delete_penilaian(id) {
        var data = $('tr#' + id);
        $('#btn_delete').attr('href', '{{ url("delete_penilaian") }}/' + id);
    }
</script>


@endsection