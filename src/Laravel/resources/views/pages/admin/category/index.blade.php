@extends('layouts.admin')
@section('content')
<style>
    .content-body {
        margin: 0px !important;
    }
</style>
<div class="kt-pagetitle">
    <h5>Content Categories</h5>
</div>
<!-- kt-pagetitle -->

<div class="kt-pagebody">
    <div class="card pd-20 pd-sm-40 mg-t-10">
        <p class="mg-b-20 mg-sm-b-30">Add Organize categories for subjects and contents</p>
        <div class="btn-group mg-b-20" role="group" aria-label="Basic example">
            <a
                type="button"
                href="/admin/category/create"
                class="btn btn-secondary pd-x-25 active"
            >
                Add New  <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </div>
        <div class="row">

          @foreach($categories as $item)
          <div class="col-md-6 mg-t-30 mg-b-20 mg-t-20">
            <div class="card bd-0">
              <div class="card-header card-header-default bg-info justify-content-between">
                <h6 class="mg-b-0 tx-14 tx-white tx-normal">{{ $item->label }}</h6>
                <div class="card-option tx-24">
                    <a href="/admin/category/{{$item->id}}/edit" class="tx-white-8 hover-white mg-l-10"><i class="fa fa-pencil lh-0"></i></a>
                  <a href="/admin/category/{{$item->id}}/delete" class="tx-white-8 hover-white mg-l-10"><i class="fa fa-times lh-0"></i></a>
                  {{-- <a href="#" class="tx-white-8 hover-white mg-l-10"><i class="icon ion-android-more-vertical lh-0"></i></a> --}}
                </div><!-- card-option -->
              </div><!-- card-header -->
              <div class="card-body bg-gray-200">
                <p class="mg-b-0">
                    {{ $item->description ? $item->description : $item->label . ' Category' }}
                    <ul class="list-unstyled">
                        <li>
                            <strong>Subjects: </strong>
                            {{ $item->subjects ? count($item->subjects) : '0' }}
                        </li>
                        <li>
                            <strong>Contents: </strong>
                            {{ $item->contents ? count($item->contents) : '0' }}
                        </li>
                    </ul>
                </p>
              </div><!-- card-body -->
              {{-- <div class="card-footer bg-gray-300 d-flex justify-content-between">
                <a href="/admin/category/{{$item->id}}" class="btn btn-info">View</a>
              </div> --}}
            </div><!-- card -->
          </div>
          @endforeach


        </div><!-- row -->
      </div>
</div>
<!-- kt-pagebody -->
<script>
    // document.addEventListener("DOMContentLoaded", event => {
    //     window.API.loadCategories().then(r => {
    //         for (var i = 0; i < r.length; i++) {
    //             $("#cat-tb-bdy").append(
    //                 `<tr id="${r[i]["name"]}-category">
    //                     <td>
    //                         <i
    //                             class="fa fa-file-o tx-22 tx-danger lh-0 valign-middle"
    //                         ></i>
    //                         <span class="pd-l-5">${r[i]["label"]}</span>
    //                     </td>
    //                     <td class="hidden-xs-down">${r[i]["created_at"]}</td>
    //                     <td class="dropdown">
    //                         <a
    //                             href="#"
    //                             data-toggle="dropdown"
    //                             class="btn pd-y-3 tx-gray-500 hover-info"
    //                             ><i class="icon ion-more"></i
    //                         ></a>
    //                         <div
    //                             class="dropdown-menu dropdown-menu-right pd-10"
    //                         >
    //                             <nav class="nav nav-style-1 flex-column">
    //                                 <a
    //                                     href="/admin/content-category/${r[i]["name"]}"
    //                                     class="nav-link"
    //                                     >Info</a
    //                                 >
    //                                 <a
    //                                     href="/admin/content-category/${r[i]["name"]}/edit"
    //                                     class="nav-link"
    //                                     >Rename</a
    //                                 >
    //                                 <a
    //                                     href="/admin/content-category/${r[i]["name"]}"
    //                                     class="nav-link"
    //                                     >Delete</a
    //                                 >
    //                             </nav>
    //                         </div>
    //                         <!-- dropdown-menu -->
    //                     </td>
    //                 </tr>`
    //                 );
    //         }
    //     });
    // });
</script>
<style>
a {
    text-transform: none;
    text-decoration: none;
    cursor: pointer;
}
</style>
@stop
