@extends('layouts.app', [
'namePage' => 'Data Siswa',
'class' => 'sidebar-mini',
'activePage' => 'dataMurid',
])

@section('content')
    <div class="">
        @include('alerts.errors')
        @include('alerts.success')
        <h3 class="title-dashboard title">Data Siswa</h3>
        <hr>
        <div class="container">

            <div class="row" style="padding-bottom: 10px;">
                <div class="col-lg-6">
                    <div class="container h-100">
                        <div class="d-flex justify-content-left h-100">
                            <div class="searchbar" style="width: -webkit-fill-available;margin-bottom:auto;">
                                <form action="{{ route('admin.searchMurid') }}" method="get">
                                    {{ csrf_field() }}
                                    <input class="search_input" type="text" name="keyword" placeholder="Search..."
                                        style="width:85%;">
                                    <button type="submit" class="search_icon btn" style="width:10%;"><i
                                            class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" style="justify-content: flex-end;">
                    <div class="pull-right" style="padding-right: 15px;">
                        {{ Form::open(['action' => ['App\\Http\\Controllers\\AdminController@addMurid'], 'method' => 'GET']) }}
                        {{ Form::submit('Tambah Siswa', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            {{-- {{ Form::open(['action' => ['App\\Http\\Controllers\\AdminController@addMurid'], 'method' => 'GET']) }}
        {{ Form::submit('Tambah Siswa', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }} --}}
            @if (!is_null($keyword))
                <h2>Keyword: {{ $keyword }}</h2>
            @endif
            <div class="wrapper">
                <div class="scrollmenu h-100">
                    <table class="table table-hover" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Nama</th>
                                <th scope="col" class="text-center">Username</th>
                                <th scope="col" class="text-center">Nama Wali</th>
                                <th scope="col" class="text-center">Username Wali</th>
                                <th scope="col" class="text-center">Asal Sekolah</th>
                                <th scope="col" class="text-center">Kelas</th>
                                <th scope="col" class="text-center">Cabang</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center" rowspan="2">Action</th>
                                <th scope="col" class="text-center">No Telp Siswa</th>
                                <th scope="col" class="text-center">No Telp Ortu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($murid as $m)
                                <tr class="{{ $m->status ? '' : 'table-danger' }}">
                                    <?php $i = $i + 1; ?>
                                    <th class="text-center"><?php echo $i; ?></th>
                                    <td class="text-center">{{ $m->nama }}</td>
                                    <td class="text-center">{{ $m->username }}</td>
                                    <td class="text-center">{{ $m->ortu->nama }}</td>
                                    <td class="text-center">{{ $m->ortu->username }}</td>
                                    <td class="text-center">{{ $m->asal_sekolah }}</td>
                                    <td class="text-center">{{ $m->kelas }}</td>
                                    <td class="text-center">{{ $m->cabang->nama }}</td>
                                    @if ($m->status)
                                        <td class="text-center">Aktif</td>
                                    @else
                                        <td class="text-center">Non Aktif</td>
                                    @endif
                                    <td>
                                        {{-- <form action="{{ url(route('admin.editMurid')) }}" method="GET"> --}}
                                        {{ Form::open(['action' => ['App\Http\Controllers\AdminController@editMurid'], 'method' => 'GET','class'=>'d-inline']) }}
                                        <input class="" type="hidden" name="id" value="{{ $m->id }}">
                                        <button type="submit" class="btn  btn-warning waves-effect px-3"><i
                                                class="fas fa-edit" aria-hidden="true"></i></button>
                                        {{ Form::close() }}
                                        @if (Auth::user()->master)
                                            {{-- <form url="admin/datamurid/{{$m->id}}" method="DELETE">
                                        {{ csrf_field() }}
                                        
                                    </form> --}}
                                            {{ Form::open(['action' => ['App\\Http\\Controllers\\MuridController@delete', $m->id], 'method' => 'DELETE','class'=>'d-inline']) }}
                                            {{-- {{ Form::submit('Delete', ['class' => 'btn btn-danger','onclick'=>"return confirm('Apakah anda yakin akan menghapus siswa?')"]) }} --}}
                                                <button type="submit" class="btn  btn-danger waves-effect px-3"
                                                    onclick="return confirm('Apakah anda yakin akan menghapus siswa?')"><i
                                                        class="fas fa-trash-alt" aria-hidden="true"></i></button>
                                            {{ Form::close() }}
                                        @endif
                                        {{ Form::open(['action' => ['App\Http\Controllers\AdminController@viewAturJadwal'], 'method' => 'GET','class'=>'d-inline']) }}
                                        <input class="" type="hidden" name="id" value="{{ $m->id }}">
                                        <button type="submit" class="btn  btn-primary waves-effect px-3">Atur Jadwal</button>
                                        {{ Form::close() }}
                                    </td>
                                    <td>{{ $m->no_telp }}</td>
                                    <td>{{ $m->ortu->no_telp }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $murid->links() }}
    </div>
@endsection
