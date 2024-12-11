<?= $ticket->status == 'Confirmed' ?
    "<div class=\"cancel text-center\">
    <a href=\"/cancel-ticket/$ticket->_id\"
        style=\"background-color: #dc3545; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px; display: inline-block;\">
        Cancel Ticket
    </a>
</div>" : "";
?>