<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubServer extends Model
{
    use HasFactory;

    protected $fillable = [
        'server_id',
        'name',
        'ip_address',
        'ovpn_user',
        'ovpn_password',
        'wg_panel_address',
        'wg_panel_password',
        'ovpn_config',
    ];

    /**
     * Get the server that owns the sub-server.
     */
    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}
