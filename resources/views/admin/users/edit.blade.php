@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.update',$user->id) }}">
                        @method('PUT')
                       @include('admin.users.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
