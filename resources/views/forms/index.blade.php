@extends('layouts.app')
<title>ACCOUNT : Forms</title>
@section('content')
<div class="content-box">
    <div class="sub-header">
        Forms
    </div>
    <div class="content-tool mt-3 mb-4">
        <a href="{{ url('form/create') }}">
            <button class="btn-form-danger text-white">
                + Create Form
            </button>
        </a>
    </div>
    @if( session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Form Title</th>
                <th>Form Link</th>
                <th>File</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody style="border-top-width: 0px;">
            @if(!empty($data) && $data->count())
                @foreach($data as $key => $value)
                    <tr>
                        <td>{{ $value->name }}</td>
                        <td>{{ url('public/forms/form_'. $value->path. '.php') }}</td>
                        <td>{{ $value->path. '.json' }}</td>

                        <td>
                            <div class="d-flex">
                                <a target="_blank" href="{{ url('public/forms/form_'. $value->path. '.php') }}"><button
                                        class="btn-form-classic me-2">Preview</button></a>
                                <a href="{{ url('form/edit/'. $value->id) }}"><button
                                        class="btn-form-classic me-2">Edit</button></a>
                                <button class="btn-form-classic" onclick="show(this)">Delete</button>
                            </div>
                            <form method="post" action="{{ route('form.delete') }}">
                                @csrf
                                <input name="path" value="{{ $value->path }}" hidden />
                                <input name="id" value="{{ $value->id }}" hidden />
                                <div class="confirm-delete mt-2" style="display:none">
                                    <button type="submit" class="btn-form-danger text-white me-2">Yes</button>
                                    <button type="button" class="btn-form-primary"
                                        onclick="cancel(this)">Cancel</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">There are no data.</td>
                </tr>
            @endif
        </tbody>
    </table>
    {!! $data->links() !!}
</div>
@endsection

@section('script')
<script>
    function cancel(obj) {
        $(obj).parent().css('display', 'none');
    }

    function show(obj) {
        $('.confirm-delete').css('display', 'none');
        console.log($(obj).parent().parent().find('.confirm-delete')[0].style.display);
        $(obj).parent().parent().find('.confirm-delete')[0].style.display = "flex";
    }

</script>
@endsection
