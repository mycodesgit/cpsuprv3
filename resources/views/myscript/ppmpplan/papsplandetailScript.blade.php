<script>
    function initpapsFormScripts() {

        function slugifySub(str) {
            return (str || '')
            .toString()
            .normalize('NFD').replace(/[\u0300-\u036f]/g,'') // remove accents
            .toLowerCase().trim()
            .replace(/[^a-z0-9]+/g,'_') // non-alnum -> _
            .replace(/^_+|_+$/g,'');    // trim underscores
        }

        // Unbind old handlers (to avoid double binding after reload)
        // document.querySelectorAll('.addRow').forEach(btn => {
        //     btn.replaceWith(btn.cloneNode(true));
        // });

        // Rebind Add Row
        document.addEventListener("click", function(e) {
            // Add Subcategory
            if (e.target.classList.contains("addSubcategory")) {
                let cat = e.target.dataset.cat;
                let subName = document.querySelector("#newSub" + cat).value.trim();
                if (!subName) return;

                let safeSub = slugifySub(subName);
                let containerId = "subcategory-" + cat + "-" + safeSub;

                if (!document.querySelector("#" + containerId)) {
                    let block = `
                        <div class="subcategory-block mb-3" id="${containerId}">
                            <h5 class="mt-3">${subName}</h5>
                            <div class="subcat-rows" id="rows-${cat}-${safeSub}"></div>
                            <button type="button" class="btn btn-outline-info btn-sm addRow" 
                                data-cat="${cat}" data-sub="${subName}">
                                <i class="fas fa-plus"></i> Add Row (${subName})
                            </button>
                        </div>
                    `;
                    document.querySelector("#category" + cat).insertAdjacentHTML("beforeend", block);
                }
            }

            // Add Row
            if (e.target.classList.contains("addRow")) {
                let cat = e.target.dataset.cat;
                let sub = e.target.dataset.sub;
                let safeSub = slugifySub(sub);

                let template = document.querySelector("#blankRowTemplate").innerHTML;
                template = template.replace("__CAT__", cat).replace("__SUB__", sub);

                let container = document.querySelector("#rows-" + cat + "-" + safeSub);
                if (!container) {
                    console.error("❌ Container not found: #rows-" + cat + "-" + safeSub);
                    return;
                }
                container.insertAdjacentHTML("beforeend", template);

                // re-init select2 for new row
                $(".select2").select2({ width: '100%' });
            }
        });

        // Remove Row (delegated)
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