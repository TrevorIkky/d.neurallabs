@extends('auth.auth_header')
@section('content')
<div class="card-body p-4 mr-2 ml-2">
    <h4 class="text-dark mb-3 mr-1 ml-1">Sign Up</h4>
    <p class="mb-3">Welcome to Neural Labs. To get started please fill in the details below and click on Sign Up.</p>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row">
            <div class="form-group col-md-12 mb-4">
                <input type="text" class="form-control input-lg" id="name" name="name" aria-describedby="nameHelp"
                    placeholder="Username" required>
            </div>
            <div class="form-group col-md-12 mb-4">
                <input type="email" class="form-control input-lg" id="email" name="email" aria-describedby="emailHelp"
                    placeholder="Email" required>
            </div>
            <div class="form-group col-md-12 ">
                <input type="tel" class="form-control input-lg" id="telephone" name="telephone" placeholder="Telephone"
                    required>
            </div>
            <div class="form-group col-md-12 ">
                <input type="text" class="form-control input-lg" id="token" name="token_name"
                    placeholder="Name of your API token" required>
            </div>
            <div class="form-group col-md-12 ">
                <input type="password" class="form-control input-lg" id="password" name="password"
                    placeholder="Password" required>
            </div>
            <div class="col-md-12">
                <div class="d-inline-block mr-3 mt-1 mb-1">
                    <label class="control control-checkbox">
                        <input type="checkbox" required />
                        <div class="control-indicator"></div>
                        I Agree the terms and conditions
                    </label>
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Sign Up</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
@endsection
<script defer>
    window.addEventListener('load', function(wl){

    })
</script>