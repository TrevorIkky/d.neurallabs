@extends('auth.auth_header')
@section('content')
<div class="card-body p-4">

    <h4 class="text-dark mb-3 ml-1 mr-1">Sign In</h4>
    <p class="mb-4 ml-1 mr-1">Please provide your email and password to sign in.</p>
    <form method="POST" action="{{ url('/login')}}">
        @csrf
        <div class="row ">
            <div class="form-group col-md-12 mb-4">
                <input type="email" class="form-control input-lg" name="email" id="email" aria-describedby="emailHelp"
                    placeholder="Email" required>
            </div>
            <div class="form-group col-md-12 ">
                <input type="password" class="form-control input-lg" name="password" id="password"
                    placeholder="Password" required>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Sign In</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>

@endsection