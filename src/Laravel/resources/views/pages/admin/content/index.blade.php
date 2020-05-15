@extends('layouts.default') @section('content')
<div class="kt-pagetitle">
    <h5>Content Manager</h5>
</div>
<!-- kt-pagetitle -->

<div class="kt-pagebody">
    <div class="card pd-20 pd-sm-40">
        <div class="btn-group mg-b-20" role="group" aria-label="Basic example">
            <a
                type="button"
                href="/admin/content/create"
                class="btn btn-secondary pd-x-25 active"
            >
                Add New  <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="table mg-b-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th class="hidden-xs-down">Modified</th>
                        <th class="wd-5p"></th>
                    </tr>
                </thead>
                <tbody id="content_list">
                    @foreach ($contents as $key => $content)
                        <tr class="content-item">
                            <a href="/admin/content/{{$content->id}}">
                            <td><a href="/admin/content/{{$content->id}}">{{ $content->title ? $content->title : '' }}</a></td>
                            <td>{{ $content->contentCategory ? $content->contentCategory['label'] : '' }}</td>
                            <td>{{ $content->contentType ? $content->contentType['label'] : '' }}</td>
                            <td>{{ $content->created_at ? $content->created_at : '' }}</td>
                            <td></td>
                        </a>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- kt-pagebody -->
<script src="{{ asset('js/axios.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", event => {
        API.loadContents().then(r => {
            for (var i = 0; i < r.length; i++) {
                // console.log("Content : " + JSON.stringify(r));
                // $("#content_list").append(
                //     `<tr id="${r[i]["id"]}-content">
                //         <td>
                //             <span class="pd-l-5">${r[i]["title"].substring(
                //                 0,
                //                 25
                //             )}...</span>
                //         </td>
                //         <td>${r[i]["content_category"]["label"]}</td>
                //         <td>${r[i]["content_type"]["label"]}</td>
                //         <td class="hidden-xs-down">${r[i]["created_at"]}</td>
                //         <td class="dropdown">
                //             <a
                //                 href="#"
                //                 data-toggle="dropdown"
                //                 class="btn pd-y-3 tx-gray-500 hover-info"
                //                 ><i class="icon ion-more"></i
                //             ></a>
                //             <div
                //                 class="dropdown-menu dropdown-menu-right pd-10"
                //             >
                //                 <nav class="nav nav-style-1 flex-column">
                //                     <a href="/admin/content/${
                //                         r[i]["id"]
                //                     }" class="nav-link">View</a>
                //                     <a href="/admin/content/${
                //                         r[i]["id"]
                //                     }/edit" class="nav-link">Edit</a>
                //                     <a href="/admin/content/${
                //                         r[i]["id"]
                //                     }/delete" class="nav-link">Delete</a>
                //                 </nav>
                //             </div>
                //         </td>
                //     </tr>`
                //     // `<option value= ${r[i]["name"]} > ${r[i]["label"]} </option>`
                // );
            }
        });
    });
</script>

<style>
.content-item:hover, .content-item  td:hover{
    background-color: #444;
    color: white !important;
}

a {
    text-transform: none;
    text-decoration: none;
    cursor: pointer;
}
</style>
@stop
