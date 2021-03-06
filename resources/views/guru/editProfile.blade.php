@extends('layouts.app', [
    'namePage' => 'Edit Profil',
    'class' => 'sidebar-mini',
    'activePage' => 'editprofil',
    ])

@section('content')
<div class="container">
@include('alerts.errors')
@include('alerts.success')
    <br>
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <h4 class="card-title"> Profil Pengajar </h4>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                <tbody>
                    <tr>
                    <td>
                        Nama
                    </td>
                    <td>
                    {{ \Auth::user()->nama }}
                    </td>
                    </tr>
                    <tr>
                    <td>
                        Username
                    </td>
                    <td>
                    {{ \Auth::user()->username }}
                    </td>
                    </tr>
                    <tr>
                    <td>
                        Cabang
                    </td>
                    <td>
                    {{ \Auth::user()->cabang->nama}}
                    </td>
                    </tr>
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>

    {{ Form::open(['action' => ['App\\Http\\Controllers\\GuruController@updateLink'], 'method' => 'PUT']) }}
    <div class="form-group">
        <div class="col col-md-3">
            <label for="text-input" class=" form-control-label">Link Meeting</label>
        </div>
        <div class="col-12 col-md-9">
            <input type="text" id="text-input" value="{{ \Auth::user()->link_meeting}}" name="link_meeting" class="form-control">
        </div>
    </div>
    <div class="col col-md-3">
    {{ Form::submit('Update Link Meeting', ['class' => 'btn btn-success']) }}
    </div>
    {{ Form::close() }}
    {{ Form::open(['action' => ['App\\Http\\Controllers\\GuruController@updateProfile'], 'method' => 'PUT']) }}
    <div class="form-group">
        <div class="col col-md-3">
        {{ Form::label('password', 'Password: ', ['class' => 'form-label']) }}
        </div>
        <div class="col-12 col-md-9">
        {{ Form::password('password',['class' => 'form-control'])}}
        </div>
    </div>
    <div class="form-group">
        <div class="col col-md-3">
        {{ Form::label('repassword', 'Confirm Password: ', ['class' => 'form-label']) }}
        </div>
        <div class="col-12 col-md-9">
        {{ Form::password('repassword',['class' => 'form-control'])}}
        </div>
    </div>
    <div class="col col-md-3">
    {{ Form::submit('Update Password', ['class' => 'btn btn-primary']) }}
    </div>
    {{ Form::close() }}
</div>
@endsection