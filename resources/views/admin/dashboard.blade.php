@php $user = Auth::user(); @endphp

@extends('admin.layouts.base')

@section('page-title')
	<h1 class="m-0">ADMIN DASHBOARD</h1>
@endsection

@section('contents')
	<div class="container d-flex align-items-center justify-content-center mt-5 mb-5 p-5 rounded border">
		<h2 fs-3>
			Welcome {{ $user->name }}!
		</h2>
	</div>
@endsection
