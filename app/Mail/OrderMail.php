<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function build()
    {
        return $this->view('mails.ordermail')
                    ->subject('Xác nhận đăng ký tài khoản')//tiêu đề email
                    ->from('ddanglong09@gmail.com', 'Đặng Đình Bảo Long')//tùy chỉnh email và tên 
                    ->with([
                        'order' => $this->order,
                    ]); //lấy dữ liệu gửi lên view

    }
}
