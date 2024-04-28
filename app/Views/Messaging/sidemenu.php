<div class="col-md-3">
    <!-- Sidebar with navigation buttons -->
    <div class="list-group">
        <a href="/messages/inbox"
           class="list-group-item list-group-item-action <?= \App\Config\Views\View::getData('active_page') === 'inbox' ? 'active' : '' ?>">Inbox</a>
        <a href="/messages/sent"
           class="list-group-item list-group-item-action <?= \App\Config\Views\View::getData('active_page') === 'sent' ? 'active' : '' ?>">Sent</a>
        <a href="#" class="list-group-item list-group-item-action btn btn-primary" data-toggle="modal"
           data-target="#composeModal">Compose Message</a>
    </div>
</div>