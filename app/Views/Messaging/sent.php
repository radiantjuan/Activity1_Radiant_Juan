<!--
Inbox message

@author Radiant C. Juan <K230925@Student.kent.edu.au>
@copyright 2024 Radiant Juan - K230925
-->

<?php

$sent_message = empty(\App\Config\Views\View::getData('messages')['messages']) ? [] : \App\Config\Views\View::getData('messages')['messages'];
$sent_message_total_count = empty(\App\Config\Views\View::getData('messages')['total_pages']) ? 0 : \App\Config\Views\View::getData('messages')['total_pages'];
$current_page = empty($_GET['current_page']) ? 1 : $_GET['current_page'];
?>

<div class="container mt-5">
    <div class="row">
        <?php include "sidemenu.php"; ?>
        <div class="col-md-9">
            <!-- Content area -->
            <h2>Sent Messages</h2>
            <!-- Sample received messages -->
            <div class="card">
                <ul class="list-group list-group-flush">
                    <!-- Sample received messages here -->
                    <?php foreach ($sent_message as $message): ?>
                        <li class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Sent to: <?= $message['receiver_name'] ?></h5>
                            </div>
                            <p class="mb-1"><?= $message['message_content'] ?></p>
                            <small>Date & Time: <?= date('Y-m-d h:i A', strtotime($message['sent_date'])) ?></small>
                        </li>
                    <?php endforeach; ?>

                    <!-- End of sample messages -->
                </ul>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center mt-4">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <?php for ($i = 1; $i <= $sent_message_total_count; $i++) : ?>
                        <li class="page-item <?= $current_page == $i ? 'active' : '' ?>">
                            <a class="page-link"
                               href="/messages/sent?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
</div>

<?php include "compose_message.php"; ?>