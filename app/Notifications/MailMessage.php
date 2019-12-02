<?php

namespace App\Notifications;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\MailMessage as DefaultMailMessage;

class MailMessage extends DefaultMailMessage
{
    private $table;

    public function table($data)
    {
        $this->table = $data;
    }

    public function data()
    {
        return array_merge(parent::data(), [
            'table'     => $this->table,
        ]);
    }
}
