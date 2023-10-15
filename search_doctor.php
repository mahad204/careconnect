<?php
include('includes/db_connect.php');
include ('functions/common_function.php')
?>

<section class="page-section">
    <div class="container">
        <hr class="divider">
        <?php
            get_unique_doctors();
        ?>
         <!--  -->
        <hr class="divider" style="max-width: 60vw">
    </div>
</section>