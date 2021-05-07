@extends('layouts.app')

@section('content')

<div class="col-md-10">
    <h2>Update Menu</h2>

    <form method="POST" action="{{ route('menus.update',$record->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input value="{{ $record->title }}"  name="title" type="text" class="form-control {{ $errors->has('title') ? 'error' : '' }}" id="title" placeholder="Menu name" require>
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" id="status">
                <option value="1" {{$record->status == 1 ? 'selected' : ''}}>Active</option>
                <option value="2" {{$record->status == 2 ? 'selected' : ''}}>In Active</option>
            </select>
        </div>
        <a class="btn btn-primary" href="{{ route('menus.index') }}" role="button">Cancel</a>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>



@endsection