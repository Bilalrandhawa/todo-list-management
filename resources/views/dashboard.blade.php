@extends('admin.master')
@section('content')
    <style>
        .margin-button {
            margin-left: 700px;
        }
    </style>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12 mb-4 mb-xl-0">
                <h4 class="font-weight-bold text-dark">Hi, welcome back!</h4>

            </div>
        </div>


        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <h4 class="card-title">To-Do-List-Management</h4>
                        <a href="{{ 'add-task' }}"><button class="btn btn-info margin-button">Add Task</button></a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>

                                    <tr>
                                        <th>
                                            Title
                                        </th>
                                        <th>
                                            Due Date
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Description
                                        </th>
                                        <th>
                                            Status
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tasks->isEmpty())
                                        <tr>
                                            <td class="text-center bg-white "colspan="4">
                                                <p>No tasks found.</p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($tasks as $data)
                                            <tr>
                                                <td class="py-1">
                                                    {{ $data->title }}
                                                </td>
                                                <td>
                                                    {{ $data->due_date }}
                                                </td>
                                                <td>
                                                    @if ($data->status === 'pending')
                                                        <label class="badge badge-warning">Pending</label>
                                                    @elseif ($data->status === 'accepted')
                                                        <label class="badge badge-success">Accepted</label>
                                                    @elseif ($data->status === 'rejected')
                                                        <label class="badge badge-danger">Rejected</label>
                                                    @endif
                                                </td>

                                                <td>
                                                    {{ $data->description }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('tasks.edit', $data->id) }}" class="btn btn-secondary">Edit</a> |
                                                    <form action="{{ route('tasks.destroy', $data->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
