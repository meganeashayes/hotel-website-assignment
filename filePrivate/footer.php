<footer>
    <?php
    $currentPage = basename($_SERVER['PHP_SELF']);
    if ($currentPage !== "admin.php") {
        echo "<p><a href=\"admin.php\">Staff Portal</a></p>";
    }
    ?>
    <p>Disclaimer: This site was created for a university project. No actual services are being offered.</p>
</footer>
</body>
</html>