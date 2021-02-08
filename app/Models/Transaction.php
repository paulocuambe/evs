<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transaction";

    public function scopeStatus($query, $status)
    {
        return $query->where('transacStatus', '=', $status);
    }

    public function scopeTestEnv($query, $env=0)
    {
        return $query->where('testENV', '=', $env);
    }

    public function scopei9status($query, $status=1)
    {
        return $query->where('i9_status', '=', $status);
    }


    public function scopeNetwork($query, $network)
    {
        $codes = [];
        $network = \strtolower($network);
        if ($network== "vodacom") {
            $codes = ["25884", "25885"];
        } elseif ($network== "tmcel") {
            $codes = ["25882", "25883"];
        } elseif ($network == "movitel") {
            $codes = ["25886", "25887"];
        } else {
            return $query;
        }

        return $query->where(function ($query) use ($codes) {
            return $query->where('msisdn_or_mno', 'LIKE', "$codes[0]%")
            ->orWhere('msisdn_or_mno', 'LIKE', "$codes[1]%");
        });
    }

    public function scopeCustomers($query, $customers = [])
    {
        return $query->where(function ($query) use ($customers) {
            if (!is_array($customers) && \is_int($customers)) {
                return $query->where('cust_id', '=', $customers);
            } elseif (count($customers) == 1) {
                return $query->where('cust_id', '=', $customers[0]);
            } elseif (count($customers) == 2) {
                return $query->where('cust_id', '=', $customers[0])
                ->orWhere('cust_id', '=', $customers[1]);
            } else {
                throw new Exception('The customers param must have a minimum of 1 and maximum length of 2.');
            }
        });
    }

    public function scopeAirtime($query)
    {
        return $query->where(function ($query) {
            $query->where('srv_id', '=', 1)->orWhere('srv_id', '=', 2);
        });
    }

    public function scopePinless($query)
    {
        return $query->where('srv_id', '=', 1);
    }

    public function scopeWithPin($query)
    {
        return $query->where('srv_id', '=', 2);
    }

    public function scopeCredelec($query)
    {
        return $query->where('srv_id', '=', 3);
    }

    public function scopeBetween($query, $interval)
    {
        $start = isset($interval[0]) ? $interval[0] . ' 00:00' : null;
        $end = isset($interval[1]) ? $interval[1] . ' 23:59:59' : null;

        if (is_null($end)) {
            return $query->where('end_ts', '>=', $start);
        } elseif (is_null($start) && !is_null($end)) {
            return $query->where('end_ts', '<=', $end);
        }

        return $query->whereBetween('end_ts', [$start, $end]);
    }

    public function scopeVoucherStats($query, $network, $interval, $customers)
    {
        return $query->testEnv()->i9status(1)->between($interval)->customers($customers)->network($network);
    }

    public function scopePinVoucherStats($query, $network, $interval, $customers)
    {
        return $query->voucherStats($network, $interval, $customers)->withPin();
    }

    public function scopePinlessVoucherStats($query, $network, $interval, $customers)
    {
        return $query->voucherStats($network, $interval, $customers)->pinless();
    }

    public function scopeCredelecStats($query, $interval, $customers)
    {
        return $query->testEnv()->i9status(1)->between($interval)->customers($customers)->credelec();
    }

    public function dealer()
    {
        return $this->hasOne(Dealer::class, 'id', 'dealer_id');
    }

    
}
