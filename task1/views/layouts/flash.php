<?php if(isset($_SESSION['message'])): ?>

    <div class="flash-message
        <?= $_SESSION['message_type'] ?? 'success' ?>">

        <?= $_SESSION['message'] ?>

    </div>

    <?php

        unset($_SESSION['message']);

        unset($_SESSION['message_type']);
    ?>

<?php endif; ?>