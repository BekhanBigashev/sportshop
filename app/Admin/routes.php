<?php

use App\Models\Order;

Route::get('', ['as' => 'admin.dashboard', function () {
	$content = 'Define your dashboard here.';
	return AdminSection::view($content, 'Dashboard');
}]);

Route::get('information', ['as' => 'admin.information', function () {
	$content = 'Define your information here.';
	return AdminSection::view($content, 'Information');
}]);

Route::get('uncheckout', ['as' => 'admin.uncheckout', function () {
    $unchekouOrders = Order::where('status', 0)->orderBy('created_at', 'desc')->get();
    $content = '<table class="table table-bordered"><tbody>';
    $content .= '<thead  class="thead-dark"><tr><td>ИД</td><td>Товары</td><td>Дата последнией активности</td></tr></thead>';
    foreach ($unchekouOrders as $order) {
        $order = Order::find($order['id']);
        if (count($order->products)) {
            $content .= '<tr><td>'.$order->id.'</td>';
            $content .= '<td>';
            foreach ($order->products as $product) {
                $content .= $product->getAdminLink() . ' x ' . $product->pivot->count . "<br>";
            }
            $content .= '</td>';
            $content .= '<td>' . $order->created_at->format('d F Y') . '</td>';
        }
    }
    $content .= '</tbody></table>';

    return AdminSection::view($content, 'Неоформленные корзины');
}]);
