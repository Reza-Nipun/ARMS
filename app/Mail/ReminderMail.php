<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use DB;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $documents = DB::select( "SELECT documents.*, units.name as unit, departments.name as department,
                                  service_types.name as service_type, users.email as user_email
                                  FROM documents
                                  LEFT JOIN units
                                  ON units.id=documents.unit_id
                                  LEFT JOIN
                                  departments
                                  ON departments.id=documents.department_id
                                  LEFT JOIN
                                  service_types
                                  ON service_types.id=documents.service_type_id
                                  LEFT JOIN
                                  users
                                  ON users.unit_id=documents.unit_id AND users.department_id=documents.department_id
                                  WHERE 1
                                  AND DATE_FORMAT(next_renewal_date, '%Y-%m-%d') BETWEEN CURDATE() AND (CURDATE() + INTERVAL 310 day)
                                  OR CURDATE() > DATE_FORMAT(next_renewal_date, '%Y-%m-%d')
                                  
                                  ORDER BY documents.unit_id, documents.department_id" );

        return $this->markdown('emails.reminder')->with('documents', $documents);
    }
}
