@extends('layouts.error')


@section('content')



<!-- Page -->
  <div class="page vertical-align text-xs-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
   <div class="page-content vertical-align-middle">
      <i class="icon wb-settings icon-spin page-maintenance-icon" aria-hidden="true"></i>
      <h2>En mantenimiento</h2>
      <p>Volveremos nuevamente en unos minutos .... </p>
      <footer class="page-copyright">
        <p>Oru Services 1.0</p>
        <p>© 2018.</p>
      {{--   <div class="social">
          <a href="javascript:void(0)">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-dribbble" aria-hidden="true"></i>
          </a>
        </div> --}}
      </footer>
    </div>
  </div>
  <!-- End Page -->

  @endsection