@extends('layouts.default') @section('content')
<div class="kt-pagetitle">
    <h5>New Subject</h5>
</div>
<!-- kt-pagetitle -->

<div class="kt-pagebody">
    <form id="subject-form" action="{{ route('new-subject') }}" method="POST">
        @csrf
        @if(isset($success))
        <script>
            document.addEventListener("DOMContentLoaded", event => {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Your subject has been saved",
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
        <div class="card pd-20 pd-sm-40">
            <p class="mg-b-20 mg-sm-b-30">
                <span style="color:red;">*</span> Marked fields are required.
            </p>
            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-12">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label"
                                >Subject Title:
                                <span class="tx-danger">*</span></label
                            >
                            <input
                                class="form-control "
                                data-placeholder="Title"
                                aria-hidden="true"
                                id="label"
                                name="label"
                                required
                                type="text"
                            />
                        </div>
                    </div>
                    <!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label"
                                >Category:
                                <span class="tx-danger">*</span></label
                            >
                            <select
                                class="form-control select2 select2-hidden-accessible"
                                data-placeholder="Select Content Type"
                                aria-hidden="true"
                                id="category"
                                name="category"
                                required
                            >
                                <option
                                    label="Select Category"
                                    disabled
                                    selected
                                    >Select Category</option
                                >
                                @foreach($categories as $item)
                                <option
                                    value="{{ $item->name }}"
                                    >{{ $item->label}}</option
                                >
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- col-4 -->
                    {{--
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label"
                                >Sub-Category:
                                <span class="tx-danger">*</span></label
                            >
                            <select
                                class="form-control select2 select2-hidden-accessible"
                                data-placeholder="Select Sub-Category"
                                aria-hidden="true"
                                id="sub_category"
                                name="sub_category"
                                required
                            >
                                <option
                                    label="Select Category"
                                    disabled
                                    selected
                                    >Select Sub-Category</option
                                >
                                @foreach($sub_categories as $item)
                                <option
                                    value="{{ $item->name }}"
                                    >{{ $item->label}}</option
                                >
                                @endforeach
                            </select>
                        </div>
                    </div>
                    --}}
                    <!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label"
                                >Access Type:
                                <span class="tx-danger">*</span></label
                            >
                            <select
                                class="form-control select2 select2-hidden-accessible"
                                data-placeholder="Select access type"
                                aria-hidden="true"
                                id="access"
                                name="access"
                                required
                            >
                                <option
                                    label="Select access type"
                                    disabled
                                    selected
                                    >Select access type</option
                                >
                                @foreach($accesses as $item)
                                <option
                                    value="{{ $item->name }}"
                                    >{{ $item->label}}</option
                                >
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label"
                                >Rating: <span class="tx-danger">*</span></label
                            >
                            <input
                                type="number"
                                max="10"
                                min="0"
                                class="form-control select2-hidden-accessible"
                                aria-hidden="true"
                                id="rating"
                                name="rating"
                                required
                            />
                        </div>
                    </div>
                    <!-- col-4 -->

                    <div class="col-12">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">
                                Tags:
                                <span class="text-info">each tag name should be separated with a ","</span>
                            </label>
                            <input
                                class="form-control "
                                data-placeholder="Title"
                                aria-hidden="true"
                                id="tags"
                                name="tags"
                            />
                        </div>
                    </div>
                    <!-- col-4 -->

                    <div class="col-lg-12 mg-t-20">
                        <div class="form-group mg-b-10-force mgt-t-20">
                            <button class="btn btn-default mg-r-5" type="submit" id="submit-btn">
                                Submit
                            </button>
                            <button class="btn btn-secondary" type="reset">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
                <!-- row -->
            </div>
        </div>
        <!-- card -->
    </form>
</div>
<!-- <script src="{{ asset('lib/medium-editor/medium-editor.js') }}"></script> -->
<script src="{{ asset('js/axios.min.js') }}"></script>

@stop
