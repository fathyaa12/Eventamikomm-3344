<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Transaction extends Model
{
    protected $fillable = [
        'event_id', 'order_id', 'customer_name', 'customer_email', 'customer_phone', 'total_price', 'status', 'snap_token',
        'voucher_id', 'discount_amount', 'ticket_tier_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function ticketTier()
    {
        return $this->belongsTo(TicketTier::class);
    }
}
