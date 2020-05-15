@extends('layouts.default') @section('content')
<div class="kt-pagetitle">
    <h5>Edit Subject</h5>
</div>
<!-- kt-pagetitle -->

<div class="kt-pagebody">
    <form id="subject-form" action="{{ route('edit-subject-form') }}" method="PUT">
        @csrf
        @if(isset($success))
        <script>
            Swal.fire({
                position: "top-end"
                , icon: "success"
                , title: "{{$success}}"
                , showConfirmButton: false
                , timer: 1500
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
                            <label class="form-control-label">Subject Title:
                                <span class="tx-danger">*</span></label>
                            <input value="{{ $subject->id }}" id="id" name="id" required type="hidden">
                            <input value="{{ $subject->label }}" class="form-control " data-placeholder="Title" aria-hidden="true" id="label" name="label" required type="text" name="">

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
                                <option value="{{ $item->name }}" {{ $subject->category == $item->id ? 'selected' : '' }}>{{ $item->label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Access Type:
                                <span class="tx-danger">*</span></label>
                            <select class="form-control select2 select2-hidden-accessible" data-placeholder="Select access type" aria-hidden="true" id="content_access" name="content_access" required>
                                <option label="Select access type" disabled>Select access type</option>
                                @foreach($accesses as $item)
                                <option value="{{ $item->name }}" {{ $subject->access == $item->id ? 'selected' : '' }}>{{ $item->label}}</option>
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
                                value="{{ $subject->rating }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-12 mg-t-20">
                        <div class="form-group mg-b-10-force mgt-t-20">
                            <button class="btn btn-default mg-r-5" type="submit" id="submit-btn">
                                Save
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
