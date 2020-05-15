@extends('layouts.default') @section('content')
<div class="kt-pagetitle">
    <h5>New Tag</h5>
</div>
<!-- kt-pagetitle -->

<div class="kt-pagebody">
    <form id="tag-form" action="{{ route('new-tag') }}" method="POST">
        @csrf
        @if(isset($success))
        <script>
            document.addEventListener("DOMContentLoaded", event => {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Your tag has been saved",
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
                                >Tag Name:
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
                                name=""
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
