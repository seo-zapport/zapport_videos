@extends('layouts.app')

@section('active_roles','active')

@section('heading')
    <i class="fas fa-cogs text-secondary"></i> Roles
@endsection
@section('content')

<div class="card">
    <div class="card-body">
        <div class="form-group">
            <a class="btn btn-info text-white" href="#" data-toggle="modal" data-target="#roleModal"><i class="fa fa-plus"></i> Add Role </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover user-roles">
                <thead class="thead-dark">
                    <tr>
                        <th width="5%">ID</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td width="5%">{{ $role->id }}</td>
                            <td>{{ $role->role }}
                                <div class="row-actions">
                                    <form method="post" action="{{ route('role.destroy', ['role'=>$role->role]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link text-danger"  onclick="return confirm('Are you sure you want to delete {{ ucfirst($role->role) }} Role?')" data-id="{{ $role->role }}">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                @include('layouts.errors')
                @if (session('delete_error_admin'))
                    <div class="alert alert-danger alert-posts">
                        {{ session('delete_error_admin') }}
                    </div>
                @endif
            </table>    
        </div>        
    </div>
</div>



<!-- Modal Add -->
<div class="modal fade bd-example-modal-lg" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Role For Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('role.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" name="role" class="form-control" placeholder="Enter New Role" required>
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
