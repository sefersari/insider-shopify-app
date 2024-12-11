@extends('layout.master')

@section('content')
    <setting
        store="{{ $setting?->shopify_store }}"
        token="{{ $setting?->shopify_token ?? null }}"
    ></setting>
@endsection
