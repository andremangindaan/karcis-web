<?php
    include "../conn.php";

    @session_start();

    $id_user = @$_SESSION['id'];

    $submit = @$_POST['submit'];
    $identity = (int)$submit[0];

    $id_ticket = htmlentities(@$_POST['id_ticket'][$identity]);
    $seats = (int)htmlentities(@$_POST['seats'][$identity]);
    $price = (int)htmlentities(@$_POST['price'][$identity]);

    $id_ticket = mysqli_real_escape_string($conn, $id_ticket);
    $seats = mysqli_real_escape_string($conn, $seats);
    $price = mysqli_real_escape_string($conn, $price);

    $percent = 10;
    $percentInDecimal = $percent / 100;

    // Get the result.
    $percent = $percentInDecimal * $price;
    $total_price = $price + $percent;

    // Validate seats and price based on data
    $sql_ticket_info = "SELECT seats, price FROM tickets WHERE id = $id_ticket";
    $result_ticket_info = $conn->query($sql_ticket_info);

    if ($result_ticket_info->num_rows > 0) {
        $ticket_info = $result_ticket_info->fetch_assoc();
        $available_seats = (int)$ticket_info['seats'];
        $original_price = (int)$ticket_info['price'];

        // Check if the requested number of seats is available
        if ($seats < 1 || $seats > $available_seats) {
            header('Location: '.$host.'tickets.php?status=seatsFailed' );
            exit;
        }
        // Check if the requested price matches the original price
        if ($price !== $original_price) {
            header('Location: '.$host.'tickets.php?status=priceMismatch' );
            exit;
        }
    } else {
        // Ticket not found
        header('Location: '.$host.'tickets.php?status=ticketNotFound' );
        exit;
    }

    // Insert into table booking
    $sql = "INSERT INTO booking (id_user, id_ticket, status, price) VALUES ('$id_user', '$id_ticket', 0, '$total_price')";
    if ($conn->query($sql) === TRUE) {
        // Update seats in table tickets
        $sql_update = "UPDATE tickets SET seats = seats - 1 WHERE id = $id_ticket";
        if($conn->query($sql_update) === FALSE){
            echo("Error description: " . mysqli_error($conn));
            exit;
        } else {
            header('Location: '.$host.'myBookings.php?status=success');
        }
    } else {
        echo("Error description: " . mysqli_error($conn));
    }

    $conn->close();
?>
