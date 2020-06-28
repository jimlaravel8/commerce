@extends('layouts.app')

@section('content')
<my-nav :user="{{ json_encode($auth_user) }}"></my-nav>
{{-- <my-header :user="{{ json_encode($auth_user) }}"></my-header> --}}
<transition name="fade">
    <v-app>
    <my-app :user="{{ json_encode($auth_user) }}"></my-app>
</v-app>
</transition>
@endsection
