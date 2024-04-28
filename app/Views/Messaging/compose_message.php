<?php
$receipients = empty(\App\Config\Views\View::getData('receipients')['receipients']) ? [] : \App\Config\Views\View::getData('receipients')['receipients'];
?>
<!-- Compose message modal -->
<div class="modal fade" id="composeModal" tabindex="-1" role="dialog" aria-labelledby="composeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="/messages/send_message">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="composeModalLabel">Compose Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Compose message form -->

                    <div class="form-group">
                        <label for="recipient">Recipient</label>
                        <select class="form-control" name="recipient" required>
                            <option value="">Choose receipient</option>
                            <?php foreach ($receipients as $receipient): ?>
                                <option value="<?= $receipient['id'] ?>"><?= $receipient['email'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" name="message" rows="5"
                                  placeholder="Your message" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>