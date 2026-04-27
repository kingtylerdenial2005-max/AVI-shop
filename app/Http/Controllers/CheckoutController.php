<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Your cart is empty!');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $shipping = $subtotal > 1999 ? 0 : 99;
        $total = $subtotal + $shipping;

        return view('checkout', compact('cart', 'subtotal', 'shipping', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        
        // 1. Create/Update Customer
        $customer = \App\Models\Customer::firstOrCreate(
            ['phone' => $request->phone],
            [
                'name' => $request->name,
                'address' => $request->address . " (Location: " . $request->location . ")"
            ]
        );

        // 2. Calculate Total
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $shipping = $subtotal > 1999 ? 0 : 99;
        $total = $subtotal + $shipping;

        // 3. Create Order
        $order = \App\Models\Order::create([
            'customer_id' => $customer->id,
            'order_number' => 'AVI-' . strtoupper(uniqid()),
            'total_amount' => $total,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'shipping_address' => $request->address . ", " . $request->location
        ]);

        // 4. Create Order Items
        $orderDetails = "";
        foreach ($cart as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'size' => $item['size']
            ]);
            $orderDetails .= "• " . $item['name'] . " (Size: " . $item['size'] . ") x" . $item['quantity'] . " - ₹" . ($item['price'] * $item['quantity']) . "\n";
        }

        // 5. Prepare WhatsApp Message
        $waNumber = "919361699627";
        $message = "*NEW NIGHTY ORDER!*\n\n" .
                   "*Order ID:* " . $order->order_number . "\n" .
                   "*Customer:* " . $request->name . "\n" .
                   "*Phone:* " . $request->phone . "\n" .
                   "*Location:* " . $request->location . "\n" .
                   "*Address:* " . $request->address . "\n\n" .
                   "*Items:*\n" . $orderDetails . "\n" .
                   "*Total Bill:* ₹" . number_format($total, 0) . "\n" .
                   "*Payment:* " . $request->payment_method . "\n\n" .
                   "Please confirm the order. Thank you!";

        $waLink = "https://wa.me/" . $waNumber . "?text=" . urlencode($message);

        // 6. Truly Automatic Background Notification (via Telegram Bot API)
        try {
            $botToken = env('TELEGRAM_BOT_TOKEN');
            $chatId = env('TELEGRAM_CHAT_ID');

            if ($botToken && $chatId) {
                $telegramMessage = "🛍️ *NEW NIGHTY ORDER!*\n\n" .
                                   "🆔 *Order ID:* " . $order->order_number . "\n" .
                                   "👤 *Customer:* " . $request->name . "\n" .
                                   "📞 *Phone:* " . $request->phone . "\n" .
                                   "📍 *Location:* " . $request->location . "\n" .
                                   "🏠 *Address:* " . $request->address . "\n\n" .
                                   "📦 *Items:*\n" . $orderDetails . "\n" .
                                   "💰 *Total Bill:* ₹" . number_format($total, 0) . "\n" .
                                   "💳 *Payment:* " . $request->payment_method . "\n\n" .
                                   "✅ *Please check admin panel for details.*";

                $telegramUrl = "https://api.telegram.org/bot{$botToken}/sendMessage";
                
                // Using file_get_contents for a simple POST request
                $data = [
                    'chat_id' => $chatId,
                    'text' => $telegramMessage,
                    'parse_mode' => 'Markdown'
                ];

                $options = [
                    'http' => [
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($data),
                    ],
                ];
                $context  = stream_context_create($options);
                file_get_contents($telegramUrl, false, $context);
            }
        } catch (\Exception $e) {
            // Silently fail if Telegram is down
        }

        // 7. UPI Intent Link
        $upiLink = null;
        if ($request->payment_method === 'UPI') {
            $vpa = "9361699627@okicici"; 
            $upiLink = "upi://pay?pa={$vpa}&pn=AVI%20Nighties&am={$total}&cu=INR";
        }

        // 7. Clear Cart
        session()->forget('cart');

        return view('order-success', compact('order', 'waLink', 'upiLink'));
    }
}
