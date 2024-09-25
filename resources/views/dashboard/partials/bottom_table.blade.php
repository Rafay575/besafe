<div class="p-4 mt-4 py-3 card shadow-lg moveAbove-unique bg-white-custom lightborder-unique">
    <h3 class="mb-4">Ticket Rating</h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead style="background-color:#0A3AA9;color:#fff;padding:0 20px">
                <tr class="bordered-row">
                    <th style="padding:10px">#</th>
                    <th style="padding:10px"> Ticket Type</th>
                    <th style="padding:10px"> Requested By</th>
                    <th style="padding:10px">Assign To</th>
                    <th style="padding:10px">Happiness Rating</th>

                </tr>
            </thead>
            <tbody>
                @php
                    // Dummy ticket data
                    $tickets = [
                        [
                            'ticket' => 1,
                            'subject' => 'Website Issue',
                            'raised_by' => 'John Doe',
                            'resolved_by' => 'Alice Smith',
                            'rating' => 4,
                        ],
                        [
                            'ticket' => 2,
                            'subject' => 'Database Downtime',
                            'raised_by' => 'Jane Doe',
                            'resolved_by' => 'Bob Johnson',
                            'rating' => 5,
                        ],
                        [
                            'ticket' => 3,
                            'subject' => 'Bug Report',
                            'raised_by' => 'John Smith',
                            'resolved_by' => 'Charlie Brown',
                            'rating' => 3,
                        ],
                        [
                            'ticket' => 4,
                            'subject' => 'Feature Request',
                            'raised_by' => 'Alice Cooper',
                            'resolved_by' => 'John Doe',
                            'rating' => 5,
                        ],
                        [
                            'ticket' => 5,
                            'subject' => 'Email Issue',
                            'raised_by' => 'John Doe',
                            'resolved_by' => 'Alice Smith',
                            'rating' => 4,
                        ],
                        [
                            'ticket' => 6,
                            'subject' => 'API Connectivity',
                            'raised_by' => 'Charlie Brown',
                            'resolved_by' => 'Bob Johnson',
                            'rating' => 2,
                        ],
                        [
                            'ticket' => 7,
                            'subject' => 'Server Migration',
                            'raised_by' => 'Jane Doe',
                            'resolved_by' => 'John Smith',
                            'rating' => 5,
                        ],
                        [
                            'ticket' => 8,
                            'subject' => 'Login Issue',
                            'raised_by' => 'John Doe',
                            'resolved_by' => 'Alice Smith',
                            'rating' => 3,
                        ],
                        [
                            'ticket' => 9,
                            'subject' => 'Payment Gateway Issue',
                            'raised_by' => 'Jane Doe',
                            'resolved_by' => 'Bob Johnson',
                            'rating' => 5,
                        ],
                        [
                            'ticket' => 10,
                            'subject' => 'Password Reset',
                            'raised_by' => 'Charlie Brown',
                            'resolved_by' => 'John Doe',
                            'rating' => 1,
                        ],
                    ];
                @endphp

                @foreach ($tickets as $ticket)
                    <tr>
                        <td style="padding:10px">{{ $ticket['ticket'] }}</td>
                        <td style="padding:10px">{{ $ticket['subject'] }}</td>
                        <td style="padding:10px">{{ $ticket['raised_by'] }}</td>
                        <td style="padding:10px">{{ $ticket['resolved_by'] }}</td>
                        <td style="padding:10px">
                            <!-- Display Rating as Stars -->
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $ticket['rating'])
                                    <span class="fa fa-star"></span>
                                @else
                                    <span class="fa fa-star-o"></span> <!-- Empty stars if needed -->
                                @endif
                            @endfor

                            <!-- Add emoji based on the rating -->
                            @if ($ticket['rating'] == 5)
                                <span>😁</span> <!-- Emoji for 5 stars -->
                            @elseif ($ticket['rating'] >= 4)
                                <span>😊</span> <!-- Emoji for 4 stars -->
                            @elseif ($ticket['rating'] >= 3)
                                <span>🙂</span> <!-- Emoji for 3 stars -->
                            @elseif ($ticket['rating'] >= 2)
                                <span>😐</span> <!-- Emoji for 2 stars -->
                            @else
                                <span>😡</span> <!-- Emoji for 1 star or below -->
                            @endif


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
