@extends('layouts.admin')

@section('content')
@if(session()->get('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div><br />
@endif

<div class="table-container">
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-phone mdl-cell--12-col-tablet">
            <a href="{{ route('products.create')}}"
                class="mdl-button mdl-js-button primary mdl-js-ripple-effect mdl-button--raised"
                style="margin-right: 10px; margin-bottom: 5px;">
                Add New
            </a>
            <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp shadow">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Name</th>
                        <th>Price</th>
                        <th>Available</th>
                        <th>Category</th>
                        <th>Orders</th>
                        <th>Likes</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $item)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">
                            <a href="{{ route('products.show',$item->id)}}" >{{$item->name}}</a>
                        </td>
                        <td>{{$item->price}}</td>
                        <td>
                            {{ ($item->is_available ? 'yes' : 'no') }}
                        </td>
                        <td>
                            @if(isset($item->categories) && count($item->categories))
                                @foreach($item->categories as $category)
                                    {{$category->label}}
                                @endforeach
                            @else
                                None
                            @endif
                        </td>
                        <td>
                            {{ (isset($item->orders) ? count($item->orders) : 'None') }}
                        </td>
                        <td>{{$item->likes }}</td>
                        <td>
                            <a href="{{ route('products.edit',$item->id)}}"
                                class="mdl-button mdl-js-button mdl-button--raised green"
                                style="margin-right: 10px; margin-bottom: 5px;">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('products.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent"
                                    style="margin-right: 10px; margin-bottom: 5px;">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfooter>
                    {{ $products->links() }}
                </tfooter>
            </table>
        </div>
    </div>
</div>
@endsection
