@extends('layouts.app')

@section('content')
<div id="app"></div>
@endsection

@section('scripts')
	<script src="https://unpkg.com/tween.js@16.3.4"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
@endsection
