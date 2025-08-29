<script>
    function initpapsFormScripts() {
        // Unbind old handlers (to avoid double binding after reload)
        document.querySelectorAll('.addRow').forEach(btn => {
            btn.replaceWith(btn.cloneNode(true));
        });

        // Rebind Add Row
        document.querySelectorAll('.addRow').forEach(btn => {
            btn.addEventListener('click', function() {
                let cat = this.dataset.cat; // A, B, C, D
                let container = document.querySelector('#category' + cat);
                let template = document.querySelector('#blankRowTemplate').innerHTML;

                // inject category hidden field
                template = template.replace('__CAT__', cat);

                container.insertAdjacentHTML('beforeend', template);
                $(container).find('.select2').select2({
                    width: '100%' // keeps same sizing
                });
            });
        });

        // Rebind Remove Row (delegated, survives reload)
        document.addEventListener('click', function(e) {
            if (e.target.closest('.removeRow')) {
                e.target.closest('.ppmp-row').remove();
            }
        });
        $(document).ready(function () {
            // Title dropdown -> auto-fill Code
            $(document).off("change", ".papstitle-select").on("change", ".papstitle-select", function () {
                let selectedOption = $(this).find("option:selected");
                let code = selectedOption.data("code") || "";
                let row = $(this).closest(".ppmp-row");
                row.find(".papscode-input").val(code);
            });

            // Procurable select -> (example: console log for now)
            $(document).off("change", ".papsprocyn-select").on("change", ".papsprocyn-select", function () {
                let value = $(this).val();
                console.log("Procurable changed:", value);
                // you can add extra logic here later
            });

            // Initialize Select2 for existing selects
            $('.select2').select2({ width: '100%' });
        });

    }

    $(document).ready(function () {
        $('.select2').select2({ width: '100%' }); // init existing selects
        initpapsFormScripts();
    });

    // document.addEventListener("DOMContentLoaded", function() {
    //     initpapsFormScripts();
    // });
</script>