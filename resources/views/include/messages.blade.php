
@if(session()->has('success'))
<div class="alert text-white bg-primary" role="alert">
    <div class="iq-alert-text">{{session()->get('success')}}</div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <i class="ri-close-line"></i>
    </button>
</div>
@endif


@if(session()->has('error'))
<div class="alert text-white bg-danger" role="alert">
    <div class="iq-alert-text">{!! session()->get('error') !!}</div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <i class="ri-close-line"></i>
    </button>
</div>
@endif

@if($errors->any())
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="alert-2 alert-danger" role="alert">
                @foreach($errors->all() as $error)
                    <li class="p-2">{{$error}}</li>
                @endforeach
            </div>
        </div>
    </div>
@endif


