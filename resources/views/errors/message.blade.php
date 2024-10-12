@if (session('success'))
    <div class="alert alert-primary alert-dismissible fade show mt-2" role="alert">
        <ul>
            <li>
                <i class="fa fa-check-circle-o me-2" aria-hidden="true"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </li>
        </ul>
    </div>
@endif
@if (session('status'))
    <div class="alert alert-primary alert-dismissible fade show mt-2" role="alert">
        <i class="fa fa-check-circle-o me-2" aria-hidden="true"></i> {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        <i class="fa fa-frown-o me-2" aria-hidden="true"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
@endif
{{--@if ($errors->any())--}}
{{--    <div class="alert">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>--}}
{{--                    <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--                        <i class="fa fa-frown-o me-2" aria-hidden="true"></i>{{ $error }}--}}
{{--                        <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close">--}}
{{--                            <span aria-hidden="true" style="margin-left: 25px">×</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li> <i class="fa fa-frown-o me-4" aria-hidden="true">{{ $error }}</i>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true" >×</span></button>
                </li>
            @endforeach
        </ul>
    </div>
@endif
