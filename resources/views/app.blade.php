@extends('layout')

@section('content')
  @include('sections.commands')
  <br>
  @include('sections.results')
@endsection

@section('scripts')
  <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
  
  <script src="{{ asset('js/app.js') }}"></script>
@endsection