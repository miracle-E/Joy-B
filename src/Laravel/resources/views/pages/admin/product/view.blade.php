@extends('layouts.admin')

@section('content')
@if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
<br />
@endif

<div class="profile-content">
    <div class="cover-photo">
        @if(isset($product))
        <div class="opacity-overlay relative">
            <div class="profile-info absolute">
                <div class="profile-photo">
                <img src="{{ $product->image }}" alt="{{ $product->name }}">
                </div>
                <div class="profile-desc">
                    {{ $product->name }}
                    <br>

                </div>
            </div>
            <div class="numbers absolute">
                <div class="detail">
                    {{ count($product->categories) }}
                    <br>
                    <div class="desc">
                        Categories
                    </div>
                </div>
                <div class="detail">
                    {{ count($product->orders) }}
                    <br>
                    <div class="desc">
                        Orders
                    </div>
                </div>
                <div class="detail">
                    {{ count($product->tags) }}
                    <br>
                    <div class="desc">
                        Tags
                    </div>
                </div>

            </div>
            <div class="buttons absolute">
                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="profile-button">
                    <i class="mdi mdi-settings"></i>Edit
                </button>
                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                for="profile-button">
                <a href="{{ route('products.edit',$product->id)}}"><li class="mdl-menu__item">Edit</li></a>
                <a href="{{ route('products.destroy',$product->id)}}"><li class="mdl-menu__item">Delete</li></a>

            </ul>
        </div>
        @endif
    </div>
</div>
<div class="profile-body">
    @if(isset($product))
    <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
        <div class="mdl-tabs__tab-bar">
        <a href="#starks-panel" class="mdl-tabs__tab is-active">Photos</a>
            <a href="#lannisters-panel" class="mdl-tabs__tab">Info</a>
        </div>
        <div class="mdl-tabs__panel is-active" id="starks-panel">
            <div class="lightbox-container">
                @if (isset($product->images))
                    @foreach ($product->image as $item)
                        <a href="{{ $item }}" data-lightbox="image-1" data-title="{{ $product->name }}"><img class="shadow" src="{{ $item }}" alt="{{ $product->name }}"></a>
                    @endforeach
                @endif
                @if (isset($product->image))
                    <a href="{{ $product->image }}" data-lightbox="image-1" data-title="{{ $product->name }}"><img class="shadow" src="{{ $product->image }}" alt="{{$product->name}}"></a>
                @endif
                <a href="{{ URL::asset('images/portrait3.jpg') }}" data-lightbox="image-1" data-title="My caption"><img class="shadow" src="{{ URL::asset('images/portrait3.jpg') }}" alt=""></a>
                <a href="{{ URL::asset('images/portrait4.jpg') }}" data-lightbox="image-1" data-title="My caption"><img class="shadow" src="{{ URL::asset('images/portrait4.jpg') }}" alt=""></a>
                <a href="{{ URL::asset('images/portrait7.jpg') }}" data-lightbox="image-1" data-title="My caption"><img class="shadow" src="{{ URL::asset('images/portrait7.jpg') }}" alt=""></a>
                <a href="{{ URL::asset('images/portrait9.jpg') }}" data-lightbox="image-1" data-title="My caption"><img class="shadow" src="{{ URL::asset('images/portrait9.jpg') }}" alt=""></a>
            </div>
        </div>
        <div class="mdl-tabs__panel" id="lannisters-panel">
            <div class="info-container">
                <div class="cell">
                    <table class="mdl-data-table mdl-js-data-table shadow">
                        <thead>
                            <tr>
                                <th class="mdl-data-table__cell--non-numeric" colspan="2">Personal <i class="mdi mdi-account left"></i> <i class="mdi mdi-pencil right"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">Name</td>
                                <td class="mdl-data-table__cell--non-numeric">Sankhadeep Roy</td>
                            </tr>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">Address</td>
                                <td class="mdl-data-table__cell--non-numeric">Liverpool, Merseyside</td>
                            </tr>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">Relationship status</td>
                                <td class="mdl-data-table__cell--non-numeric">Single</td>
                            </tr>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">Phone</td>
                                <td class="mdl-data-table__cell--non-numeric">+91 8874122148</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cell">
                    <table class="mdl-data-table mdl-js-data-table shadow">
                        <thead>
                            <tr>
                                <th class="mdl-data-table__cell--non-numeric" colspan="2">Work <i class="mdi mdi-briefcase-check left"></i> <i class="mdi mdi-pencil right"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">Club</td>
                                <td class="mdl-data-table__cell--non-numeric">Liverpool FC</td>
                            </tr>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">Position</td>
                                <td class="mdl-data-table__cell--non-numeric">Centre Forward</td>
                            </tr>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">Wages</td>
                                <td class="mdl-data-table__cell--non-numeric">250k</td>
                            </tr>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">Market Value</td>
                                <td class="mdl-data-table__cell--non-numeric">$32m</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cell">
                    <table class="mdl-data-table mdl-js-data-table shadow">
                        <thead>
                            <tr>
                                <th class="mdl-data-table__cell--non-numeric" colspan="2">Social <i class="mdi mdi-thumb-up-outline left"></i> <i class="mdi mdi-pencil right"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric"><i class="mdi mdi-facebook"></i></td>
                                <td class="mdl-data-table__cell--non-numeric">Sankhadeep Roy</td>
                            </tr>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric"><i class="mdi mdi-twitter"></i></td>
                                <td class="mdl-data-table__cell--non-numeric">Liverpool, Merseyside</td>
                            </tr>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric"><i class="mdi mdi-pinterest"></i></td>
                                <td class="mdl-data-table__cell--non-numeric">Single</td>
                            </tr>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric"><i class="mdi mdi-instagram"></i></td>
                                <td class="mdl-data-table__cell--non-numeric">+91 8874122148</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>


</div>
<style>
.profile-content {
    margin-left: 0px;
}
.profile-content .profile-body {
    background: white;
}
.profile-content div.cover-photo {
    height: 250px;
}
a{
    text-decoration: none;
}
@media screen and (max-width: 839px){
    .page-content {
    padding-left: 25px !important;
}
}

</style>
@endsection
