@extends('auth.auth_header')
@section('content')
<div class="card-body p-4">

    <h4 style="display: flex; justify-content: center; " class="text-dark mb-3 ml-1 mr-1"> API token.</h4>
    <p style="display: flex; justify-content: center; " class="mb-4 ml-1 mr-1">Here is your API token. Please copy it
        and store it in a secure place. We will only be able to show it to you once. To copy please click on the input.
    </p>
    <div class="row ">
        {{-- <div class="form-group col-md-12 mb-4">
                <input type="text" class="form-control input-lg" name="token_name" id="token_name"
                    aria-describedby="Token Name" placeholder="Api Token Name" required>
            </div>

            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">GENERATE</button>
            </div> --}}
        <div class="form-group col-md-12 mb-4 mt-3 ">
            <input class="form-control input-lg" id="api_token" style="display: flex; justify-content: center; "
                value="{{ Session::get('api_token') ?? 'Token will appear here.'}}">

        </div>
        <div class="col-12">
            @if (Session::get('api_token') !== null)
            <a style="display: flex; justify-content: center; " class="text-blue" href="{{route('login')}}">Proceed to
                next</a>
            @endif
        </div>

    </div>
</div>
</div>
</div>
</div>

@endsection


<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>


<script defer>
    window.addEventListener('load', ()=>{
         document.getElementById('api_token').addEventListener('click', 
            function(e){
                var copyText = document.getElementById("api_token");
                copyText.select();
                copyText.setSelectionRange(0, 99999); 
                document.execCommand("copy");
                
         })
    })
</script>