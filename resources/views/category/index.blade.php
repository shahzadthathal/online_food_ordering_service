@extends('layouts.app')

@section('content')

<div class="col-md-10">
    <h2>Manage Categories</h2>
    <a class="btn btn-primary mb-2" href="{{ route('category.create') }}" role="button">Add Menu Item Category</a>
    
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
    @endif

    <table class="table table-hover bg-white">
        <thead>
            <tr>
            <th scope="col">@sortablelink('id')</th>
                <th scope="col">@sortablelink('title')</th>
                <th scope="col">@sortablelink('status')</th>
                <th scope="col">@sortablelink('created_at')</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
                <tr>
                    <th scope="row">{{ $record->id }}</th>
                    <td>{{ $record->title }}</td>
                    <td>{{ $record->status == 1 ? 'Active' :"In Active" }}</td>
                    <td>{{ $record->created_at }}</td>
                    <td>
                        <div class="d-flex flex-row">
                            <a class="btn btn-warning btn-sm mr-2" href="{{ route('category.show',$record->id) }}" role="button">Detail</a>
                            <a class="btn btn-dark btn-sm mr-2" href="{{ route('category.edit',$record->id) }}" role="button">Edit</a>
                            <form style="display:inline-block" id="form_{{$record->id}}" action="{{ route('category.destroy',$record->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="deleteItem(`{{$record->id}}`)" type="button" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $records->links() }}

</div>


@section('footerjs')

<script>

function deleteItem(id){
    if(confirm("Are you sure to perform this action")){
        $("#form_"+id).submit()
    }else{
        return false
    }
}

</script>
@endsection


@endsection