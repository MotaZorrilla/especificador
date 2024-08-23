@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const pluginCard = document.querySelector(".card-plugin .card");
            const pluginButton = document.querySelector(".fixed-plugin-button");
            const closeButton = document.querySelector(".fixed-plugin-close-button");

            // Abre el modal cuando se hace clic en el botón de configuración
            pluginButton.addEventListener("click", function() {
                pluginCard.classList.add("active");
            });

            // Cierra el plugin cuando se hace clic en el botón de cerrar
            closeButton.addEventListener("click", function() {
                pluginCard.classList.remove("active");
            });
        });

        function sidebarColor(element) {
            let color = element.getAttribute("data-color");
            document.querySelector(".navbar").classList =
                `navbar navbar-dark navbar-expand-lg shadow-sm border-radius-lg bg-gradient-${color}`;
        }

        function darkMode(element) {
            if (element.checked) {
                document.body.classList.add('dark-version');
            } else {
                document.body.classList.remove('dark-version');
            }
        }
    </script>
@endsection
