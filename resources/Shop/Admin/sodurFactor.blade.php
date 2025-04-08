@extends('Admin.Layout.master')

@section('content')

    <section class=" space-y-3 relative">
        <article class="space-y-5 bg-F1F1F1 p-3 ">

            <article class="flex justify-between items-center">
                <div class="flex items-center space-x-reverse space-x-2 w-1/2">
                    <img src="{{asset("capsule/images/blue-user.svg")}}" alt="">
                    <div class="flex items-center space-x-2 space-x-reverse">
                        <h1 class="font-bold text-sm sm:tetx-base">نام مشتری:</h1>
                        <span class="text-sm sm:tetx-base">حسین آجرلو</span>
                    </div>

                </div>
                <div class="flex items-center justify-end space-x-reverse  space-x-2 w-1/2">
                    <h1 class="font-bold text-sm sm:tetx-base">تاریخ:</h1>
                    <span class="text-sm sm:tetx-base">1403/12/20</span>
                </div>
            </article>
        </article>
        <article class="space-y-5 bg-F1F1F1 p-3 ">
            <article class="flex justify-between items-center">
                <div class="flex items-center space-x-reverse space-x-2">
                    <img src="{{asset("capsule/images/plus.svg")}}" alt="" class="plus cursor-pointer">
                    <h1 class="font-medium w-44">اقلام فاکتور</h1>
                </div>
                <div class="flex items-center space-x-reverse space-x-2">
                    <h1 class="font-bold text-sm sm:tetx-base">شماره فاکتور:</h1>
                    <span class="text-sm sm:tetx-base">12587</span>
                </div>
            </article>
            <form action="{{route('hossein.back')}}" method="post" class="w-full">
                @csrf

                <table class="border-collapse  border border-gray-400 w-full table-fixed">
                    <thead class="bg-2081F2">
                    <tr>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>سفارش</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white max-w-max">
                            <span>تعداد</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span class="text-min sm:text-sm text-nowrap">قیمت واحد</span>
                            <span class="text-[11px]">(ریال)</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span class="text-min sm:text-sm text-nowrap">قیمت کل</span>
                            <span class="text-[11px]">(ریال)</span>
                        </th>

                    </tr>

                    </thead>
                    <tbody>
                    <tr>

                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                شارژ کپسول 2 کیلوئی
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                2
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                3،250،000
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full  ">
                                6،500،000

                            </p>
                        </td>


                    </tr>
                    <tr>

                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                شارژ کپسول 2 کیلوئی
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                2
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                3،250،000
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full  ">
                                6،500،000

                            </p>
                        </td>


                    </tr>
                    <tr>

                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                شارژ کپسول 2 کیلوئی
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                2
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                3،250،000
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full  ">
                                6،500،000

                            </p>
                        </td>


                    </tr>
                    <tr>

                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                شارژ کپسول 2 کیلوئی
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                2
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                3،250،000
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full  ">
                                6،500،000

                            </p>
                        </td>


                    </tr>
                    <tr>

                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                2
                            </p>
                        </td>
                        <td colspan="2" class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                جمع کل :19،500،000
                            </p>
                        </td>


                    </tr>

                    </tbody>
                </table>
                <section class="flex items-center justify-center space-x-reverse space-x-3 p-5">
                    <div class="bg-268832 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                        <button>صدور فاکتورنهایی</button>
                    </div>
                    <div class="bg-2081F2 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                        <button>صدور و پرینت</button>
                    </div>
                </section>
            </form>


        </article>

        <article class="circle-page invisible absolute w-full h-full top-0 bg-black/65 transition-all duration-300">
            <div
                class="absolute  top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] shadow bg-white p-2 rounded-md w-11/12">
                <div class="flex items-center justify-between">
                    <h1 class="p-1 font-bold">
                        لیست کالاها و خدمات :
                    </h1>
                    <img src="{{asset("capsule/images/close.svg")}}" alt="" class="close-page">
                </div>
                <div class="flex items-center justify-between">
                    <h1 class="p-1 font-bold">
                        نام کالا و خدمات :
                    </h1>
                    <select class="search-tags w-2/3" multiple="multiple">
                        <option value="hossein" data-price="10000">hossein</option>
                        <option value="satia" data-price="20000">satia</option>
                        <option value="test" data-price="30000">test</option>
                        <option value="pride" data-price="40000">pride</option>
                        <option value="test" data-price="50000">test</option>
                        <option value="gol" data-price="60000">gol</option>


                    </select>

                </div>
                <div class="flex items-center justify-between mt-5">
                    <table class="border-collapse  border border-gray-400 w-full table-fixed">
                        <thead class="bg-2081F2">
                        <tr>
                            <th class=" text-sm font-light px-2 leading-6 text-white ">
                                <span> سفارش</span>
                            </th>
                            <th class=" text-sm font-light px-2 leading-6 text-white max-w-max">
                                <span>تعداد</span>
                            </th>
                            <th class=" text-sm font-light px-2 leading-6 text-white max-w-max">
                                <span>قیمت کل (ریال)</span>
                            </th>

                        </tr>

                        </thead>
                        <tbody id="tbody">


                        </tbody>
                    </table>


                </div>
                <section class="flex items-center  space-x-reverse space-x-3 p-5">
                    <div class="bg-268832 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                        <button class="cursor-pointer px-4" onclick="changeInput()">اعمال تغییر</button>
                    </div>
                    <div class="bg-268832 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                        <button class="cursor-pointer px-4" onclick="saveAndCloseModal()">ذخیره</button>
                    </div>

                </section>
            </div>


        </article>
    </section>

