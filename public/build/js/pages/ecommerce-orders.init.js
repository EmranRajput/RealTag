// Basic Table
    new gridjs.Grid({
        columns: [
            {
                name: 'Title',
                sort: {
                    enabled: false
                },
                formatter: (cell) => gridjs.html(`<span class="fw-semibold">${cell}</span>`)
            },
            {
                name: 'Action',
                formatter: (cell) => gridjs.html(`<span class="fw-semibold">${cell}</span>`)
            },
            {
                name: 'Active Status',
                formatter: (cell) => gridjs.html(`<span class="fw-semibold">${cell}</span>`)
            }
        ],
        pagination: {
            limit: 7
        },
        sort: true,
        search: true,
         data = [
                '<?php foreach($agreements as $agreement): ?>'
                    ['<?= $agreement->title ?>', 'asd', 'aasd'],
                '<?php endforeach; ?>'
        ]
    }).render(document.getElementById("table-ecommerce-orders"));

    flatpickr('#order-date', {
        defaultDate: new Date(),
        dateFormat: "d M, Y",
    });
