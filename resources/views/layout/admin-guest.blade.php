<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    @include('partials.admin-head')
</head>

<body class="scroll-sm">

    @yield('admin-guest')

    @include('partials.admin-scripts')

    <script>
        // ================== Password Show Hide Js Start ==========
        function initializePasswordToggle(toggleSelector) {
            $(toggleSelector).on('click', function() {
                $(this).toggleClass("ri-eye-off-line");
                var input = $($(this).attr("data-toggle"));
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        }
        // Call the function
        initializePasswordToggle('.toggle-password');

        $(document).ready(function() {
            $('.alert .remove-button').on('click', function() {
                $(this).closest('.alert').addClass('d-none')
            });
        })
        // ========================= Password Show Hide Js End ===========================
    </script>

</body>

</html>