@endsection
@section('script')

    <script>
        let plusBtn = document.querySelector('.plus');
        let closePage = document.querySelector('.close-page');
        let circle = document.querySelector('.circle-page');
        let elementAppend = [];
        let selectedItems = []; // Array to store selected items

        function openModal() {
            circle.style.clipPath = 'circle(100% at center)';
            circle.style.visibility = 'visible';
            circle.classList.remove('invisible');

            // Pre-select items in select2 that are already in the table
            let tbody = document.getElementById('tbody');
            let rows = tbody.getElementsByTagName('tr');
            selectedItems = []; // Reset selected items

            for (let i = 0; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName('td');
                if (cells.length >= 1) {
                    let itemName = cells[0].textContent.trim();
                    selectedItems.push(itemName);
                }
            }

            // Set the selected values in select2
            $('.search-tags').val(selectedItems).trigger('change');
        }

        function closeModal() {
            circle.style.clipPath = 'circle(0% at center)';
            circle.style.visibility = 'hidden';
            circle.classList.add('invisible');
        }

        // Remove old event listeners
        plusBtn.removeEventListener('click', openModal);
        closePage.removeEventListener('click', closeModal);
        circle.removeEventListener('click', function(e) {
            if (e.target === circle) {
                closeModal();
            }
        });

        // Add new event listeners
        plusBtn.addEventListener('click', openModal);
        closePage.addEventListener('click', closeModal);
        circle.addEventListener('click', function(e) {
            if (e.target === circle) {
                closeModal();
            }
        });

        let tagValue = [];
        $(".search-tags").select2({
            tags: true,
        }).on('change', function() {
            // Update selectedItems when select2 changes
            selectedItems = $(this).val();
        });

        function changeInput() {
            let tbody = document.getElementById('tbody');
            let dataAll = $('.search-tags').select2('data');
            let selectedValues = $('.search-tags').val() || [];

            // Remove rows for items that are no longer selected
            let existingRows = tbody.getElementsByTagName('tr');
            for (let i = existingRows.length - 1; i >= 0; i--) {
                let row = existingRows[i];
                let cells = row.getElementsByTagName('td');
                if (cells.length >= 1) {
                    let productInput = cells[0].querySelector('input[name="product[]"]');
                    if (productInput && !selectedValues.includes(productInput.value)) {
                        row.remove();
                    }
                }
            }

            // Add new rows for newly selected items
            for (const data of dataAll) {
                // Check if the item is already in the table
                let isDuplicate = false;
                let existingRows = tbody.getElementsByTagName('tr');

                for (let i = 0; i < existingRows.length; i++) {
                    let cells = existingRows[i].getElementsByTagName('td');
                    if (cells.length >= 1) {
                        let productInput = cells[0].querySelector('input[name="product[]"]');
                        if (productInput && productInput.value === data.id) {
                            isDuplicate = true;
                            break;
                        }
                    }
                }

                // Only add the item if it's not already in the table
                if (!isDuplicate) {
                    let row = document.createElement('tr')
                    let tdOne = document.createElement('td');
                    tdOne.classList.add("border", 'border-gray-400', 'text-center', 'p-1');
                    tdOne.classList.add("border");
                    tdOne.classList.add("border");
                    tdOne.classList.add("border");

                    tdOne.innerHTML = `
                                    <input type="hidden" name="product[]" value="${data.id}">
                                 <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full border rounded-md border-2 border-black/40">
                                    ${data.id}
                                </p>`;
                    let tdTwo = document.createElement('td');

                    tdTwo.classList.add('border', 'border-gray-400', 'text-center', 'p-1')
                    tdTwo.innerHTML = `<div class=" flex items-center justify-center space-x-reverse space-x-1">
                                    <img src="{{asset('capsule/images/plus.svg')}}" alt=""
                                         class="w-[10px] h-[10px] text-center sm:w-5 sm:h-5 cursor-pointer plus">
                                        <input type="number" name="count[]" min="1" value="1"
                                           class="text-center w-full border rounded-md border-2 border-black/40 w-[27px] sm:w-5/6">
                                    <img src="{{asset('capsule/images/circle-minus.svg')}}" alt=""
                                         class="w-[10px] h-[10px] sm:w-5 sm:h-5 cursor-pointer minus">
                                </div>`;
                    let tdThree = document.createElement('td');

                    tdThree.classList.add("border", 'border-gray-400', 'text-center', 'p-1');
                    tdThree.innerHTML = `
                                <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full border rounded-md border-2 border-black/40">
                                    ${data.element.getAttribute("data-price")}
                                </p>`;
                    row.append(tdOne);
                    row.append(tdTwo);
                    row.append(tdThree);
                    tbody.append(row);
                    elementAppend.push(data.id);
                    let minusBtn = document.getElementsByClassName('minus');
                    let plusBtn = document.getElementsByClassName('plus');

                    for (const minus of minusBtn) {
                        minus.onclick = function () {
                            if (minus.previousElementSibling.value > 1) {
                                minus.previousElementSibling.value = +minus.previousElementSibling.value - 1;
                            }
                        }
                    }
                    for (const plus of plusBtn) {
                        plus.onclick = function () {
                            plus.nextElementSibling.value = +plus.nextElementSibling.value + 1;
                        }
                    }
                }
            }
        }

        function saveAndCloseModal() {
            // Add items to main table and calculate total
            addItemsToMainTable();
        }

        function addItemsToMainTable() {
            // Get the main table body
            let mainTableBody = document.querySelector('table tbody');
            let modalTableBody = document.getElementById('tbody');
            let rows = modalTableBody.getElementsByTagName('tr');

            // Calculate total
            let total = 0;
            let totalQuantity = 0;

            // Add each row from modal to main table
            for (let i = 0; i < rows.length; i++) {
                let row = rows[i];
                let cells = row.getElementsByTagName('td');

                if (cells.length >= 3) {
                    let itemName = cells[0].textContent.trim();
                    let quantity = parseInt(cells[1].querySelector('input[name="count[]"]').value);
                    let unitPrice = cells[2].textContent.trim().replace(/,/g, '');
                    let productId = cells[0].querySelector('input[name="product[]"]').value;

                    // Check if the item is already in the main table
                    let isDuplicate = false;
                    let existingRowIndex = -1;
                    let existingRows = mainTableBody.getElementsByTagName('tr');

                    for (let j = 0; j < existingRows.length - 1; j++) { // Exclude the last row (total row)
                        let existingCells = existingRows[j].getElementsByTagName('td');
                        if (existingCells.length >= 1) {
                            let existingItemName = existingCells[0].textContent.trim();
                            if (existingItemName === itemName) {
                                isDuplicate = true;
                                existingRowIndex = j;
                                break;
                            }
                        }
                    }

                    // Calculate total price for this item
                    let itemTotal = quantity * parseInt(unitPrice);

                    if (isDuplicate) {
                        // Update existing row
                        let existingRow = existingRows[existingRowIndex];
                        let existingCells = existingRow.getElementsByTagName('td');

                        // Update quantity
                        existingCells[1].innerHTML = `
                            <input type="hidden" name="product[]" value="${productId}">
                            <input type="hidden" name="count[]" value="${quantity}">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full">${quantity}</p>`;

                        // Update total price
                        existingCells[3].innerHTML = `<p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full">${itemTotal.toLocaleString()}</p>`;
                    } else {
                        // Add new row
                        total += itemTotal;
                        totalQuantity += quantity;

                        // Create new row for main table
                        let newRow = document.createElement('tr');

                        // Add item name
                        let nameCell = document.createElement('td');
                        nameCell.classList.add("border", "border-gray-400", "text-center", "p-1");
                        nameCell.innerHTML = `<p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full">${itemName}</p>`;
                        newRow.appendChild(nameCell);

                        // Add quantity with hidden inputs
                        let quantityCell = document.createElement('td');
                        quantityCell.classList.add("border", "border-gray-400", "text-center", "p-1");
                        quantityCell.innerHTML = `
                            <input type="hidden" name="product[]" value="${productId}">
                            <input type="hidden" name="count[]" value="${quantity}">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full">${quantity}</p>`;
                        newRow.appendChild(quantityCell);

                        // Add unit price
                        let unitPriceCell = document.createElement('td');
                        unitPriceCell.classList.add("border", "border-gray-400", "text-center", "p-1");
                        unitPriceCell.innerHTML = `<p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full">${parseInt(unitPrice).toLocaleString()}</p>`;
                        newRow.appendChild(unitPriceCell);

                        // Add total price
                        let totalPriceCell = document.createElement('td');
                        totalPriceCell.classList.add("border", "border-gray-400", "text-center", "p-1");
                        totalPriceCell.innerHTML = `<p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full">${itemTotal.toLocaleString()}</p>`;
                        newRow.appendChild(totalPriceCell);

                        // Insert before the last row (total row)
                        mainTableBody.insertBefore(newRow, mainTableBody.lastElementChild);
                    }
                }
            }

            // Recalculate total and total quantity from all rows in the main table
            total = 0;
            totalQuantity = 0;
            let allRows = mainTableBody.getElementsByTagName('tr');

            for (let i = 0; i < allRows.length - 1; i++) { // Exclude the last row (total row)
                let cells = allRows[i].getElementsByTagName('td');
                if (cells.length >= 4) {
                    let quantityInput = cells[1].querySelector('input[name="count[]"]');
                    let quantity = quantityInput ? parseInt(quantityInput.value) : parseInt(cells[1].textContent.trim());
                    let unitPrice = parseInt(cells[2].textContent.trim().replace(/,/g, ''));
                    let itemTotal = quantity * unitPrice;
                    totalQuantity += quantity;
                    total += itemTotal;
                }
            }

            // Update total in the last row
            let totalRow = mainTableBody.lastElementChild;
            let totalCell = totalRow.querySelector('td:last-child');
            if (totalCell) {
                totalCell.innerHTML = `<p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full">جمع کل: ${total.toLocaleString()}</p>`;
            }

            // Update total quantity in the last row
            let quantityCell = totalRow.querySelector('td:nth-child(2)');
            if (quantityCell) {
                quantityCell.innerHTML = `<p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full">${totalQuantity}</p>`;
            }

            // Close modal after adding items
            closeModal();
        }


    </script>
@endsection
