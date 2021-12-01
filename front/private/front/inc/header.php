<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>


<link href="toastr/toastr.css" rel="stylesheet"/>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="toastr/toastr.min.js"></script>
<script>

    toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "linear",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }

    function typeToTitle(type) {
        switch(type) {
            case 'success':
                return 'Succès';
            case 'info':
                return 'Info';
            case 'warning':
                return 'Attention';
            case 'error':
                return 'Erreur';
        }
    }
</script>


<?php if(isset($_SESSION['flash'])) : ?>
    <script>
        window.onload = function() {
        <?php foreach($_SESSION['flash'] as $type => $message) : ?>
            type = "<?= $type ?>";
            title = typeToTitle(type);
            toastr[type]("<?= $message; ?>", title);                
        <?php endforeach; ?>
        }
    </script>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>