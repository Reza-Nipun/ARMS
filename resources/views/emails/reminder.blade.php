@component('mail::message')

Dear Concern,<br>
Please check the below item list, which renewal dates are expiring soon.

<table width="100%" id="table_id" border="1" style="border-style: solid; border-collapse: collapse;">
    <thead>
        <th class="text-center">Item</th>
        <th class="text-center">Service</th>
        <th class="text-center">Brand</th>
        <th class="text-center">Model</th>
        <th class="text-center">Serial</th>
        <th class="text-center">Unit</th>
        <th class="text-center">Dept.</th>
        <th class="text-center">Email</th>
        <th class="text-center">Liable Person</th>
        <th class="text-center">Orig. Loc.</th>
        <th class="text-center">Doc. Loc.</th>
        <th class="text-center">Last Renew</th>
        <th class="text-center">Next Renew</th>
        <th class="text-center">Vendor</th>
        <th class="text-center">Amount</th>
        <th class="text-center">Remarks</th>
    </thead>
    <tbody>
        @foreach($documents as $d)
            <tr>
                <td class="text-center">{{ $d->item_name }}</td>
                <td class="text-center">{{ $d->service_type }}</td>
                <td class="text-center">{{ $d->brand }}</td>
                <td class="text-center">{{ $d->model }}</td>
                <td class="text-center">{{ $d->serial_no }}</td>
                <td class="text-center">{{ $d->unit }}</td>
                <td class="text-center">{{ $d->department }}</td>
                <td class="text-center">{{ $d->user_email }}</td>
                <td class="text-center">{{ $d->user }}</td>
                <td class="text-center">{{ $d->original_placement_location }}</td>
                <td class="text-center">{{ $d->original_document_location }}</td>
                <td class="text-center">{{ $d->last_renewal_date }}</td>
                <td class="text-center">{{ $d->next_renewal_date }}</td>
                <td class="text-center">{{ $d->vendor }}</td>
                <td class="text-center">{{ $d->amount }}</td>
                <td class="text-center">{{ $d->remarks }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent