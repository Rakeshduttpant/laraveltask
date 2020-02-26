@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Resource</div>
                <div class="card-body">
                <form method="POST" action="/resources/{{$groups->id}}">
                        @csrf
                        @method("put")
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="namne" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$groups->name }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="group" class="col-md-4 col-form-label text-md-right">Group</label>
                            <div class="col-md-6">

                                <select id="group" class="form-control @error('name') is-invalid @enderror" name="group">
                                    <option value="">select group</option>
                                    @foreach ($op as $op1)
                                        <option value="{{$op1->id}}" @if ($op1->id == $groups->group_id) selected  @endif> {{$op1->name}}</option>
                                    @endforeach
                                </select>
                                @error('group')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                            <div class="col-md-6">
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{$groups->description}}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Updated
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
