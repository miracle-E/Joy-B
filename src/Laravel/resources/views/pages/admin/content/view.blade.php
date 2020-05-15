@extends('layouts.default') @section('content')
<div class="kt-pagetitle">
    <h5>Content Editor</h5>
</div>
<script src="https://cdn.plyr.io/3.5.10/plyr.js"></script>
<link rel="stylesheet" href="https://cdn.plyr.io/3.5.10/plyr.css" />



<!-- kt-pagetitle -->

<div class="kt-pagebody">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    @if ($content->contentType["name"] === 'video')
    <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">{{ $content->title }}</h6>
        <p class="mg-b-20 mg-sm-b-30">
            Created {{ $content->created_at }}
        </p>
        <div class="row tx-roboto">
            <dt class="col-sm-3 tx-inverse">Category</dt>
            <dd class="col-sm-9">{{ $content->contentCategory['name'] }}</dd>
            <dt class="col-sm-3 tx-inverse">Subject</dt>
            <dd class="col-sm-9">{{ $content->subject['label'] }}</dd>
            <dt class="col-sm-3 tx-inverse">Rating</dt>
            <dd class="col-sm-9">{{ $content->rating }}</dd>
            <!-- <dt class="col-sm-3 tx-inverse">Position</dt>
            <dd class="col-sm-9">{{ $content->position ? $content->position : '-' }}</dd> -->
            <!-- <dt class="col-sm-3 tx-inverse">Topic</dt>
            <dd class="col-sm-9">{{ $content->topic ? $content->topic : '-' }}</dd> -->
            <dt class="col-sm-3 tx-inverse">Status</dt>
            <dd class="col-sm-9">{{ $content->is_published ? 'Published' : 'Not Published' }}</dd>
            <dt class="col-sm-3 tx-inverse">Publish Date</dt>
            <dd class="col-sm-9">{{ $content->published_date ? $content->published_date : '-' }}</dd>

            <hr class="hr-primary">

            <div class="col-sm-4">
                <span class="tx-uppercase tx-12 tx-medium d-block mg-b-15">Media Content</span>


                <div class="display-1 pd-10 mt-4 bg-gray-200 tx-inverse tx-center mg-b-15">
                    <img src="{{ $content->media ? $content->media->thumbnail : null }}" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">

                </div>
                <span class="tx-uppercase tx-medium tx-12 d-block mg-b-15">Thumbnail</span>

            </div><!-- col-4 -->
            <div class="col-sm offset-sm-1">
                <div style="text-align:center">
                    <br><br>
                    @if($content->media)
                        @if($content->media->url)
                            <iframe src="{{$content->media->url}}" frameborder="0" style="width:100%; hieght: 265px;" poster="{{$content->media->thumbnail}}" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @endif
                    @endif


                </div>
                <span class="tx-uppercase tx-medium tx-12 d-block mg-b-15">Uploaded file</span>

            </div>
        </div><!-- row -->

        <div class="btn-group mg-b-20 mg-t-20" role="group" aria-label="Basic example">
            <a
                type="button"
                href="/admin/content/{{ $content->id }}/edit"
                class="btn btn-secondary pd-x-25 active"
            >
                Edit <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
            <a
                type="button"
                href="/admin/content/{{ $content->id }}/delete"
                class="btn btn-danger pd-x-25 active"
            >
                Delete <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    @endif


    @if ($content->contentType["name"] === 'text')
    <div class="card pd-20 pd-sm-40 mg-t-25">
        <h6 class="card-body-title">{{ $content->title }}</h6>
        <p class="mg-b-20 mg-sm-b-30">
            Created {{ $content->created_at }}
        </p>

        <dl class="row">
            <dt class="col-sm-3 tx-inverse">Category</dt>
            <dd class="col-sm-9">{{ $content->contentCategory['name'] }}</dd>
            <dt class="col-sm-3 tx-inverse">Subject</dt>
            <dd class="col-sm-9">{{ $content->subject['label'] }}</dd>
            <dt class="col-sm-3 tx-inverse">Rating</dt>
            <dd class="col-sm-9">{{ $content->rating }}</dd>
            <!-- <dt class="col-sm-3 tx-inverse">Position</dt>
            <dd class="col-sm-9">{{ $content->position ? $content->position : '-' }}</dd>
            <dt class="col-sm-3 tx-inverse">Topic</dt>
            <dd class="col-sm-9">{{ $content->topic ? $content->topic : '-' }}</dd> -->
            <dt class="col-sm-3 tx-inverse">Status</dt>
            <dd class="col-sm-9">{{ $content->is_published ? 'Published' : 'Not Published' }}</dd>
            <dt class="col-sm-3 tx-inverse">Publish Date</dt>
            <dd class="col-sm-9">{{ $content->published_date ? $content->published_date : '-' }}</dd>

        </dl>

        <div class="row mb-20">
            <div class="col-12">
                <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
                    <div class="card">
                        <div class="card-header" role="tab" id="headingTwo">
                            <h6 class="mg-b-0">
                                <a class="transition collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Body
                                </a>
                            </h6>
                        </div>
                        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" style="">
                            <div class="card-body">
                                {!! html_entity_decode($content->body) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="btn-group mg-b-20 mg-t-20" role="group" aria-label="Basic example">
            <a
                type="button"
                href="/admin/content/{{ $content->id }}/edit"
                class="btn btn-secondary pd-x-25 active"
            >
                Edit <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
            <a
                type="button"
                href="/admin/content/{{ $content->id }}/delete"
                class="btn btn-danger pd-x-25 active"
            >
                Delete <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    @endif

    @if(isset($content))
        <!-- <div class="btn-group mg-b-20" role="group" aria-label="Basic example">
            <a
                type="button"
                href="/admin/content/{{ $content->id }}/edit"
                class="btn btn-secondary pd-x-25 active"
            >
                Edit <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
            <a
                type="button"
                href="/admin/content/{{ $content->id }}/delete"
                class="btn btn-danger pd-x-25 active"
            >
                Delete <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
        </div> -->
    @endif

</div>
<!-- <script src="{{ asset('lib/medium-editor/medium-editor.js') }}"></script> -->
<script src="{{ asset('js/axios.min.js') }}"></script>
<style>
    hr {
        border-top: 1px solid #757575;
        opacity: 0.3;
        width: 100%;
        margin: 10px;
    }

</style>

@stop
