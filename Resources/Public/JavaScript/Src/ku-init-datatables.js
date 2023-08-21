/**
 * Init datatables.
 */

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    const tables = document.querySelectorAll('.table-datatable');

    class KUdatatable {
        constructor(table) {
            this.datatable = table;
            this.initDatatable();
        }

        initDatatable() {
            /**
            * Check if Datatables plugin exist
            */
            if (typeof DataTable === 'undefined') {
                return;
            }

            /**
             * Init Datatables
             */
            this.datatable = new DataTable(this.datatable, {
                responsive: true, // Fold on mobile
                autoWidth: false, // calculate width on resize
                lengthChange: false, // Set table length before pagination
                order: [[parseInt(this.datatable.dataset.col, 10), this.datatable.dataset.sortorder]], // Get values from data-col and data-sortorder attributes
                language: {
                    url: getLang()
                }
            });
        }
    }

    /**
     * Assign datatables to tables
     */

    if (tables) {
        Array.from(tables).forEach((table) => {
            const tableEl = new KUdatatable(table);
        });
    }
});
