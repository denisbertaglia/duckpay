@extends('layouts.app')


@section('title','All Users')

@section('title.section')
<h1 class="mx-2">
    {{__("painel.active_users")}}
</h1>
@endsection

@section('sidebar')
<nav class="navbar navbar-expand-lg bg-body-tertiary mt-1">
    <div class="container-fluid">
        <div class=" navbar-collapse">
            <div class="navbar-nav">
                <a class="nav-link {{ ($type == 'LOGIN')  ?'active':'' }}" href="{{route('users.index');}}">
                    {{__("painel.All")}}
                </a>
                <a class="nav-link {{ ($type == " SHOPKEEPER") ?'active':'' }}"
                    href="{{route('users.index', ['type' => "SHOPKEEPER"]);}}">
                    {{__("painel.Shopkeepers")}}
                </a>
                <a class="nav-link {{ ($type == " CUSTOMER") ?'active':''}}"
                href="{{route('users.index',['type' => "CUSTOMER"]);}}">
                    {{__("painel.Buyers")}}
                </a>
            </div>
        </div>
    </div>
</nav>
@endsection

@section('content')
<table class="table">
    <thead>
        @if(count($users))
        <tr>
            <th scope="col"> {{__("painel.Name")}} </th>
            <th scope="col"> {{__("painel.Type")}} </th>
            <th scope="col"></th>
        </tr>
        @endif
    </thead>
    <tbody>
        @php
        /**
        * @var $user App\Application\User\UserDTO
        */
        @endphp
        @forelse($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{ __("painel.".$user->userType)}}</td>
            <td class="text-center">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
                        viewBox="0 0 16 16">
                        <path
                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                        <path
                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                    </svg>
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td class="text-center"> {{__("no_users")}}.</td>
        </tr>
        @endforelse

    </tbody>
</table>

<div class="d-grid gap-2  my-2" role="toolbar" aria-label="Toolbar with button groups">
    @if($endpage)
    <a href="{{route('users.index', ['type' => $type, 'page' => ++$page]);}}"
        class="btn btn-warning">{{__("painel.view_more")}}</a>
    @endif
</div>
@endsection
