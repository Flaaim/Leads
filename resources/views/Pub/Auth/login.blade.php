@extends('Pub::layout')

@section('content')
<div class="col-6 mt-3">
    <h1>{{__('auth.login_title')}}</h1>
<form action="{{route('auths.login')}}" method="POST">
    @csrf

    @if($errors->any())
        <ul>
        @foreach($errors->all() as $error)  
            <li>
                {{$error}}
            </li>
        @endforeach
        </ul>

    @endif
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" id="form2Example1" name="email" class="form-control" placeholder="Email"/>
    <label class="form-label" for="form2Example1" >{{__('auth.login_email')}}</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" id="form2Example2" name="password" class="form-control" placeholder="Password"/>
    <label class="form-label" for="form2Example2" >{{__('auth.login_password')}}</label>
  </div>

  <!-- 2 column grid layout for inline styling -->
  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
      <!-- Checkbox -->
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
        <label class="form-check-label" for="form2Example31"> Remember me </label>
      </div>
    </div>

    <div class="col">
      <!-- Simple link -->
      <a href="#!">Forgot password?</a>
    </div>
  </div>

  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4">{{__('auth.login_submit')}}</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Not a member? <a href="#!">Register</a></p>
    <p>or sign up with:</p>
    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-facebook-f"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-google"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-twitter"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-github"></i>
    </button>
  </div>
</form>
</div>
@endsection