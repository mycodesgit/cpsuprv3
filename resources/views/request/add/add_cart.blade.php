@extends('layouts.master')

@section('body')
    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>My Cart</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Select Items in {{ $items->first()->category_name }} Category</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="example1" class="table table-hover">
                                        <thead class="bg-light">
                                            <tr>
                                                <th width="5%" style="visibility: ;">#</th>
                                                <th>Description</th>
                                                <th>Unit</th>
                                                <th>Cost</th>
                                                <th width="10%">#</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            @php $no = 1; @endphp
                                            @foreach($items as $itemdata)
                                            <tr id="tr-{{ $itemdata->id }}">
                                                <td style="visibility: ;">{{ $itemdata->unit_id_alias }}</td>
                                                <td>{{ $itemdata->item_descrip }}</td>
                                                <td>{{ $itemdata->unit_name }}</td>
                                                <td>{{ $itemdata->item_cost }}</td>
                                                <td>
                                                    <a href="" class="btn btn-outline-success btn-sm btn-selectitem" data-toggle="modal" data-target="#itemModal" data-id="{{ $itemdata->id }}">
                                                        <i class="fa-solid fa-cart-shopping"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">List of your Selected Items in {{ $items->first()->category_name }} Category</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" id="table-cart">
                                    <table id="cart" class="table table-hover table-striped">
                                        <thead style="font-size: 8pt">
                                            <tr>
                                                <th>Description</th>
                                                <th>Unit</th>
                                                <th>Qty</th>
                                                <th>Cost</th>
                                                <th>Total Cost</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodycart">

                                        </tbody>
                                    </table>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="float-right">
                                                <h5>Grand Total: <span id="grandTotal"></span></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <form id="updateStatusForm" action="{{ route('savePR') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="purpose_id" value="{{ request('purpose_Id') }}">
                                        {{-- <div class="row">
                                            <div class="col-md-6">
                                                <input type="file" name="doc_file" class="form-control form-control-sm" id="fileInput" accept=".pdf" onchange="handleFileUpload()">
                                            </div>
                                        </div>
                                        <span class="text-danger text-xs">Upload a PDF file for attachement Layout</span> --}}
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="editpdflayout" class="font-weight-bold">Upload a PDF file for attachment Layout</label>
                                                        <div id="dropZone" class="file-drop-zone" 
                                                            style="border: 2px dashed #14743f; border-radius: 10px; padding: 20px; text-align: center; cursor: pointer; position: relative;">
                                                            <input type="file" class="custom-file-input" id="editpdflayout" name="doc_file" accept=".pdf" 
                                                                style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;">
                                                            <div class="file-upload-content">
                                                                <div class="upload-icon" style="font-size: 3em; color: #14743f;">
                                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                                </div>
                                                                <p class="upload-text" style="margin: 10px 0; color: #14743f;">Browse Files to upload Layout</p>
                                                            </div>
                                                        </div>
                                                        <div class="file-info mt-2" style="text-align: center; color: #555;">
                                                            <i class="fas fa-file-pdf"></i> <span id="fileNameDisplay">No selected file -</span>
                                                            <button type="button" class="btn btn-sm btn-outline-danger ml-2" onclick="clearFile()">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="editpdfppmp" class="font-weight-bold">Upload a PPMP file for attachement</label>
                                                        <div id="dropZonePPMP" class="file-drop-zone" 
                                                            style="border: 2px dashed #14743f; border-radius: 10px; padding: 20px; text-align: center; cursor: pointer; position: relative;">
                                                            <input type="file" class="custom-file-input" id="editpdfppmp" name="ppmp_file" accept=".pdf" 
                                                                style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;">
                                                            <div class="file-upload-content">
                                                                <div class="upload-icon" style="font-size: 3em; color: #14743f;">
                                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                                </div>
                                                                <p class="upload-text" style="margin: 10px 0; color: #14743f;">Browse Files to upload PPMP</p>
                                                            </div>
                                                        </div>
                                                        <div class="file-info mt-2" style="text-align: center; color: #555;">
                                                            <i class="fas fa-file-pdf"></i> <span id="fileNamePPMPDisplay">No selected file -</span>
                                                            <button type="button" class="btn btn-sm btn-outline-danger ml-2" onclick="clearFilePPMP()">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- additional attachment --}}

                                        {{-- <div class="row">
                                            <div class="col-md-6">
                                                <input type="file" name="ppmp_file" class="form-control form-control-sm" id="fileInput" accept=".pdf" onchange="handleFileUpload()" required>
                                                
                                            </div>
                                        </div>
                                        <span class="text-danger text-xs">Upload a PPMP file for attachement</span> --}}


                                        <button id="submitPRButton" class="btn btn-success float-right">
                                            <i class="fas fa-save"></i> Submit PR
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="itemModal" role="dialog" aria-labelledby="itemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemModalLabel">Add to Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('prCreate') }}" id="requestpr">
                        @csrf

                        <input type="hidden" name="category_id" value="{{ $purpose->cat_id }}">
                        <input type="hidden" name="user_id" value="{{ $purpose->user_id }}">
                        <input type="hidden" name="campid" value="{{ $purpose->camp_id }}">
                        <input type="hidden" name="off_id" value="{{ $purpose->office_id }}">
                        <input type="hidden" name="transaction_no" value="{{ $purpose->id }}">
                        <input type="hidden" name="purpose_id" value="{{ $purpose->id }}">
                        <input type="hidden" name="item_id">
                        <input type="hidden" name="unit_id">

                        <div class="form-group mt-2">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label><span class="badge badge-secondary">Item</span></label>
                                    <input type="text" name="item_name" class="form-control form-control-sm" readonly>
                                </div>

                                <div class="mt-2 col-md-12">
                                    <label><span class="badge badge-secondary">Unit</span></label>
                                    <input type="text" name="unit_name" class="form-control form-control-sm" readonly>
                                </div>

                                <div class="mt-2 col-md-12">
                                    <label><span class="badge badge-secondary">Item Cost</span></label>
                                    @if(in_array($purpose->cat_id, [18, 20, 21, 22, 29, 30, 31]))
                                        <input type="text" name="item_cost" class="form-control form-control-sm" onkeyup="formatNumber(this); calculateTotalCost()">
                                    @else
                                        <input type="text" name="item_cost" class="form-control form-control-sm" onkeyup="formatNumber(this); calculateTotalCost()" readonly>
                                    @endif
                                </div>

                                <div class="mt-2 col-md-4">
                                    <label><span class="badge badge-secondary">Quantity</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity()">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="qty" id="quantityInput" class="form-control form-control-md" value="1" oninput="validateQuantity(this, {{ in_array($purpose->cat_id, [29]) ? 'true' : 'false' }});" onkeyup="calculateTotalCost()">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2 col-md-8">
                                    <label>Total Cost:</label>
                                    <input type="text" name="total_cost" onkeyup="formatNumber(this);" class="form-control form-control-md" readonly>
                                </div>

                                <div class="col-md-12">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="form-control form-control-sm btn btn-outline-success btn-sm">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function formatNumber(input) {
            const value = input.value.replace(/[^\d.]/g, '');
            const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            input.value = formattedValuetoggleReadonly(input);
        }
    </script>

    <script>
        function incrementQuantity() {
            var quantityInput = document.getElementById('quantityInput');
            var currentQuantity = parseInt(quantityInput.value) || 0;
            quantityInput.value = currentQuantity + 1;
            calculateTotalCost();
        }

        function decrementQuantity() {
            var quantityInput = document.getElementById('quantityInput');
            var currentQuantity = parseInt(quantityInput.value) || 1;
            quantityInput.value = currentQuantity > 1 ? currentQuantity - 1 : 1;
            calculateTotalCost();
        }

        function calculateTotalCost() {
            const qtyInput = document.getElementsByName('qty')[0];
            const itemCostInput = document.getElementsByName('item_cost')[0];
            const qty = parseFloat(qtyInput.value) || 0;
            const itemCost = parseFloat(itemCostInput.value.replace(/[^\d.]/g, '')) || 0;
            const totalCost = qty * itemCost;
            const formattedTotalCost = totalCost.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Modified line
            document.getElementsByName('total_cost')[0].value = formattedTotalCost;
        }

        function validateQuantity(input, allowDecimal) {
            if (allowDecimal) {
                // Allow only numbers and one decimal point
                input.value = input.value.replace(/[^0-9.]/g, '');
                if ((input.value.match(/\./g) || []).length > 1) {
                    input.value = input.value.replace(/\.+$/, "");
                }
            } else {
                // Only allow whole numbers
                input.value = input.value.replace(/[^0-9]/g, '');
            }
        }
    </script>

    @if(request()->routeIs(['selectItems']))
        <script>
            var purposeId = "{{ request('purpose_Id') }}"; // Retrieving purpose_Id from the request
            var allCartRoute = "{{ route('getcartitemListRead', ['purpose_Id' => ':purpose_Id']) }}"
                .replace(':purpose_Id', purposeId);
        </script>
    @endif

    <script>
        var reqDeleteRoute = "{{ route('itemreqDelete', ['id' => ':id']) }}";
    </script>

    <script>
        // Preview and validate the selected PDF file
        function previewFile(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.type !== "application/pdf") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File',
                        text: 'Only PDF files are allowed.',
                    });
                    clearFile();
                    return;
                }
                document.getElementById('fileNameDisplay').innerText = file.name;
            }
        }
        // Clear the selected file
        function clearFile() {
            document.getElementById('editpdflayout').value = '';
            document.getElementById('fileNameDisplay').innerText = 'No selected file -';
        }
        // Drag and Drop functionality (PDF only)
        const dropZone = document.getElementById('dropZone');
        dropZone.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropZone.style.backgroundColor = '#f0f8ff';
        });

        dropZone.addEventListener('dragleave', (event) => {
            event.preventDefault();
            dropZone.style.backgroundColor = 'white';
        });

        dropZone.addEventListener('drop', (event) => {
            event.preventDefault();
            dropZone.style.backgroundColor = 'white';

            const files = event.dataTransfer.files;
            if (files.length > 0) {
                const file = files[0];
                if (file.type !== "application/pdf") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File',
                        text: 'Only PDF files are allowed.',
                    });
                    return;
                }
                document.getElementById('editpdflayout').files = files;
                previewFile({ target: document.getElementById('editpdflayout') });
            }
        });
        document.getElementById('editpdflayout').addEventListener('change', previewFile);
    </script>

    <script>
        // Preview and validate the selected PDF file
        function previewFilePPMP(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.type !== "application/pdf") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File',
                        text: 'Only PDF files are allowed.',
                    });
                    clearFilePPMP();
                    return;
                }
                document.getElementById('fileNamePPMPDisplay').innerText = file.name;
            }
        }
        // Clear the selected file
        function clearFilePPMP() {
            document.getElementById('editpdfppmp').value = '';
            document.getElementById('fileNamePPMPDisplay').innerText = 'No selected file -';
        }
        // Drag and Drop functionality (PDF only)
        const dropZonePPMP = document.getElementById('dropZonePPMP');
        dropZonePPMP.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropZonePPMP.style.backgroundColor = '#f0f8ff';
        });

        dropZonePPMP.addEventListener('dragleave', (event) => {
            event.preventDefault();
            dropZonePPMP.style.backgroundColor = 'white';
        });

        dropZonePPMP.addEventListener('drop', (event) => {
            event.preventDefault();
            dropZonePPMP.style.backgroundColor = 'white';

            const files = event.dataTransfer.files;
            if (files.length > 0) {
                const file = files[0];
                if (file.type !== "application/pdf") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File',
                        text: 'Only PDF files are allowed.',
                    });
                    return;
                }
                document.getElementById('editpdfppmp').files = files;
                previewFilePPMP({ target: document.getElementById('editpdfppmp') });
            }
        });
        document.getElementById('editpdfppmp').addEventListener('change', previewFilePPMP);
    </script>
@endsection
