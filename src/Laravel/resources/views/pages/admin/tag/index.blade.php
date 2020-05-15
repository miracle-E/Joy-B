@extends('layouts.default') @section('content')
<style>
    .content-body {
        margin: 0px !important;
    }

</style>
<div class="kt-pagetitle">
    <h5>Tags</h5>
</div>
<!-- kt-pagetitle -->

<div class="kt-pagebody">
    @if(isset($success))
        <script>
            document.addEventListener("DOMContentLoaded", event => {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "{{ $success }}",
                    showConfirmButton: false,
                    timer: 2500
                });
            });
        </script>
        @endif
        @if(isset($error))
        <script>
            document.addEventListener("DOMContentLoaded", event => {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "{{$error}}",
                    showConfirmButton: false,
                    timer: 2500
                });
            });
        </script>
        @endif

    <div class="content-wrapper">
        <!-- content-left -->
        <div class="content-body">
            <div class="btn-group mg-b-20" role="group" aria-label="Basic example">
                <a
                    type="button"
                    href="/admin/tag/create"
                    class="btn btn-secondary pd-x-25 active"
                >
                    Add New  <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            </div>

            <!-- content-body-header -->
            <table class="table table-striped mg-b-0 mg-t-20">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="hidden-xs-down">Modified</th>
                        <th class="hidden-xs-down">Contents Count</th>
                        <th class="hidden-xs-down">Subjects</th>
                        <th class="wd-5p"></th>
                    </tr>
                </thead>
                <tbody id="cat-tb-bdy">
                    @foreach($tags as $item)

                    <tr id="{{$item->name}}-category">

                        <td>
                            <i class="fa fa-file-o tx-22 tx-danger lh-0 valign-middle"></i>
                            <span class="pd-l-5">{{ $item->label }}</span>

                        </td>
                        <td class="hidden-xs-down">{{ $item->created_at }}</td>
                        <td class="hidden-xs-down">{{ $item->contents ? count($item->contents) : 0 }}</td>
                        <td class="hidden-xs-down">{{ $item->subjects ? count($item->subjects) : 0 }}</td>

                        <td class="dropdown">
                            <a href="#" data-toggle="dropdown" class="btn pd-y-3 tx-gray-500 hover-info"><i class="icon ion-more"></i></a>
                            <div class="dropdown-menu dropdown-menu-right pd-10">
                                <nav class="nav nav-style-1 flex-column">

                                    <a href="/admin/tag/{{ $item->id }}/edit" class="nav-link">Edit</a>

                                    <a href="/admin/tag/{{ $item->id }}/delete" class="nav-link">Delete</a>

                                </nav>
                            </div>
                            <!-- dropdown-menu -->
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- content-body -->
    </div>
    <!-- content-wrapper -->
</div>
<!-- kt-pagebody -->
<style>
 tr:hover, td:hover{
    background-color: #444;
    color: white !important;
}

a {
    text-transform: none;
    text-decoration: none;
}
</style>
@stop
