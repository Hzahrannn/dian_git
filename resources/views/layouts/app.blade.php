<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

    <title>Dian</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body style="background-color:powderblue;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/')}}">DIAN</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @if(Auth::check())
                <ul class="navbar-nav mr-auto">
                    @if(Auth::user()->jabatan == "hrd")
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('pengguna') }}">Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('iklan_lowongan_kerja') }}">Iklan Lowongan Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('lamaran') }}">Lamaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('absensi') }}">Absensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('penilaian') }}">Penilaian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('cuti') }}">Cuti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('izin') }}">Izin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('sp') }}">SP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('pengunduran') }}">Pengunduran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('phk') }}">PHK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('demosi') }}">Demosi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('mutasi') }}">Mutasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('gaji') }}">Gaji</a>
                    </li>
                    @elseif(Auth::user()->jabatan == "kabag")
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('penilaian') }}">Penilaian</a>
                    </li>
                    @elseif(Auth::user()->jabatan == "manajer")
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('penilaian') }}">Penilaian</a>
                    </li>
                    @elseif(Auth::user()->jabatan == "direktur")
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('absensi') }}">Absensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('penilaian') }}">Penilaian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('cuti') }}">Cuti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('izin') }}">Izin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('sp') }}">SP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('pengunduran') }}">Pengunduran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('phk') }}">PHK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('demosi') }}">Demosi</a>
                    </li>
                    @elseif(Auth::user()->jabatan == "kasir")
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('gaji') }}">Gaji</a>
                    </li>
                    @elseif(Auth::user()->jabatan == "pembantu_hrd")
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('gaji') }}">Gaji</a>
                    </li>
                    @elseif(Auth::user()->jabatan == "karyawan")
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('absensi') }}">Absensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('cuti') }}">Cuti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('izin') }}">Izin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('sp') }}">SP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('pengunduran') }}">Pengunduran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('phk') }}">PHK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('demosi') }}">Demosi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('mutasi') }}">Mutasi</a>
                    </li>
                    @endif
                </ul>
                @endif
                <ul class="navbar-nav ml-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->nama }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>

            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>

</body>

</html>