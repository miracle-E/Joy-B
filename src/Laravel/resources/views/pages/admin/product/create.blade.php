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
    <div class="mdl-cell shadow mdl-cell--9-col mdl-cell--12-col-phone mdl-cell--12-col-tablet" style="background: white;">
        <div class="panel-header">
            Add Product
        </div>
        <div class="panel-body forms">
            <form  method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mdl-textfield mdl-js-textfield textfield-demo">
                    <input class="mdl-textfield__input" type="text" name="name" required id="name" />
                    <label class="mdl-textfield__label" for="name">Name</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield textfield-demo">
                    <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="price" required id="price" />
                    <label class="mdl-textfield__label" for="price">Price</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield textfield-demo">
                    <input class="mdl-textfield__input" type="file" name="image" required id="image" />
                    <label class="mdl-textfield__label" for="image">Image</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield textfield-demo">
                    <textarea class="mdl-textfield__input" type="text" name="description" required rows= "4" id="description"></textarea>
                    <label class="mdl-textfield__label" for="sample5">Describe product here...</label>
                </div>
                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                    Submit
                </button>
            </form>

        </div>
    </div>
@endsection
