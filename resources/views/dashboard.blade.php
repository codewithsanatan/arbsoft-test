@extends('layout')
@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <h3 class="card-header text-center">Dashboard</h3>
                    <div class="card-body">
                        {{-- <p>Welcome to Dashboard</p> --}}
                        @if (auth()->user()->id == 1)
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($allUsers as $key => $user)
                                    <tr>
                                        <th scope="row">{{$key + 1}}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->status}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#userEditModal_' . $user->id}}" {{$user->id == 1 ? 'disabled' : ''}} >Edit</button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="{{'#userDeleteModal_' . $user->id}}" {{$user->id == 1 ? 'disabled' : ''}} >Delete</button>

                                            {{-- Edit User Modal --}}
                                            <div class="modal fade" id="{{'userEditModal_' . $user->id}}" tabindex="-1" role="dialog" aria-labelledby="{{'userModalLabel_' . $user->id}}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="{{'userModalLabel_' . $user->id}}">Update User</h5>
                                                        <button type="button" class="btn-close close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('update.user')}}" method="POST">
                                                        <div class="modal-body">
                                                                @csrf
                                                                <input type="text" name="user_id" value="{{$user->id}}" hidden>
                                                                <div class="form-group">
                                                                    <label for="fullname" class="col-form-label">Name</label>
                                                                    <input type="text" class="form-control" name="fullname" id="fullname" value="{{$user->name}}">
                                                                    @if ($errors->has('fullname'))
                                                                    <span class="text-danger">{{ $errors->first('fullname') }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="user_email" class="col-form-label">Email</label>
                                                                    <input type="text" class="form-control" name="user_email" id="user_email" value="{{$user->email}}">
                                                                    @if ($errors->has('user_email'))
                                                                    <span class="text-danger">{{ $errors->first('user_email') }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="message-text" class="col-form-label">Status:</label>
                                                                    <select name="user_status" id="user_status" class="form-control">
                                                                        <option value="inactive" {{$user->status == "inactive" ? "selected" : ""}}>Inactive</option>
                                                                        <option value="active" {{$user->status == "active" ? "selected" : ""}}>Active</option>
                                                                        <option value="blocked" {{$user->status == "blocked" ? "selected" : ""}}>Blocked</option>
                                                                    </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update User</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- User Delete Modal --}}
                                            <div class="modal fade" id="{{'userDeleteModal_' . $user->id}}" tabindex="-1" role="dialog" aria-labelledby="{{'userModalLabel_' . $user->id}}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="{{'userModalLabel_' . $user->id}}">Are you Sure to Delete this User</h5>
                                                        <button type="button" class="btn-close close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('delete.user')}}" method="POST">
                                                        <div class="modal-body">
                                                            @csrf
                                                            <input type="text" name="user_id" value="{{$user->id}}" hidden>
                                                            <p>You can't undo this action</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Delete User</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center" >Welcome to  {{auth()->user()->name}}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection





{{-- <!DOCTYPE html>
<html>
<head>
    <title>Custom Auth in Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
        <div class="container">
            <a class="navbar-brand mr-auto" href="#">PositronX</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
</body>
</html>
 --}}
