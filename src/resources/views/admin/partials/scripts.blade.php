<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('form input[type=text]').blur(function () {
            $(this).closest('form').submit();
        }).keypress(function (e) {
            if (e.which === 10 || e.which === 13) {
                $(this).closest('form').submit();
            }
        });

        $('form select').change(function () {
            $(this).closest('form').submit();
        })
    })
</script>
