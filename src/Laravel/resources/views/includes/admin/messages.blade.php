@if(count($errors) > 0)
@foreach ($errors->all() as $error)
<script>
    $(function () {
        $.growl.error({ title: "Error", message: "{{$error}}" });
        $.growl({ title: "Error", message: "{{ $error }}!" });
    });
</script>
@endforeach
@endif

@if ($errors->any())
@foreach ($errors->all() as $error)
<script>
    $(function () {
        $.growl.error({ title: "Error", message: "{{$error}}" });
        $.growl({ title: "Error", message: "{{ $error }}!" });
    });
</script>
@endforeach
@endif

@if(session('success'))
<script>
    $(function () {
        $.growl.notice({ title: "Notice", message: "{{session('success')}}" });
    });
</script>
@endif

@if(session('error'))
<script>
    $(function () {
        $.growl.error({ title: "Error", message: "{{session('error')}}" });
    });
</script>
@endif
