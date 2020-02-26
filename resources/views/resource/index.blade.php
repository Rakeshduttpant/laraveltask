@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Resources
                <a href="{{route('resources.create')}}" class="btn btn-success text-center" style="float:right">Add</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID.</th>
                                    <th>Name</th>
                                    <th>Group Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($resources as $resource)
                                    <tr>
                                        <td>{{ $resource->id }}</td>
                                        <td>{{ $resource->name }}</td>
                                        <td>{{ $resource->group->name }}</td>
                                        <td>{{ $resource->description }}</td>
                                        <td>
                                            <a href="{{ route('resources.edit',$resource->id) }}" class="text-success">Edit</a> |
                                            <a href="{{ route('resources.destroy',$resource->id) }}" class="text-danger" onclick="handleDelete(event, {{ $resource->id }})">
                                                Delete
                                            </a>
                                            <form action="{{ route('resources.destroy',$resource->id) }}" method="post" id="dlt{{ $resource->id }}">
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
                            <h6>Showing {{ $resources->firstItem() }} to {{ $resources->lastItem() }} of {{ $resources->total() }} entries</h6>
                            {{ $resources->links() }}
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
