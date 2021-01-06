@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white p-4">
                <h3>{{ $iklan_lowongan_kerja[0]->judul }}</h3>
            </div>

            <div class="card-body p-4">
                <h4 class="mb-3">{{ $iklan_lowongan_kerja[0]->nama }}</h4>
                <div class="">
                    @forelse ($lamaran as $v)
                    <button href="#" class="btn bg-primary btn-flat text-white mb-3" data-toggle="modal" data-target="#lamaranModal" onclick="lamaran()" disabled>Telah Melamar</button>
                    @empty
                    <a href="#" class="btn bg-primary btn-flat text-white mb-3" data-toggle="modal" data-target="#lamaranModal" onclick="lamaran()">Lamar</a>
                    @endforelse
                </div>
                <p class="mb-3">
                    {{ $iklan_lowongan_kerja[0]->deskripsi }}
                </p>
                <p>
                    Gaji : {{ $iklan_lowongan_kerja[0]->gaji }}
                </p>
                <div class="d-flex justify-content-end">
                    <p>
                        Job Posted : {{ $iklan_lowongan_kerja[0]->created_at }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->

<div class="modal fade" id="lamaranModal" tabindex="-1" role="dialog" aria-labelledby="lamaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form method="POST" id="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header p-4">
                    <h5 class="modal-title" id="lamaranModalLabel">New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label>Upload CV</label>
                        <input type="file" class="form-control" name="foto_cv">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="text" class="form-control" name="id_lowongan_kerja" value="{{ $id }}" hidden>
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
                <h5 class="modal-title" id="deleteModalLabel">Delete Iklan Lowongan Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <p>Apakah anda mau mendelete Iklan Lowongan Kerja ini?</p>
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
        $('#table_iklan_lowongan_kerja').DataTable();
    });

    function lamaran() {
        $('#lamaranModalLabel').text('Lamar?');
        $('#form').attr('action', '{{ url("insert_lamaran") }}');
    }

    function delete_iklan_lowongan_kerja(id) {
        var data = $('tr#' + id);
        $('#btn_delete').attr('href', '{{ url("delete_iklan_lowongan_kerja") }}/' + id);
    }
</script>


@endsection