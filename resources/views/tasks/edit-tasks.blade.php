@extends('admin.master')
@section('content')
    <style>
        select.form-control,
        .select2-container--default select.select2-selection--single,
        .select2-container--default .select2-selection--single select.select2-search__field,
        select.typeahead,
        select.tt-query,
        select.tt-hint {
            padding: 0.8375rem .75rem;
            border: 0;
            outline: 1px solid #e4e6f6;
            color: #666666;
        }
    </style>
    <div class="content-wrapper">
        <div class="row">

            <div class="col-12 grid-margin stretch-card">

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
                        <h4 class="card-title">Edit Task</h4>
                        <form class="forms-sample" method="post" action="{{ route('task.update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $task->id }}">
                            <div class="form-group">
                                <label for="exampleInputName1">Title</label>
                                <input type="text" name="title" class="form-control" id="Title"
                                    placeholder="Enter Title" value="{{ $task->title }}" required>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="due-date">Due Date</label>
                                    <input id="due-date" class="form-control bg-white" name="due_date"
                                        placeholder="dd/mm/yyyy" value="{{ $task->due_date }}" required />
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="exampleFormControlSelect1">Select Status</label>
                                    <select class="form-control" name="status" id="exampleFormControlSelect1" required>
                                        <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="accepted" {{ $task->status === 'accepted' ? 'selected' : '' }}>
                                            Accepted</option>
                                        <option value="rejected" {{ $task->status === 'rejected' ? 'selected' : '' }}>
                                            Rejected</option>
                                    </select>
                                </div>


                            </div>
                            <div class="form-group">
                                <label for="desciption">Description</label>
                                <textarea class="form-control" placeholder="Description" id="desciption" name="description" rows="4">{{ $task->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#due-date", {
                enableTime: true,
                dateFormat: "d/m/Y H:i",
                time_24hr: true
            });
        });
    </script>
@endsection
