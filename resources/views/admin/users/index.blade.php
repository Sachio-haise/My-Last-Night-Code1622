@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
       <div class="col-12">
           <h1 class="float-start">Users</h1>
           <a class="btn btn-success float-end" href="{{route('admin.users.create')}}" >Create</a>
       </div>
    </div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-primary btn-sm" >Edit</a>

                    <a  class="btn btn-danger btn-sm" onclick="event.preventDefault();document.getElementById('delete-user-{{$user->id}}').submit();">Delete</a>

                    <form action="{{route('admin.users.destroy',$user->id)}}" id="delete-user-{{$user->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
              </tr>
            @endforeach

        </tbody>
      </table>
      {{$users->links()}}
</div>
@endsection
