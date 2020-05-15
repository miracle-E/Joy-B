@extends('layouts.default') @section('content')
<div class="kt-pagetitle">
    <h5>Content Editor</h5>
</div>
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
    <form
        id="content-form"
        action=action="{{ route('edit-content',$content->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >
    @csrf
    @method('PUT')
        <div class="card pd-20 pd-sm-40">
            <p class="mg-b-20 mg-sm-b-30">
                <span style="color:red;">*</span> Marked fields are required.
            </p>
            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label"
                                >Content Type:
                                <span class="tx-danger">*</span></label
                            >
                            <select
                                class="form-control select2 select2-hidden-accessible"
                                data-placeholder="Select Content Type"
                               id="content_type"
                                name="content_type"
                                required
                            >
                                <option
                                    label="Select Content Type"
                                    disabled
                                ></option>
                                @foreach($content_types as $item)
                                <option value="{{ $item->name }}" {{ $content->content_type == $item->name ? 'selected' : '' }}>{{ $item->label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Category:
                                <span class="tx-danger">*</span></label>
                            <select class="form-control select2 select2-hidden-accessible" data-placeholder="Select Content Type" aria-hidden="true" id="category" name="category" required>
                                <option label="Select Category" disabled >Select Category</option>
                                @foreach($categories as $item)
                                <option value="{{ $item->name }}" {{ $content->category == $item->name ? 'selected' : '' }}>{{ $item->label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label"
                                >Content Access:
                                <span class="tx-danger">*</span></label
                            >
                            <select
                                class="form-control select2 select2-hidden-accessible"
                                data-placeholder="Select access type"
                                id="content_access"
                                name="content_access"
                                value="{{ $content->content_access }}"
                                required
                            >
                                <option
                                    label="Select access type"
                                    disabled
                                ></option>
                                @foreach($accesses as $item)
                                <option value="{{ $item->name }}" {{ $content->content_access == $item->name ? 'selected' : '' }}>{{ $item->label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- col-4 -->
                </div>
                <!-- row -->
            </div>
        </div>
        <!-- card -->

        <div class="card pd-20 pd-sm-40 mg-t-10">
            
            <!-- col-4 -->
            <div class="col-lg-6">
                <div class="form-group mg-b-10-force">
                    <label class="form-control-label"
                        >Subject:
                        <span class="tx-danger">*</span></label
                    >
                    <select
                        class="form-control select2 select2-hidden-accessible"
                        data-placeholder="Select Content Type"
                        aria-hidden="true"
                        id="subject_id"
                        name="subject_id"
                        required
                    >
                        <option label="Select Subject" disabled
                            >Select Subject</option
                        >
                        @foreach($subjects as $item)
                        <option
                            value="{{ $item->id }}"
                            >{{ $item->label}}</option
                        >
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group mg-b-10-force">
                    <label class="form-control-label"
                        >Title: <span class="tx-danger">*</span></label>
                    <input
                        class="form-control select2 select2-hidden-accessible"
                        type="text"
                        name="title"
                        id="title"
                        name="title"
                        value="{{ $content->title }}"
                        placeholder="Resolved Issues At Creating New Display Board"
                        required
                    />
                </div>
            </div>
            <br />
            <div id="editor_box">
                <div class="col-lg-12">
                    <div class="form-group mg-b-10-force">
                        <!-- col-12 -->
                        <label class="form-control-label">
                            Body: <span class="tx-danger">*</span>
                        </label>

                        <!-- The toolbar will be rendered in this container. -->
                        <div id="toolbar-container"></div>

                        <!-- This container will become the editable. -->
                        <div
                            id="editor"
                            style="height: 300px; border: 1px solid rgba(68, 68, 68, 0.26);"
                        >
                            {!! $content->body !!}
                        </div>
                        <textarea
                            rows="3"
                            class="hidden form-control select2 select2-hidden-accessible"
                            name="body"
                            id="body"
                            value="{!! $content->body !!}"
                            style="height: 300px; width: 100%; border: 1px solid rgba(68, 68, 68, 0.26);"
                        ></textarea
                        >
                    </div>
                </div>

                <script>
                    DecoupledEditor.create(document.querySelector("#editor"))
                        .then(editor => {
                            const toolbarContainer = document.querySelector(
                                "#toolbar-container"
                            );

                            toolbarContainer.appendChild(
                                editor.ui.view.toolbar.element
                            );
                        })
                        .catch(error => {
                            console.error(error);
                        });
                </script>
            </div>
        </div>
        <!-- card -->

        <div class="card pd-20 pd-sm-40 mg-t-10">
            <div class="form-layout">
                <div class="row mg-b-25">
                    <!-- col-4 -->
                    <div class="col-lg-6">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label"
                                >Video: <span class="tx-danger">*</span></label
                            >
                            <!-- <label class="custom-file"> -->
                            <input
                                type="file"
                                id="media"
                                name="media"
                                class="form-control select2 select2-hidden-accessible"
                            />
                            <!-- <span class="custom-file-control"></span> -->
                            <!-- </label> -->
                        </div>
                    </div>
                    <!-- col-4 -->
                    <div class="col-lg-6">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label"
                                >Thumbnail: <span class="tx-danger">*</span></label
                            >
                            <!-- <label class="custom-file"> -->
                            <input
                                type="file"
                                id="thumbnail"
                                name="thumbnail"
                                class="form-control select2 select2-hidden-accessible"
                            />
                            <!-- <span class="custom-file-control"></span> -->
                            <!-- </label> -->
                        </div>
                    </div>
                    <!-- col-4 -->
                    <div class="col-lg-6">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Rating: </label>
                            <input
                                class="form-control select2 select2-hidden-accessible"
                                type="number"
                                max="5"
                                min="1"
                                placeholder="1"
                                name="rating"
                                id="rating"
                                aria-hidden="true"
                                value="{{ $content->rating }}"
                            />
                        </div>
                    </div>
                    <!-- col-4 -->
                    <div class="col-lg-6">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label"
                                >Publish Date:
                            </label>
                            <input
                                type="datetime-local"
                                class="form-control"
                                placeholder="MM/DD/YYYY"
                                id="publish_date"
                                name="published_date"
                                value="{{ $content->created_at}}"
                                required
                            />
                        </div>
                    </div>
                    <!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <!-- <label class="form-control-label"
                            >Publish: <span class="tx-danger">*</span></label
                        > -->
                            <label class="ckbox">
                                <input
                                    type="checkbox"
                                    checked
                                    id="publish"
                                    name="publish"
                                    value="{{ $content->is_published}}"
                                />
                                <span>Publish Content</span>
                            </label>
                        </div>
                    </div>
                    <!-- col-4 -->
                </div>
                <!-- row -->

                <div class="form-layout-footer">
                    <button
                        class="btn btn-default mg-r-5"
                        type="submit"
                        id="submit-btn"
                    >
                        Submit Form
                    </button>
                    <button class="btn btn-secondary" type="reset">
                        Cancel
                    </button>
                </div>
                <!-- form-layout-footer -->
            </div>
        </div>
        <!-- card -->
    </form>
</div>
<!-- <script src="{{ asset('lib/medium-editor/medium-editor.js') }}"></script> -->
<script src="{{ asset('js/axios.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", event => {
        let category_field = document.getElementById("category");
        let title_field = document.getElementById("title");
        let content_type_field = document.getElementById("content_type");
        let access_type_field = document.getElementById("content_access");
        let editor_box = document.getElementById("editor_box");
        let publish_date_field = document.getElementById("publish_date");
        let publish_field = document.getElementById("publish");
        let rating_field = document.getElementById("rating");
        let editor = document.getElementById("editor");
        let body = document.getElementById("body");
        let media_field = document.getElementById("media");
        let submit_btn = document.getElementById("submit-btn");
        let content_form = document.getElementById("content-form");
        let file = null;

        // // media_field.addEventListener("click", e => {
        //     // console.log("image E :" + e);
        //     media_field.onchange = (e) => {
        //         console.log(e.target.files[0]);
        //         file = e.target.files[0];
        //         // var reader = new FileReader();
        //         // reader.readAsDataURL(media_field.files[0]);
        //         // console.log("image" + image);
        //         // file = image;
        //     };
        // // });

        editor.addEventListener("keydown", e =>{
            // console.log("NOTE : " + editor.innerHTML);

            body.value = editor.innerHTML;
        });

        content_form.addEventListener("submit", e => {
            // e.preventDefault();

            // submit();
        });

        async function submit() {
            let title = title_field.value;
            let category = category_field.value;
            let media = media_field;
            let published_date = publish_date_field.value;
            let is_published = publish_field.value;
            let content_type = content_type_field.value;
            let rating = rating_field.value;
            let content_access = access_type_field.value;
            let body = editor.innerHTML;

            // console.log("DSLSMFSD : " + body);

            let form_data = new FormData();
            form_data.append("title", title);
            form_data.append("content_type", content_type);
            form_data.append("content_access", content_access);
            form_data.append("category", category);
            form_data.append("body", body);
            form_data.append("media", media);
            form_data.append("publish_date", published_date);
            form_data.append("is_published", is_published ? 1 : 0);

            console.log(media.value);
            let data = {
                title: title,
                content_type: content_type,
                content_access: content_access,
                category: category,
                body: body,
                media: file,
                publish_date: published_date,
                is_published: is_published ? 1 : 0
            };

            console.log(JSON.stringify(data));

            // send AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/api/v1/admin/contents");
            xhr.setRequestHeader("Authorization", `Bearer ${window.API.jwt}`);
            // xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader(
                "Content-Type",
                "application/x-www-form-urlencoded"
            );
            // xhr.setRequestHeader("Content-Type", "application/my-binary-type");
            xhr.send(form_data);
            return;

            window.API.postJson("/api/v1/admin/contents", data)
                .then(r => {
                    console.log("Posted : " + r);
                })
                .catch(e => {
                    console.error("Failed loading resources..." + e);
                });
        }

        content_type_field.addEventListener("change", () => {
            if (content_type_field.value == "text") {
                editor_box.style = "display: inline;";
            } else if (content_type_field.value == "video") {
                editor_box.style = "display: none;";
            }
        });

        window.API.loadCategories().then(r => {
            for (var i = 0; i < r.length; i++) {
                $(category_field).append(
                    `<option value= ${r[i]["name"]} > ${r[i]["label"]} </option>`
                );
            }
        });

        window.API.loadContentTypes().then(r => {
            for (var i = 0; i < r.length; i++) {
                $(content_type_field).append(
                    `<option value= ${r[i]["name"]} > ${r[i]["label"]} </option>`
                );
            }
        });
        window.API.loadAccessTypes().then(r => {
            for (var i = 0; i < r.length; i++) {
                $(access_type_field).append(
                    `<option value= ${r[i]["name"]} > ${r[i]["label"]} </option>`
                );
            }
        });
    });
</script>
@stop
