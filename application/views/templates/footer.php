<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    </div>
    <!-- ./wrapper -->

    <script>
    // Page Preloader
    document.onreadystatechange = function() {
        if (document.readyState === 'complete') {
            setTimeout(function() {
                document.getElementById('page-preloader').classList.add('loaded');
            }, 500);
        }
    };

    // AJAX Loading Overlay
    $(document).ajaxStart(function() {
        $('#loading-overlay').fadeIn(200);
    }).ajaxStop(function() {
        $('#loading-overlay').fadeOut(200);
    });
    </script>

</body>
</html>