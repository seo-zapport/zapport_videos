@extends('layouts.app')

@section('active_user','active')

@section('heading')
    <i class="fas fa-users text-secondary"></i> Users
@endsection


@section('content')
<div class="card">
    <div class="card-body px-3">
        <div class="form-group">
            <a class="btn btn-info text-white" href="#" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus"></i> Add Role Users</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover user-roles">
                <thead class="thead-dark">
                    <tr>
                        <th>Username</th>
                        <th width="30%">Email</th>
                        <th width="10%">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @if (count($user->roles) != 0)
                            <tr>
                                <td>
                                    {{ ucfirst($user->name) }}
                                    <div class="row-actions">
                                        <span id="{{ $user->id }}" class="show-edit btn btn-link text-secondary"><i class="far fa-edit"></i> Quick Edit</span>
                                    </div>
                                </td>
                                <td width="30%">{{ $user->email }}</td>
                                <td width="10%">
                                    @foreach ($user->roles as $role)
                                        {{ ucfirst($role->role) }}
                                    @endforeach
                                </td>
                            </tr>
                            @foreach ($user->roles as $role)
                                <tr class="inline-edit-row form-hide form-hidden-{{ $user->id }}">
                                    <td colspan="5" >
                                        <fieldset class="inline-edit-col w-100">
                                            <form method="post" action="{{ route('admin.update', ['user_id' => $user->id, 'role_id' => $role->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <p class="text-muted">QUICK EDIT</p>
                                                <span>Role</span>
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <select name="role_id" id="role_id" class="form-control-sm" onchange="this.form.submit();">
                                                    @foreach ($roles as $allRole)
                                                        <option {{ ($role->id == $allRole->id) ? 'selected' : '' }} value="{{ $allRole->id }}">{{ $allRole->role }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </fieldset>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</div>


<!-- Modal Add -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Role For Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('admin.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="role">Select User</label>
                        <select name="user_id" class="form-control" required>
                            <option value="" selected disabled>Select User</option>
                            @foreach ($users as $user)
                                @if (count($user->roles) < 1)
                                    <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role">Select Role</label>
                        <select name="role_id" class="form-control" required>
                            <option value="" selected disabled>Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ ucfirst($role->role) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
