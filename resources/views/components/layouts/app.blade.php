<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    @include('partials.admin-head')
    @livewireStyles
</head>

<body>
    @include('partials.admin-sidebar')

    <main class="dashboard-main">
        @include('partials.admin-navbar')

        <div class="dashboard-main-body">
            {{ $slot }}
        </div>

        <footer class="d-footer">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <p class="mb-0">© 2024. All Rights Reserved.</p>
                </div>
                <div class="col-auto">
                    <p class="mb-0">Made by <a href="https://www.instagram.com/not_sameed52/" target="_blank"
                            class="text-primary-600">Sameed</a></p>
                </div>
            </div>
        </footer>
    </main>

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
        // ========================= Password Show Hide Js End ===========================
    </script>
    @yield('admin_scripts')
    @livewireScripts
</body>

</html>
