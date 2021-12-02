@extends('layouts.base')
@section('title', 'Заказы')


@section('content')
    <table border="1">
        <thead>
        <tr>
            <td>ID</td>
            <td>Имя</td>
            <td>Телефон</td>
            <td>Сумма</td>
            <td>Дата</td>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order):
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->name}}</td>
            <td>{{$order->phone}}</td>
            <td>{{$order->totalPrice()}}</td>
            <td>{{$order->created_at->format('d.m.Y')}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

@endsection
