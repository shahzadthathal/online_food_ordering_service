@extends('layouts.app')

@section('content')

<div class="col-md-10">
    <h2>Add Menu</h2>

    <form method="post" action="{{route('category.store')}}">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" type="text" class="form-control {{ $errors->has('title') ? 'error' : '' }}" id="title" placeholder="Category title" require>
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" id="status">
            <option value="1">Active</option>
            <option value="2">In Active</option>
            </select>
        </div>
        <a class="btn btn-primary" href="{{ route('category.index') }}" role="button">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>



@endsection