@extends('layouts.admin')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div><br />
@endif
<div class="mdl-grid" style="margin-top:15px;">
    <div class="mdl-cell shadow mdl-cell--12-col mdl-cell--12-col-phone mdl-cell--12-col-tablet"
        style="background: white;">
        <div class="panel-header">
            Edit Product
        </div>
        <div class="panel-body forms">
            <form method="post" action="{{ route('products.update', $product->id) }}"  enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="mdl-textfield mdl-js-textfield textfield-demo">
                    <input class="mdl-textfield__input" type="text" id="sample1" name="name"
                        value={{ $product->name }} />
                    <label class="mdl-textfield__label" for="sample1">Text...</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield textfield-demo">
                    <input class="mdl-textfield__input" type="text" value={{ $product->price }}
                        pattern="-?[0-9]*(\.[0-9]+)?" name="price" required id="price" />
                    <label class="mdl-textfield__label" for="price">Price</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield textfield-demo">
                <img src="{{ $product->image }}" alt="{{ $product->name }}">
                    <input class="mdl-textfield__input" type="file" name="image"
                        id="image" />
                    <label class="mdl-textfield__label" for="image"></label>
                </div>
                <div class="mdl-textfield mdl-js-textfield textfield-demo">
                    <textarea class="mdl-textfield__input" type="text" name="description"
                        value={{ $product->description }} rows="4"
                        id="description">{{ $product->description }}</textarea>
                    <label class="mdl-textfield__label" for="sample5">Describe product here...</label>
                </div>

                <div class="mdl-textfield mdl-js-textfield textfield-demo">
                    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="option-1">
                    <input type="checkbox" id="option-1" class="mdl-checkbox__button" name="is_available" value="1" checked="{{ $product->is_available == (1||true) ? true : false }}" />
                        <span class="mdl-checkbox__label">Available</span>
                    </label>
                </div>

                <button type="submit"
                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                    Submit
                </button>
            </form>

        </div>
    </div>
    @endsection
