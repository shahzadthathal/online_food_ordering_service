@extends('layouts.app')

@section('content')

<div class="col-md-9">
    <h2>Add Menu Item</h2>

    <form method="post" action="{{route('menuitems.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="menu_id" class="col-form-label">Menu</label>
            <select id="menu_id" name="menu_id" class="form-control" required>
            @foreach($menus as $item)
                <option value="{{$item->id}}">{{$item->title}}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="menu_id" class="col-form-label">Menu Item Categories</label>
            <select id="categories" name="categories[]" class="form-control wide" multiple required>
            @foreach($categories as $item)
                <option value="{{$item->id}}">{{$item->title}}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" type="text" class="form-control {{ $errors->has('title') ? 'error' : '' }}" id="title" placeholder="Menu item title" require>
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input name="image" type="file" class="form-control {{ $errors->has('image') ? 'error' : '' }}" id="image" require>
            @if ($errors->has('image'))
                <span class="text-danger">{{ $errors->first('image') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" id="status">
            <option value="1">Active</option>
            <option value="2">In Active</option>
            </select>
        </div>
        <a class="btn btn-primary" href="{{ route('menuitems.index') }}" role="button">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
        
    </form>

</div>



@endsection