@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Groups
                <a href="{{route('groups.create')}}" class="btn btn-success text-center" style="float:right">Add</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id.</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($groups as $group)
                                    <tr>
                                        <td>{{ $group->id }}</td>
                                        <td>{{ $group->name }}</td>
                                        <td>{{ $group->description }}</td>
                                        <td>
                                            <a href="{{ route('groups.edit',$group->id) }}" class="text-success">Edit</a> |
                                            <a href="{{ route('groups.destroy',$group->id) }}" class="text-danger" onclick="handleDelete(event, {{ $group->id }})">
                                                Delete
                                            </a>
                                            <form action="{{ route('groups.destroy',$group->id) }}" method="post" id="dlt{{ $group->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="7">No Category Available</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 d-flex justify-content-between justify-content-center">
                            <h6>Showing {{ $groups->firstItem() }} to {{ $groups->lastItem() }} of {{ $groups->total() }} entries</h6>
                            {{ $groups->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        const handleDelete = (e, id) => {
            e.preventDefault();
            if(confirm('Are you sure?')){
                $(`#dlt${id}`).submit();
            }
        }
    </script>
